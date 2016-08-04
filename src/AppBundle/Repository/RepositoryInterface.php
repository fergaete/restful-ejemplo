<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Collection\BaseCollection;

/**
 * Interface RepositoryInterface
 * @package AppBundle\Repository
 */
interface RepositoryInterface {

    /**
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return BaseCollection
     */
    public function findAll(array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param int $id
     * @return object|null
     */
    public function findById($id);
}