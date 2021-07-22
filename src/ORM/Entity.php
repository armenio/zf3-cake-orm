<?php

/**
 * @author Rafael Armenio <rafael.armenio@gmail.com>
 *
 * @link http://github.com/armenio
 */

namespace Armenio\Cake\ORM;

use Cake\ORM\Entity as VendorEntity;
use JeremyHarris\LazyLoad\ORM\LazyLoadEntityTrait;

/**
 * Class Entity
 *
 * @package Armenio\Cake\ORM
 */
class Entity extends VendorEntity
{
    use LazyLoadEntityTrait;
}
