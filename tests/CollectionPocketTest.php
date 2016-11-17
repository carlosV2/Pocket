<?php

namespace tests\carlosV2\Pocket;

use carlosV2\Pocket\CollectionPocket;
use Symfony\Component\Filesystem\Filesystem;

class CollectionPocketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $path;

    protected function setUp()
    {
        $this->path = sys_get_temp_dir() . '/pocket/collection_pocket.pocket';
    }

    protected function tearDown()
    {
        (new Filesystem())->remove($this->path);
    }

    /** @test */
    public function itReturnsAnEmptyArray()
    {
        $this->assertEquals([], (new CollectionPocket($this->path))->getAll());
    }

    /** @test */
    public function itReturnsAnArrayWithTheAddedValues()
    {
        $pocket = new CollectionPocket($this->path);
        $pocket->add('a');
        $pocket->add(2);
        $pocket->add(false);

        $this->assertEquals(['a', 2, false], $pocket->getAll());
    }

    /** @test */
    public function itKnowsTheValuesItIsStoring()
    {
        $pocket = new CollectionPocket($this->path);
        $pocket->add('a');
        $pocket->add(2);
        $pocket->add(false);

        $this->assertTrue($pocket->has('a'));
        $this->assertFalse($pocket->has(3));
    }

    /** @test */
    public function itRemovesStoredValues()
    {
        $pocket = new CollectionPocket($this->path);
        $pocket->add('a');
        $pocket->add(2);
        $pocket->add(false);

        $pocket->remove(2);
        $this->assertEquals(['a', false], $pocket->getAll());
    }
}
