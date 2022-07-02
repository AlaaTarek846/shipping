<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    //    =======================Models Map fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Representative = One

    public function representative(){

        return $this->belongsTo(Representative::class);
    }

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }



}
