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

final class IBanFirstEnvironment
{
    /**
     * For testing your integration
     */
    public const SANDBOX = 'sandbox';

    /**
     * For live integrations, "Production" use case.
     */
    public const LIVE = 'live';

    /**
     * No needs to instantiate this class.
     */
    private function __construct()
    {
    }
}