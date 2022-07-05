<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    //    =======================Models Weight fields

    protected $guarded = ['id'];
    //    =======================Relation  Admin User

    public function admin(){

        return $this->belongsTo(Admin::class);
    }

}
