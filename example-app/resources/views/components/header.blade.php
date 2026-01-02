<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        <div class="flex-shrink-0">
            <a href="/" class="text-xl font-bold text-gray-900">
                <h1>My App</h1>
            </a>
        </div>

        <nav class="flex space-x-4">
            <a href="/">Home</a>
            <a href="{{ route('contact.index') }}">お問い合わせ</a>
            @auth
                <a href="/admin" class="text-indigo-600 hover:text-indigo-900 px-3 py-2 rounded-md text-sm font-medium">
                    管理画面へ
                </a>
            @endauth
        </nav>
    </div>
</header>