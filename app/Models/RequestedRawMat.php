<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedRawMat extends Model
{
    use HasFactory;

    protected $table = "requested_rm";

    protected $fillable = [
        'request_id',
        'item_code',
        'uom_id',
        'quantity_requested',
        'procurement_method',
        'station_id',
    ];

    public function request(){
        return $this->belongsTo(MaterialRequest::class, 'request_id', 'request_id');
    }

    public function items(){
        return $this->hasMany(ManufacturingMaterials::class, 'item_code', 'item_code');
    }

    public function uom(){
        return $this->hasOne(MaterialUOM::class, 'uom_id', 'uom_id');
    }
}
