@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
@endphp

<nav class="sticky top-0 z-50 bg-background-base/90 backdrop-blur-md border-b border-card-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-primary font-bold text-lg">
                <img src="{{ asset('images/logo.png') }}" alt="FitLife Logo" class="w-9 h-9 object-contain">
                <span>FitLife.id</span>
            </a>

            {{-- Desktop Menu --}}
            <div x-data="{ active: '{{ Route::currentRouteName() }}' }" class="hidden md:flex items-center gap-8">

                <a href="{{ route('home') }}" @click="active = 'home'"
                    :class="active === 'home'
                        ?
                        'text-primary border-b-2 border-primary' :
                        'text-text-muted hover:text-primary'"
                    class="font-medium transition pb-1">
                    Home
                </a>

                <a href="{{ route('kalkulator') }}" @click="active = 'kalkulator'"
                    :class="active === 'kalkulator'
                        ?
                        'text-primary border-b-2 border-primary' :
                        'text-text-muted hover:text-primary'"
                    class="font-medium transition pb-1">
                    Kalkulator BMI
                </a>

                <a href="{{ route('menu') }}" @click="active = 'menu'"
                    :class="active === 'menu'
                        ?
                        'text-primary border-b-2 border-primary' :
                        'text-text-muted hover:text-primary'"
                    class="font-medium transition pb-1">
                    Menu Sehat
                </a>

                <a href="{{ route('artikel.index') }}" @click="active = 'artikel.index'"
                    :class="active === 'artikel.index'
                        ?
                        'text-primary border-b-2 border-primary' :
                        'text-text-muted hover:text-primary'"
                    class="font-medium transition pb-1">
                    Artikel
                </a>
            </div>

            {{-- Right Section --}}
            <div class="hidden md:flex items-center">

                @if (Auth::check())
                    @php
                        $user = Auth::user();
                        $profilePhoto = asset('default-user.png');

                        if (!empty($user->photo)) {
                            $path = $user->photo;
                            $profilePhoto = Storage::url($path);
                            if (Storage::disk('public')->exists($path)) {
                                $profilePhoto .= '?v=' . Storage::disk('public')->lastModified($path);
                            }
                        } elseif (!empty($user->google_avatar)) {
                            if (Str::startsWith($user->google_avatar, 'http')) {
                                $profilePhoto = $user->google_avatar;
                            } else {
                                $path = $user->google_avatar;
                                $profilePhoto = Storage::url($path);
                                if (Storage::disk('public')->exists($path)) {
                                    $profilePhoto .= '?v=' . Storage::disk('public')->lastModified($path);
                                }
                            }
                        }
                    @endphp

                    {{-- Avatar --}}
                    <a href="{{ route('test.profile') }}"
                        class="relative w-10 h-10 rounded-full
                              ring-2 ring-primary/40 hover:ring-primary
                              transition duration-300 hover:scale-105">

                        <div class="w-full h-full rounded-full overflow-hidden">
                            <img src="{{ $profilePhoto }}" alt="Profile" class="w-full h-full object-cover">
                        </div>

                        {{-- Online Indicator (keluar sedikit) --}}
                        <span
                            class="absolute -bottom-1 -right-1
                                     w-3.5 h-3.5 bg-green-400
                                     rounded-full ring-2 ring-background-base">
                        </span>
                    </a>
                @else
                    {{-- Login Button --}}
                    <a href="{{ route('auth.login') }}"
                        class="bg-primary hover:bg-primary-hover
                              text-background-dark px-6 py-2.5
                              rounded-full font-semibold
                              shadow-[0_0_15px_rgba(0,255,127,0.3)]
                              transition transform hover:-translate-y-0.5">
                        Login
                    </a>
                @endif
            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden flex items-center">
                <button class="text-text-light hover:text-primary transition">
                    <span class="material-icons-round text-3xl">menu</span>
                </button>
            </div>

        </div>
    </div>
</nav>
