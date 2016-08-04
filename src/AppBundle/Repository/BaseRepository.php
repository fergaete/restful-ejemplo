<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Collection\BaseCollection;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseRepository
 * @package AppBundle\Repository
 */
abstract class BaseRepository implements RepositoryInterface {

    /**
     * @var string
     */
    protected $entityName = '';

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $em) {
        $this->entityManager = $em;
    }

    /**
     * @param $id
     * @return object|null
     */
    public function findById($id) {
        $entity = $this->entityManager->getRepository($this->entityName)->find((int) $id);
        if($entity) {
            return $entity;
        }
    }

    /**
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return BaseCollection
     */
    public function findAll(array $orderBy = null, $limit = null, $offset = null) {
        return $this->entityManager->getRepository($this->entityName)->findBy(array(), $orderBy, $limit, $offset);
    }
}