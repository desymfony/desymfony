<?php

namespace Desymfony\DesymfonyBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PonenciaRepository extends EntityRepository
{
    /**
     * Devuelve todas las ponencias del dia indicado
     *
     * @param string $dia Dia de las ponencias
     */
    public function findTodasDeFecha($fecha)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->add('select', 'p')
            ->add('from', 'DesymfonyBundle:Ponencia p ')
            ->add('where', 'p.fecha = :fecha')
            ->add('orderBy', 'p.fecha ASC')
            ->setParameter('fecha', new \DateTime($fecha), \Doctrine\DBAL\Types\Type::DATETIME);

            $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * Devuelve todas las ponencias ordenadas por fecha
     *
     */

    public function findTodasOrdFecha()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT p FROM Desymfony\DesymfonyBundle\Entity\Ponencia p
                                    ORDER BY p.fecha ASC')
                    ->getResult();
    }


}