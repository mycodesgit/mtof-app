<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\AppLogoFavicon;
use App\Models\AppName;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = AppLogoFavicon::first();
        $settingsname = AppName::first();

        return view('setting.systemset', compact('settings', 'settingsname'));
    }

    public function createLogoFavicon(Request $request)
    {
        $validated = $request->validate([
            'logosys'    => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'faviconsys' => 'nullable|image|mimes:png,ico|max:512',
        ]);

        try {
            // Find the existing settings record or create a new one if it doesn't exist
            $settings = AppLogoFavicon::first() ?? new AppLogoFavicon();

            // Handle System Main Logo upload (stored in 'storage/app/public/systemlogo')
            if ($request->hasFile('logosys')) {
                if ($settings->logosys && Storage::disk('public')->exists($settings->logosys)) {
                    Storage::disk('public')->delete($settings->logosys);
                }
                $settings->logosys = $request->file('logosys')->store('systemlogo', 'public');
            }

            // Handle Favicon upload (stored in 'storage/app/public/systemlogo')
            if ($request->hasFile('faviconsys')) {
                if ($settings->faviconsys && Storage::disk('public')->exists($settings->faviconsys)) {
                    Storage::disk('public')->delete($settings->faviconsys);
                }
                $settings->faviconsys = $request->file('faviconsys')->store('systemlogo', 'public');
            }

            $settings->save();

            return response()->json([
                'success' => true, 
                'message' => 'System logo and favicon updated successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => true, 
                'message' => 'Failed to save logo and favicon settings!'
            ], 500);
        }
    }

    public function updateGeneralSettings(Request $request)
    {
        $validated = $request->validate([
            'application_headername' => 'required|string|max:255',
            'application_fullname'   => 'required|string',
            'application_desc'       => 'nullable|string',
            'application_about'      => 'nullable|string',
            'application_category'   => 'nullable|string',
            'application_email'      => 'nullable|email|max:255',
            'application_contactno'  => 'nullable|string|max:50',
        ]);

        try {
            // Updates the first record or creates one if the table is empty
            $appSetting = AppName::first() ?? new AppName();
            $appSetting->fill($validated);
            $appSetting->save();

            return response()->json([
                'success' => true,
                'message' => 'General settings updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to save general settings!'
            ], 500);
        }
    }
}
