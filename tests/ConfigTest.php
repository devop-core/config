<?php
namespace DevOp\Core\Test;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \DevOp\Core\Config
     */
    private $config;

    public function setUp()
    {
        $resource = __DIR__ . '/config/config.php';
        $this->config = \DevOp\Core\Config::init([$resource], 'prod', [
            'static_var' => 'static_value'
        ]);
    }

    public function testLoadConfig()
    {
        $config = \DevOp\Core\Config::init([__DIR__ . '/config/config.php']);
        $this->assertInstanceOf('\DevOp\Core\Config', $config);
    }
    
    public function testGet()
    {
        $this->assertEquals('value2', $this->config->get('conf2'));
    }

    public function testGetStaticValue()
    {
        $this->assertEquals('static_value', $this->config->get('static_var'));
    }

    public function testSet()
    {
        $this->config->set('conf1', 'new_value1');
        $this->assertEquals('new_value1', $this->config->get('conf1'));
    }

    public function testAll()
    {
        $this->assertNotEmpty($this->config->all());
    }
    
    public function testInvalidFileException()
    {
        $this->setExpectedException('\RuntimeException');
        \DevOp\Core\Config::init('test.php');
    }
}
