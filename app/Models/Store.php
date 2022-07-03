<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    //    =======================Models Store fields

    protected $guarded = ['id'];

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

    //    =======================Relation  One To Many   Model = Branch = One

    public function branch(){

        return $this->belongsTo(Branch::class,'branche_id');
    }


    //    =======================Relation  One To Many   Model = ShipmentTransfer = Many

    public function shipmenttransfer(){

        return $this->hasMany(ShipmentTransfer::class);
    }
    //    =======================Relation  One To Many   Model = DetailShipmentRepresentative = Many

    public function detailShipmentRepresentative(){

        return $this->hasMany(DetailShipmentRepresentative::class);
    }


    //    =======================Relation  One To Many   Model = Employee = Many

    public function employee(){

        return $this->belongsTo(Employee::class,'employee_id');
    }
    //    =======================Relation  One To Many   Model = stock = Many

    public function stock(){

        return $this->hasMany(Stock::class);
    }

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }
}
