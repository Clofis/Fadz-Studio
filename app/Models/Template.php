<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'thumbnail',
        'preview_link',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Generate WhatsApp link otomatis
     */
    public function whatsappLink(): string
    {
        $setting = Setting::first();
        $phone = $setting ? $setting->whatsapp_number : '';
        $message = "Halo Admin, saya ingin pesan template *{$this->code}*";
        
        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }
}