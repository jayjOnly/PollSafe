<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Manajemen Anggota Organisasi</title>
</head>

<body>
    <x-nav-bar-auth></x-nav-bar-auth>
    <div class="container">
        <div class="header">
            <h1>{{ $organization_detail['name'] }} - Manajemen Anggota</h1>
            @if($is_leader)
                <div class="header-buttons">
                    <button class="btn btn-primary" onclick="openModal('edit-organization')">Edit Organisasi</button>
                    <button class="btn btn-danger" onclick="deleteOrganization()">Delete Organisasi</button>
                </div>
            @endif
        </div>

        <div class="organization-info">
            <div class="info-section">
                <div>
                    <div class="info-item">
                        <label>Nama Organisasi</label>
                        <p>{{ $organization_detail['name'] }}</p>
                    </div>
                    <div class="info-item">
                        <label>Deskripsi</label>
                        <p>{{ $organization_detail['description'] }}</p>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Dibuat</label>
                        <p>{{ $organization_detail['created_at'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-section">
            <h2>Action Organisasi:</h2>
            <div class="action-buttons">
                @if($is_leader)
                    <a href="#" onclick="window.location.href = '{{ route('voting-create', ['organization_id' => $organization_detail['id']]) }}';" class="btn btn-action">Create Vote</a>
                    <a href="#" onclick="openModal('add-member')" class="btn btn-primary">Add Member</a>
                @endif
                <a href="#" onclick="window.location.href = '{{ route('voting-active', ['organization_id' => $organization_detail['id']]) }}';" class="btn btn-primary">Vote Now</a>
            </div>
        </div>

        <div class="members-list">
            <h2>Daftar Anggota</h2>
            <table class="members-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th> <th>Bergabung Sejak</th>
                        @if($is_leader)
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organization_detail['members'] as $member)
                        <tr>
                            <td>{{ $member['name'] }}</td>
                            <td>{{ $member['email'] }}</td>
                            <td>
                                <span class="role-badge role-admin">{{ $member['role'] }}</span>
                            </td>
                            <td class="member-since">{{ $member['joined_at'] }}</td>
                            @if($is_leader)
                                <td class="member-actions">
                                    @if ($member['is_leader'] === false)
                                        <button onclick="deleteMember('{{ $member['id'] }}', '{{ $member['name'] }}')" class="btn btn-danger btn-remove-user">
                                            <i class="fas fa-user-times"></i>
                                        </button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-edit-organization" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
        <div class="modal-content">
            <h2 id="modal-title">Add Organization</h2>
            <label for="org-name">Organization Name</label>
            <input type="text" id="org-name" placeholder="Enter organization name" required>
            
            <label for="org-description">Description</label>
            <textarea id="org-description" placeholder="Enter organization description" required></textarea>
            
            <div class="modal-buttons">
                <button class="cancel-button" onclick="closeModal('edit-organization')">Cancel</button>
                <button class="add-button" onclick="editOrganization()">Update</button>
            </div>
        </div>
    </div>

    <div id="modal-add-member" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
        <div class="modal-content">
            <h2 id="modal-title">Add Organization Member</h2>
            <label for="member-email">Member Email</label>
            <input type="email" id="member-email" placeholder="Enter Member Email" required>
            
            <div class="modal-buttons">
                <button class="cancel-button" onclick="closeModal('add-member')">Cancel</button>
                <button class="add-button" onclick="addMember()">Add</button>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    // Function to open the edit modal
    function openModal(type) {
        if (type === 'edit-organization') {
            document.getElementById("org-name").value = '{{ $organization_detail['name'] }}';
            document.getElementById("org-description").value = '{{ $organization_detail['description'] }}';

            document.getElementById("modal-edit-organization").style.display = "flex";
            document.getElementById("modal-edit-organization").style.opacity = "1";
        } else if (type === 'add-member') {
            document.getElementById("member-email").value = '';

            document.getElementById("modal-add-member").style.display = "flex";
            document.getElementById("modal-add-member").style.opacity = "1";
        }
    }

    // Function to close the modal
    function closeModal(type) {
        if (type === 'edit-organization') {
            document.getElementById("modal-edit-organization").style.opacity = "0";
            setTimeout(() => {
                document.getElementById("modal-edit-organization").style.display = "none";
            }, 300); // Match this duration with the fade-out animation duration
        } else if (type === 'add-member') {
            document.getElementById("modal-add-member").style.opacity = "0";
            setTimeout(() => {
                document.getElementById("modal-add-member").style.display = "none";
            }, 300); // Match this duration with the fade-out animation duration
        }
    }

    // Function to handle the AJAX request to add an organization
    function editOrganization() {
        const name = document.getElementById("org-name").value;
        const description = document.getElementById("org-description").value;

        fetch('/api/editOrganization', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adjust this if you're using a different CSRF token setup
            },
            body: JSON.stringify({ organization_id: '{{ $organization_detail['id'] }}', name: name, description: description })
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
            alert('Organization updated successfully!');
            closeModal(); // Close modal after success
            location.reload(); // Reload the page
        })
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Error:', error);
            alert(`Failed to update organization: ${error.message}`);
        });
    }

    // Function to confirm deletion
    function deleteOrganization() {
        const confirmation = confirm("Are you sure you want to delete this organization?");
        if (confirmation) {
            fetch('/api/deleteOrganization', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adjust this if you're using a different CSRF token setup
                },
                body: JSON.stringify({ organization_id: '{{ $organization_detail['id'] }}' })
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
                alert('Organization deleted successfully!');
                window.location.href = '{{ route('organization') }}';
            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('Error:', error);
                alert(`Failed to delete organization: ${error.message}`);
            });
        }
    }

    function addMember() {
        const member_email = document.getElementById("member-email").value;

        fetch('/api/addOrganizationMember', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adjust this if you're using a different CSRF token setup
            },
            body: JSON.stringify({ organization_id: '{{ $organization_detail['id'] }}', email: member_email })
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
            alert('Member added successfully!');
            closeModal(); // Close modal after success
            location.reload(); // Reload the page
        })
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Error:', error);
            alert(`Failed to add member: ${error.message}`);
        });
    }

    function deleteMember(id, name) {
        const confirmation = confirm(`Are you sure you want to delete member '${name}' from this organization?`);
        if (confirmation) {
            fetch('/api/deleteOrganizationMember', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adjust this if you're using a different CSRF token setup
                },
                body: JSON.stringify({ organization_id: '{{ $organization_detail['id'] }}', member_id: id })
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
                alert('Member deleted successfully!');
                location.reload(); // Reload the page
            })
            .catch(error => {
                // Handle any errors that occurred during the fetch
                console.error('Error:', error);
                alert(`Failed to member: ${error.message}`);
            });
        }
    }
</script>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f5f5f5;
    }

    .container {
        max-width: 1600px;
        margin: 0 auto;
        background-color: #fff;
        margin-top: 1rem;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .header h1 {
        color: #333;
        font-size: 24px;
    }

    .header-buttons {
        display: flex;
        gap: 10px;
    }

    .action-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 30px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-remove-user {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        padding: 0;
        border-radius: 50%;
        margin-left: 1rem;
    }

    .btn-remove-user i {
        font-size: 15px;
    }

    .btn-action{
        background-color: #28a745;
        color: #fff;
    }

    .btn-action:hover {
        background-color: #078725;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .members-list {
        padding: 5px;
    }

    .members-table {
        width: 100%;
        border-collapse: collapse;
    }

    .members-table th,
    .members-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .members-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }

    .members-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .role-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .role-admin {
        background-color: #ffc107;
        color: #000;
    }

    .role-member {
        background-color: #6c757d;
        color: #fff;
    }

    .member-actions {
        gap: 10px;
        align-items: center;
    }

    .member-since {
        color: #6c757d;
        font-size: 0.9em;
    }

    .organization-info {
        margin-bottom: 30px;
    }

    .info-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .info-item {
        margin-bottom: 15px;
    }

    .info-item label {
        display: block;
        color: #555;
        font-weight: 500;
        margin-bottom: 5px;
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
</style>