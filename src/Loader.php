<?php
namespace DevOp\Core\Config;

class Loader
{

    /**
     * @param string $filename
     * @throws \RuntimeException
     */
    public function __construct($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new \RuntimeException('Configuration file does not exist or not readable.');
        }
        require $filename;
    }
}
