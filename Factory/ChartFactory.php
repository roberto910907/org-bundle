<?php

namespace SoftDevel\OrgChartBundle\Factory;

use Doctrine\ORM\EntityManager;
use SoftDevel\OrgChartBundle\Chart\AbstractChart;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 16/05/18 10:49 PM
 */
class ChartFactory implements ChartFactoryInterface
{
    private $entityManager;

    /**
     * ChartFactory constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($className)
    {
        /** @var AbstractChart $chart */
        $chart = (new $className);
        $chart
            ->setEntityManager($this->entityManager)
            ->configure();

        return $chart;
    }
}