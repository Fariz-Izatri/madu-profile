<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterSettings;
use Illuminate\Support\Facades\Validator;

class FooterSettingsController extends Controller
{
    public function index()
    {
        $settings = FooterSettings::first();
        return view('admin.footer-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $settings = FooterSettings::first();
        if (!$settings) {
            $settings = new FooterSettings();
        }

        $settings->alamat = $request->alamat;
        $settings->email = $request->email;
        $settings->telepon = $request->telepon;
        $settings->facebook_url = $request->facebook_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->save();

        return redirect()->route('admin.footer-settings.index')
            ->with('success', 'Pengaturan footer berhasil diperbarui.');
    }
}
