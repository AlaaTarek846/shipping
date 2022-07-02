<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    //    =======================Models Reason fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

}
