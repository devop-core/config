<?php
namespace DevOp\Core;

class Config
{

    /**
     * @var mixed
     */
    private static $data = [];

    /**
     * @var mixed
     */
    private static $values = [];

    /**
     * @param string|array $resource
     * @param string $environment
     * @param array|string|null $params
     */
    public function __construct($resource, $environment = '', $params = [])
    {
        self::$data = self::load($resource, $environment, $params);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        return isset(self::$data[$name]);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if ($this->has($name)) {
            return self::$data[$name];
        }

        return $default;
    }

    /**
     * @param string $name
     * @param mixed $args
     */
    public function set($name, $args)
    {
        self::$data[$name] = $args;

        return $this;
    }
    
    /**
     * 
     * @return mixed
     */
    public function all()
    {
        return self::$data;
    }

    /**
     * @param array|string $resource
     * @param string $environment
     * @param mixed $params
     * @return mixed
     * @throws \RuntimeException
     */
    public static function load($resource, $environment = '', $params = [])
    {

        if (is_string($resource) && !file_exists($resource)) {
            throw new \RuntimeException("Invalid configuration file <{$resource}>.");
        }

        if (is_array($params)) {
            $values = $params;
        } else if (file_exists($params)) {
            $values = self::load($params, $environment);
        } else if (!empty($params)) {
            throw new \RuntimeException("Invalid parameters file <{$params}>.");
        }

        if (!empty($values)) {
            foreach ($values AS $key => $value) {
                self::$values["{{$key}}"] = $value;
            }
        }

        if (is_array($resource)) {
            $config = array_replace_recursive(self::$data, $resource);
        } else {
            $config = array_replace_recursive(self::$data, include_once $resource);
        }

        if (!empty($environment) && is_string($resource) && false !== $pathinfo = pathinfo($resource)) {
            $filename = implode(DIRECTORY_SEPARATOR, [$pathinfo['dirname'], "{$pathinfo['filename']}_{$environment}.{$pathinfo['extension']}"]);
            if (file_exists($filename)) {
                $config = array_replace_recursive($config, include_once $filename);
            }
        }

        return self::transform($config);
    }

    /**
     * @param mixed $data
     * @param string $prefix
     * @return mixed
     */
    public static function transform($data, $prefix = '')
    {
        $values = [];
        foreach ($data AS $key => $value) {
            if (is_array($value)) {
                $values = array_merge($values, self::transform($value, "{$prefix}{$key}."));
            } else {
                $values["{$prefix}{$key}"] = isset(self::$values[$value]) ? self::$values[$value] : $value;
            }
        }
        return $values;
    }
}
