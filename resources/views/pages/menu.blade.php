@extends('layouts.main')

@section('title', $title)
@section('content')
    <style>
        .menu-hero {
            background: #e9f6ef;
            padding: 60px 0 30px;
        }

        .menu-banner-wrap {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
        }

        .menu-banner-wrap img {
            width: 100%;
            height: 380px;
            object-fit: cover;
        }

        .menu-card {
            border: 1px solid #e4ebe5;
            border-radius: 16px;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
            transition: 0.2s ease;
            height: 100%;
            position: relative;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 34px rgba(0, 0, 0, 0.08);
        }

        .menu-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .tag-badge {
            background: #e7f8ef;
            color: #0da36b;
            border-radius: 999px;
            padding: 6px 12px;
            font-weight: 600;
            font-size: 12px;
        }

        .tips-card {
            background: #e9f6ef;
            border-radius: 14px;
            padding: 18px;
            height: 100%;
        }

        .menu-meta {
            border-top: 1px solid #eef3ef;
            background: #f9fdfb;
            padding: 12px 16px;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #6c7d86;
            font-size: 13px;
            font-weight: 600;
        }

        .meta-icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e7f8ef;
            color: #0da36b;
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
    </style>

    <section class="menu-hero">
        <div class="container text-center">
            <div class="mb-4">
                <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-egg-fried"></i></div>
                <h2 class="fw-bold">Menu Sehat</h2>
                <p class="text-muted">Koleksi resep makanan sehat yang lezat dan bergizi untuk mendukung pola makan Anda</p>
            </div>
            <div class="menu-banner-wrap mb-4 mx-auto" style="max-width: 960px;">
                <img src="{{ optional($menus->first())->gambar ? Storage::url($menus->first()->gambar) : asset('images/salad.jpg') }}"
                    alt="Banner Menu Sehat">
            </div>
        </div>
    </section>

    <section class="py-5" style="background:#f7fbf8;">
        <div class="container">
            <div class="row g-4">
                @forelse ($menus as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="menu-card position-relative">
                            <img src="{{ $item->gambar ? Storage::url($item->gambar) : asset('images/gambar_menu.jpg') }}"
                                class="menu-img" alt="Menu {{ $item->nama_menu }}">
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0">{{ $item->nama_menu }}</h5>
                                    <span class="badge bg-success-subtle text-success">Sehat</span>
                                </div>
                                <p class="text-muted small mb-0">{!! Str::limit($item->deskripsi, 120) !!}</p>
                            </div>
                            <div class="menu-meta d-flex justify-content-between align-items-center">
                                <div class="meta-item">
                                    <span class="meta-icon"><i class="bi bi-fire"></i></span>
                                    <span>{{ !is_null($item->kalori ?? null) ? $item->kalori . ' kkal' : 'Kalori belum ada' }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-icon"><i class="bi bi-clock-history"></i></span>
                                    <span>{{ !is_null($item->waktu_memasak ?? null) ? $item->waktu_memasak . ' menit' : 'Waktu belum ada' }}</span>
                                </div>
                            </div>
                            <a href="{{ route('menu.show', $item->id) }}" class="stretched-link"
                                aria-label="Detail {{ $item->nama_menu }}"></a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada menu yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Tips Menyiapkan Menu Sehat</h4>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="tips-card h-100">
                        <h5 class="fw-bold mb-2">1. Persiapan Awal</h5>
                        <p class="text-muted mb-0 small">Siapkan bahan-bahan segar dan cuci bersih sebelum dimasak.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tips-card h-100">
                        <h5 class="fw-bold mb-2">2. Porsi Seimbang</h5>
                        <p class="text-muted mb-0 small">Perhatikan keseimbangan protein, karbohidrat, dan sayuran.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tips-card h-100">
                        <h5 class="fw-bold mb-2">3. Variasi Menu</h5>
                        <p class="text-muted mb-0 small">Ganti menu secara berkala untuk mendapatkan nutrisi yang beragam.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
