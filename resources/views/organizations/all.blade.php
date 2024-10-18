@extends('components.nav-bar')

@section('content')
<div class="container">
    <h1>Daftar Organisasi</h1>
    <a href="{{ route('organizations.create') }}" class="btn btn-primary">Buat Organisasi Baru</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $organization)
                <tr>
                    <td>{{ $organization->name }}</td>
                    <td>{{ Str::limit($organization->description, 100) }}</td>
                    <td>
                        <a href="{{ route('organizations.show', $organization) }}" class="btn btn-sm btn-info">Lihat</a>
                        @if(Auth::user()->id == $organization->created_by)
                            <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-sm btn-primary">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    h1 {
        color: #333;
        margin-bottom: 20px;
    }
    .btn-primary {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.875em;
    }
    .btn-info {
        background-color: #17a2b8;
        color: white;
    }
    .btn-info:hover {
        background-color: #138496;
    }
</style>
@endsection