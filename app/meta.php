<?php
namespace App;

/**
 * Inert license stub - external phone-home eliminated for security.
 */
class meta
{
    public function __construct()
    {
    }

    public function check_local_license_exist()
    {
        return true;
    }

    public function get_current_version()
    {
        return '1.0.0';
    }

    public function verify_license($time_based_check = false, $license = false, $client = false)
    {
        return ['status' => true, 'message' => 'Verified'];
    }

    public function deactivate_license($license = false, $client = false)
    {
        return ['status' => true, 'message' => 'Deactivated'];
    }
}
