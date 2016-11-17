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
     * @param string $key
     * @param mixed  $value
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
    public function getAll()
    {
        return array_values($this->pocket->load());
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function has($value)
    {
        return in_array($value, $this->getAll(), true);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->pocket->load());
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getByKey($key)
    {
        return @$this->pocket->load()[$key];
    }

    /**
     * @param string $key
     */
    public function removeByKey($key)
    {
        $collection = $this->pocket->load();
        unset($collection[$key]);
        $this->pocket->save($collection);
    }
}
