<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        // Ambil pengaturan dikelompokkan berdasarkan group_name
        $settings = Setting::all()->groupBy('group_name');
        
        // Pastikan group 'general' ada sebagai default tampilan pertama
        if (!isset($settings['general'])) {
            $settings['general'] = collect();
        }

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        try {
            DB::beginTransaction();

            foreach ($data as $key => $value) {
                // Cari setting berdasarkan key_name
                $setting = Setting::where('key_name', $key)->first();
                
                if ($setting) {
                    // Update value berdasarkan tipenya
                    $finalValue = $value;
                    
                    if ($setting->type === 'boolean') {
                        $finalValue = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
                    }
                    
                    $setting->update(['value' => $finalValue]);
                }
            }

            DB::commit();
            return back()->with('success', 'Configuration synchronized successfully across all nodes.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Critical synchronization failure: ' . $e->getMessage());
        }
    }
}
