@php
    $settings = \App\Models\Settings::first();
@endphp
@include('errors.maintenance', ['settings' => $settings])
