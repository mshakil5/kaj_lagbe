<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Work;
use App\Models\AdditionalAddress;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'surname',
        'is_type',
        'password',
        'address_first_line',
        'address_second_line',
        'address_third_line',
        'town',
        'country',
        'postcode',
        'photo',
        'phone',
        'status',
        'about',
        'facebook',
        'twitter',
        'google',
        'linkedin',
        'google_id',
        'facebook_id',
        'updated_by',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["0", "1", "2"][$value],
        );
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function additionalAddresses()
    {
        return $this->hasMany(AdditionalAddress::class);
    }
    
    public function accDelRequest()
    {
        return $this->hasMany(AccDelRequest::class);
    }


}
