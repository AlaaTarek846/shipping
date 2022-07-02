<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    //    =======================Models Client Fields

    protected $guarded = ['id'];

  //    =======================Relation  One To One  Model=User=One

    public function user(){

        return $this->belongsTo(User::class);
    }

    //    =======================Relation  One To Many   Model = Citie = One

    public function citie(){

        return $this->belongsTo(Citie::class,'city_id');
    }

    //    =======================Relation  One To Many   Model = Shipment = Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

    //    =======================Creat  Url  Photo


    protected $appends = [
        'image_path'
    ];

    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/client/'.$this->photo);
    }

}
