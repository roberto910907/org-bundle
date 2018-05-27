<?php

namespace SoftDevel\OrgBundle\Chart;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 16/05/18 10:39 PM
 */
abstract class AbstractChart implements ChartInterface
{
    /** @var EntityManager $entityManager */
    protected $entityManager;
    /** @var  Request $request */
    protected $request;
    protected $ajax = [];
    protected $config = [];
    protected $mapping = [];
    protected $editing = false;

    /**
     * @return array
     */
    public function getAjax(): array
    {
        return $this->ajax;
    }

    /**
     * @param array $ajax
     */
    public function setAjax(array $ajax)
    {
        $this->ajax = $ajax;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * @param array $mapping
     */
    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @return bool
     */
    public function isEditing(): bool
    {
        return $this->editing;
    }

    /**
     * @param bool $editing
     *
     * @return AbstractChart
     */
    public function setEditing($editing): AbstractChart
    {
        $this->editing = $editing;

        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     *
     * @return AbstractChart
     */
    public function setEntityManager($entityManager): AbstractChart
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    public function handleRequest(Request $request)
    {
        $this->request = $request;
        $this->editing = $request->query->get('editing');

        if ($this->editing) {
            $this->edit();
        }
    }

    public function edit()
    {
        $data = $this->request->request->all();
        $id = $data['ids'];

        $repository = $this->entityManager->getRepository($this->getEntity());
        $accessor = PropertyAccess::createPropertyAccessor();
        $entity = $repository->find($id);

        foreach ($this->mapping as $key => $field) {
            if ($key !== 'id') {
                if ($key == 'start_date') {
                    $value = new \DateTime($data[$id . '_' . $key]);
                } else {
                    $value = $data[$id . '_' . $key];
                }
                $accessor->setValue($entity, $this->mapping[$key], $value);
            }
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function getResponse()
    {
        $repository = $this->entityManager->getRepository($this->getEntity());
        $entities = $repository->findAll();
        $accessor = PropertyAccess::createPropertyAccessor();
        $data = [];

        foreach ($entities as $entity) {
            $data[] = [
                'id' => $accessor->getValue($entity, $this->mapping['id']),
                'text' => $accessor->getValue($entity, $this->mapping['text']),
                'title' => $accessor->getValue($entity, $this->mapping['title']),
                'img' => $accessor->getValue($entity, $this->mapping['img']),
                'parent' => $accessor->getValue($entity, $this->mapping['parent']),
                'server' => true
            ];
        }

        return new JsonResponse([
            'data' => $data
        ]);
    }

    public function isSubmitted()
    {
        return $this->request->isXmlHttpRequest();
    }
}