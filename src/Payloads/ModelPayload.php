<?php

namespace Palzin\PalzinDumps\Payloads;

use Illuminate\Database\Eloquent\Model;
use Palzin\PalzinDumps\Support\Dumper;

class ModelPayload extends Payload
{
    public function __construct(
        protected Model $model,
    ) {
    }

    public function type(): string
    {
        return 'model';
    }

    /** @return array<string, array|string> */
    public function content(): array
    {
        $relations = $this->model->relationsToArray();

        return [
            'relations'  => $this->model->relationsToArray() ? Dumper::dump($relations) : [],
            'className'  => get_class($this->model),
            'attributes' => Dumper::dump($this->model->attributesToArray()),
        ];
    }
}
