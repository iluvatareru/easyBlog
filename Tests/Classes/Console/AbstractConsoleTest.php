<?php

namespace Tests\Classes\Console;

require_once 'vendor/autoload.php';

include('Classes/Console/AbstractConsole.php');
include('Classes/Console/PageGenerator.php');
include('Classes/Console/ConfigGenerator.php');
include('Classes/Console/Console.php');

use Classes\Console\AbstractConsole;

use Symfony\Component\EventDispatcher\EventDispatcher;

class AbstractConsoleTest extends \PhpUnit_Framework_TestCase
{
    public function testCreate()
    {
        $dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcher');

        $dispatcher->expects($this->any())
            ->method('getListeners')
            ->will($this->returnValue('foo'));

        $console = AbstractConsole::create(0, 'asdasda', $dispatcher);
        $consolePageGenerator = AbstractConsole::create(2, ['1' => 'save'], $dispatcher);
        $consoleConfigGenerator = AbstractConsole::create(2, 'adsads', $dispatcher);

        $this->assertInstanceOf('Classes\Console\Console', $console);
        $this->assertInstanceOf('Classes\Console\PageGenerator', $consolePageGenerator);
        $this->assertInstanceOf('Classes\Console\ConfigGenerator', $consoleConfigGenerator);
    }
}