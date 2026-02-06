@extends('layouts.main')

@section('title', $title)
@section('content')
    @php
        $featuredId = optional($featured)->id;
    @endphp

    <style>
        .artikel-hero {
            background: #e9f6ef;
            padding: 50px 0 30px;
        }

        .fitlife-icon {
            width: 80px;
            height: 80px;
            background: #e8f8ef;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fitlife-icon i {
            font-size: 42px;
            color: #1fb879;
        }

        .search-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #dfe8e4;
        }

        .search-wrapper .form-control {
            border: none !important;
            box-shadow: none !important;
            padding: 12px 48px 12px 14px;
            border-radius: 12px !important;
            font-size: 14px;
        }

        .search-wrapper .form-control::placeholder {
            opacity: 0.7;
            font-size: 14px;
        }

        .search-button {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #444;
            padding: 4px;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity .12s ease;
        }

        .search-button:hover i {
            opacity: 0.8;
        }

        .clear-x {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            z-index: 100 !important;
        }

        .clear-x i:hover {
            color: #222;
        }

        .featured-box {
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            background: #ffffff;
        }

        .pill {
            display: inline-block;
            width: fit-content;
            max-width: max-content;
            padding: 8px 14px;
            background: #e7f8ef;
            color: #0da36b;
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            white-space: nowrap;
        }

        .artikel-card {
            border: 1px solid #e5ece8;
            border-radius: 16px;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
            transition: 0.2s ease;
            height: 100%;
        }

        .artikel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
        }

        .artikel-card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .search-kecil {
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .search-wrapper .form-control {
                padding: 10px 44px 10px 12px;
            }
        }
    </style>

    <section class="artikel-hero">
        <div class="container text-center">
            <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-journal-text"></i></div>
            <h2 class="fw-bold mb-2">Artikel Diet & Kesehatan</h2>
            <p class="text-muted mb-4">Baca artikel terbaru seputar diet, nutrisi, dan tips hidup sehat dari para ahli</p>
            <form action="{{ route('artikel.index') }}" method="GET" class="mx-auto" style="max-width: 540px;">
                <div class="input-group input-group-lg position-relative search-wrapper">
                    <input type="text" name="kategori" id="searchKategori" class="form-control search-kecil"
                        placeholder="Cari berdasarkan kategori" value="{{ request('kategori') }}" autocomplete="off">
                    <button type="submit" class="search-button" id="btnSearch" aria-label="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                    @if (request()->filled('kategori'))
                        <button type="button" id="clearSearch" class="clear-x position-absolute" title="Reset"
                            style="right: 12px; top: 50%; transform: translateY(-50%); z-index: 100;">
                            <i class="bi bi-x-lg" style="font-size:16px; color:#555;"></i>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </section>

    @if ($featured)
        <section class="py-4">
            <div class="container">
                <div class="featured-box">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ $featured->gambar ? Storage::url($featured->gambar) : asset('images/jus buah.jpg') }}"
                                alt="{{ $featured->judul }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                            <div class="pill mb-3">{{ $featured->kategori ?? 'Artikel Unggulan' }}</div>
                            <h3 class="fw-bold mb-2">{{ $featured->judul }}</h3>
                            <p class="text-muted">{!! Str::limit(strip_tags($featured->isi), 180) !!}</p>
                            <div class="text-muted small mb-3">
                                <i
                                    class="bi bi-calendar me-1"></i>{{ $featured->created_at?->format('d F Y') ?? 'Terbit terbaru' }}
                            </div>
                            <a href="{{ route('artikel.show', $featured->slug) }}" class="btn btn-fitlife w-auto">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="py-5" style="background:#f7fbf8;">
        <div class="container">
            <div class="row g-4">
                @forelse($artikels as $a)
                    @if ($featuredId && $featuredId === $a->id)
                        @continue
                    @endif
                    <div class="col-lg-4 col-md-6">
                        <div class="artikel-card">
                            <img src="{{ $a->gambar ? Storage::url($a->gambar) : asset('images/sayuran.jpg') }}"
                                alt="{{ $a->judul }}">
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="pill">{{ $a->kategori ?? 'Tips' }}</span>
                                    <span class="text-muted small"><i class="bi bi-calendar"></i>
                                        {{ $a->created_at?->format('d M Y') }}</span>
                                </div>
                                <h6 class="fw-bold">{{ $a->judul }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit(strip_tags($a->isi), 100) }}</p>
                                <a href="{{ route('artikel.show', $a->slug) }}" class="text-success fw-semibold">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada artikel.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <script>
        (function() {
            const input = document.getElementById('searchKategori');
            const btnSearch = document.getElementById('btnSearch');
            const btnClear = document.getElementById('clearSearch');
            const form = input ? input.closest('form') : null;

            if (!input || !btnSearch) return;

            input.style.paddingRight = '56px';

            input.addEventListener('focus', () => {
                btnSearch.style.opacity = '1';
                btnSearch.style.pointerEvents = 'auto';
            });
            input.addEventListener('input', () => {
                btnSearch.style.opacity = '1';
            });

            input.addEventListener('blur', () => {
            });

            form?.addEventListener('submit', () => {
                btnSearch.style.opacity = '0';
                btnSearch.style.pointerEvents = 'none';
            });

            if (btnClear) {
                btnClear.addEventListener('click', () => {
                    input.value = '';
                    window.location.href = "{{ route('artikel.index') }}";
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                if (btnClear) {
                    btnClear.style.display = 'inline-flex';
                    btnSearch.style.opacity = '0';
                } else {
                    btnSearch.style.opacity = '1';
                }
            });
        })();
    </script>
@endsection
