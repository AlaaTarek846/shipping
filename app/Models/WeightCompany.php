<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightCompany extends Model
{
    use HasFactory;

    //    =======================Models WeightCompany fields

    protected $guarded = ['id'];

    //    =======================Relation  Company

    public function company(){

        return $this->belongsTo(Company::class,'company_id');
    }

    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }

}
