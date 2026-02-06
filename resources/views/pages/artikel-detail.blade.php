@extends('layouts.main')

@section('title', $title)
@section('content')

    <style>
        .artikel-hero {
            background: #e9f6ef;
            padding: 48px 0 30px;
        }

        .detail-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .detail-img {
            width: 100%;
            height: 360px;
            object-fit: cover;
        }

        .artikel-card {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0px 12px 28px rgba(0, 0, 0, 0.07);
            transition: 0.2s;
            height: 100%;
        }

        .artikel-card:hover {
            transform: translateY(-4px);
        }

        .artikel-card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }
    </style>

    <section class="artikel-hero">
        <div class="container text-center">
            {{-- <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-journal-text"></i></div> --}}
            <h2 class="fw-bold mb-2">{{ $artikel->judul }}</h2>
            <div class="text-muted small">
                <i class="bi bi-calendar me-1"></i>{{ $artikel->created_at?->format('d M Y') }} &nbsp; | &nbsp;
                <i class="bi bi-eye me-1"></i>{{ $artikel->dibaca }} kali dibaca
            </div>
        </div>
    </section>

    <div class="container py-4">

        {{-- Tombol kembali --}}
        <div class="mb-3">
            <a href="{{ route('artikel.index') }}" class="btn btn-outline-success">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="detail-card mb-5">
            <img src="{{ $artikel->gambar ? Storage::url($artikel->gambar) : asset('images/sayuran.jpg') }}"
                class="detail-img" alt="{{ $artikel->judul }}">
            <div class="p-4">
                <div class="mb-3 text-muted small">Ditulis oleh {{ $artikel->penulis ?? 'Admin' }}</div>
                <div class="fs-6" style="line-height: 1.7rem;">
                    {!! $artikel->isi !!}
                </div>
            </div>
        </div>

        @if (isset($artikels) && $artikels->count() > 1)
            <h3 class="fw-bold mb-3">Artikel Lainnya</h3>

            <div class="row g-4">
                @foreach ($artikels as $a)
                    @if ($a->id != $artikel->id)
                        <div class="col-md-4">
                            <div class="artikel-card">
                                <img src="{{ $a->gambar ? Storage::url($a->gambar) : asset('images/gambar_menu.jpg') }}"
                                    alt="{{ $a->judul }}">

                                <div class="p-3">
                                    <div class="fw-bold" style="font-size: 18px;">
                                        {{ $a->judul }}
                                    </div>

                                    <div class="text-muted mb-2">
                                        {!! Str::limit(strip_tags($a->isi), 80) !!}
                                    </div>

                                    <a href="{{ route('artikel.show', $a->slug) }}" class="btn btn-outline-success w-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    </div>

@endsection
