<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Translatable;

    /**
     * @var string[]
     */
    protected $with = ['translations'];

    /**
     * @var string[]
     */
    protected $guarded = [];


    /**
     * @var array|string[]
     */
    protected array $translatedAttributes = ['name'];

}
