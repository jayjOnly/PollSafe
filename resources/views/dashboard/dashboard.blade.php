<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PollSafe - Online Voting System</title>
</head>

<body>

    <x-nav-bar-auth></x-nav-bar-auth>
    
    <div class="table-container">

        <table>
            <h2>Active Votes</h2>
            <thead>
                <th>Voting Name</th>
                <th>Organization Name</th>
                <th>Ends At</th>
                <th>Vote Status</th>
                <th>Details</th>
            </thead>

            @foreach($organization_vote_list as $vote_list)
            <tbody>
                <tr>
                    <td>{{ $vote_list['name']}}</td>
                    <td>{{ $vote_list['organization']}}</td>
                    <td>{{ date('d F Y H:i', strtotime($vote_list['end_date'])) }}</td>
                    <td class ="{{ $vote_list['vote_status']? 'voted':'not-voted'}} ">{{ $vote_list['vote_status']? 'voted':'not voted'}}</td>
                    <td> <a href='#'  
                        class="vote-btn" {{ $vote_list['vote_status'] ? 'disabled' : '' }} 
                        onclick="window.location.href = '{{ route('voting-active', ['organization_id' => $vote_list['organization_id']]) }}';">Vote!</a>
                    </td>
                   
                </tr>
            </tbody>
            @endforeach

        </table>

    </div>

    <div class="table-container">

        <table>
            <h2>Voting History</h2>
            <thead>
                <th>Voting Name</th>
                <th>Organization Name</th>
                <th>Vote Count</th>
                <th>End Date</th>
                <th>Winner</th>
            </thead>

            @foreach($organization_history_vote_list as $vote_history_list)
            <tbody>
                <tr>
                    <td>{{ $vote_history_list['name']}}</td>
                    <td>{{ $vote_history_list['organization']}}</td>
                    <td>{{ $vote_history_list['vote_member_count'] }}</td>
                    <td>{{ date('d F Y H:i', strtotime($vote_history_list['end_date'])) }}</td>
                    <td>{{ $vote_history_list['winner'] }}</td>
                </tr>
            </tbody>
            @endforeach

        </table>

    </div>

    <x-footer></x-footer>
</body>
</html>

<style>
    *{
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f0f0f0;
    }
    h1 {
        text-align: center;
    }

    h2{
        margin-top:20px;
        margin-left: 100px;
        margin-bottom: 10px;
    }
    .page-title{
        margin: 20px 20px;
    }

    .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        margin-top:20px;
    }

    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        background-color: #ddd;
        border: none;
        margin-right: 5px;
        transition: background-color 0.3s;
    }

    .tab-button.active {
        background-color: #007bff;
        color: white;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .voted {
        color: green;
    }

    .not-voted {
        color: red;
    }

    .vote-btn {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .vote-btn[disabled] {
        background-color: gray;
        cursor: not-allowed;
    }

    .table-container {
        overflow-x: auto;
        border-color: #888888;
        border-width: 5px;
        
    }

    table {
        width: 85%;
        border-collapse: collapse;
        margin: auto;
        margin-top: 5px;
    }


    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 0.5px solid #e0e0e0;
    }

    th {
        font-style:bold;
        color: #000000;
        border-bottom: 1px solid #d0d0d0;
        background-color: #fefefe;
        align-content: center;
    }

    td{
        color:  #2b2b2b;
    }

    tr {

        background-color: #fefefe;
       
    }

    tr:hover {
        background-color: rgb(248, 248, 248);
    }

    .footer-container{
        position:fixed;
        bottom:0;
        left:0;
        width:100%;
    }

</style>

