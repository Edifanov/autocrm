<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table("mark")
 * @ORM\Entity
 */
class Mark
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name",type="string",length=60)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="class",type="string",length=60)
     * @var string
     */
    protected $class;

    /**
     * @ORM\Column(name="model",type="string",length=60)
     * @var string
     */
    protected $model;

    /**
     * @ORM\ManyToOne(targetEntity="Rate")
     * @var Rate
     */
    protected $rate;

    /**
     * @ORM\Column(name="places",type="integer",length=11)
     * @var integer
     */
    protected $places;

    /**
     * @ORM\Column(name="year_of_issue",type="integer",length=4)
     * @var integer
     */
    protected $yearOfIssue;

    /**
     * @ORM\Column(name="engine_capacity", type="float")
     * @var float
     */
    protected $engineCapacity;
}