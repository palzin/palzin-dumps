<?php

use Illuminate\Support\Str;
use Palzin\PalzinDumps\PalzinDumps;
use Palzin\PalzinDumps\Payloads\{DumpPayload, ModelPayload};
use Palzin\PalzinDumps\Support\Dumper;
use Palzin\PalzinDumps\Tests\Models\Dish;

it('should return the correct payload to dump', function () {
    $args   = [
        'name' => 'Luan',
    ];

    $args           = Dumper::dump($args);
    $notificationId = Str::uuid()->toString();

    $backtrace      = [
        'file' => 'Test',
        'line' => 1,
    ];

    $palzindumps      = new PalzinDumps(notificationId: $notificationId, backtrace: $backtrace);
    $payload        = $palzindumps->send(new DumpPayload($args));

    expect($payload)
        ->id->toBe($notificationId)
        ->type->toBe('dump')
        ->ideHandle->toMatchArray([
            'handler' => 'phpstorm://open?file=Test&line=1',
            'path'    => 'Test',
            'line'    => 1,
        ])
        ->and($payload['content']['dump'])
        ->toContain(
            '<span class=sf-dump-key>name</span>',
            '<span class=sf-dump-str title="4 characters">Luan</span>'
        );
});

it('should return the correct payload to model', function () {
    $dish = Dish::query()->first();

    $notificationId = Str::uuid()->toString();

    $backtrace      = [
        'file' => 'Test',
        'line' => 1,
    ];

    $palzindumps      = new PalzinDumps($notificationId, backtrace: $backtrace);
    $payload        = $palzindumps->send(new ModelPayload($dish));

    expect($payload)
        ->id->toBe($notificationId)
        ->type->toBe('model')
        ->ideHandle->toMatchArray([
            'handler' => 'phpstorm://open?file=Test&line=1',
            'path'    => 'Test',
            'line'    => 1,
        ])
        ->and($payload['content']['relations'])
        ->toMatchArray([])
        ->and($payload['content']['className'])
        ->toBe('Palzin\PalzinDumps\Tests\Models\Dish')
        ->and($payload['content']['attributes'])
        ->toContain(
            '<span class=sf-dump-key>id</span>',
            '<span class=sf-dump-key>name</span>',
            '<span class=sf-dump-key>active</span>',
        );
});
