<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comentario
 * @package AppBundle\Entity
 * @ORM\Table(name="comentario", indexes={@ORM\Index(name="comentario_id_post_idx", columns={"id_post"})})
 * @ORM\Entity
 */
class Comentario {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=20, nullable=false)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=false)
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado_at", type="datetime", nullable=false)
     */
    private $creadoAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_post", referencedColumnName="id")
     * })
     */
    private $post;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = (int) $id;
    }

    /**
     * @return string
     */
    public function getAutor() {
        return $this->autor;
    }

    /**
     * @param string $autor
     */
    public function setAutor($autor) {
        $this->autor = (string) $autor;
    }

    /**
     * @return string
     */
    public function getContenido() {
        return $this->contenido;
    }

    /**
     * @param string $contenido
     */
    public function setContenido($contenido) {
        $this->contenido = (string) $contenido;
    }

    /**
     * @return \DateTime
     */
    public function getCreadoAt() {
        return $this->creadoAt;
    }

    /**
     * @param \DateTime $creadoAt
     */
    public function setCreadoAt(\DateTime $creadoAt) {
        $this->creadoAt = $creadoAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Post
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post) {
        $this->post = $post;
    }
}
