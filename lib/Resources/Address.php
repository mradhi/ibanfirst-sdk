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

/**
 * @property-read $street
 * @property-read $postCode
 * @property-read $city
 * @property-read $province
 * @property-read $country
 */
class Address extends AbstractResource
{
    /**
     * The street and street number for the address described.
     *
     * @var string|null
     */
    protected ?string $street = null;

    /**
     * The ZIP/Post code for the address described.
     *
     * @var string|null
     */
    protected ?string $postCode = null;

    /**
     * The city for the address described.
     *
     * @var string|null
     */
    protected ?string $city = null;

    /**
     * The province code for the address described. This field could be required if the country use a province system,
     * like United States or Canada. To see a full list of province code, please refer to
     * http://www.mapability.com/ei8ic/contest/states.php.
     *
     * @var string|null
     */
    protected ?string $province = null;

    /**
     * The two-letters abbreviation for the country, following the ISO-3166 for the address described.
     *
     * @var string|null
     */
    protected ?string $country = null;
}