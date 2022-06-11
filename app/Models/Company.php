<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    const TABLE = 'companies';
    const NAME = 'name';
    const EMAIL = 'email';
    const LOGO = 'logo';
    const WEBSITE = 'website';

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::LOGO,
        self::WEBSITE
    ];

}
