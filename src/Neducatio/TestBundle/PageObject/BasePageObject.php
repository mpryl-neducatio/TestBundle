<?php

namespace Neducatio\TestBundle\PageObject;

use \Behat\Mink\Element\DocumentElement;
use \Behat\Mink\Element\TraversableElement;

/**
 * Base page object
 */
abstract class BasePageObject
{
  protected $builder;
  protected $page;
  protected $proofSelectorVisibility = false;
  protected $parent;
  protected $subPageObjectsData = array();
  protected $subPageObjects;

  /**
   * Do sth.
   *
   * @param TraversableElement $page    Page used to instantiate PageObject
   * @param PageObjectBuilder  $builder Page object builder
   * @param BasePageObject     $parent  Subpage object parent
   */
  public function __construct(TraversableElement $page, PageObjectBuilder $builder, BasePageObject $parent = null)
  {
    $this->page = $page;
    $this->builder = $builder;
    $this->parent = $parent;
    $this->builder->getValidator($page)->validate($page, $this->proofSelector, $this->proofSelectorVisibility);
    $this->builder->getHarvester()->registerHooks($page, $this->proofSelector);
  }

  /**
   * Gets hook
   *
   * @param string  $key   Hook key
   * @param integer $place Index of given node (if exists many nodes with the same key)
   *
   * @return NodeElement
   */
  public function get($key, $place = 0)
  {
    return $this->builder->getHarvester()->get($key, $place);
  }

  /**
   * Get Awaiter from Builder
   *
   * @return PageAwaiter
   */
  public function getAwaiter()
  {
    return $this->builder->getAwaiter();
  }

//  /**
//   * get sub page objects
//   *
//   * @return array
//   */
//  public function getSubPages()
//  {
//    return $this->subPageObjects;
//  }

  /**
   * Get parent
   *
   * @return BasePageObject
   */
  public function getParent()
  {
    return $this->parent;
  }
}
