'use client'

import { useState, useEffect } from 'react'
import axios from '@/src/lib/axios'

interface User {
        id: number;
        name: string;
        email: string;
    }

export default function LoginPage() {
    const [email, setEmail] = useState('admin@gmail.com')
    const [password, setPassword] = useState('1111')
    const [user, setUser] = useState<User | null>(null) // ログインユーザーの保存

    useEffect(() => {
        // 関数を useEffect の中に引っ越す
        const checkLoginStatus = async () => {
            try {
                const res = await axios.get('/api/user')
                setUser(res.data)
            } catch {
                setUser(null)
            }
        }

        checkLoginStatus()
    }, []) // ここが空配列なら、初回1回だけ実行される

    const handleLogin = async (e: React.FormEvent) => {
        e.preventDefault()

        try {
            await axios.get('/sanctum/csrf-cookie')

            // ログインを試みる（エラーが出ても無視して進む設定）
            await axios.post('/api/login', { email, password }, {
                headers: { 'Accept': 'application/json' }
            }).catch( () => {
                // リダイレクトによるCORSエラーは、通信自体は成功していることが多いです
                console.log('Post自体は完了しました');
            });

            // 【ここが本番】本当にログインできたかユーザー情報を取ってみる
            const res = await axios.get('api/user')
            setUser(res.data)
            alert(`おめでとうございます！${res.data.name}さんとしてログインしました！`);

        } catch (error) {
            console.error('本当の失敗:', error);
        }
    }

    const handleLogout = async () => {
        try {
            await axios.post('/api/logout')
            setUser(null)
            alert('ログアウトしました')
        } catch (error) {
            alert('ログアウト失敗')
        }
    }

    return (
        <div className='flex flex-col items-center justify-center min-h-screen bg-gray-100 text-black'>
            
        </div>
    )
    
}