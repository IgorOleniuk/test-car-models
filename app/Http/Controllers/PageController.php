<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function brands()
    {
        return view('brands');
    }

    public function models(int $id)
    {
        return view('models', compact('id'));
    }
}
