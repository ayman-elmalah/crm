<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Slug
     *
     * @return string
     */
    public $slug = 'dashboard';

    /**
     * Dashboard page
     *
     * @return view
     */
    public function index() {
        $slug = $this->slug;
        $title = __('lang.dashboard');

        return view('admin.dashboard.index', compact('slug', 'title'));
    }

    /**
     * Set language default
     *
     * @return redirect
     */
    public function setLanguage($lang, Request $request)
    {
        $languages = app_languages();

        return array_key_exists($lang, $languages) ? redirect()->back()->withCookie(cookie()->forever('lang', $lang)) : redirect()->back();
    }
}
