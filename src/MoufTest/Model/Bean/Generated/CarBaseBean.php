<?php
namespace MoufTest\Model\Bean\Generated;

use Mouf\Database\TDBM\ResultIterator;
use Mouf\Database\TDBM\ResultArray;
use Mouf\Database\TDBM\AlterableResultIterator;
use MoufTest\Model\Bean\BrandBean;
use Mouf\Database\TDBM\AbstractTDBMObject;

/*
 * This file has been automatically generated by TDBM.
 * DO NOT edit this file, as it might be overwritten.
 * If you need to perform changes, edit the CarBean class instead!
 */

/**
 * The CarBaseBean class maps the 'cars' table in database.
 */
class CarBaseBean extends AbstractTDBMObject implements \JsonSerializable
{
    /**
     * The constructor takes all compulsory arguments.
     *
     * @param BrandBean $brand
     * @param string $name
     * @param int $maxSpeed
     */
    public function __construct(BrandBean $brand, $name, $maxSpeed) {
        parent::__construct();
        $this->setBrand($brand);
        $this->setName($name);
        $this->setMaxSpeed($maxSpeed);
    }
        /**
     * The getter for the "id" column.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->get('id', 'cars');
    }

    /**
     * The setter for the "id" column.
     *
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->set('id', $id, 'cars');
    }

    /**
     * Returns the BrandBean object bound to this object via the brand_id column.
     *
     * @return BrandBean
     */
    public function getBrand() {
        return $this->getRef('cars_ibfk_1', 'cars');
    }

    /**
     * The setter for the BrandBean object bound to this object via the brand_id column.
     *
     * @param BrandBean $object
     */
    public function setBrand(BrandBean $object = null) {
        $this->setRef('cars_ibfk_1', $object, 'cars');
    }

    /**
     * The getter for the "name" column.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->get('name', 'cars');
    }

    /**
     * The setter for the "name" column.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->set('name', $name, 'cars');
    }

    /**
     * The getter for the "max_speed" column.
     *
     * @return int
     */
    public function getMaxSpeed() : int
    {
        return $this->get('max_speed', 'cars');
    }

    /**
     * The setter for the "max_speed" column.
     *
     * @param int $max_speed
     */
    public function setMaxSpeed(int $max_speed)
    {
        $this->set('max_speed', $max_speed, 'cars');
    }


    /**
     * Serializes the object for JSON encoding
     *
     * @param bool $stopRecursion Parameter used internally by TDBM to stop embedded objects from embedding other objects.
     * @return array
     */
    public function jsonSerialize($stopRecursion = false)
    {
        $array = [];
        $array['id'] = $this->getId();
        if (!$stopRecursion) {
            $object = $this->getBrand();
            $array['brand'] = $object ? $object->jsonSerialize(true) : null;
        }
        $array['name'] = $this->getName();
        $array['maxSpeed'] = $this->getMaxSpeed();


        return $array;
    }

    /**
     * Returns an array of used tables by this bean (from parent to child relationship).
     *
     * @return string[]
     */
    protected function getUsedTables()
    {
        return [ 'cars' ];    
    }
}