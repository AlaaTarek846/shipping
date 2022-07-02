<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportType extends Model
{
    use HasFactory;

    //    =======================Models TransportType fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = PickUp = Many

    public function pickup(){

        return $this->hasMany(PickUp::class);
    }

}
