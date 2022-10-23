<?php

namespace Palzin\PalzinDumps\Payloads;

class LivewireEventsPayload extends Payload
{
    public function __construct(
        protected array $event
    ) {
    }

    public function content(): array
    {
        return [
            'event' => $this->event,
        ];
    }

    public function type(): string
    {
        return 'livewire-events';
    }
}
