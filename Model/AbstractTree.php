<?php

namespace SoftDevel\OrgChartBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Tree\Traits\NestedSetEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 27/05/18 07:36 PM
 */
abstract class AbstractTree
{
    use NestedSetEntity;

    /**
     * @Gedmo\TreeParent
     *
     * @ORM\ManyToOne(targetEntity="SoftDevel\OrgChartBundle\Model\AbtractTree", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="SoftDevel\OrgChartBundle\Model\AbtractTree", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $childrens;

    /**
     * @return int
     */
    public function getRoot(): int
    {
        return $this->root;
    }

    /**
     * @param int $root
     *
     * @return TreeTrait
     */
    public function setRoot(int $root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     *
     * @return TreeTrait
     */
    public function setLevel(int $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * @param int $left
     *
     * @return TreeTrait
     */
    public function setLeft(int $left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * @return int
     */
    public function getRight(): int
    {
        return $this->right;
    }

    /**
     * @param int $right
     *
     * @return TreeTrait
     */
    public function setRight(int $right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChildrens()
    {
        return $this->childrens;
    }

    /**
     * @param mixed $childrens
     */
    public function setChildrens($childrens)
    {
        $this->childrens = $childrens;

        return $this;
    }
}