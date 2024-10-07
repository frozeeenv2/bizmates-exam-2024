<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request, ?string $country = 'Japan')
    {
        $country = Country::with('cities')->where('name', $country)->firstOrFail();

        return view('welcome', compact(['country']));
    }
}
