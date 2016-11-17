<?php

namespace tests\carlosV2\Pocket;

use carlosV2\Pocket\IndexedPocket;
use Symfony\Component\Filesystem\Filesystem;

class IndexedPocketTest extends \PHPUnit_Framework_TestCase
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
        $this->assertEquals([], (new IndexedPocket($this->path))->getAll());
    }

    /** @test */
    public function itReturnsAnArrayWithTheAddedValues()
    {
        $pocket = new IndexedPocket($this->path);
        $pocket->add('string', 'a');
        $pocket->add('integer', 2);
        $pocket->add('boolean', false);

        $this->assertEquals(['a', 2, false], $pocket->getAll());
    }

    /** @test */
    public function itReturnsSelectedKeys()
    {
        $pocket = new IndexedPocket($this->path);
        $pocket->add('string', 'a');
        $pocket->add('integer', 2);
        $pocket->add('boolean', false);

        $this->assertEquals(2, $pocket->getByKey('integer'));
        $this->assertNull($pocket->getByKey('float'));
    }

    /** @test */
    public function itKnowsTheValuesItIsStoring()
    {
        $pocket = new IndexedPocket($this->path);
        $pocket->add('string', 'a');
        $pocket->add('integer', 2);
        $pocket->add('boolean', false);

        $this->assertTrue($pocket->has('a'));
        $this->assertFalse($pocket->has(3));
    }

    /** @test */
    public function itKnowsTheKeysItIsStoring()
    {
        $pocket = new IndexedPocket($this->path);
        $pocket->add('string', 'a');
        $pocket->add('integer', 2);
        $pocket->add('boolean', false);

        $this->assertTrue($pocket->hasKey('string'));
        $this->assertFalse($pocket->hasKey('float'));
    }

    /** @test */
    public function itRemovesStoredValues()
    {
        $pocket = new IndexedPocket($this->path);
        $pocket->add('string', 'a');
        $pocket->add('integer', 2);
        $pocket->add('boolean', false);

        $pocket->removeByKey('integer');
        $this->assertEquals(['a', false], $pocket->getAll());
    }
}
