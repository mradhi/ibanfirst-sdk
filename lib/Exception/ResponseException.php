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

namespace IBanFirst\Exception;

use stdClass;
use Throwable;

class ResponseException extends SDKException
{
    protected stdClass $error;

    protected int $statusCode;

    public function __construct(stdClass $errorContent, int $statusCode, $code = 0, Throwable $previous = null)
    {
        $this->error = $errorContent->Error;
        $this->statusCode = $statusCode;

        parent::__construct($this->getErrorMessage(), $code, $previous);
    }

    public function getErrorMessage(): ?string
    {
        if (property_exists($this->error, 'ErrorMessage')) {
            return $this->error->ErrorMessage;
        }

        return null;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorType(): ?string
    {
        if (property_exists($this->error, 'ErrorType')) {
            return $this->error->ErrorType;
        }

        return null;
    }

    public function getErrorCode(): ?int
    {
        if (property_exists($this->error, 'ErrorCode')) {
            return $this->error->ErrorCode;
        }

        return null;
    }
}