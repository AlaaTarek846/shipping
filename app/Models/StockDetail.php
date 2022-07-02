<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    use HasFactory;
    //    =======================Models Stock Detail Fields

    protected $guarded = ['id'];

    //    =======================Relation  Stock

    public function stock(){

        return $this->belongsTo(Stock::class);
    }

    //    =======================Relation  Shipment

    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }

}
