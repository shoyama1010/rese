<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
</head>
<body>
    <h1>管理者ログイン</h1>
    <p>メールアドレス: admin@example.com</p>
    <p>パスワード: yourpassword</p>

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>

    @if ($errors->any())
    <div>
        <p>{{ $errors->first('email') }}</p>
    </div>
    @endif

</body>
</html>
