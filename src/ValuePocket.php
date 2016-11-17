<?php

namespace carlosV2\Pocket;

use Symfony\Component\Filesystem\Filesystem;

final class ValuePocket
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var mixed
     */
    private $defaultValue;

    /**
     * @var mixed
     */
    private $cache;

    /**
     * @param string $path
     * @param mixed  $defaultValue
     */
    public function __construct($path, $defaultValue = null)
    {
        $this->path = $path;
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return mixed
     */
    public function load()
    {
        if (is_null($this->cache)) {
            $this->cache = file_exists($this->path) ? unserialize(file_get_contents($this->path)) : $this->defaultValue;
        }

        return $this->cache;
    }

    /**
     * @param mixed $value
     */
    public function save($value)
    {
        $this->cache = $value;

        (new Filesystem())->mkdir(dirname($this->path));
        file_put_contents($this->path, serialize($value));
    }
}
