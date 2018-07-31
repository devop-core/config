<?php
namespace DevOp\Core;

class Config
{

    /**
     * @var mixed
     */
    private $container = [];

    /**
     * @param mixed $resources
     * @param string|null $environment
     * @param array|null $params
     */
    public function __construct($resources, $environment = null, array $params = [])
    {
        $this->load($resources, $environment, $params);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        return isset($this->container[$name]);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if ($this->has($name)) {
            return $this->container[$name];
        }

        return $default;
    }

    /**
     * @param string $name
     * @param mixed $args
     */
    public function set($name, $args)
    {
        $this->container[$name] = $args;

        return $this;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->container;
    }

    /**
     * @param mixed $resources
     * @param string|null $environment
     * @param array $params
     * @return Config
     */
    public static function init($resources, $environment = null, array $params = [])
    {
        return new Config($resources, $environment, $params);
    }
    
    /**
     * @param mixed $resources
     * @param string|null $environment
     * @param array $params
     * @throws \RuntimeException
     */
    public function load($resources, $environment = null, array $params = [])
    {

        if (is_array($resources)) {
            $data = $this->loadFromArray($resources, $environment);
        } else if (file_exists($resources)) {
            $data = $this->loadFromArray([$resources], $environment);
        } else {
            throw new \RuntimeException('Invalid configuration source defined.');
        }

        $this->container = array_replace_recursive($data, $params);
    }

    /**
     * @param array $resources
     * @param string|null $environment
     * @return mixed
     * @throws \InvalidArgumentException
     */
    private function loadFromArray(array $resources = [], $environment = null)
    {
        $data = [];

        foreach ($resources AS $resource) {
            
            if (!file_exists($resource)) {
                throw new \InvalidArgumentException("Invalid resource {$resource}");
            }

            $data = array_replace_recursive($data, include $resource);

            if (null === $environment) {
                continue;
            }

            $pathinfo = pathinfo($resource);
            $filename = "{$pathinfo['filename']}_{$environment}.{$pathinfo['extension']}";

            if (file_exists($filename)) {
                $data = array_replace_recursive($data, include $filename);
            }
        }

        return $data;
    }
}
