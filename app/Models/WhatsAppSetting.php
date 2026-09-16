<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppSetting extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_settings';

    protected $guarded = [];

    protected $casts = [
        'enabled' => 'boolean',
        'notifications' => 'array',
    ];

    /**
     * Default event notification keys
     */
    public static function defaultEvents()
    {
        return [
            'on_deposit' => true,
            'on_withdrawal' => true,
            'on_plan_purchase' => true,
            'on_wallet_connect' => true,
            'on_registration' => true,
            'on_kyc_submit' => true,
            'on_contact_message' => true,
            'on_transfer' => true,
        ];
    }

    /**
     * Get or create the singleton instance of WhatsApp settings
     */
    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'enabled' => false,
                'provider' => 'ultramsg',
                'instance_id' => null,
                'token' => null,
                'admin_number' => null,
                'notifications' => self::defaultEvents(),
            ]);
        }
        return $settings;
    }

    /**
     * Check if WhatsApp notifications are enabled globally AND for a specific event
     */
    public function isEventEnabled(string $event): bool
    {
        if (!$this->enabled) {
            return false;
        }

        $notifications = is_array($this->notifications) ? $this->notifications : json_decode($this->notifications ?? '[]', true);

        return !empty($notifications[$event]);
    }
}
