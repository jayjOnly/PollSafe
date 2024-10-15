@extends('components.nav-bar')

@section('content')
<div class="container">
    <h1>{{ $organization->name }}</h1>
    <p class="description">{{ $organization->description }}</p>

    <div class="info-box">
        <h3>Informasi Organisasi</h3>
        <p><strong>Dibuat oleh:</strong> {{ $organization->creator->name }}</p>
        <p><strong>Tanggal dibuat:</strong> {{ $organization->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Jumlah anggota:</strong> {{ $organization->members->count() }}</p>
    </div>

    <div class="member-list">
        <h3>Daftar Anggota</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    @if(Auth::id() == $organization->created_by)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($organization->members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ ucfirst($member->pivot->role) }}</td>
                        @if(Auth::id() == $organization->created_by && Auth::id() != $member->id)
                            <td>
                                <form action="{{ route('organizations.remove_member', [$organization, $member]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(Auth::id() == $organization->created_by)
        <div class="admin-actions">
            <h3>Aksi Admin</h3>
            <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-primary">Edit Organisasi</a>
            {{-- <a href="{{ route('organizations.invite', $organization) }}" class="btn btn-success">Undang Anggota</a> --}}
        </div>
    @endif
</div>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    h1 {
        color: #333;
        margin-bottom: 10px;
    }
    .description {
        font-style: italic;
        color: #666;
        margin-bottom: 20px;
    }
    .info-box {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .member-list {
        margin-top: 30px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .admin-actions {
        margin-top: 30px;
    }
    .btn {
        display: inline-block;
        padding: 10px 15px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-success {
        background-color: #28a745;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.875rem;
    }
</style>
@endsection