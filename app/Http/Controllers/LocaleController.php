<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    public function changeLocale($locale)
{
    if (!in_array($locale, ['en', 'uz'])) {
        $locale = 'en';
    }

    Session::put('locale', $locale); // Session ga saqlash
    return redirect()->back();
}

}
