<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'setting_key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['setting_key', 'setting_value'];

    /**
     * Get a setting value by key, optionally decoded as JSON.
     */
    public static function getValue(string $key, bool $asArray = false): mixed
    {
        $setting = static::find($key);
        if (!$setting) return null;

        if ($asArray) {
            return json_decode($setting->setting_value, true);
        }

        return $setting->setting_value;
    }

    /**
     * Set (upsert) a setting.
     */
    public static function setValue(string $key, mixed $value): void
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        static::updateOrCreate(
            ['setting_key' => $key],
            ['setting_value' => $value]
        );
    }
}
