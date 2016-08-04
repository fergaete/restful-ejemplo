<?php
namespace RestBundle\Controller;

use AppBundle\Entity\Comentario;
use AppBundle\Entity\Collection\ComentarioCollection;
use AppBundle\Form\ComentarioType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ComentarioController
 * @package RestBundle\Controller
 */
class ComentarioController extends FOSRestController implements ClassResourceInterface {

    /**
     * @ApiDoc(
     *  resource    = true,
     *  description = "Listar Comentarios",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      204 = "Returned when successful",
     *      404 = "Not Found"
     *  },
     *  output      = "ComentarioCollection<AppBundle\Entity\Comentario>"
     * )
     * @Rest\View()
     *
     * @return ComentarioCollection
     */
    public function cgetAction() {
        return $this->view($this->get('app.repository.comentario')->findAll());
    }

    /**
     * @ApiDoc(
     *  resource    = true,
     *  description = "Detalle Comentario",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      204 = "Returned when successful",
     *      404 = "Not Found"
     *  },
     *  output = "AppBundle\Entity\Comentario"
     * )
     * @Rest\View()
     *
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id) {
        $comentario = $this->get('app.repository.comentario')->findById($id);
        if(!$comentario) {
            throw new NotFoundHttpException(sprintf('Comentario con id: %d no existe.', $id));
        }
        return $this->view($comentario);
    }

    /**
     * @ApiDoc(
     *  description = "Crear Comentario",
     *  input       = "AppBundle\Form\ComentarioType",
     *  statusCodes = {
     *      201 = "Returned when the Comentario is created",
     *      400 = "Bad Request",
     *      404 = "Not Found"
     *  }
     * )
     * @Rest\View()
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function cpostAction(Request $request) {
        return $this->processForm($request, new Comentario(), Request::METHOD_POST);
    }

    /**
     * @ApiDoc(
     *  description = "Actualizar Comentario",
     *  input       = "AppBundle\Form\Type\CodeudorType",
     *  statusCodes = {
     *      204 = "Returned when successful",
     *      400 = "Bad Request",
     *      404 = "Not Found"
     *  }
     * )
     * @Rest\View()
     * @param Request $request
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function putAction(Request $request, $id) {
        /** @var Comentario $comentario */
        $comentario = $this->get('app.repository.comentario')->findById($id);
        if(!$comentario) {
            throw new NotFoundHttpException(sprintf('Comentario con id:%d no existe.', $id));
        }
        return $this->processForm($request, $comentario, Request::METHOD_PUT);
    }

    /**
     * @ApiDoc(
     *  description = "Eliminar Comentario",
     *  input       = "AppBundle\Form\Type\CodeudorType",
     *  statusCodes = {
     *      204 = "Returned when successful",
     *      400 = "Bad Request",
     *      404 = "Not Found"
     *  }
     * )
     * @Rest\View()
     * @param Request $request
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction(Request $request, $id) {
        /** @var Comentario $comentario */
        $comentario = $this->get('app.repository.comentario')->findById($id);
        if(!$comentario) {
            throw new NotFoundHttpException(sprintf('Comentario con id:%d no existe.', $id));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($comentario);
        $em->flush();
        return $this->view(Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @param Comentario $comentario
     * @param string $method
     * @return \FOS\RestBundle\View\View
     */
    private function processForm(Request $request, Comentario $comentario, $method) {
        $form = $this->createForm('AppBundle\Form\ComentarioType', $comentario, array('method' => $method));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $entityManager = $this->get('doctrine.orm.default_entity_manager');
            $entityManager->persist($comentario);
            $entityManager->flush();
            $statusCode = ($method == Request::METHOD_PUT) ? Response::HTTP_NO_CONTENT : Response::HTTP_CREATED;
            return $this->redirectView($this->generateUrl('api_1_get_comentarios', array('id' => $comentario->getId())), $statusCode);
        }
        return $this->view($form, Response::HTTP_BAD_REQUEST);
    }
}