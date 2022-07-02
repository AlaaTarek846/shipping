<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetailShipmentRepresentative extends Model
{
    use HasFactory;

    //    =======================Models Detail Shipment Representative   fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }


    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }

    //    =======================Relation  One To Many   Model = ShipmentStatu = One

    public function shipmentstatu(){

        return $this->belongsTo(ShipmentStatu::class,'shipment_status_id');
    }

    //    =======================Relation  One To Many   Model = Store = One

    public function store(){

        return $this->belongsTo(Store::class);
    }
}
