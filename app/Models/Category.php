<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;

    /**
     * translatedAttributes
     *
     * @var array
     */
    public $translatedAttributes = ['category_name'];
    
    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];
    
    /**
     * with
     *
     * @var array
     */
    protected $with = ['translations'];
    
    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['translations'];
    
    
    

    
}
