<?php

namespace App\Controllers;

class Product extends Controller
{
    public function index()
    {
        return view('list');
    }
}