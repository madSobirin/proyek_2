@extends('layouts.main')

@section('title', $title)
@section('content')
    <style>
        .menu-hero {
            background: #e9f6ef;
            padding: 28px 0 18px;
        }

        .menu-hero .badge {
            font-weight: 600;
        }

        .detail-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .detail-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .detail-header {
            margin-bottom: 18px;
        }

        @media (max-width: 576px) {
            .menu-hero {
                padding: 20px 0 12px;
            }

            .detail-img {
                height: 200px;
            }
        }
    </style>

    <section class="menu-hero">
        <div class="container text-center">
            {{-- <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-egg-fried"></i></div> --}}
            <h2 class="fw-bold mb-0">{{ $menu->nama_menu }}</h2>
            <div class="text-muted small">
                <i class="bi bi-calendar me-1"></i>{{ $menu->created_at?->format('d M Y') }} &nbsp; | &nbsp;
                <i class="bi bi-eye me-1"></i>{{ $menu->dibaca }} kali dibaca
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="detail-header">
            <a href="{{ route('menu') }}" class="btn btn-outline-success">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden detail-card">
            @if ($menu->gambar)
                <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="w-100 detail-img">
            @endif

            <div class="p-4">
                <h3 class="fw-bold mb-2">{{ $menu->nama_menu }}</h3>


                <div class="d-flex gap-4 align-items-center mb-3 text-muted">
                    <div class="d-flex align-items-center gap-2 fw-semibold">
                        <span class="badge bg-success-subtle text-success rounded-3 p-2">
                            <i class="bi bi-fire"></i>
                        </span>
                        <span>{{ !is_null($menu->kalori ?? null) ? $menu->kalori . ' kkal' : 'Kalori belum ada' }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 fw-semibold">
                        <span class="badge bg-success-subtle text-success rounded-3 p-2">
                            <i class="bi bi-clock-history"></i>
                        </span>
                        <span>{{ !is_null($menu->waktu_memasak ?? null) ? $menu->waktu_memasak . ' menit' : 'Waktu belum ada' }}</span>
                    </div>
                </div>

                <p class="fs-6" style="line-height:1.7rem;">{!!$menu->deskripsi !!}</p>
            </div>
        </div>
    </div>
@endsection
