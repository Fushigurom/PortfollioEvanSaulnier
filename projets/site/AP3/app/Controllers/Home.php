<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function home(): string
    {
        return view('home');
    }

    public function tarifs(): string
    {
        return view('tarifs');
    }

    public function calendrier(): string
    {
        return view('calendrier');
    }

    public function contact(): string
    {
        return view('contact');
    }
}
