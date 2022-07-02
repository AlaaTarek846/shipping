<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAreaPrice extends Model
{
    use HasFactory;
    //    =======================Models Shipping Area Price fields

    protected $guarded = ['id'];

    //    =======================Relation  Area

    public function area(){

        return $this->belongsTo(Area::class);
    }
    //    =======================Relation  Province

    public function province(){

        return $this->belongsTo(Province::class);
    }

}
