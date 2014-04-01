<?php

namespace Classes;

/**
 * This Classes has to generate Config.json file.
 */
class BlogConfig
{
    private $configFile = 'Config.json';
    private $config;
    private $allowedProperties = ['page_title', 'page_h1', 'charset'];

    public function __construct()
    {
        if (! file_exists('Config/'.$this->configFile)) {
            touch('Config/Config.json');
        }
    }

    private function saveFile()
    {
        $jsonConfig = json_encode($this->config);

        file_put_contents('Config/'.$this->configFile, $jsonConfig);
    }

    public function setConfig($property, $val)
    {
        if (! in_array($property, $this->allowedProperties)) {
            return false;
        }

        $this->config = $this->getConfig();

        $this->config[$property] = trim($val);
        $this->saveFile();
    }

    public function getConfig()
    {
        $configJson = file_get_contents('Config/'.$this->configFile);

        return json_decode($configJson, true);
    }
} 