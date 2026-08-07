@extends('layouts.app')

@section('title', 'Blog Terbaru')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="display-4 text-gradient mb-2">
                <i class="fas fa-newspaper"></i> Blog Terbaru
            </h1>
            <p class="text-muted fs-5">Temukan artikel dan cerita menarik dari penulis kami</p>
        </div>
    </div>

    <div class="row">

        @forelse($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card h-100">

                <div class="card-body d-flex flex-column">

                    <span class="badge bg-primary mb-3" style="width: fit-content;">
                        <i class="fas fa-tag"></i> {{ $post->category?->name ?? 'Tanpa Kategori' }}
                    </span>

                    <h5 class="card-title mb-3">
                        {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                    </h5>

                    <small class="text-muted mb-3">
                        <i class="far fa-calendar"></i> {{ $post->created_at?->format('d M Y') }}
                    </small>

                    <p class="card-text flex-grow-1">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}...
                    </p>

                    <a href="{{ route('post.show', $post->id) }}"
                       class="btn btn-primary mt-auto">

                        <i class="fas fa-arrow-right"></i> Baca Selengkapnya

                    </a>

                </div>

            </div>

        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> Belum ada artikel.
            </div>
        </div>
        @endforelse

    </div>
</div>
@endsection
