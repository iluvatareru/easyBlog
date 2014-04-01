<?php

require_once 'vendor/autoload.php';

define('storage', 'EasyBlogMongoDb');

include_once("Classes/BlogConfig.php");
include_once("Classes/BlogPage.php");
include_once("Classes/Console/AbstractConsole.php");
include_once("Classes/Console/Console.php");
include_once("Classes/Console/ConfigGenerator.php");
include_once("Classes/Console/PageGenerator.php");
include_once("Classes/Console/SymfonyGenerator.php");
include_once("Classes/Console/SymfonyCommand.php");
include_once("Classes/Data/AbstractData.php");
require_once("Classes/Data/EasyBlogMongoDb.php");
require_once("Classes/Data/File.php");
include_once("Classes/Model/BlogModel.php");
include_once("Classes/Event/ConfigEvent.php");
include_once("Classes/Event/EntryEvent.php");

use Classes\Console\AbstractConsole;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Classes\BlogPage;

$dispatcher = new EventDispatcher();

$blogPageListener = new BlogPage();
$dispatcher->addListener('set.config', array($blogPageListener, 'generatePage'));
$dispatcher->addListener('enter.entry', array($blogPageListener, 'generatePage'));

$console = AbstractConsole::create($argc, $argv, $dispatcher);
$console->generate($argv);