'use client';

import { useState } from 'react';

export default function ContactPage() {
    // 1. フォームの入力値を管理する State
    const [formData, setFormData] = useState({
        last_name: '',
        first_name: '',
        corp_name: '',
        email: '',
        content: '',
    });

    // 2. 通信状態やエラーメッセージを管理する State
    const [status, setStatus] = useState(''); 
    // Laravelのエラーは { email: ['必須です'], ... } の形なので、それに合わせた型定義
    const [validationErrors, setValidationErrors] = useState<Record<string, string[]>>({});

    // 入力欄の内容が変わるたびに実行される関数
    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    // 送信ボタンが押されたときの関数
    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault(); // 画面のリロードを防ぐ
        setStatus('送信中...');
        setValidationErrors({}); // エラー表示を一旦リセット

        try {
            // Step 2で成功したAPIへ、今度は formData を送る
            const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/contact`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formData),
            });

            const data = await res.json();

            if (res.ok) {
                // 成功 (200 OK / 201 Created)
                setStatus('送信完了！お問い合わせありがとうございました。');
                // フォームを空にする
                setFormData({ last_name: '', first_name: '', corp_name: '', email: '', content: '' });
            } else if (res.status === 422) {
                // バリデーションエラー (422 Unprocessable Content)
                setStatus('入力内容に不備があります。');
                setValidationErrors(data.errors); // Laravelからのエラー詳細をセット
            } else {
                // その他のエラー (500など)
                setStatus('サーバーエラーが発生しました。');
                console.error(data);
            }
        } catch (error) {
            console.error(error);
            setStatus('通信エラーが発生しました。');
        }
    };

    return (
        <div className="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow-md text-gray-800">
            <h1 className="text-2xl font-bold mb-6 text-center">お問い合わせ</h1>

            {/* ステータスメッセージ表示エリア */}
            {status && (
                <div className={`mb-6 p-4 rounded text-center font-bold ${status.includes('完了') ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700'}`}>
                    {status}
                </div>
            )}

            <form onSubmit={handleSubmit} className="space-y-6">
                {/* 氏名（横並び） */}
                <div className="flex flex-col md:flex-row gap-4">
                    <div className="w-full">
                        <label className="block text-sm font-medium mb-1">姓 <span className="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="last_name"
                            value={formData.last_name}
                            onChange={handleChange}
                            className={`w-full border p-2 rounded ${validationErrors.last_name ? 'border-red-500 bg-red-50' : 'border-gray-300'}`}
                            placeholder="山田"
                        />
                        {validationErrors.last_name && <p className="text-red-500 text-sm mt-1">{validationErrors.last_name[0]}</p>}
                    </div>
                    <div className="w-full">
                        <label className="block text-sm font-medium mb-1">名 <span className="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="first_name"
                            value={formData.first_name}
                            onChange={handleChange}
                            className={`w-full border p-2 rounded ${validationErrors.first_name ? 'border-red-500 bg-red-50' : 'border-gray-300'}`}
                            placeholder="太郎"
                        />
                        {validationErrors.first_name && <p className="text-red-500 text-sm mt-1">{validationErrors.first_name[0]}</p>}
                    </div>
                </div>

                {/* 会社名 */}
                <div>
                    <label className="block text-sm font-medium mb-1">会社名</label>
                    <input
                        type="text"
                        name="corp_name"
                        value={formData.corp_name}
                        onChange={handleChange}
                        className="w-full border p-2 rounded border-gray-300"
                        placeholder="株式会社〇〇"
                    />
                     {/* 会社名は任意ですが、もしエラーがあれば表示 */}
                     {validationErrors.corp_name && <p className="text-red-500 text-sm mt-1">{validationErrors.corp_name[0]}</p>}
                </div>

                {/* メールアドレス */}
                <div>
                    <label className="block text-sm font-medium mb-1">メールアドレス <span className="text-red-500">*</span></label>
                    <input
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                        className={`w-full border p-2 rounded ${validationErrors.email ? 'border-red-500 bg-red-50' : 'border-gray-300'}`}
                        placeholder="example@email.com"
                    />
                    {validationErrors.email && <p className="text-red-500 text-sm mt-1">{validationErrors.email[0]}</p>}
                </div>

                {/* 本文 */}
                <div>
                    <label className="block text-sm font-medium mb-1">お問い合わせ内容 <span className="text-red-500">*</span></label>
                    <textarea
                        name="content"
                        value={formData.content}
                        onChange={handleChange}
                        rows={5}
                        className={`w-full border p-2 rounded ${validationErrors.content ? 'border-red-500 bg-red-50' : 'border-gray-300'}`}
                        placeholder="お問い合わせ内容をご記入ください"
                    ></textarea>
                    {validationErrors.content && <p className="text-red-500 text-sm mt-1">{validationErrors.content[0]}</p>}
                </div>

                {/* 送信ボタン */}
                <button
                    type="submit"
                    className="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition duration-200"
                >
                    送信する
                </button>
            </form>
        </div>
    );
}