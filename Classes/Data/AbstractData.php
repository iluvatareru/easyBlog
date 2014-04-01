<?php

namespace Classes\Data;

abstract class AbstractData
{
    /**
     * This can be file, table or collection
     */
    abstract function getAll($stack);

    abstract function insert($stack, $data);

    public static function create($storage)
    {
        $class = "Classes\\Data\\".$storage;
        return new $class;
    }
}