<?php

namespace App\Http\Controllers;


class HomeController extends AdminMainController
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/


    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        return view('index');
    }
}
