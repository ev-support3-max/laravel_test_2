<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // 飛び先
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'corp_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        Inquiry::create($validated);

        // リダイレクト後に戻る場所
        return redirect()->route('contact.index')->with('success', 'お問い合わせを送信しました。');
    }
}
