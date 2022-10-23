<?php

namespace PalzinDumps\PalzinDumps\Exceptions;

use Exception;

final class CannotSendPayloadException extends Exception
{
    /**
     * @throws CannotSendPayloadException
     */
    public static function throw(string $message = ''): void
    {
        throw new static('PalzinDumps: Could not send payload to app. ' . $message);
    }
}
