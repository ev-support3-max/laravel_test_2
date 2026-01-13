<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::latest()->get();
    }
    
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'お問い合わせを受け取りました',
        ]);
    }
}
