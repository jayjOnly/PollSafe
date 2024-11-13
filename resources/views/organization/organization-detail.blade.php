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
            <div class="header-buttons">
                <a href="#" class="btn btn-primary">Edit Organisasi</a>
                <a href="#" class="btn btn-danger">Delete Organisasi</a>
            </div>
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
                <a href="#" class="btn btn-action">Create Vote</a>
                <a href="#" class="btn btn-primary">Add Member</a>
                <a href="#" class="btn btn-primary">Vote Now</a>
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
                        <th>Aksi</th>
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
                            <td class="member-actions">
                                <select class="role-select">
                                    <option selected>Member</option>
                                    <option>Admin</option>
                                </select>
                                <button class="btn btn-danger btn-remove-user">
                                    <i class="fas fa-user-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
        display: flex;
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
</style>