<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'general')->pluck('value', 'key');
        return view('admin.settings.general', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'currency', 'currency_symbol', 'free_shipping_above', 'tax_rate',
            'footer_text', 'facebook_url', 'instagram_url', 'twitter_url', 'youtube_url',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field), 'general');
        }

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $file     = $request->file('site_logo');
            $filename = 'logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            Setting::set('site_logo', $filename, 'general');
        }

        if ($request->hasFile('site_favicon')) {
            $file     = $request->file('site_favicon');
            $filename = 'favicon.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            Setting::set('site_favicon', $filename, 'general');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully.');
    }

    public function payment()
    {
        $settings = Setting::where('group', 'payment')->pluck('value', 'key');
        return view('admin.settings.payment', compact('settings'));
    }

    public function updatePayment(Request $request)
    {
        $fields = [
            'stripe_key', 'stripe_secret', 'stripe_enabled',
            'paypal_client_id', 'paypal_secret', 'paypal_mode', 'paypal_enabled',
            'cod_enabled', 'cod_charge',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''), 'payment');
        }

        return redirect()->route('admin.settings.payment')->with('success', 'Payment settings saved.');
    }

    public function email()
    {
        $settings = Setting::where('group', 'email')->pluck('value', 'key');
        return view('admin.settings.email', compact('settings'));
    }

    public function updateEmail(Request $request)
    {
        $fields = ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption', 'mail_from_name'];
        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''), 'email');
        }
        return redirect()->route('admin.settings.email')->with('success', 'Email settings saved.');
    }

    public function seo()
    {
        $settings = Setting::where('group', 'seo')->pluck('value', 'key');
        return view('admin.settings.seo', compact('settings'));
    }

    public function updateSeo(Request $request)
    {
        $fields = ['meta_title', 'meta_description', 'meta_keywords', 'google_analytics', 'google_tag_manager'];
        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''), 'seo');
        }
        return redirect()->route('admin.settings.seo')->with('success', 'SEO settings saved.');
    }
}
