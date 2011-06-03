<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PonenteRepository extends EntityRepository
{
    public function findTodosAlfabeticamente()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p FROM Desymfony\DesymfonyBundle\Entity\Ponente p
                                    ORDER BY p.nombre ASC')
                    ->getResult();
    }
}