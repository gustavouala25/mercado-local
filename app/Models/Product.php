<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image_path',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['whatsapp_link'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function whatsappLink(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->vendor || !$this->vendor->whatsapp_number) {
                    return null;
                }

                $text = urlencode("Hola, vi {$this->name} en el Marketplace y me interesa");
                return "https://wa.me/{$this->vendor->whatsapp_number}?text={$text}";
            }
        );
    }
}
