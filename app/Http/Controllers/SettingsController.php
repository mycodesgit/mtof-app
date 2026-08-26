<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\AppLogoFavicon;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = AppLogoFavicon::first();

        return view('setting.systemset', compact('settings'));
    }

    public function createLogoFavicon(Request $request)
    {
        $validated = $request->validate([
            'logosys'    => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'faviconsys' => 'nullable|image|mimes:png,ico|max:512',
        ]);

        //try {
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
            
        //} catch (\Exception $e) {
            return response()->json([
                'error' => true, 
                'message' => 'Failed to save logo and favicon settings!'
            ], 500);
        //}
    }
}
