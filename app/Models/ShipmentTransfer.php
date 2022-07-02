<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentTransfer extends Model
{
    use HasFactory;

    //    =======================Models ShipmentTransfer fields

    protected $guarded = ['id'];

    //    =======================Relation  Shipment

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }

    //    =======================Relation  Employee

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    //    =======================Relation  Representative

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  Store

    public function store_start(){

        return $this->belongsTo(Store::class,'store_start_id');
    }

    public function store_end(){

        return $this->belongsTo(Store::class,'store_end_id');
    }



}
