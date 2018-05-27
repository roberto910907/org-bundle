<?php

namespace SoftDevel\OrgChartBundle\Factory;

use SoftDevel\OrgChartBundle\Chart\AbstractChart;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 27/05/18 01:33 PM
 */
interface ChartFactoryInterface
{
    /**
     * Create a new AbstractChart instance
     *
     * @param string $className
     *
     * @return AbstractChart
     */
    public function create($className);
}