<?php

namespace Classes\Console;

use Symfony\Component\Console\Application;

class SymfonyGenerator extends AbstractConsole
{
    public function generate($argv)
    {
        $application = new Application();
        $application->add(new SymfonyCommand());
        $application->run();
    }
}