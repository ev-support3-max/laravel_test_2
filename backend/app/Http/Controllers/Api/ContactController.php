<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return response()->json($contacts);
    }

    public function store(ContactRequest $request)
    {
        // $contact = Contact::create($request->validated());

        // return response()->json([
        //     'message' => 'お問い合わせを受け取りました',
        //     'data' => $contact, // データも返すと親切です
        // ], 201);
    }
}
