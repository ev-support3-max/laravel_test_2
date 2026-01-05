<x-layouts.app title="お問い合わせ">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10 mb-10">
        <div class="text-center mb-8">
            <h1 class="text-center mb-6 text-xl font-bold">お問い合わせ</h1>
            <p class="text-gray-600 mt-2 text-center">以下のフォームを入力してください</p>
            <p class="text-red-800 text-xs mt-2 text-center">※赤字は入力必須項目です</p>
        </div>

        {{-- 完了メッセージ --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">送信完了</p>
                <p>{{ session('success')}}</p>
            </div>
        @endif

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
            @csrf
            <!-- フォーム内容 -->

            {{-- お名前 --}}
            <div>
                <div class="flex space-x-4">
                    <div class="block w-1/2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            お名前（姓）<span class="text-red-500">*</span>
                        </label>
                        <input 
                        type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required 
                        class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="山田"
                        >
                    </div>
                    <div class="block w-1/2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            お名前（名）<span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                            class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="太郎"
                        >
                    </div>
                </div>
            </div>

            {{-- 会社名 --}}
            <div>
                <label for="corp_name" class="block text-sm font-medium text-gray-700 mb-1">
                    会社名
                </label>
                <input
                    type="text" name="corp_name" id="corp_name" value="{{ old('corp_name') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="株式会社〇〇"
                >
            </div>

            {{-- メールアドレス --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    メールアドレス<span class="text-red-500">*</span>
                </label>
                <input
                    type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="example@example.com"
                >
            </div>

            {{-- お問い合わせ内容 --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                    お問い合わせ内容<span class="text-red-500">*</span>
                </label>
                <textarea
                    name="content" id="content" rows="5" required
                    class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="お問い合わせ内容を入力してください"
                >{{ old('content') }}</textarea>
            </div>

            {{-- 送信ボタン --}}
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus-ring-2 focus:ring-offset-2 focus:ring-blue-500 duration-150"
                >
                    送信
                </button>
            </div>
        </form>
    </div>
</x-app>