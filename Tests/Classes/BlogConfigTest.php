<?php

namespace Classes;

include('Classes/BlogConfig.php');

class BlogConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers  Classes\BlogConfig::getConfig
     */
    public function testConfigFileShouldBeArray()
    {
        $blogConfigObject = new BlogConfig();

        $this->assertInternalType('array', $blogConfigObject->getConfig());

        return $blogConfigObject;
    }

    /**
     * @covers Classes\BlogConfig::setConfig
     * @depends testConfigFileShouldBeArray
     */
    public function testSetConfig($blogConfigObject)
    {
        $blogConfigObject->setConfig("charset", "utf-8");

        $configArray = $blogConfigObject->getConfig();

        $this->assertEquals($configArray["charset"], "utf-8");
    }

    /**
     * @covers Classes\BlogConfig::setConfig
     * @depends testConfigFileShouldBeArray
     */
    public function testSetConfigWithWrongPropertyShouldReturnFalse($blogConfigObject)
    {
        $this->assertEquals($blogConfigObject->setConfig("h231", "TestH231"), false);
    }

}