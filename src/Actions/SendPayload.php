<?php

namespace Palzin\PalzinDumps\Actions;

use Palzin\PalzinDumps\Exceptions\CannotSendPayloadException;
use Palzin\PalzinDumps\Payloads\Payload;

final class SendPayload
{
    /**
     * Sends Payload to the Desktop App
     *
     * @throws CannotSendPayloadException
     */
    public static function handle(string $appUrl, array|Payload $payload): string
    {
        $curlRequest = curl_init();

        curl_setopt_array($curlRequest, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json', 'Accept: application/json'],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_URL            => $appUrl,
        ]);

        curl_close($curlRequest);

        $curlResult = curl_exec($curlRequest);

        if ($curlResult === false) {
            return 'Could not connect to PalzinDumps app. Is it closed?';

            // CannotSendPayloadException::throw(curl_error($curlRequest));
        }

        return strval($curlResult);
    }
}
