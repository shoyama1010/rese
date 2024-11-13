@extends('layouts.admin')

@section('content')
    <div class="csv-upload">
        <h1>CSVインポート</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.upload_csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSVファイルを選択</label>
                <input type="file" name="csv_file" id="csv_file" accept=".csv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">インポートする</button>
        </form>
    </div>
@endsection
