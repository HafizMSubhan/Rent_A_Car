<?php

// app/Http/Controllers/SettingsController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // Retrieve the current rate per kilometer setting
        $ratePerKm = Setting::where('key', 'rate_per_km')->first()->value;

        return view('settings', compact('ratePerKm'));
    }

    public function update(Request $request)
    {
        // Validate and update the rate per kilometer setting
        $request->validate([
            'rate_per_km' => 'required|numeric',
        ]);

        Setting::updateOrCreate(
            ['key' => 'rate_per_km'],
            ['value' => $request->input('rate_per_km')]
        );

        return redirect()->route('settings')->with('success', 'Rate per kilometer updated successfully.');
    }
}
