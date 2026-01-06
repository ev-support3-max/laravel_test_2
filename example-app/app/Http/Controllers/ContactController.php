<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Http\Requests\StoreInquiryRequest;

class ContactController extends Controller
{
    public function index()
    {
        // 飛び先
        return view('contact.index');
    }

    public function store(StoreInquiryRequest $request)
    {
        Inquiry::create($request->validated());

        // リダイレクト後に戻る場所
        return redirect()
                ->route('contact.index')
                ->with('success', 'お問い合わせを送信しました。');
    }
}
