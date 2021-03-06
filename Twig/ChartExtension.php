<?php

namespace SoftDevel\OrgChartBundle\Twig;

use SoftDevel\OrgChartBundle\Chart\AbstractChart;
use Twig_Environment;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 16/05/18 10:52 PM
 */
class ChartExtension extends \Twig_Extension
{
    private $twig;

    /**
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('org_chart_js', [$this, 'renderChartJs'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('org_chart_html', [$this, 'renderChartHtml'], ['is_safe' => ['html']]),
        ];
    }

    public function renderChartJs(AbstractChart $chart)
    {
        return $this->twig->render("@OrgChart/org_chart/chart.js.twig", [
            'chart' => $chart
        ]);
    }

    public function renderChartHtml(AbstractChart $chart)
    {
        return $this->twig->render("@OrgChart/org_chart/chart.html.twig", [
            'chart' => $chart
        ]);
    }

    public function getName()
    {
        return 'org_chart_extension';
    }
}