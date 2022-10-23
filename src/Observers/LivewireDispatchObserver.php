<?php

namespace Palzin\PalzinDumps\Observers;

use Illuminate\Support\Str;
use Palzin\PalzinDumps\PalzinDumps;
use Palzin\PalzinDumps\Payloads\LivewireEventsPayload;
use Palzin\PalzinDumps\Support\{Dumper, IdeHandle};
use ReflectionClass;

class LivewireDispatchObserver
{
    public function register(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::listen('component.dehydrate', function ($component) {
                if (!$this->isEnabled()) {
                    return;
                }

                $dispatch = collect((array) $component->getDispatchQueue());

                if ($dispatch->isEmpty()) {
                    return;
                }

                $dispatch->each(function ($event) use ($component) {
                    $notificationId = strval(data_get($event, 'event'));
                    $params         = (array) data_get($event, 'data');

                    $component         = get_class($component);

                    /** @phpstan-ignore-next-line */
                    $reflector         = new ReflectionClass($component);
                    $componentBasePath = strval($reflector->getFileName());

                    $data = [
                        'event'            => $notificationId,
                        'dispatch'         => true,
                        'component'        => $component,
                        'componentHandler' => [
                            'handler' => IdeHandle::makeFileHandler($componentBasePath, '1'),
                            'path'    => Str::of(strval($component))->replace(config('livewire.class_namespace') . '\\', ''),
                            'line'    => 1,
                        ],
                        'params' => Dumper::dump($params),
                    ];

                    $dumps = new PalzinDumps(notificationId: $notificationId);

                    $dumps->send(new LivewireEventsPayload($data));

                    $dumps->toScreen('Dispatch');
                });
            });
        }
    }

    public function isEnabled(): bool
    {
        return (bool) config('palzindumps.send_livewire_dispatch');
    }
}
