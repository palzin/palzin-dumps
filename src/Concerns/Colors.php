<?php

namespace PalzinDumps\PalzinDumps\Concerns;

use PalzinDumps\PalzinDumps\PalzinDumps;

trait Colors
{
    public function danger(): PalzinDumps
    {
        if (boolval(config('palzindumps.send_color_in_screen'))) {
            return $this->toScreen('danger', true);
        }

        return $this->color('border-red-300');
    }

    public function dark(): PalzinDumps
    {
        return $this->color('border-black');
    }

    public function warning(): PalzinDumps
    {
        if (boolval(config('palzindumps.send_color_in_screen'))) {
            return $this->toScreen('warning', true);
        }

        return $this->color('border-orange-300');
    }

    public function success(): PalzinDumps
    {
        if (boolval(config('palzindumps.send_color_in_screen'))) {
            return $this->toScreen('success', true);
        }

        return $this->color('border-green-600');
    }

    public function info(): PalzinDumps
    {
        if (boolval(config('palzindumps.send_color_in_screen'))) {
            return $this->toScreen('info', true);
        }

        return $this->color('border-blue-600');
    }
}
