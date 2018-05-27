<?php

namespace SoftDevel\OrgBundle\TestChart;

use SoftDevel\OrgBundle\Chart\AbstractChart;

class TestOrgChart extends AbstractChart
{
    public function configure()
    {
        $this->setAjax([
            'route_list' => 'test_index',
            'route_new' => 'test_new',
            'route_edit' => 'test_edit',
            'route_delete' => 'test_delete',
        ]);

        $this->setConfig([
            'date_grid' => "%d.%m.%Y",
            'step' => 1,
            'scale_unit' => 'day'
        ]);

        $this->setMapping([
            'id' => 'id',
            'text' => 'name',
            'start_date' => 'startAt',
            'duration' => 'duration',
            'progress' => 'advanced'
        ]);

        return $this;
    }

    public function getEntity()
    {
        return Test::class;
    }

    public function getName()
    {
        return "test_chart";
    }
}