<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory, Translatable;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['product_id', 'variation_id', 'price'];

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
     * translatedAttributes
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * Method variation
     *
     * @return void
     */
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    /**
     * Method product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
