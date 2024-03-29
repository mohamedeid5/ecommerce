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
     * hidden
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * translatedAttributes
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * Method scopeActive
     *
     * @param $query $query [explicite description]
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

}
