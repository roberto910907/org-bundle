<?php

namespace SoftDevel\OrgChartBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Tree\Traits\NestedSetEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @author  Roberto Rielo <roberto910907@gmail.com>.
 * @version OrgBundle v1.0 27/05/18 07:36 PM
 */
trait TreeTrait
{
    use NestedSetEntity;

    /**
     * @Gedmo\TreeParent
     *
     * @ORM\ManyToOne(targetEntity="TreeTrait", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="TreeTrait", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $childrens;
}