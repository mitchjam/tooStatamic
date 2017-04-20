<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InquirySubmitted;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        \Mail::to('mitchjam1928@gmail.com')->send(new InquirySubmitted($request->from, $request->description));

        return redirect('/')->withMessage('Thanks! We have received you message and will get back to you shortly.');
    }
}
