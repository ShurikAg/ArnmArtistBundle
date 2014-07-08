<?php
namespace Arnm\ArtistBundle\Model;

use Arnm\PagesBundle\Entity\Area;
use Arnm\PagesBundle\Entity\Page;
use Arnm\ConfigBundle\Model\ConfigImpl;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This class is responsible for configuration handling of artist module
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class Settings extends ConfigImpl
{

    /**
     * @var int
     */
    protected $inheritPage;

    /**
     * @var int
     */
    protected $replaceArea;

    /**
     * @var Page
     *
     * @Assert\NotBlank(message="Page to inherit from must be selected.")
	 * @Assert\Type(type="object", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $page;

    /**
     * @var Area
     *
     * @Assert\NotBlank(message="Are must be selected.")
	 * @Assert\Type(type="object", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $area;

    /**
     * @return int
     */
    public function getInheritPage()
    {
        if($this->page instanceof Page){
            return $this->page->getId();
        }

        return $this->inheritPage;
    }

    /**
     * @param int $inheritPage
     */
    public function setInheritPage($inheritPage)
    {
        $this->inheritPage = $inheritPage;
    }

    /**
     * @return string
     */
    public function getReplaceArea()
    {
        if($this->area instanceof Area){
            return $this->area->getCode();
        }

        return $this->replaceArea;
    }

    /**
     * @param int $replaceArea
     */
    public function setReplaceArea($replaceArea)
    {
        $this->replaceArea = $replaceArea;
    }

    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

	/**
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

	/**
     * @param Page $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

	/**
     * @param Area $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

	/**
     * {@inheritdoc}
     * @see Arnm\ConfigBundle\Model.ConfigInterface::getNamespace()
     */
    public function getNamespace()
    {
        return 'artist_settings';
    }
}
