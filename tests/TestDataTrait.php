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

namespace IBanFirst;

trait TestDataTrait
{
    protected function loadJsonFixture(string $name)
    {
        return json_decode($this->loadFixture($name));
    }

    protected function loadFixture(string $name)
    {
        $path = $this->buildFixturePath($name);
        return fread(fopen($path, 'r'), filesize($path));
    }

    protected function buildFixturePath(string $name): string
    {
        return 'tests/fixtures/' . $name . '.json';
    }
}