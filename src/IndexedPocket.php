<?php

namespace carlosV2\Pocket;

final class IndexedPocket
{
    /**
     * @var ValuePocket
     */
    private $pocket;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->pocket = new ValuePocket($path, []);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function add($key, $value)
    {
        $collection = $this->pocket->load();
        $collection[$key] = $value;
        $this->pocket->save($collection);
    }

    /**
     * @return mixed[]
     */
    public function getValues()
    {
        return array_values($this->pocket->load());
    }

    /**
     * @return mixed[]
     */
    public function getKeys()
    {
        return array_keys($this->pocket->load());
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function has($value)
    {
        return in_array($value, $this->getValues(), true);
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->pocket->load());
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function getByKey($key)
    {
        return @$this->pocket->load()[$key];
    }

    /**
     * @param mixed $key
     */
    public function removeByKey($key)
    {
        $collection = $this->pocket->load();
        unset($collection[$key]);
        $this->pocket->save($collection);
    }
}
