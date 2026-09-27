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
        $defaultTruck = 'truck_logistics_fleet.jpg';
        $defaultCrypto = 'plan_gold_ecx.jpg';
        $fallback = $this->isTruck() ? $defaultTruck : $defaultCrypto;

        if (empty($this->image)) {
            return asset('themes/ecx/assets/images/plans/' . $fallback);
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $clean = ltrim($this->image, '/');
        $baseName = basename($clean);

        // 1. Tracked ECX theme plan image (committed to Git, directly accessible on cPanel)
        if (file_exists(public_path('themes/ecx/assets/images/plans/' . $baseName)) || file_exists(base_path('themes/ecx/assets/images/plans/' . $baseName))) {
            return asset('themes/ecx/assets/images/plans/' . $baseName);
        }

        // 2. Direct public/photos/ folder
        if (file_exists(public_path('photos/' . $baseName)) || file_exists(base_path('public/photos/' . $baseName))) {
            return asset('photos/' . $baseName);
        }

        // 3. Public storage photos folder
        if (file_exists(public_path('storage/photos/' . $baseName))) {
            return asset('storage/photos/' . $baseName);
        }

        // 4. Public storage relative path
        if (file_exists(public_path('storage/' . $clean))) {
            return asset('storage/' . $clean);
        }

        // 5. If the base file exists in themes/ecx under public
        if (file_exists(public_path('themes/ecx/assets/images/plans/' . $fallback))) {
            return asset('themes/ecx/assets/images/plans/' . $fallback);
        }

        return asset('themes/ecx/assets/images/plans/' . $baseName);
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
