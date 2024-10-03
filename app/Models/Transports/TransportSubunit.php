<?php
 
namespace App\Models\Transports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportSubunit extends Model
{
    
    protected $table = 'cv.truck_subunits';

    protected $fillable = [
        'main_truck',
        'subunit',
        'start_date',
        'end_date'
    ];
}