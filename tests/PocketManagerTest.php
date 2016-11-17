<?php

namespace tests\carlosV2\Pocket;

use carlosV2\Pocket\CollectionPocket;
use carlosV2\Pocket\IndexedPocket;
use carlosV2\Pocket\PocketManager;
use carlosV2\Pocket\ValuePocket;
use Symfony\Component\Filesystem\Filesystem;

class PocketManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $path;

    protected function setUp()
    {
        $this->path = sys_get_temp_dir() . '/pocket/';
    }

    protected function tearDown()
    {
        (new Filesystem())->remove($this->path);
    }

    /** @test */
    public function itProvidesValuePockets()
    {
        $this->assertInstanceOf(ValuePocket::class, (new PocketManager($this->path))->getValuePocket());
    }

    /** @test */
    public function itProvidesCollectionPockets()
    {
        $this->assertInstanceOf(CollectionPocket::class, (new PocketManager($this->path))->getCollectionPocket());
    }

    /** @test */
    public function itProvidesIndexedPockets()
    {
        $this->assertInstanceOf(IndexedPocket::class, (new PocketManager($this->path))->getIndexedPocket());
    }

    /** @test */
    public function itClearsAnyPocketInTheDestinationPath()
    {
        (new Filesystem())->dumpFile($this->path . 'file.txt', 'Date');
        (new PocketManager($this->path))->clear();

        $this->assertFileNotExists($this->path);
    }
}
