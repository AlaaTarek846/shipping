<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    //    =======================Models ServiceType fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

    //    =======================Relation  One To Many   Model = RepresentativeArea = Many

    public function representative_area(){

        return $this->hasMany(RepresentativeArea::class,'area_id');
    }
}
