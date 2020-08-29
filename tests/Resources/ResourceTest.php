<?php
/*
 * This file is part of the iBanFirst HTTP Client package.
 *
 * (c) Radhi GUENNICHI <guennichiradhi@gmail.com> <+216 50 711 816>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace IBanFirst\Resources;

use IBanFirst\Exception\ResourceException;
use PHPUnit\Framework\TestCase;

class FakeResource extends AbstractResource
{
    protected array $map = ['sub' => SubFakeResource::class];

    protected ?string $foo = null;
    protected ?string $bar = null;
    protected ?string $baz = null;
    protected SubFakeResource $sub;
}

class SubFakeResource extends AbstractResource
{
    protected string $name;
}

class ResourceTest extends TestCase
{
    public function testValidGetter(): void
    {
        $resource = new FakeResource(['foo' => 'val']);

        $this->assertEquals('val', $resource->foo);
    }

    public function testInvalidGetter(): void
    {
        $this->expectException(ResourceException::class);
        $this->expectExceptionMessage('The field "undefined" does not exist in the resource "IBanFirst\\Resources\\FakeResource"');

        $resource = new FakeResource(['foo' => 'val']);
        $resource->undefined;
    }

    public function testInvalidMapping(): void
    {
        $this->expectException(ResourceException::class);
        $this->expectExceptionMessage('The field "sub" should be an array to be casted to an object.');

        new FakeResource(['sub' => 'val']);
    }

    public function testValidMapping(): void
    {
        $resource = new FakeResource(['sub' => ['name' => 'Radhi', 'age' => 25]]);

        $this->assertEquals('Radhi', $resource->sub->name);
    }
}