<?php

namespace carlosV2\Pocket;

use Symfony\Component\Filesystem\Filesystem;

final class PocketManager
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function clear()
    {
        (new Filesystem())->remove($this->path);
    }

    /**
     * @param mixed $defaultValue
     *
     * @return ValuePocket
     */
    public function getValuePocket($defaultValue = null)
    {
        return new ValuePocket($this->getFileName(), $defaultValue);
    }

    /**
     * @return CollectionPocket
     */
    public function getCollectionPocket()
    {
        return new CollectionPocket($this->getFileName());
    }

    /**
     * @return IndexedPocket
     */
    public function getIndexedPocket()
    {
        return new IndexedPocket($this->getFileName());
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return sprintf(
            '%s%s%s.pocket',
            rtrim($this->path, DIRECTORY_SEPARATOR),
            DIRECTORY_SEPARATOR,
            str_replace('\\', '_', $this->getCallerClassName())
        );
    }

    /**
     * @return string
     */
    private function getCallerClassName()
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        return md5($trace[2]['file'] . ':' . $trace[2]['line']);
    }
}
