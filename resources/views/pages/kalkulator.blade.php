@extends('layouts.main')

@section('title', $title)

@section('content')
    <style>
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

        .kalk-page-wrapper {
            position: relative;
        }

        .kalk-page-wrapper.locked .kalk-content {
            filter: blur(10px) saturate(.95);
            pointer-events: none;
            user-select: none;
            opacity: 0.9;
        }

        .kalk-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            pointer-events: auto;
        }

        .kalk-overlay .card {
            max-width: 520px;
            margin: 0 16px;
            padding: 28px;
            border-radius: 14px;
            text-align: center;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
        }

        .kalk-overlay h4 {
            margin-bottom: 8px;
            font-weight: 700;
            color: #184d3a;
        }

        .kalk-overlay p {
            margin-bottom: 18px;
            color: #4b5c54;
        }

        .kalk-overlay .btn {
            min-width: 160px;
        }

        @media (max-width: 768px) {
            .kalk-overlay .card {
                padding: 20px;
            }
        }

        .bmi-legend {
            padding: 0;
            margin: 0;
            list-style: none;
            display: grid;
            gap: 10px;
            font-weight: 600;
            color: #374b47;
            font-size: 14px;
        }

        .bmi-legend li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bmi-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
        }

        .dot-low {
            background: #2bb3d6;
        }

        .dot-normal {
            background: #1fb879;
        }

        .dot-over {
            background: #f2cf4d;
        }

        .dot-obese {
            background: #ff6b6b;
        }

        .me-2 {
            margin-right: .5rem !important;
        }

        .page-bottom-space {
            padding-bottom: 150px;
        }
    </style>



    <!-- wrapper used to toggle blur when guest -->
    <div class="kalk-page-wrapper @guest locked @endguest">
        <div class="kalk-content">
            <section class="calc-hero text-center">
                <div class="container">
                    <div class="fitlife-icon mx-auto mb-2 mt-5"><i class="bi bi-activity"></i></div>
                    <h2 class="fw-bold">Kalkulator BMI</h2>
                    <p class="text-muted">
                        Hitung indeks massa tubuh dan dapatkan rekomendasi kategori kesehatan Anda
                    </p>
                    <div class="hero-divider" aria-hidden="true"></div>
                </div>
            </section>
            <div class="container page-bottom-space">
                <style>
                    .calc-row {
                        --bs-gutter-x: 28px;
                        --bs-gutter-y: 24px;
                    }

                    .calc-card {
                        background: #fff;
                        border-radius: 14px;
                        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
                    }

                    .info-card {
                        background: #fff;
                        border-radius: 14px;
                        box-shadow: 0 14px 34px rgba(0, 0, 0, 0.06);
                        padding: 22px;
                        height: 100%;
                    }

                    .kalk-overlay {
                        z-index: 999;
                    }

                    .kalk-page-wrapper .info-card {
                        z-index: 2;
                        position: relative;
                    }
                </style>

                <div class="row calc-row align-items-start">
                    <div class="col-lg-7 col-md-8">
                        <div class="card calc-card p-4 h-100">
                            <form method="POST" action="{{ route('kalkulator') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tinggi" class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi" id="tinggi" class="form-control" required
                                        min="1" placeholder="Contoh: 150">
                                </div>

                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat Badan (kg)</label>
                                    <input type="number" name="berat" id="berat" class="form-control" required
                                        min="1" placeholder="Contoh: 43">
                                </div>

                                <button type="submit" class="btn btn-fitlife w-100">Hitung BMI</button>
                            </form>

                            @if (session('hasil'))
                                <div class="bmi-result-wrapper mt-4">
                                    <div class="bmi-result-card">
                                        {!! session('hasil') !!}
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-center gap-4 mt-3 small text-muted flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-stopwatch"></i> <span>Hasil cepat & praktis</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-clipboard-check"></i> <span>Kategori kesehatan jelas</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-lightbulb"></i> <span>Bantu rencanakan pola hidup</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3 small text-muted" style="max-width:600px;margin:0 auto;">
                            Mengukur BMI membantu Anda memahami risiko kesehatan dan membuat keputusan gaya hidup yang lebih
                            bijak.
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <div class="info-card">
                            <h4>Tentang BMI</h4>
                            <p class="mb-2">
                                Body Mass Index (BMI) adalah cara menghitung berat badan ideal berdasarkan tinggi dan berat
                                badan Anda.
                                Hasil membantu mengidentifikasi risiko kesehatan terkait berat badan.
                            </p>

                            <div class="mb-3 fw-bold">Kategori BMI:</div>

                            <ul class="bmi-legend list-unstyled mb-0">
                                <li><span class="bmi-dot dot-low me-2"></span>&lt; 18.5 : Berat Badan Rendah</li>
                                <li><span class="bmi-dot dot-normal me-2"></span>18.5 – 24.9 : Normal</li>
                                <li><span class="bmi-dot dot-over me-2"></span>25 – 29.9 : Berat Badan Berlebih</li>
                                <li><span class="bmi-dot dot-obese me-2"></span>&gt; 30 : Obesitas</li>
                            </ul>

                            <hr>
                            <h6 class="fw-bold">Tips singkat</h6>
                            <ul class="small text-muted" style="padding-left:18px;">
                                <li>Perbanyak sayur, kurangi gula dan makanan olahan.</li>
                                <li>Jaga porsi makan dan rutin berolahraga ringan.</li>
                                <li>Konsultasi ke ahli gizi untuk rekomendasi personal.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @guest
            <div class="kalk-overlay">
                <div class="card text-center">
                    <h4>Silakan login / daftar terlebih dahulu</h4>
                    <p>Untuk mengakses kalkulator BMI ini, Anda harus masuk ke akun. Silakan login atau daftar untuk
                        melanjutkan.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('auth.index') }}" class="btn btn-fitlife">Masuk / Daftar</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        @endguest
    </div>
@endsection
