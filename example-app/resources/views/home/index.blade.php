<x-layouts.app title="Home Page">
    {{-- Home Page Content --}}
    <div class="flex flex-col items-center justify-center min-h-[80vh]">
        <h1 class="text-4xl font-bold text-gray-900 mb-6 tracking-tight">
            ここはフロントページです
        </h1>

        <p class="text-lg text-gray-600 mb-10 leading-relaxed">
            ようこそ、このサイトへ。<br>
            お問い合わせは下記リンクから。
        </p>

        <a href="{{ route('contact.index') }}" 
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            お問い合わせページへ
        </a>
    </div>
</x-layouts.app>