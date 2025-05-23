<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
    ];
    
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @param string|null $description
     * @return Setting
     */
    public static function setValue($key, $value, $description = null)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        
        if ($description && !$setting->exists) {
            $setting->description = $description;
        }
        
        $setting->save();
        return $setting;
    }
}
