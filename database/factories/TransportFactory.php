<?php

namespace Database\Factories;

use App\Models\Transports\Transport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class TransportFactory extends Factory
{
    protected $model = Transport::class;
    public function definition(): array
    {
        return [
            'unit_number' => strtoupper(Str::random(3)).rand(111,999),
            'year' => date('Y-m-d',rand(0,strtotime('+5 years', strtotime(date('Y-m-d')))))
        ];
    }
}
