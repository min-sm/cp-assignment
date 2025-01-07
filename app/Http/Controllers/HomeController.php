<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = [
            [
                'image' => 'img/slider-1.jpg',
                'title' => 'Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport',
                'description' => 'Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order. Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.',
                'price' => '$599',
            ],
            [
                'image' => 'img/slider-2.jpg',
                'title' => 'Samsung Galaxy Watch 4, Bluetooth, 40mm, Black',
                'description' => 'The latest.',
                'price' => '$349',
            ],
            // Add more mock products as needed
        ];

        return view('pages.home', compact('products'));
    }
}
