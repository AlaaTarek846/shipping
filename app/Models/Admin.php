<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    //    =======================Models Admin Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To One  Model = User = One

    public function user(){

        return $this->belongsTo(User::class);
    }
    //    =======================Relation  Employee

    public function employee(){

        return $this->hasMany(Employee::class);
    }
    //    =======================Relation  Representative

    public function representative(){

        return $this->hasMany(Representative::class);
    }
    //    =======================Relation  Employee

    public function additionalService(){

        return $this->hasMany(AdditionalService::class);
    }
    //    =======================Relation  Country

    public function country(){

        return $this->hasMany(Country::class);
    }

    //    =======================Relation  Province

    public function province(){

        return $this->hasMany(Province::class);
    }
    //    =======================Relation  Area

    public function area(){

        return $this->hasMany(Area::class);
    }
    //    =======================Relation  Area

    public function client(){

        return $this->hasMany(Client::class);
    }
    //    =======================Relation  Department

    public function department(){

        return $this->hasMany(Department::class);
    }
    //    =======================Relation  Branch

    public function branch(){

        return $this->hasMany(Branch::class);
    }
    //    =======================Relation  Company

    public function company(){

        return $this->hasMany(Company::class);
    }
    //    =======================Relation  Shipment

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }
    //    =======================Relation  Shipment

    public function importShipmentt(){

        return $this->hasMany(ImportShipmentt::class);
    }
    //    =======================Relation  Shipment

    public function store(){

        return $this->hasMany(Store::class);
    }

    //    =======================Relation  shippingAreaPrice

    public function shippingAreaPrice(){

        return $this->hasMany(ShippingAreaPrice::class);
    }
    //    =======================Relation  StorageSystem

    public function storageSystem(){

        return $this->hasMany(StorageSystem::class);
    }
    //    =======================Relation  PickUp

    public function pickUp(){

        return $this->hasMany(PickUp::class);
    }
    //    =======================Relation  Connect

    public function connect(){

        return $this->hasMany(Connect::class);
    }
    //    =======================Relation  Complain

    public function complain(){

        return $this->hasMany(Complain::class);
    }
    //    =======================Relation  WeightCompany

    public function weightCompany(){

        return $this->hasMany(WeightCompany::class);
    }
    //    =======================Relation  Weight

    public function weight(){

        return $this->hasMany(Weight::class);
    }



    //    =======================Creat  Url  Photo

    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/admin/'.$this->photo);
    }
}
