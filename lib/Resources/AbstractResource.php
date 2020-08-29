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

abstract class AbstractResource
{
    /**
     * Used to map class props to the correct type.
     *
     * @var array
     */
    protected array $map = [];

    /**
     * The response data.
     *
     * @var array
     */
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;

        foreach ($data as $key => $value) {
            if (property_exists(get_class($this), $key)) {
                $this->{$key} = $this->castValue($key, $value);
            }
        }
    }

    private function castValue(string $key, $value)
    {
        if (array_key_exists($key, $this->map)) {
            if (!is_array($value)) {
                throw new ResourceException(
                    sprintf('The field "%s" should be an array to be casted to an object.', $key)
                );
            }

            $value = new $this->map[$key]($value);
        }

        return $value;
    }

    /**
     * Magic getter. If you try and access an unknown property, we
     * throw an exception.
     *
     * @param string $field
     *
     * @return mixed
     *
     * @throws ResourceException
     */
    public function __get(string $field)
    {
        if (!property_exists(get_class($this), $field)) {
            throw new ResourceException(
                sprintf('The field "%s" does not exist in the resource "%s".', $field, static::class)
            );
        }

        return $this->{$field};
    }
}