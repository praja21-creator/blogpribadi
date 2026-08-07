@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row justify-content-center py-5">

    <div class="col-md-8">

        <span class="badge bg-dark mb-3">
            <i class="fas fa-tag"></i> {{ $post->category?->name ?? 'Tanpa Kategori' }}
        </span>

        <h1>
            {{ $post->title }}
        </h1>

        <small class="text-muted">
            <i class="far fa-calendar"></i> {{ $post->created_at?->format('d M Y H:i') }}
        </small>

        <hr>

        <p style="line-height: 30px;">
            {!! nl2br(e($post->content)) !!}
        </p>

        <a href="{{ route('home') }}"
           class="btn btn-secondary mt-3">

            <i class="fas fa-arrow-left"></i> Kembali

        </a>

    </div>

</div>
@endsection
