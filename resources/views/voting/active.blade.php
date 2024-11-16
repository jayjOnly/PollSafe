<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Aktif</title>
</head>
<body>
    <x-nav-bar-auth></x-nav-bar-auth>
    <nav>
        <div class="nav-container">
            <ul class="nav-menu">
                <li>
                    <a href="{{ route('voting-active', ['organization_id' => $organization_id]) }}" class="active">
                        Semua Voting Aktif
                    </a>
                </li>
                <li>
                    <a href="{{ route('voting-history', ['organization_id' => $organization_id]) }}">
                        History Voting
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Voting Aktif</h2>
            </div>
            <div class="card-body">
                @foreach ($organization_vote_list as $vote)
                    <div class="vote-item" onclick="window.location.href = '{{ route('voting', ['organization_vote_id' => $vote['id']]) }}'">
                        <div class="vote-info">
                            <div class="vote-title">{{ $vote['name'] }}</div>
                            <div>
                                <p>Total Suara: {{ $vote['vote_member_count'] }}</p>
                                <p>Berakhir Pada: {{ date('d F Y H:i', strtotime($vote['end_date'])) }}</p>
                            </div>
                        </div>
                        <div>
                            <span class="vote-status">Aktif</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>

<style>
    /* Styling untuk halaman voting aktif */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    nav {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .nav-menu {
        display: flex;
        list-style: none;
    }

    .nav-menu li {
        padding: 20px 0;
    }

    .nav-menu a {
        text-decoration: none;
        color: #333;
        padding: 20px;
        transition: color 0.3s;
    }

    .nav-menu a:hover {
        color: #007bff;
    }

    .nav-menu a.active {
        border-bottom: 3px solid #007bff;
        color: #007bff;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 0 20px;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .card-header h2 {
        font-size: 1.5em;
        color: #333;
    }

    .card-body {
        padding: 20px;
    }

    .vote-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .vote-info {
        flex: 1;
        margin-right: 20px;
    }

    .vote-title {
        font-size: 1.2em;
        margin-bottom: 0.5%;
    }

    .vote-info p {
        color: #666;
        font-size: 0.9em;
        margin-right: 10px;
    }

    .vote-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 15px;
        background: #e3f2fd;
        color: #1565c0;
        text-align: center;
        margin-right: 1em; 
    }
</style>