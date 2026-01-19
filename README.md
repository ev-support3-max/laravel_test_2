'use client'

import { useEffect, useState } from 'react'

export default function ContactPage() {
  const [message, setMessage] = useState('')
  const [error, setError] = useState('')

  useEffect(() => {
    console.log("ContactPage mounted. Starting fetch..."); // 1. 開始ログ

    const fetchData = async () => {
      try {
        // 環境変数を使わず、直接URLを指定してテストする
        const url = 'https://solid-potato-xrvq99jrx6gf9qg9-80.app.github.dev/api/contact';
        console.log("Fetching URL:", url); // 2. URL確認

        const res = await fetch(url);
        console.log("Response status:", res.status); // 3. ステータス確認

        if (!res.ok) {
          throw new Error(`HTTP error: ${res.status}`);
        }

        const data = await res.json();
        console.log("Data received:", data); // 4. データ受信確認
        setMessage(JSON.stringify(data, null, 2)); // 整形して表示

      } catch (err) {
        console.error("Fetch error details:", err); // 5. エラー詳細
        if (err instanceof Error) {
          setError(err.message);
        } else {
          setError('Unknown error');
        }
      }
    }

    fetchData();
  }, [])

  // エラーがあれば表示
  if (error) return (
    <main>
        <h1>Contact - Error</h1>
        <p style={{ color: 'red' }}>❌ {error}</p>
    </main>
  );

  return (
    <main>
      <h1>Contact</h1>
      {/* messageが空の間は Loading... を表示して区別する */}
      {message ? (
          <pre style={{ background: '#f0f0f0', padding: '10px' }}>{message}</pre>
      ) : (
          <p>Loading API data...</p>
      )}
    </main>
  )
}