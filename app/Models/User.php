<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin;
use App\Models\Country;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'firstName',
        'lastName',
        'phone',
        'email',
        'password',
        'building_name',
        'building_number',
        'address_Line_1',
        'address_Line_2',
        'address_Line_3',
        'city',
        'county',
        'country_id',
        'postcode'
    ];

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

    public function isAdmin() {
        return Admin::where('user_id', '=', $this->id)->exists();
    }

    public function getFullName() {
        return $this->title.' '.$this->firstName.' '.$this->lastName;
    }

    public function countryName() {
        return Country::where('id', $this->country_id)->first()->name;
    }

    /**
     * Relationships
     */
    public function shipments() {
        return $this->hasMany(Shipment::class);
    }
}
