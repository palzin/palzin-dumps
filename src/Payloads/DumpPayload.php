<?php

namespace PalzinDumps\PalzinDumps\Payloads;

class DumpPayload extends Payload
{
    public function __construct(
        public string $dump,
        public mixed $originalContent = null,
    ) {
    }

    public function type(): string
    {
        return 'dump';
    }

    public function content(): array
    {
        return [
            'dump'            => $this->dump,
            'originalContent' => $this->originalContent,
        ];
    }
}
