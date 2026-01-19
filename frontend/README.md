This is a [Next.js](https://nextjs.org) project bootstrapped with [`create-next-app`](https://nextjs.org/docs/app/api-reference/cli/create-next-app).

## Getting Started

First, run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

You can start editing the page by modifying `app/page.tsx`. The page auto-updates as you edit the file.

This project uses [`next/font`](https://nextjs.org/docs/app/building-your-application/optimizing/fonts) to automatically optimize and load [Geist](https://vercel.com/font), a new font family for Vercel.

## Learn More

To learn more about Next.js, take a look at the following resources:

- [Next.js Documentation](https://nextjs.org/docs) - learn about Next.js features and API.
- [Learn Next.js](https://nextjs.org/learn) - an interactive Next.js tutorial.

You can check out [the Next.js GitHub repository](https://github.com/vercel/next.js) - your feedback and contributions are welcome!

## Deploy on Vercel

The easiest way to deploy your Next.js app is to use the [Vercel Platform](https://vercel.com/new?utm_medium=default-template&filter=next.js&utm_source=create-next-app&utm_campaign=create-next-app-readme) from the creators of Next.js.

Check out our [Next.js deployment documentation](https://nextjs.org/docs/app/building-your-application/deploying) for more details.




<!-- return (
        <div className='flex flex-col items-center justify-center min-h-screen bg-gray-100 text-black'>
            <div className="p-8 bg-white shadow-md rounded-lg w-96">
                {user ? (
                    /* ログイン済みの表示 */
                    <div className="text-center">
                        <h1 className="text-xl font-bold mb-4">マイページ</h1>
                        <p className="text-gray-700">ようこそ、<span className="font-bold">{user.name}</span>さん</p>
                        <p className="text-sm text-gray-500 mb-6">{user.email}</p>
                        
                        <button 
                            onClick={handleLogout}
                            className="w-full bg-red-500 text-white p-2 rounded hover:bg-red-600 transition"
                        >
                            ログアウトする
                        </button>
                    </div>
                ) : (
                    /* 未ログイン（フォーム）の表示 */
                    <>
                        <h1 className="text-2xl font-bold mb-6 text-center">ログイン</h1>
                        <form onSubmit={handleLogin} className="space-y-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">メールアドレス</label>
                                <input 
                                    type="email" 
                                    value={email} 
                                    onChange={(e) => setEmail(e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded mt-1"
                                />
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-gray-700">パスワード</label>
                                <input 
                                    type="password" 
                                    value={password} 
                                    onChange={(e) => setPassword(e.target.value)}
                                    className="w-full p-2 border border-gray-300 rounded mt-1"
                                />
                            </div>
                            <button 
                                type="submit" 
                                className="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition font-bold"
                            >
                                ログインして開始
                            </button>
                        </form>
                    </>
                )}
            </div>
        </div>
    ) -->