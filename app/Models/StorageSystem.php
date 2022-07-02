<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageSystem extends Model
{
    use HasFactory;

    //    =======================Models StorageSystem fields

    protected $guarded = ['id'];

    //    =======================Relation Many to Many  Storage System Company

    public function company(){

        return $this->belongsToMany(Company::class,'storage_system_companies','storage_system_id','company_id');

    }





}
