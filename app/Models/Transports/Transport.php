<?php
 
namespace App\Models\Transports;

use Database\Factories\TransportFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transport extends Model
{
    use HasFactory;
    protected $table = "cv.trucks";
    protected $fillable = [
        'unit_number',
        'year',
        'notes',
    ];

    public function truckSubUnits(): hasMany
    {
        return $this->hasMany(TransportSubunit::class, 'unit_number', 'main_truck');
    }
    protected static function newFactory()
    {
        return TransportFactory::new();
    }
}