@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-8">
            <h1>Kelola Artikel</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ Buat Artikel Baru</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="40%">Judul</th>
                    <th width="25%">Kategori</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $index => $post)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($post->title, 50) }}...</td>
                        <td><span class="badge bg-info">{{ $post->category?->name ?? 'Tanpa Kategori' }}</span></td>
                        <td>{{ $post->created_at?->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
