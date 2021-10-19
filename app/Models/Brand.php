<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, Translatable;

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

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'is_active', 'image'
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * translatedAttributes
     *
     * @var array
     */
    protected array $translatedAttributes = ['name'];

    /**
     * Method getImageAttribute
     *
     * @param $val
     *
     * @return string
     */
    public function getImageAttribute($val): string
    {

        return $val !== null ? 'admin/images/brands/' . $val : '';

    }
    
    /**
     * Method scopeIsActive
     *
     * @param $query $query [explicite description]
     *
     * @return void
     */
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    /**
     * Method setSlugAttribute
     *
     * @param $value $value [explicite description]
     *
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }


}
