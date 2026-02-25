@extends('layouts.main')

@section('title', $title)

@section('content')

    <section class="relative bg-background-base pt-12 pb-20 lg:pt-24 lg:pb-32 overflow-hidden">
        <div
            class="absolute inset-0 bg-linear-to-br from-background-dark via-background-base to-background-dark opacity-80 pointer-events-none">
        </div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/5 filter blur-[120px] rounded-full pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2 text-left">
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-card-dark border border-card-border text-primary text-sm font-bold tracking-wide uppercase mb-6">
                        Hidup lebih sehat dan bahagia
                    </span>
                    <h1 class="text-4xl lg:text-6xl font-extrabold leading-tight mb-6 text-white">
                        Selamat Datang di <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-primary to-green-300">Fitlife.id</span>
                    </h1>
                    <p class="text-lg text-text-muted mb-8 leading-relaxed max-w-xl">
                        Platform manajemen diet dan pola makan digital untuk hidup yang lebih sehat dengan menu lezat,
                        artikel inspiratif, dan kalkulator BMI.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start">
                        <a class="bg-primary text-background-dark hover:bg-primary-hover px-8 py-3.5 rounded-full font-bold shadow-[0_0_20px_rgba(0,255,127,0.4)] transition transform hover:-translate-y-1"
                            href="#">
                            Mulai Sekarang
                        </a>
                        <a class="bg-transparent border border-card-border hover:border-primary text-white hover:text-primary px-8 py-3.5 rounded-full font-bold transition"
                            href="#">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative group">
                    <div
                        class="absolute inset-0 bg-primary/20 rounded-3xl transform rotate-3 scale-95 opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-2xl">
                    </div>
                    <img alt="Fresh vegetables and healthy food preparation"
                        class="relative rounded-3xl shadow-2xl border border-card-border object-cover w-full h-100 lg:h-125 transform transition duration-500 hover:scale-[1.01]"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQ4ZkSFClO1fXtFbM0XmO9HaCa_r9xNW8tboOEpzU7LBjEFr5MPX4c86KmN2zBDe6d_YoFLQVSQ8A05NFXJEdmxFjW4rakGfhZleToMRiI8UAtyHgiXcg4cLOpsjuifCjLKlfYK-f4nZ5SdfmAy-FXZ0pOfr1n2CUBYI3h5myPjfEaNdOSnDRu-HUcTPQX59IVEidQcadhat-aKa25U7WoftnrqckvkVyf84ERzpSltf24cU-EJFf78t3LWPE77S3ylwfSmnh3JNY" />
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Fitur Unggulan FitLife.id</h2>
                <p class="text-text-muted text-lg">
                    Dapatkan semua yang anda butuhkan untuk mencapai tujuan kesehatan anda
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-card-dark rounded-2xl p-8 shadow-lg hover:shadow-primary/10 transition-shadow border border-card-border flex flex-col items-center text-center group hover:border-primary/50">
                    <div
                        class="w-16 h-16 bg-background-base text-primary border border-card-border rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-[0_0_15px_rgba(0,255,127,0.2)]">
                        <span class="material-icons-round text-3xl">show_chart</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Kalkulator BMI</h3>
                    <p class="text-text-muted mb-8 grow">
                        Hitung indeks massa tubuh anda dan dapatkan rekomendasi berat badan ideal.
                    </p>
                    <a class="w-full bg-transparent border border-primary text-primary hover:bg-primary hover:text-background-dark py-3 rounded-xl font-bold transition"
                        href="{{ route('kalkulator') }}">
                        Lihat Detail
                    </a>
                </div>
                <div
                    class="bg-card-dark rounded-2xl p-8 shadow-lg hover:shadow-primary/10 transition-shadow border border-card-border flex flex-col items-center text-center group hover:border-primary/50">
                    <div
                        class="w-16 h-16 bg-background-base text-primary border border-card-border rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-[0_0_15px_rgba(0,255,127,0.2)]">
                        <span class="material-icons-round text-3xl">restaurant_menu</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Menu Sehat</h3>
                    <p class="text-text-muted mb-8 grow">
                        Temukan berbagai pilihan menu makanan sehat untuk diet anda.
                    </p>
                    <a class="w-full bg-transparent border border-primary text-primary hover:bg-primary hover:text-background-dark py-3 rounded-xl font-bold transition"
                        href="{{ route('menu') }}">
                        Lihat Detail
                    </a>
                </div>
                <div
                    class="bg-card-dark rounded-2xl p-8 shadow-lg hover:shadow-primary/10 transition-shadow border border-card-border flex flex-col items-center text-center group hover:border-primary/50">
                    <div
                        class="w-16 h-16 bg-background-base text-primary border border-card-border rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 group-hover:shadow-[0_0_15px_rgba(0,255,127,0.2)]">
                        <span class="material-icons-round text-3xl">article</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Artikel</h3>
                    <p class="text-text-muted mb-8 grow">
                        Baca artikel dan tips seputar diet serta pola hidup sehat.
                    </p>
                    <a class="w-full bg-transparent border border-primary text-primary hover:bg-primary hover:text-background-dark py-3 rounded-xl font-bold transition"
                        href="{{ route('artikel.index') }}">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-background-base border-t border-card-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-card-dark rounded-2xl p-6 shadow-sm border border-card-border">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Menu Sehat Terbaru</h3>
                        <a class="text-primary text-sm font-semibold hover:text-white transition" href="#">Lihat
                            semua</a>
                    </div>
                    <div
                        class="h-32 flex items-center justify-center text-text-muted italic bg-background-base/50 rounded-xl border border-dashed border-card-border">
                        Belum ada menu yang tersedia.
                    </div>
                </div>
                <div class="bg-card-dark rounded-2xl p-6 shadow-sm border border-card-border">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Artikel Terbaru</h3>
                        <a class="text-primary text-sm font-semibold hover:text-white transition" href="#">Lihat
                            semua</a>
                    </div>
                    <div
                        class="h-32 flex items-center justify-center text-text-muted italic bg-background-base/50 rounded-xl border border-dashed border-card-border">
                        Belum ada artikel.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="bg-linear-to-r from-card-dark to-background-dark border-t border-card-border py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 pattern-dots text-primary"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold mb-6 text-white">Siap Memulai Perjalanan Sehat Anda?</h2>
            <p class="text-lg md:text-xl text-text-muted mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengguna yang telah merasakan manfaat hidup lebih sehat.
            </p>
            <a class="inline-block bg-primary text-background-dark hover:bg-white hover:text-background-dark px-10 py-4 rounded-full font-bold text-lg shadow-[0_0_25px_rgba(0,255,127,0.5)] transition transform hover:scale-105"
                href="#">
                Hitung BMI Sekarang
            </a>
        </div>
    </section>
    <footer class="bg-background-dark pt-12 pb-8 border-t border-card-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div
                            class="bg-primary text-background-dark p-1 rounded font-bold text-lg h-7 w-7 flex items-center justify-center">
                            F</div>
                        <span class="font-bold text-xl text-white">FitLife.id</span>
                    </div>
                    <p class="text-text-muted text-sm max-w-xs">
                        Platform kesehatan terpercaya untuk membantu Anda mencapai berat badan ideal dan gaya hidup sehat.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-text-muted">
                        <li><a class="hover:text-primary transition" href="#">Home</a></li>
                        <li><a class="hover:text-primary transition" href="#">Kalkulator BMI</a></li>
                        <li><a class="hover:text-primary transition" href="#">Menu Sehat</a></li>
                        <li><a class="hover:text-primary transition" href="#">Artikel</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-text-muted">
                        <li>support@fitlife.id</li>
                        <li>+62 812 3456 7890</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-card-border pt-8 text-center text-sm text-text-muted">
                © 2023 FitLife.id. All rights reserved.
            </div>
        </div>
    </footer>


    {{-- ... kode section sebelumnya ... --}}


@endsection
