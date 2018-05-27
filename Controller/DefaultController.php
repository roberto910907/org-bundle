<?php

namespace SoftDevel\OrgBundle\Controller;

use SoftDevel\OrgBundle\Factory\ChartFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $chartFactory;

    /**
     * DefaultController Constructor.
     *
     * @param ChartFactory $chartFactory
     */
    public function __construct(ChartFactory $chartFactory)
    {
        $this->chartFactory = $chartFactory;
    }

    /**
     * @Route("/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $gantt = $this->chartFactory->create(TestGantt::class);

        $gantt->handleRequest($request);

        if ($gantt->isSubmitted()) {
            return $gantt->getResponse();
        }

        return $this->render('@Org/index.html.twig', [
            'cargo_chart' => ''
        ]);
    }
}
