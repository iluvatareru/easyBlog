<?php

namespace Classes\Model;

use Classes\Data\AbstractData;
use Classes\Data\FactoryData;
use Classes\Event\EntryEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class BlogModel
{
    private $storage;
    private $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher = null)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->storage = AbstractData::create(storage);
    }

    public function getAllBlogPosts()
    {
        $entries = $this->storage->getAll('entry');

        return $entries;
    }

    public function enterEntry($entry_title, $entry_content)
    {
        $document = [ "entry_title" => $entry_title, "entry_content" => $entry_content ];

        $this->storage->insert('entry', $document);

        $this->eventDispatcher->dispatch('enter.entry', new EntryEvent());
    }
}