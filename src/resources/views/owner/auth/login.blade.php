<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オーナーログイン</title>
</head>

<body>
    <h1>オーナーログイン</h1>
    <p>メールアドレス: owner@example.com</p>
    <p>パスワード: yourpassword</p>

    <form action="{{ route('owner.login') }}" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
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
