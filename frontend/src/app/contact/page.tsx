'use client';
import React, { useState } from 'react';

export default function ContactPage() {
  // 1. 入力データを定義
  const [formData, setFormData] = useState({
    first_name: '',
    last_name: '',
    corp_name: '',
    email: '',
    content: '',
  });

  // そのほかのメッセージの定義
  const [status, setStatus] = useState(''); // 送信成功 or 失敗メッセージ
  const [validationErrors, setValidationErrors] = useState<any>({});


  // 2. 入力するたびにデータを更新
  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  // 3. 送信ボタンをおしたときの関数
  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault(); // 画面のリロードを防ぐ
    setStatus('送信中...');
    setValidationErrors({}); // エラーを一旦リセット
  }

  try {
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
      // 成功時(201)
      setStatus('送信完了！お問い合わせありがとうございます');
      setFormData({ first_name: '', last_name: '', corp_name: '', email: '', content: ''})
    }
  }


  const sendTest = async () => {
    setStatus('送信中。。。');

    // テスト用の固定データ
    const testData = {
      first_name: '',
      last_name: '',
      corp_name: '',
      email: ``,
      content: '',
    };

    try {
      const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/contact`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(testData),
      });

      if (res.ok) {
        const data = await res.json();
        console.log(data);
        setStatus('送信成功！DBを確認して下さい');
      } else {
        const errorData = await res.json();
        console.error(errorData);
        setStatus(`エラー：${res.status} ${JSON.stringify(errorData)}`);
      }
    } catch (error) {
      console.error(error);
      setStatus('通信エラー');
    }
  };

  return (
    <div className='p-10'>
      <h1 className="text-2xl font-bold mb-4">POST送信テスト（お問い合わせ）</h1>
      <p className="mb-4 text-blue-600 font-bold">{status}</p>
      <button
        onClick={sendTest}
        className='bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700'
      >
        テストデータを送信
      </button>
    </div>
  );
}