<?php
namespace RestBundle\Controller;

use AppBundle\Entity\Collection\PostCollection;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PostController
 * @package RestBundle\Controller
 */
class PostController extends FOSRestController implements ClassResourceInterface {

    /**
     * @ApiDoc(
     *  resource    = true,
     *  description = "Listar Posts",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Not Found"
     *  },
     *  output      = "PostCollection<AppBundle\Entity\Post>"
     * )
     * @Rest\View()
     * @return PostCollection
     */
    public function cgetAction() {
        return $this->view($this->get('app.repository.post')->findAll());
    }

}