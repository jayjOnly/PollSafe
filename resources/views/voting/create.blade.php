<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Voting Baru</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Buat Voting Baru</h1>
        </div>
        @error('error')
            <div class="message error" id="message">{{ $message }}</div>
        @enderror
        <form method="POST" action="/api/addVote">
            @csrf
            <input type="hidden" id="custId" name="organization_id" value="{{ $organization_detail['id'] }}">
            <div class="form-group">
                <label for="voting_name">Nama Voting</label>
                <input type="text" id="voting_name" name="voting_name" required placeholder="Masukkan nama voting" value="{{ old('voting_name') }}">
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required placeholder="Masukkan deskripsi voting" value="{{ old('description') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="start_time">Waktu Mulai</label>
                <input type="datetime-local" id="start_time" name="start_time" required value="{{ old('start_time') }}">
            </div>
            <div class="form-group">
                <label for="end_time">Waktu Berakhir</label>
                <input type="datetime-local" id="end_time" name="end_time" required value="{{ old('end_time') }}">
            </div>

            <div class="candidates-list">
                <h2>Kandidat</h2>
                @foreach ($organization_detail['members'] as $member)
                    <div class="candidate-item">
                        <input type="checkbox" id="candidate1" name="candidates[]" value="{{ $member['id'] }}">
                        <label for="candidate1">{{ $member['name'] }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn">Buat Voting</button>
        </form>
    </div>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        padding: 20px;
        background-color: #f5f5f5;
    }

    .container {
        max-width: 1600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .header h1 {
        color: #333;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: 500;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        transition: background-color 0.3s;
        background-color: #007bff;
        color: #fff;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .candidates-list {
        margin-top: 20px;
    }

    .candidates-list h2 {
        margin-bottom: 10px;
    }

    .candidate-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .candidate-item input {
        margin-right: 10px;
    }

    .message {
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
    }

    .error {
        background-color: #ffcccc;
        color: red;
    }
</style>