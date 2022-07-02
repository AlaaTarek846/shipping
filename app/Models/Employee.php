<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    //    =======================Models Employee Fields

    protected $guarded = ['id'];

    //    =======================Relation  Employee User

    public function branch(){

        return $this->belongsTo(Branch::class);
    }

    //    =======================Relation  Employee User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }
    //    =======================
    public function user(){

        return $this->belongsTo(User::class);
    }

    //    =======================
    public function department(){

        return $this->belongsTo(Department::class,);
    }
    //    =======================
    public function job(){

        return $this->belongsTo(Job::class);
    }
    //    =======================Relation  ShipmentTransfer

    public function shipmenttransfer(){

        return $this->hasMany(ShipmentTransfer::class);
    }


    //    =======================Relation  Store

    public function store(){

        return $this->hasMany(Store::class,'employee_id');
    }
    //    =======================Relation  One To Many   Model = Citie = One

    public function citie(){

        return $this->belongsTo(Citie::class,'city_id');
    }
    //    =======================Creat  Url  Photo


    protected $appends = [
        'image_photo',
        'image_cv',
        'image_face',
        'image_back'
    ];

    //============== appends paths ===========

    //append img path

    //=========================

    public function getImagePhotoAttribute(): string
    {
        return asset('public/uploads/employee-photo/'.$this->photo);
    }

    //=========================

    public function getImageCvAttribute(): string
    {
        return asset('public/uploads/employee-cv/'.$this->cv);
    }
    //=========================

    public function getImageFaceAttribute(): string
    {
        return asset('public/uploads/employee-face_ID_card_pic/'.$this->face_ID_card_pic);
    }
    //=========================

    public function getImageBackAttribute(): string
    {
        return asset('public/uploads/employee-back_ID_card_pic/'.$this->back_ID_card_pic);
    }

}
