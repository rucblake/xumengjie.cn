<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'version' => '181126'
        ];
        return view('index', $data);
    }
}
