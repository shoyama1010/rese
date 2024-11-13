<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者用ダッシュボード</title>
    <!-- 管理者用のCSSやJSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">ダッシュボード</a></li>
                <li><a href="{{ route('admin.csv_import') }}">CSVインポート</a></li>
                <!-- その他の管理者メニュー -->
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>管理者用ダッシュボード</p>
    </footer>
</body>
</html>
