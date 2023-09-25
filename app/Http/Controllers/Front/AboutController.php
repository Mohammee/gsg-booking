<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('site.about');
    }
}
