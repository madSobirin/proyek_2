@extends('layouts.main')

@section('title', $title)

@section('content')

    <style>
        .hero-section {
            background: linear-gradient(120deg, #1fb879 0%, #0da36b 100%);
            color: #fff;
            position: relative;
            overflow: hidden;
            padding: 80px 0 70px;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset('images/sayuran.jpg') }}') center/cover no-repeat;
            opacity: 0.12;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-illustration {
            position: relative;
            z-index: 1;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.2);
        }

        .hero-illustration img {
            width: 100%;
            height: 340px;
            object-fit: cover;
        }

        .capsule-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.16);
            color: #fff;
            border-radius: 999px;
            padding: 8px 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .feature-section {
            padding: 70px 0 50px;
            background: #f7fbf8;
        }

        .fitlife-card {
            border: 1px solid #e3efe6;
            border-radius: 16px;
            background: #fff;
            padding: 22px;
            height: 100%;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
            transition: all .2s ease;
        }

        .fitlife-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
        }

        .fitlife-icon {
            width: 48px;
            height: 48px;
            background: #e7f8ef;
            color: #0da36b;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .cta-section {
            background: linear-gradient(120deg, #1fb879 0%, #0aa56a 100%);
            color: #fff;
            padding: 60px 0;
        }

        .pill-btn {
            border-radius: 999px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .mini-card {
            border-radius: 14px;
            border: 1px solid #e5ece8;
            padding: 16px;
            background: #fff;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
    </style>

    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="capsule-badge mb-3">Hidup lebih sehat dan bahagia</span>
                    <h1 class="display-5 fw-bold mb-3">Selamat Datang di <span style="color:#ffe66d;">Fitlife.id</span></h1>
                    <p class="lead mb-4">Platform manajemen diet dan pola makan digital untuk hidup yang lebih sehat dengan
                        menu lezat, artikel inspiratif, dan kalkulator BMI.</p>
                    <div class="d-flex flex-wrap gap-3">
                        @auth
                            <a href="{{ route('kalkulator') }}" class="btn btn-light pill-btn fw-semibold">Mulai Sekarang</a>
                        @else
                            <a href="{{ route('auth.login') }}" class="btn btn-light pill-btn fw-semibold">Mulai Sekarang</a>
                        @endauth
                        <a href="#fitur" class="btn btn-outline-light pill-btn">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <img src="{{ asset('images/gambar_menu.jpg') }}" alt="Pilihan menu sehat">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="feature-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Fitur Unggulan FitLife.id</h2>
                <p class="text-muted">Dapatkan semua yang anda butuhkan untuk mencapai tujuan kesehatan anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="fitlife-card text-center h-100">
                        <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-activity"></i></div>
                        <h5 class="fw-bold mb-2">Kalkulator BMI</h5>
                        <p class="text-muted small">Hitung indeks massa tubuh anda dan dapatkan rekomendasi berat badan
                            ideal.</p>
                        <a href="{{ route('kalkulator') }}" class="btn btn-fitlife mt-2 w-100">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fitlife-card text-center h-100">
                        <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-egg-fried"></i></div>
                        <h5 class="fw-bold mb-2">Menu Sehat</h5>
                        <p class="text-muted small">Temukan berbagai pilihan menu makanan sehat untuk diet anda.</p>
                        <a href="{{ route('menu') }}" class="btn btn-fitlife mt-2 w-100">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fitlife-card text-center h-100">
                        <div class="fitlife-icon mx-auto mb-2"><i class="bi bi-journal-text"></i></div>
                        <h5 class="fw-bold mb-2">Artikel</h5>
                        <p class="text-muted small">Baca artikel dan tips seputar diet serta pola hidup sehat.</p>
                        <a href="{{ route('artikel.index') }}" class="btn btn-fitlife mt-2 w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="fitlife-card h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Menu Sehat Terbaru</h5>
                            <a href="{{ route('menu') }}" class="text-success">Lihat semua</a>
                        </div>
                        <div class="row g-3">
                            @forelse($featuredMenus as $menu)
                                <div class="col-md-6">
                                    <div class="mini-card h-100">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ $menu->gambar ? Storage::url($menu->gambar) : 'https://via.placeholder.com/90x70' }}"
                                                    class="rounded" width="90" height="70"
                                                    alt="{{ $menu->nama_menu }}">
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $menu->nama_menu }}</h6>
                                                <p class="small text-muted mb-2">{!! Str::limit($menu->deskripsi, 80) !!}</p>
                                                <div class="d-flex flex-wrap gap-3 text-muted small mb-2">
                                                    <span class="d-flex align-items-center gap-1">
                                                        <i class="bi bi-fire text-danger"></i>
                                                        {{ !is_null($menu->kalori ?? null) ? $menu->kalori . ' kkal' : 'Kalori belum ada' }}
                                                    </span>
                                                    <span class="d-flex align-items-center gap-1">
                                                        <i class="bi bi-clock-history text-success"></i>
                                                        {{ !is_null($menu->waktu_memasak ?? null) ? $menu->waktu_memasak . ' menit' : 'Waktu belum ada' }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('menu.show', $menu->id) }}"
                                                    class="text-success fw-semibold small">Lihat menu</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted mb-0">Belum ada menu yang tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="fitlife-card h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Artikel Terbaru</h5>
                            <a href="{{ route('artikel.index') }}" class="text-success">Lihat semua</a>
                        </div>
                        <div class="row g-3">
                            @forelse($latestArticles as $artikel)
                                <div class="col-sm-6">
                                    <div class="mini-card h-100">
                                        <div class="ratio ratio-4x3 mb-2">
                                            <img src="{{ $artikel->gambar ? Storage::url($artikel->gambar) : 'https://via.placeholder.com/200x150' }}"
                                                class="rounded w-100 h-100 object-fit-cover" alt="{{ $artikel->judul }}">
                                        </div>
                                        <div class="small text-success fw-semibold mb-1">
                                            {{ $artikel->kategori ?? 'Artikel' }}</div>
                                        <h6 class="fw-bold mb-1">{{ $artikel->judul }}</h6>
                                        <p class="small text-muted mb-2">{!! Str::limit(strip_tags($artikel->isi), 90) !!}</p>
                                        <a href="{{ route('artikel.show', $artikel->slug) }}"
                                            class="text-success small fw-semibold">Baca selengkapnya</a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted mb-0">Belum ada artikel.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section text-center">
        <div class="container">
            <h2 class="fw-bold mb-2">Siap Memulai Perjalanan Sehat Anda?</h2>
            <p class="mb-4">Bergabunglah dengan ribuan pengguna yang telah merasakan manfaat hidup lebih sehat.</p>
            <a href="{{ route('kalkulator') }}" class="btn btn-light pill-btn">Hitung BMI Sekarang</a>
        </div>
    </section>


    {{-- ... kode section sebelumnya ... --}}

    <div id="chatbot-container" class="fixed-bottom-right">

        <button id="chatbot-toggle" class="chatbot-btn shadow-lg">
            <i class="bi bi-chat-dots-fill" style="font-size: 24px;"></i>
        </button>

        <div id="chatbot-window" class="chatbot-window shadow-lg d-none">

            <div class="chat-header d-flex justify-content-between align-items-center p-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="chat-avatar-icon">
                        <i class="bi bi-robot"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-white">Health AI</h6>
                        <span class="badge bg-success-subtle text-success border border-success-subtle"
                            style="font-size: 10px;">Online</span>
                    </div>
                </div>
                <button id="chatbot-close" class="btn btn-sm text-white"><i class="bi bi-x-lg"></i></button>
            </div>

            <div class="chat-body p-3" id="chat-messages">

                <div class="d-flex gap-2 mb-3">
                    <div
                        class="chat-avatar-small bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-robot" style="font-size: 12px;"></i>
                    </div>
                    <div>
                        <div class="chat-bubble bg-light text-dark p-2 rounded-3 shadow-sm">
                            <small class="d-block fw-bold mb-1 text-primary">Health AI</small>
                            Halo! Saya asisten kesehatan virtual Anda. Ada yang bisa saya bantu seputar diet atau kesehatan
                            hari ini? 🌱
                        </div>
                        <small class="text-muted" style="font-size: 10px;">Baru saja</small>
                    </div>
                </div>

            </div>

            <div class="chat-footer p-2 border-top bg-white">
                <form id="chat-form" class="d-flex align-items-center gap-2">
                    <input type="text" id="chat-input" class="form-control form-control-sm border-0 bg-light"
                        placeholder="Ketik pesan kesehatan..." autocomplete="off">
                    <button type="submit"
                        class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 32px; height: 32px;">
                        <i class="bi bi-send-fill" style="font-size: 12px;"></i>
                    </button>
                </form>
                <div class="text-center mt-1">
                    <small class="text-muted" style="font-size: 9px;">Health AI bisa membuat kesalahan. Cek info
                        penting.</small>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Posisi Container di Pojok Kanan Bawah */
        .fixed-bottom-right {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: end;
            gap: 15px;
        }

        /* Tombol Toggle Bulat */
        .chatbot-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1fb879 0%, #0da36b 100%);
            border: none;
            color: white;
            cursor: pointer;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chatbot-btn:hover {
            transform: scale(1.1);
        }

        /* Jendela Chat */
        .chatbot-window {
            width: 350px;
            height: 500px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: slideInUp 0.3s ease-out forwards;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Chat */
        .chat-header {
            background: linear-gradient(135deg, #1fb879 0%, #0da36b 100%);
        }

        .chat-avatar-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        /* Body Chat */
        .chat-body {
            flex: 1;
            overflow-y: auto;
            background: #f8f9fa;
        }

        /* Bubble Chat */
        .chat-bubble {
            font-size: 0.9rem;
            line-height: 1.4;
            max-width: 85%;
        }

        .chat-avatar-small {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
        }

        /* Pesan User (Nanti dipakai lewat JS) */
        .user-message {
            justify-content: flex-end;
        }

        .user-message .chat-bubble {
            background: #1fb879 !important;
            /* Warna Hijau FitLife */
            color: white !important;
            border-radius: 12px 12px 0 12px;
        }

        /* Custom Scrollbar */
        .chat-body::-webkit-scrollbar {
            width: 5px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('chatbot-toggle');
            const closeBtn = document.getElementById('chatbot-close');
            const chatWindow = document.getElementById('chatbot-window');
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatMessages = document.getElementById('chat-messages');

            // Fungsi Buka/Tutup Chat
            function toggleChat() {
                chatWindow.classList.toggle('d-none');
                if (!chatWindow.classList.contains('d-none')) {
                    chatInput.focus(); // Otomatis fokus ke input saat dibuka
                }
            }

            toggleBtn.addEventListener('click', toggleChat);
            closeBtn.addEventListener('click', toggleChat);

            // Simulasi Kirim Pesan (UI Only)
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = chatInput.value.trim();

                if (message) {
                    // 1. Tambahkan Pesan User ke UI
                    const userBubble = `
                        <div class="d-flex gap-2 mb-3 justify-content-end">
                            <div>
                                <div class="chat-bubble p-2 rounded-3 shadow-sm" style="background: #1fb879; color: white; border-radius: 12px 12px 0 12px;">
                                    ${message}
                                </div>
                                <small class="text-muted d-block text-end" style="font-size: 10px;">Anda • Baru saja</small>
                            </div>
                        </div>
                    `;
                    chatMessages.insertAdjacentHTML('beforeend', userBubble);

                    // Reset Input
                    chatInput.value = '';

                    // Auto Scroll ke Bawah
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    // 2. Simulasi Balasan Bot (Loading...)
                    setTimeout(() => {
                        const botBubble = `
                            <div class="d-flex gap-2 mb-3">
                                <div class="chat-avatar-small bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-robot" style="font-size: 12px;"></i>
                                </div>
                                <div>
                                    <div class="chat-bubble bg-light text-dark p-2 rounded-3 shadow-sm">
                                        <small class="d-block fw-bold mb-1 text-white">Health AI</small>
                                        Maaf, fitur AI saya sedang dalam pengembangan. Nanti saya akan bisa menjawab pertanyaan: "${message}" 😉
                                    </div>
                                    <small class="text-muted" style="font-size: 10px;">Baru saja</small>
                                </div>
                            </div>
                        `;
                        chatMessages.insertAdjacentHTML('beforeend', botBubble);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);
                }
            });
        });
    </script>
@endsection
