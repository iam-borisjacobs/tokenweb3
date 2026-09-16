<?php

namespace App\Services;

use App\Models\WhatsAppSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send an event-triggered notification if enabled
     *
     * @param string $eventType Event key (e.g. 'on_deposit', 'on_withdrawal', etc.)
     * @param string $title Short title of the alert
     * @param array $details Associative array of event fields
     * @return bool
     */
    public static function sendNotification(string $eventType, string $title, array $details = []): bool
    {
        try {
            $settings = WhatsAppSetting::getSettings();

            if (!$settings->isEventEnabled($eventType)) {
                return false;
            }

            $provider = $settings->provider ?? 'ultramsg';
            $instanceId = trim($settings->instance_id ?? '');
            $token = trim($settings->token ?? '');
            $adminNumber = trim($settings->admin_number ?? '');

            if (empty($instanceId) || empty($token) || empty($adminNumber)) {
                Log::info("WhatsApp alert for [{$eventType}] skipped: Missing WhatsApp API credentials or admin phone number.");
                return false;
            }

            $body = self::buildMessage($title, $details);

            $result = self::sendDirect($provider, $instanceId, $token, $adminNumber, $body);

            return $result['success'] ?? false;
        } catch (\Throwable $e) {
            Log::warning("WhatsApp notification error for [{$eventType}]: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Dispatch a direct message via the specified provider
     *
     * @param string $provider 'ultramsg' or 'green_api'
     * @param string $instanceId
     * @param string $token
     * @param string $adminNumber
     * @param string $message
     * @return array
     */
    public static function sendDirect(string $provider, string $instanceId, string $token, string $adminNumber, string $message): array
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $adminNumber);
        if (empty($cleanPhone)) {
            return [
                'success' => false,
                'message' => 'Admin phone number is invalid or empty.'
            ];
        }

        try {
            if ($provider === 'green_api') {
                // Green-API format: https://api.green-api.com/waInstance{idInstance}/sendMessage/{apiTokenInstance}
                $cleanInstanceId = preg_replace('/^waInstance/i', '', $instanceId);
                $url = "https://api.green-api.com/waInstance{$cleanInstanceId}/sendMessage/{$token}";
                $chatId = $cleanPhone . '@c.us';

                $response = Http::timeout(8)
                    ->asJson()
                    ->post($url, [
                        'chatId' => $chatId,
                        'message' => $message,
                    ]);

                $json = $response->json();
                if ($response->successful() && !empty($json['idMessage'])) {
                    return [
                        'success' => true,
                        'message' => 'Notification dispatched successfully via Green-API.',
                        'response' => $json,
                    ];
                }

                $err = $json['message'] ?? $response->body();
                Log::warning("Green-API error: " . $err);
                return [
                    'success' => false,
                    'message' => 'Green-API error: ' . $err,
                    'response' => $json,
                ];
            } else {
                // UltraMsg format: https://api.ultramsg.com/{instance_id}/messages/chat
                $cleanInstance = preg_replace('/^instance/i', 'instance', $instanceId);
                $url = "https://api.ultramsg.com/{$cleanInstance}/messages/chat";

                $response = Http::timeout(8)
                    ->asForm()
                    ->post($url, [
                        'token' => $token,
                        'to' => $cleanPhone,
                        'body' => $message,
                        'priority' => 10,
                    ]);

                $json = $response->json();
                if ($response->successful() && (isset($json['sent']) && ($json['sent'] === 'true' || $json['sent'] === true || isset($json['id'])))) {
                    return [
                        'success' => true,
                        'message' => 'Notification dispatched successfully via UltraMsg.',
                        'response' => $json,
                    ];
                }

                $err = $json['error'] ?? $json['message'] ?? $response->body();
                Log::warning("UltraMsg error: " . $err);
                return [
                    'success' => false,
                    'message' => 'UltraMsg error: ' . $err,
                    'response' => $json,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning("WhatsApp dispatch exception: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Send a test message to verify credentials and delivery
     */
    public static function sendTestMessage(string $provider, string $instanceId, string $token, string $adminNumber): array
    {
        $testMsg = "✅ *ECX Groups WhatsApp Alert Test*\n" .
                   "━━━━━━━━━━━━━━━━━━━━\n" .
                   "🎉 *Connection Successful!*\n" .
                   "Your website administrator alerts are correctly connected and ready to deliver real-time notifications.\n" .
                   "━━━━━━━━━━━━━━━━━━━━\n" .
                   "📅 *Timestamp:* " . now()->format('Y-m-d H:i:s') . "\n" .
                   "⚡ *Provider:* " . strtoupper($provider);

        return self::sendDirect($provider, $instanceId, $token, $adminNumber, $testMsg);
    }

    /**
     * Format details into a clean, modern WhatsApp message layout
     */
    private static function buildMessage(string $title, array $details): string
    {
        $appName = config('app.name', 'ECX Groups');

        $lines = [];
        $lines[] = "🔔 *{$appName} Alert: {$title}*";
        $lines[] = "━━━━━━━━━━━━━━━━━━━━";

        foreach ($details as $label => $value) {
            if (is_null($value) || $value === '') {
                continue;
            }
            $lines[] = "• *{$label}:* {$value}";
        }

        $lines[] = "━━━━━━━━━━━━━━━━━━━━";
        $lines[] = "📅 *Time:* " . now()->format('Y-m-d H:i:s');

        return implode("\n", $lines);
    }
}
