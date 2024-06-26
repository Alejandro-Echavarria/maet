<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'phone',
        'address',
        'bio',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getBirthdayAttribute($value){

        return Carbon::parse($value)->format('d-m-Y');
    }

    // Relación uno a muchos
    public function education()
    {
        return $this->hasMany(Education::class);
    }

    // Relación uno a muchos
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    // Relación uno a muchos
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // Relación uno a muchos
    public function workingSkills()
    {
        return $this->hasMany(WorkingSkill::class);
    }

    // Relación uno a muchos
    public function knowledge()
    {
        return $this->hasMany(Knowledge::class);
    }

    public function platforms()
    {
        return $this->morphMany(Platform::class, 'platformable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
