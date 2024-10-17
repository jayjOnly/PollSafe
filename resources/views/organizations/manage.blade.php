<!-- resources/views/organizations/members/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Anggota Organisasi</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
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

        .invite-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 15px;
            align-items: end;
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
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.3s;
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

        .members-table {
            width: 100%;
            border-collapse: collapse;
        }

        .members-table th,
        .members-table td {
            padding: 12px;
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

        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $organization->name }} - Manajemen Anggota</h1>
            <a href="{{ route('organizations.show', $organization->uuid) }}" class="btn btn-primary">
                Kembali ke Organisasi
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(Auth::user()->organizations()->where('organizations.id', $organization->id)->wherePivot('role', 'admin')->exists())
        <div class="invite-section">
            <h2>Tambah Anggota Baru</h2>
            <form action="{{ route('organizations.members.invite', $organization->uuid) }}" method="POST" class="form-grid">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Masukkan email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="member">Member</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Anggota</button>
            </form>
        </div>
        @endif

        <div class="members-list">
            <h2>Daftar Anggota</h2>
            <table class="members-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung Sejak</th>
                        @if(Auth::user()->organizations()->where('organizations.id', $organization->id)->wherePivot('role', 'admin')->exists())
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>
                            <span class="role-badge role-{{ $member->pivot->role }}">
                                {{ ucfirst($member->pivot->role) }}
                            </span>
                        </td>
                        <td class="member-since">
                            {{ $member->pivot->created_at->diffForHumans() }}
                        </td>
                        @if(Auth::user()->organizations()->where('organizations.id', $organization->id)->wherePivot('role', 'admin')->exists())
                        <td class="member-actions">
                            @if($member->id !== Auth::id())
                            <form action="{{ route('organizations.members.updateRole', [$organization->uuid, $member->id]) }}" 
                                  method="POST" 
                                  style="display: inline;">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()" 
                                        class="role-select" 
                                        {{ $member->pivot->role === 'admin' && $members->where('pivot.role', 'admin')->count() === 1 ? 'disabled' : '' }}>
                                    <option value="member" {{ $member->pivot->role === 'member' ? 'selected' : '' }}>
                                        Member
                                    </option>
                                    <option value="admin" {{ $member->pivot->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            </form>

                            <form action="{{ route('organizations.members.remove', [$organization->uuid, $member->id]) }}" 
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        {{ $member->pivot->role === 'admin' && $members->where('pivot.role', 'admin')->count() === 1 ? 'disabled' : '' }}>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>