<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_url'];

    /**
     * Resolve the public web asset URL for the plan's picture.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $clean = ltrim($this->image, '/');

        if (str_starts_with($clean, 'storage/app/public/')) {
            return asset($clean);
        }

        return asset('storage/app/public/' . $clean);
    }

    /**
     * Check if this is a Truck / Real-World Asset plan.
     */
    public function isTruck()
    {
        $cat = strtolower($this->category ?? '');
        $type = strtolower($this->type ?? '');
        return $cat === 'truck' || $cat === 'asset' || $type === 'truck' || $type === 'asset';
    }

    /**
     * Get a human-readable category badge label.
     */
    public function getCategoryLabelAttribute()
    {
        return $this->isTruck() ? 'Trucking & Assets' : 'Crypto & Trading';
    }
}
