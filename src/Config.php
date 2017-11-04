<?php
namespace DevOp\Core\Config;

class Config
{

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if ($this->has($name)) {
            return $this->data[$name];
        }
        return $default;
    }

    /**
     * @param string $name
     * @param mixed $args
     */
    public function set($name, $args)
    {
        $this->data[$name] = $args;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        return isset($this->data[$name]);
    }
}
