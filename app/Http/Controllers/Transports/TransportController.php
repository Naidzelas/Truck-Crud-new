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

        return to_route('index');

        // if (
        //     $request->year < 1900
        //     || $request->year > Carbon::now()->add(5, 'days')->year) 
        // {
        //     return redirect('transports')->with('error', 'Wrong date');
        // }4

        // $validated = $this->validate($request, [
        //     'unit_number' => 'required|string',
        //     'year' => 'required|int',
        //     'notes' => 'string',
        // ]);

        // $transport->fill($validated)->save();
        // return redirect('transports');

    }
    public function update(Request $request, Transport $transport)
    {
        // $this->validate($request, [
        //     'unit_number' => 'required|string',
        //     'year' => 'required|int',
        //     'notes' => 'text',
        // ]);

        $transport->fill($request->validated())->save();
        return redirect('transports');

    }
    public function store(Request $request, Transport $transport)
    {
        return redirect('transports');
    }

    public function destroy(Request $request, Transport $transport)
    {
        $transport->where('id',$request->id)->delete();

        return to_route('index');
    }
}