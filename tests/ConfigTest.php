<?php
namespace DevOp\Core\Test;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var mixed
     */
    private $config = [];

    /**
     * @var mixed
     */
    private $params = [];

    public function setUp()
    {
        $this->config = [
            'app' => [
                'name' => 'Config Manager'
            ],
            'database' => [
                'hostname' => '{DB_HOSTNAME}',
                'username' => '{DB_USERNAME}',
                'password' => '{DB_PASSWORD}',
                'dbname' => '{DB_NAME}'
            ]
        ];

        $this->params = [
            'DB_HOSTNAME' => 'localhost',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => 's3cr3t',
            'DB_NAME' => 'test',
        ];
    }

    public function testLoadConfiguration()
    {
        $config = new \DevOp\Core\Config($this->config, 'dev', $this->params);
        $this->assertInstanceOf('\DevOp\Core\Config', $config);
    }
    
    public function testSetAndGet()
    {
        $config = new \DevOp\Core\Config($this->config);
        $config->set('test_set', 'test_set');
        $this->assertEquals('test_set', $config->get('test_set'));
    }
    
    public function testInvalidConfiguration()
    {
        $this->setExpectedException(\RuntimeException::class);
        new \DevOp\Core\Config('invaid_configuration_file.php');
    }
}
