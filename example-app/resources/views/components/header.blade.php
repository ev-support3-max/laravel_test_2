<header class="bg-white shadow-sm border-b px-2 py-2 border-gray-200">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
        <div class="shrink-0">
            <a href="/" class="text-xl font-bold text-gray-900">
                <h1>My App</h1>
            </a>
        </div>

        <nav class="flex space-x-4">
            <a href="/" class="text-indigo-600 hover:text-indigo-900 px-3 py-2 rounded-md text-sm font-normal">Home</a>
            <a href="{{ route('contact.index') }}" class="text-indigo-600 hover:text-indigo-900 px-3 py-2 rounded-md text-sm font-normal">お問い合わせ</a>
            @auth
                <a href="/admin" class="text-orange-600 hover:text-indigo-900 px-3 py-2 rounded-md text-sm font-semibold">
                    管理画面へ
                </a>
            @endauth
        </nav>
    </div>
</header>