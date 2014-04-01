<?php

namespace Classes\Event;

use Symfony\Component\EventDispatcher\Event;
use Classes\BlogConfig;


class ConfigEvent extends Event
{
    protected $blogConfig;

    public function __construct(BlogConfig $blogConfig)
    {
        $this->blogConfig = $blogConfig;
    }

    public function getBlogConfig()
    {
        return $this->blogConfig;
    }
}