<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    //    =======================Models Client Fields

    protected $guarded = ['id'];

    //    =======================Relation  One To One   Model=User=One

    public function user(){
        return $this->belongsTo(User::class);
    }

    //    =======================Relation  One To Many   Model=Shipment=Many

    public function shipment(){

        return $this->hasMany(Shipment::class);
    }

    //    =======================Relation  One To Many   Model=ShipmentTransfer=Many

    public function shipmenttransfer(){

        return $this->hasMany(ShipmentTransfer::class);
    }
    //    =======================Relation  One To Many   Model = RepresentativeMove = Many

    public function representative_move(){

        return $this->hasMany(RepresentativeMove::class);
    }
    //    =======================Relation  One To Many   Model = DetailShipmentRepresentative = Many

    public function detailShipmentRepresentative(){

        return $this->hasMany(DetailShipmentRepresentative::class);
    }

    //    =======================Relation  One To Many   Model = Citie = One

    public function citie(){

        return $this->belongsTo(Citie::class,'city_id');
    }

    //    =======================Relation  One To Many   Model = RepresentativeArea = Many

    public function representative_area(){

        return $this->hasMany(RepresentativeArea::class);
    }
    //    =======================Relation  One To Many   Model = MessageRepresentative = Many

    public function message_representative(){

        return $this->hasMany(MessageRepresentative::class);
    }
    //    =======================Relation  One To Many   Model = representative_account = Many

    public function representative_account(){

        return $this->hasMany(RepresentativeAccount::class);
    }
    //    =======================Relation  One To Many   Model = RepresentativeAccountDetail = Many

    public function representative_account_detail(){

        return $this->hasMany(RepresentativeAccountDetail::class);
    }
    //    =======================Relation  One To Many   Model = RepresentativeIncome = Many

    public function representativeIncome(){

        return $this->hasMany(RepresentativeIncome::class);
    }

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }
    //    =======================Relation  One To Many   Model = Map = Many

    public function map(){

        return $this->hasMany(Map::class);
    }

    //    =======================Creat  Url  Photo 12 -3-2022


    protected $appends = [
        'image_path',
        'license_photo_path',
        'fish_photo_path',
        'cv_path'
    ];




    //============== appends paths ===========

    //append img path

    public function getImagePathAttribute(): string
    {
        return asset('public/uploads/representative-photo/'.$this->photo);
    }

    //append cv path

    public function getCvPathAttribute(): string
    {
        return asset('public/uploads/representative-cv/'.$this->cv);
    }

    //append license photo path

    public function getLicensePhotoPathAttribute(): string
    {
        return asset('public/uploads/representative-license_photo/'.$this->license_photo);
    }
    //append fish photo path

    public function getFishPhotoPathAttribute(): string
    {
        return asset('public/uploads/representative-fish_photo/'.$this->fish_photo);
    }
}
