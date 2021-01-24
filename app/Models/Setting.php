<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, Translatable;

    /**
     * @var string[]
     */
    protected $with = ['translations'];

    /**
     * @var string[]
     */
    protected $fillable = ['key', 'is_translatable', 'palin_value'];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_translatable' => 'boolean'
    ];

    /**
     * @var string[]
     */
    protected $translatedAttributes = ['value'];

    /**
     * set given settings
     *
     * @param array $settings
     *
     * @return void
     */
    public static function setMany(array $settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    /**
     * set the given setting
     * @param string $key
     * @param mixed $value
     * @return void
     */

    public static function set(string $key, mixed $value)
    {
        if ($key === 'translatable') {
            return static::setTranslatableSettings($value);
        }

        $value = is_array($value) ? json_encode($value) : $value;

        static::updateOrCreate(['key' => $key , 'plain_value' => $value]);
    }

    /**
     * @param array $settings
     * @return void
     */
    private static function setTranslatableSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            static::updateOrCreate(['key' => $key], [
                'is_translatable' => true,
                'value' => $value
            ]);
        }
    }
}
