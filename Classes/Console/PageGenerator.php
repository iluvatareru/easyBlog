<?php

namespace Classes\Console;

use Classes\Event\EntryEvent;

class PageGenerator extends AbstractConsole
{
    public function generate($argv)
    {
        $this->eventDispatcher->dispatch('enter.entry', new EntryEvent());
    }
}