'use client';
import { useState } from 'react';

export default function ContactPage() {
  const [status, setStatus] = useState('');

  const sendTest = async () => {
    setStatus('送信中。。。');

    // テスト用の固定データ
    const testData = {
      first_name: 'Test',
      last_name: 'Taro',
      corp_name: 'Test Corp',
      email: `test-${Date.now()}@example.com`,
      content: 'Next.jsからの送信テスト',
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