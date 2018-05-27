<?php

namespace SoftDevel\OrgBundle\Chart;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 16/05/18 10:41 PM
 */
interface ChartInterface
{
    public function configure();

    public function getEntity();

    public function getName();
}