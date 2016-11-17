<?php

namespace carlosV2\Pocket;

final class CollectionPocket
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
     * @param mixed $value
     */
    public function add($value)
    {
        $collection = $this->pocket->load();
        $collection[] = $value;
        $this->pocket->save($collection);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function has($value)
    {
        return in_array($value, $this->pocket->load(), true);
    }

    /**
     * @return mixed[]
     */
    public function getValues()
    {
        return $this->pocket->load();
    }

    /**
     * @param mixed $value
     */
    public function remove($value)
    {
        $this->pocket->save(array_values(array_filter($this->pocket->load(), function ($storedValue) use ($value) {
            return $storedValue !== $value;
        })));
    }
}
