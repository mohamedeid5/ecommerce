<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['is_active'];

    /**
     * with
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $translatedAttributes = ['name'];

}
