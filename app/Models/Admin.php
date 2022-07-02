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
