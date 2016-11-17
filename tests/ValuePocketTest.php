<?php

namespace tests\carlosV2\Pocket;

use carlosV2\Pocket\ValuePocket;
use Symfony\Component\Filesystem\Filesystem;

class ValuePocketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $path;

    protected function setUp()
    {
        $this->path = sys_get_temp_dir() . '/pocket/value_pocket.pocket';
    }

    protected function tearDown()
    {
        (new Filesystem())->remove($this->path);
    }

    /** @test */
    public function itReturnsTheDefaultValueIfNoneWasPreviouslyProvided()
    {
        $this->assertEquals(42, (new ValuePocket($this->path, 42))->load());
    }

    /** @test */
    public function itReturnsThePreviouslyProvidedValue()
    {
        $pocket = new ValuePocket($this->path, 42);
        $pocket->save(21);

        $this->assertEquals(21, $pocket->load());
    }

    /** @test */
    public function itCachesTheProvidedValue()
    {
        $pocket = new ValuePocket($this->path, 42);
        $pocket->save(21);

        file_put_contents($this->path, 'This is invalid data');

        $this->assertEquals(21, $pocket->load());
    }
}
