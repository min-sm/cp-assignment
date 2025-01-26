<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        return view('pages.inquiry');
    }

    public function create() {}
}
