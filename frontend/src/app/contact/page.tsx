'use client';
import { useState } from 'react';

export default function ContactPage() {
    const [message, setMessage] = useState('未確認');

    const checkConnection = async () => {
        try {
            // ★ credentials (Cookie設定) は書かない！ただのfetch！
            const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/health`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            const data = await res.json();
            setMessage(`接続成功: ${data.status}`);
        } catch (error) {
            console.error(error);
            setMessage('接続失敗');
        }
    };

    return (
        <div className="p-10">
            <h1 className="text-2xl font-bold mb-4">API接続テスト (Token/Publicモード)</h1>
            <p className="mb-4">状態: {message}</p>
            <button 
                onClick={checkConnection}
                className="bg-blue-500 text-white px-4 py-2 rounded"
            >
                接続確認
            </button>
        </div>
    );
}