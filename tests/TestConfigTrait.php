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

trait TestConfigTrait
{
    protected function getConfig(string $key)
    {
        if (file_exists(dirname(__DIR__) . '/tests/config.php')) {
            $config = require_once dirname(__DIR__) . '/tests/config.php';
        } else {
            $config = require_once dirname(__DIR__) . '/tests/config.php.dist';
        }

        if (array_key_exists($key, $config)) {
            return $config[$key];
        }

        return null;
    }
}