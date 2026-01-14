1. axios の作成 (src/lib/axios.ts)
まずは Laravel と通信するための設定ファイルを作ります。 frontend/src/lib フォルダを作成し、その中に axios.ts を作ってください。

TypeScript

import Axios from 'axios'

const axios = Axios.create({
    baseURL: process.env.NEXT_PUBLIC_API_BASE_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
    withCredentials: true, // Cookie認証に必須
    withXSRFToken: true,   // Laravel 11のCSRF対策に必須
})

export default axios
2. ログイン画面の作成 (src/app/login/page.tsx)
次に、実際にログインを試す画面です。src/app/login フォルダを作り、その中に page.tsx を作ります。

TypeScript

'use client'
import { useState } from 'react'
import axios from '@/lib/axios'

export default function LoginPage() {
    const [email, setEmail] = useState('admin@gmail.com')
    const [password, setPassword] = useState('1111') // Seederで作ったパスワード

    const handleLogin = async (e: React.FormEvent) => {
        e.preventDefault()
        try {
            // 1. CSRFトークンを初期化（Sanctumの儀式）
            await axios.get('/sanctum/csrf-cookie')
            // 2. ログイン実行
            await axios.post('/login', { email, password })
            
            alert('ログイン成功！通信がつながりました！')
        } catch (error: any) {
            console.error(error)
            alert('失敗：詳細はコンソールを見てね')
        }
    }

    return (
        <div className="p-10">
            <h1 className="text-2xl mb-4">ログインテスト</h1>
            <form onSubmit={handleLogin} className="space-y-4">
                <input type="email" value={email} onChange={e => setEmail(e.target.value)} className="border p-2 block text-black" />
                <input type="password" value={password} onChange={e => setPassword(e.target.value)} className="border p-2 block text-black" />
                <button type="submit" className="bg-blue-500 text-white p-2 rounded">接続テスト開始</button>
            </form>
        </div>
    )
}
3. 運命の接続テスト
ブラウザで https://...-3000.app.github.dev/login を開く。

「接続テスト開始」ボタンを押す。

🚨 もしエラーが出た場合（Codespacesでよくあること）
もし 419 (Unknown) や CORS エラーが出たら、Laravel側の .env 設定が Codespaces の今のURLとズレている可能性があります。その時は以下を確認してください：

SANCTUM_STATEFUL_DOMAINS: ...-3000.app.github.dev (Next.jsのURL、https:// は無し)

FRONTEND_URL: https://...-3000.app.github.dev (Next.jsのURL、https:// 有り)

まずはボタンを押して、「成功！」のアラートが出るかどうか試してみてください。 これさえ通れば、あとは自由にマイページのデザインをいじっていくだけです！

どうなりましたか？ドキドキしますね。