<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    use HasFactory;
    //    =======================Models AdditionalService Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many  Model = Shipment = many
    public function shipment(){

        return $this->hasMany(Shipment::class);
    }


}
