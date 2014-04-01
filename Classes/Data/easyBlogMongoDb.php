<?php

namespace Classes\Data;

class EasyBlogMongoDb extends AbstractData
{
    private $m;

    public function __construct()
    {
        $this->m = new \MongoClient();
    }

    public function getAll($collection)
    {
        $collection = $this->m->myblog->$collection;

        $cursor = $collection->find();

        return $cursor;
    }

    public function insert($collection, $document)
    {
        $collection = $this->m->myblog->$collection;

        $collection->insert($document);
    }
}