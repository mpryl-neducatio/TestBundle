<?php

namespace Neducatio\TestBundle\PageObject;

use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Element\DocumentElement;
use Neducatio\TestBundle\Utility\DocumentElementValidator;
use Neducatio\TestBundle\Utility\NodeElementValidator;
use Neducatio\TestBundle\Utility\HookHarvester;
use Neducatio\TestBundle\Utility\Awaiter\PageAwaiter;

/**
 * Page and subpage object builder
 */
class PageObjectBuilder
{
  private $nodeValidator;
  private $documentValidator;
  private $harvester;
  private $awaiter;

  /**
   * Creates dependencies
   */
  public function __construct()
  {
    $this->nodeValidator = new NodeElementValidator();
    $this->documentValidator = new DocumentElementValidator();
    $this->harvester = new HookHarvester();
    $this->awaiter = new PageAwaiter();
  }

  /**
   * Builds
   *
   * @param string          $page    Page
   * @param DocumentElement $element Document element
   *
   * @return instance of page
   */
  public function build($page, TraversableElement $element)
  {
    $this->awaiter->setPage($element);

    return new $page($element, $this);
  }

  /**
   * Gets validator
   * 
   * @param TraversableElement $page Validator for given page type will be returned
   *
   * @return TraversableElementValidator
   */
  public function getValidator(TraversableElement $page)
  {
    if ($page instanceof NodeElement) {

        return $this->nodeValidator;
    }

    return $this->documentValidator;
  }

  /**
   * Gets harvester
   *
   * @return HookHarvester
   */
  public function getHarvester()
  {
    return $this->harvester;
  }

  /**
   * Gets awaiter
   *
   * @return PageAwaiter
   */
  public function getAwaiter()
  {
    return $this->awaiter;
  }
}
