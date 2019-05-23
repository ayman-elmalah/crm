<?php

/**
 * App languages
 *
 * @return array
 */
function app_languages()
{
    return [
        'ar' => 'اللغة العربية',
        'en' => 'English',
    ];
}

/**
 * Language middleware
 *
 * @return void
 */
function lang_middleware()
{
    request()->lang = (request()->cookie('lang') && array_key_exists(request()->cookie('lang'), app_languages())) ? request()->cookie('lang') : config('app.locale');

    app()->setLocale(request()->lang);
}

/**
 * Upload File
 *
 * @return string
 */
function upload_file($directory, $file){
    $filename = rand().time().'.'.$file->getClientOriginalExtension();

    Storage::putFileAs('public/uploads/'.$directory, $file, $filename);

    return $filename;
}

/**
 * Uploded file path from storage
 *
 * @return string
 */
function uploded_file($directory, $file) {
    return url(Storage::url('public/uploads/' . $directory . '/' . $file));
}
