<?php

namespace App\Http\Controllers\Transports;

use App\Models\Transports\TransportSubunit;
use App\Http\Controllers\Controller;
use App\Models\Transports\Transport;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransportUnitController extends Controller
{
    protected string $model = TransportSubunit::class;
    public array $units = [];

    public function index(Request $request, TransportSubunit $transportSubunit)
    { 
        $transportSubunit->where('main_truck', $request->unit_number)
            ->each(function (TransportSubunit $data){
                $this->units[$data->subunit][] = [
                    'id' => $data->id,
                    'main_truck' => $data->main_truck,
                    'start_date' => $data->start_date,
                    'end_date' => $data->end_date,
                ];
            });

        return Inertia::render('CreatePlan', [
            'transport' => $request->unit_number,
            'transportsUnits' => $this->units,
            'availableTransports' => Transport::all(),
        ]);
    }

    public function store(Request $request, TransportSubunit $transportSubunit)
    {

        $request->validate([
            'transport' => 'required|string',
            'subunit' => 'required|string',
            'date' => 'required|array',
        ]);

        $transportSubunit->create([
            'main_truck' => $request->transport,
            'subunit' => $request->subunit,
            'start_date' => substr($request->date[0],0,10),
            'end_date' => substr($request->date[1], 0, 10),

        ]);
    }
    public function destroy(Request $request, TransportSubunit $transportSubunit)
    {
        $request->validate([ 
            'id' => 'required',
        ]);

        $transportSubunit->where('id',$request->id)->delete();
    }
}