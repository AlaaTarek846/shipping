<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laratrust\Traits\LaratrustUserTrait;
use App\Notifications\ResetPassworrdNotification;

class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {

        $url = 'https://spa.test/reset-password?token=' . $token;

        $this->notify(new ResetPassworrdNotification($url));
    }

    //APPEND

    protected $appends = [
        'user_data'
    ];

    public function getUserDataAttribute()
    {
        if ($this->user_type == "client")
        {
            return $this->client()->get()->first();
        }

        if ($this->user_type == "company")
        {
            return $this->company()->get()->first();
        }

        if ($this->user_type == "speradmin")
        {
            return $this->sper_admin()->get()->first();
        }

        if ($this->user_type == "admin")
        {
            return $this->admin()->get()->first();
        }

        if ($this->user_type == "representative")
        {
//            return collect($this->representative()->get()->first())->filter();
            return $this->representative()->get()->first();

        }
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return ["email"=>$this->attributes["email"]];
    }

    //    =======================Relation  One To One  Model=client=One

    public function client(){

        return $this->hasOne(Client::class,'user_id');
    }
    //    =======================Relation  One To One  Model=UserApiK=One

    public function userApiK(){

        return $this->hasOne(UserApiK::class,'user_id');
    }

    //    =======================Relation  One To One  Model=Admin=One

    public function sper_admin()
    {
        return $this->hasOne(SuperAdmin::class,'user_id');

    }
    //    =======================Relation  One To One  Model=Admin=One

    public function admin()
    {
        return $this->hasOne(Admin::class,'user_id');

    }

    //    =======================Relation  One To One  Model=Representative=One

    public function representative()
    {
        return $this->hasOne(Representative::class,'user_id');

    }

    //    =======================Relation  One To One  Model=Employee=One

    public function employee(){

        return $this->hasOne(Employee::class);

    }

    //    =======================Relation  One To One  Model=company=One

    public function company(){

        return $this->hasOne(Company::class);

    }

    //    =======================Relation  One To Many  Model=Shipment=Many

    public function shipment(){

        return $this->hasMany(Shipment::class,'sender_id');
    }
    //    =======================Relation  One To Many  Model=Connect=Many

    public function connect(){

        return $this->hasMany(Connect::class);
    }
    //    =======================Relation  One To Many  Model=PickUp=Many

    public function pickup(){

        return $this->hasMany(PickUp::class);
    }

   //    =======================Relation  One To Many  Model=Complain=Many

    public function complain(){

        return $this->hasMany(Complain::class);
    }

    //    =======================Relation  One To Many  Model = Notification = Many

    public function notification(){

        return $this->hasMany(Notification::class);
    }

    //    =======================Relation  One To Many  Package

    public function package(){

        return $this->belongsTo(Package::class);
    }
    //    =======================Relation   One To Many   Model = User = Many

    public function packageUser(){

        return $this->hasMany(PackageUser::class);
    }



}
