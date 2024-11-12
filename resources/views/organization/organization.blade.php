<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PollSafe - Online Voting System</title>
</head>

<body>
    <x-nav-bar-auth></x-nav-bar-auth>

    <div class="container">
        <div class="header">
            <h1>Organization List</h1>
            <button class="add-button">Add Organization</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Organization Name</th>
                    <th>Organization Leader</th>
                    <th>Member Count</th>
                    <th>Created At</th>
                    <th>Vote Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tech Innovations Inc.</td>
                    <td>John Doe</td>
                    <td>150</td>
                    <td><span class="created-at">March 10, 2023<br>9:15 AM</span></td>
                    <td><span class="status-green">No ongoing vote</span></td>
                    <td><button class="action-button">View Details</button></td>
                </tr>
                <tr>
                    <td>Green Earth Corp.</td>
                    <td>Emma Wilson</td>
                    <td>85</td>
                    <td><span class="created-at">January 25, 2023<br>2:30 PM</span></td>
                    <td><span class="status-red">3 vote is required!</span></td>
                    <td><button class="action-button">View Details</button></td>
                </tr>
                <tr>
                    <td>Smart Solutions Ltd.</td>
                    <td>Michael Smith</td>
                    <td>230</td>
                    <td><span class="created-at">December 5, 2022<br>11:00 AM</span></td>
                    <td><span class="status-orange">3 ongoing vote</span></td>
                    <td><button class="action-button">View Details</button></td>
                </tr>
                <tr>
                    <td>Health Plus Inc.</td>
                    <td>Sarah Connor</td>
                    <td>120</td>
                    <td><span class="created-at">February 12, 2023<br>1:45 PM</span></td>
                    <td><span class="status-green">No ongoing vote</span></td>
                    <td><button class="action-button">View Details</button></td>
                </tr>
                <tr>
                    <td>Bright Future NGO</td>
                    <td>James Lee</td>
                    <td>45</td>
                    <td><span class="created-at">May 18, 2022<br>10:00 AM</span></td>
                    <td><span class="status-red">3 vote is required!</span></td>
                    <td><button class="action-button">View Details</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>

<style>
    body {
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        
        font-family: Arial, sans-serif;
        background-color: #fafafa;
    }

    .container {
        /* background: linear-gradient(135deg, rgba(0, 105, 255, 0.8), rgba(0, 255, 255, 0.5)),
                    radial-gradient(circle, rgba(0, 105, 255, 0.5) 0%, rgba(0, 255, 255, 0.2) 70%);
        background-blend-mode: multiply; */
        padding: 10px;
        flex: 1;
        
        
    }
    
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 5px 0;
        padding: 0 15px;
    }

    .header h1 {
        font-size: 24px;
        color: #333;
    }

    .add-button {
        margin-left: 10px;
        padding: 10px 15px;
        font-size: 14px;
        color: white;
        background-color: #28a745;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .table-container {
        overflow-x: auto;
        border-color: #888888;
        border-width: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 0.5px solid #e0e0e0;
    }

    th {
        font-weight: bold;
        color: #555555;
        border-bottom: 1px solid #d0d0d0;
        background-color: #fefefe;
    }

    tr {
        background-color: #fefefe;
    }

    tr:hover {
        background-color: rgb(248, 248, 248);
    }

    .created-at {
        color: #888888;
        font-size: 14px;
    }

    .action-button {
        padding: 8px 12px;
        font-size: 14px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .action-button:hover {
        background-color: #006adc;
    }

    .status-green {
        color: #28a745;
        font-weight: bold;
    }

    .status-red {
        color: #dc3545;
        font-weight: bold;
    }

    .status-orange {
        color: #fd7e14;
        font-weight: bold;
    }

    @media only screen and (max-width: 768px) {
        .feature-container {
            grid-template-columns: 1fr; 
        }
    }
</style>