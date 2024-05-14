<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_type_id',
        'slug',
        'name',
        'bio',
        'tax_id_number',
        'country',
        'city',
        'state',
        'street',
        'zip_code',
        'email',
        'phone',
    ];

    /*----------------------------------------------------------------------------*/
    // Relations
    /*----------------------------------------------------------------------------*/

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function platforms()
    {
        return $this->morphMany(Platform::class, 'platformable');
    }
}
