<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    //    =======================Models Complain Fields

    protected $guarded = ['id'];

    //    =======================Relation One to Many  User

    public function user(){

        return $this->belongsTo(User::class);

    }
}
