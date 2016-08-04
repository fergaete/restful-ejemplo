<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Comentario;
use AppBundle\Form\ComentarioType;

/**
 * Comentario controller.
 * Class ComentarioController
 * @package AppBundle\Controller
 */
class ComentarioController extends Controller {

    /**
     * Lists all Comentario entities.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        return $this->render('AppBundle:Comentario:index.html.twig', array(
            'comentarios' => $this->get('app.repository.comentario')->findAll(),
        ));
    }

    /**
     * Creates a new Comentario entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request) {
        $comentario = new Comentario();
        $form = $this->createForm('AppBundle\Form\ComentarioType', $comentario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();
            return $this->redirectToRoute('comentario_show', array('id' => $comentario->getId()));
        }
        return $this->render('AppBundle:Comentario:new.html.twig', array(
            'comentario' => $comentario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comentario entity.
     * @param Comentario $comentario
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Comentario $comentario) {
        $deleteForm = $this->createDeleteForm($comentario);
        return $this->render('AppBundle:Comentario:show.html.twig', array(
            'comentario' => $comentario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comentario entity.
     * @param Request $request
     * @param Comentario $comentario
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Comentario $comentario) {
        $deleteForm = $this->createDeleteForm($comentario);
        $editForm = $this->createForm('AppBundle\Form\ComentarioType', $comentario);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();
            return $this->redirectToRoute('comentario_edit', array('id' => $comentario->getId()));
        }
        return $this->render('AppBundle:Comentario:edit.html.twig', array(
            'comentario' => $comentario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comentario entity.
     * @param Request $request
     * @param Comentario $comentario
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Comentario $comentario) {
        $form = $this->createDeleteForm($comentario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comentario);
            $em->flush();
        }
        return $this->redirectToRoute('comentario_index');
    }

    /**
     * Creates a form to delete a Comentario entity.
     * @param Comentario $comentario
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Comentario $comentario) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comentario_delete', array('id' => $comentario->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
