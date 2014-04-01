<?php

namespace Classes\Console;

use Classes\BlogConfig;
use Classes\Model\BlogModel;
use Classes\Event\ConfigEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class AbstractConsole
{
    protected $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    abstract public function generate($argv);

    public static function create($argc, $argv, $dispatcher)
    {
        if ($argc > 1 && $argv[1] == "save") {
            return new PageGenerator($dispatcher);
        } elseif ($argc > 1 && $argv[1] == "blog:generate") {
            return new SymfonyGenerator($dispatcher);
        } elseif ($argc > 1) {
            return new ConfigGenerator($dispatcher);
        } else {
            return new Console($dispatcher);
        }
    }

    protected function setConfig($property, $val)
    {
        $configObject = new BlogConfig();
        $configObject->setConfig($property, $val);

        /**
         * BUG: Events are not working properly with files... File content is still the same.
         */
        $this->eventDispatcher->dispatch('set.config', new ConfigEvent($configObject));
    }

    protected function enterEntity($entry_title, $entry_content)
    {
        $modelObject = new BlogModel($this->eventDispatcher);
        $modelObject->enterEntry($entry_title, $entry_content);
    }
}