<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp_number',
        'brand_name',
        'instagram',
        'tiktok',
    ];

    /**
     * Singleton pattern - hanya 1 record setting
     */
    public static function get()
    {
        return self::first() ?? self::create([
            'whatsapp_number' => '',
            'brand_name' => 'Undangan Digital',
            'instagram' => '',
            'tiktok' => '',
        ]);
    }
}