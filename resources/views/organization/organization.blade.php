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
            <button class="add-organization-button" onclick="openModal()">Add Organization</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Organization Name</th>
                    <th>Organization Leader</th>
                    <th>Member Count</th>
                    <th>Created At</th>
                    {{-- <th>Vote Status</th> --}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($organization_list as $organization)
                        <tr>
                            <td>{{ $organization['name'] }}</td>
                            <td>{{ $organization['leader'] }}</td>
                            <td>{{ $organization['member_count'] }}</td>
                            <td><span class="created-at">{{ $organization['created_at'] }}</span></td>
                            {{-- <td><span class="status-green">No ongoing vote</span></td> --}}
                            <td><button class="action-button" onclick="window.location.href = '{{ route('organization-detail', ['organization_id' => $organization['id']]) }}';">View Details</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
        <div class="modal-content">
            <h2 id="modal-title">Add Organization</h2>
            <label for="org-name">Organization Name</label>
            <input type="text" id="org-name" placeholder="Enter organization name" required>
            
            <label for="org-description">Description</label>
            <textarea id="org-description" placeholder="Enter organization description" required></textarea>
            
            <div class="modal-buttons">
                <button class="cancel-button" onclick="closeModal()">Cancel</button>
                <button class="add-button" onclick="addOrganization()">Add</button>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById("org-name").value = '';
        document.getElementById("org-description").value = '';
        document.getElementById("modal").style.display = "flex";
        document.getElementById("modal").style.opacity = "1";
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById("modal").style.opacity = "0";
        setTimeout(() => {
            document.getElementById("modal").style.display = "none";
        }, 300); // Match this duration with the fade-out animation duration
    }

    // Function to handle the AJAX request to add an organization
    function addOrganization() {
        const name = document.getElementById("org-name").value;
        const description = document.getElementById("org-description").value;

        fetch('/api/addOrganization', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ name: name, description: description })
        })
        .then(response => {
            // Check if the response status is 200
            if (response.status === 200) {
                return response.json();
            } else {
                // If not 200, throw an error with the message from the response
                return response.json().then(errorData => {
                    throw new Error(errorData.message || 'An error occurred');
                });
            }
        })
        .then(data => {
            // If we reach here, the response was successful
            alert('Organization added successfully!');
            closeModal(); // Close modal after success
            location.reload(); // Reload the page
        })
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Error:', error);
            alert(`Failed to add organization: ${error.message}`);
        });
    }
</script>

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

    .add-organization-button {
        padding: 10px 25px;
        font-size: 14px;
        color: white;
        background-color: #28a745;
        border: none;
        border-radius: 25px;
        cursor: pointer;
    }

    .add-organization-button:hover {
        background-color: #22893a;
    }

    .table-container {
        overflow-x: auto;
        border: 1px solid #ddd;
        margin: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 0.5px solid #e0e0e0;
    }

    th {
        font-weight: bold;
        color: #555;
        background-color: #fefefe;
    }

    tr {
        background-color: #fefefe;
    }

    tr:hover {
        background-color: #f8f8f8;
    }

    .created-at {
        color: #888888;
        font-size: 14px;
    }

    .action-button {
        padding: 10px 25px;
        font-size: 14px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 25px;
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

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease;
    }

    .modal-content h2 {
        margin-top: 0;
        color: #333;
    }

    .modal-content label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }

    .modal-content input, .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 14px;
        resize: none; /* Prevents resizing of the textarea */
        height: 150px; /* Set the desired height */
    }

    .modal-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .cancel-button, .add-button {
        padding: 10px 25px;
        font-size: 14px;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .cancel-button {
        background-color: #dc3545;
        margin-right: 10px;
    }

    .cancel-button:hover {
        background-color: #c82333;
    }

    .add-button {
        background-color: #28a745;
    }

    .add-button:hover {
        background-color: #218838;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media only screen and (max-width: 768px) {
        .feature-container {
            grid-template-columns: 1fr; 
        }
    }
</style>
