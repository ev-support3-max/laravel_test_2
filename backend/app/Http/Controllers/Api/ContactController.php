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

        return response()->json($contacts, 200);
    }

    public function store(ContactRequest $request)
    {
        // 1. データをDBに保存
        $contact = Contact::create($request->validated());

        // 2. JSONを返す
        return response()->json([
            'message' => 'お問い合わせを受け付けました',
            'data' => $contact
        ], 201);
    }
}
