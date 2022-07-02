<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeAccountDetail extends Model
{
    use HasFactory;

    //    =======================Models Representative Account Detail fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  One To Many   Model = RepresentativeAccount = One
    public function representative_account(){

        return $this->belongsTo(RepresentativeAccount::class);
    }

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }

    //    =======================Relation  One To Many   Model = ShipmentStatu = One

    public function shipmentstatu(){

        return $this->belongsTo(ShipmentStatu::class);
    }


}
