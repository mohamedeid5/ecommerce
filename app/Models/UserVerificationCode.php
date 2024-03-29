<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationCode extends Model
{
    use HasFactory;

    protected $table = 'users_verification_code';

    protected $fillable = [
        'user_id',
        'code',
    ];
}
