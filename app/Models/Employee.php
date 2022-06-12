<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ID = 'id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const COMPANY_ID = 'company_id';
    const PHONE = 'phone';

    protected $fillable = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::EMAIL,
        self::COMPANY_ID,
        self::PHONE,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, self::COMPANY_ID, Company::ID);
    }

}
