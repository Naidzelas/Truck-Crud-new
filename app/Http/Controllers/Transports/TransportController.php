<?php

namespace App\Http\Controllers\Transports;

use App\Models\Transports\Transport;
use App\Http\Controllers\Controller;
use App\Models\Transports\TransportSubunit;
use Database\Seeders\TruckSeeder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransportController extends Controller
{
    protected string $model = Transport::class;
    public array $subunitData = [];

    public function index(Transport $transport)
    {
       TransportSubunit::query()->orderBy('end_date','asc')
            ->each(function (TransportSubunit $data){
                $this->subunitData[$data->main_truck][] = [
                    'subunit' => $data->subunit,
                    'start_date' => $data->start_date,
                    'end_date' => $data->end_date
                ];
            });

        return Inertia::render('Home', [
            'transports' => $transport->all(),
            'subunitData' => $this->subunitData,
        ]);
    }
    public function create()
    {
        $seeder = new TruckSeeder;
        $seeder->run();
    }
    public function update(Request $request, Transport $transport)
    {
        $request->validate([
            'note' => 'string|max:255',
        ]);
        
        $transport->where('id',$request->id)->update([
            'notes' => $request->note
        ]);
    }

    public function destroy(Request $request, Transport $transport)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $transport->where('id',$request->id)->delete();
    }
}