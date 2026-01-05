<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'サイト名' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- ヘッダーの読み込み --}}
    <x-header />

    {{-- メインコンテンツ --}}
    <main class="grow">
        {{ $slot }}
    </main>

    {{-- フッターの読み込み --}}
    <x-footer />
    
</body>
</html>