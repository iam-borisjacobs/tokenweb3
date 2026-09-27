<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use App\Traits\PingServer;
use Livewire\Component;

class SoftwareModule extends Component
{
    use PingServer;

    public function render()
    {
        $settings = Settings::find(1);
        $mod = $settings ? $settings->modules : [];
        return view('livewire.admin.software-module', [
            'mod' => $mod,
        ]);
    }

    public function updateModule($module, $value)
    {
        $settings = Settings::find(1);
        $boolVal = ($value === 'true' || $value === true || $value === 1 || $value === '1');

        if ($module == 'membership' or $module == 'signal') {
            try {
                $response = $this->fetctApi('/set-modules', [
                    'value' => $value,
                    'module' => $module
                ], 'POST');
                $info = json_decode($response);
            } catch (\Throwable $e) {
                $info = null;
            }

            // Always persist the module option state
            $options = $settings->modules;
            $options[$module] = $boolVal;
            $settings->modules = $options;
            $settings->save();

            $msg = ($info && isset($info->message)) ? $info->message : 'Module status updated successfully';
            return redirect()->route('appsettingshow')->with('success', $msg);
        } else {
            // Save module option
            $options = $settings->modules ?? [];
            $options[$module] = $boolVal;

            // Maintain overall investment parent flag
            if ($module === 'investment_crypto' || $module === 'investment_truck') {
                $cryptoOn = isset($options['investment_crypto']) ? $options['investment_crypto'] : true;
                $truckOn = isset($options['investment_truck']) ? $options['investment_truck'] : true;
                $options['investment'] = ($cryptoOn || $truckOn);
            }

            if ($module === 'require_wallet_investment') {
                $settings->require_wallet_for_investment = $boolVal;
            }

            $settings->modules = $options;
            $settings->save();
            return redirect()->route('appsettingshow')->with('success', 'Action Successful');
        }
    }
}