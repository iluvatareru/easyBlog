<?php

namespace Classes\Console;

class ConfigGenerator extends AbstractConsole
{
    public function generate($argv)
    {
        $this->setConfig($argv[1], $argv[2]);
    }
}