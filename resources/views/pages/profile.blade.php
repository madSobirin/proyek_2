@extends('layouts.main')
@section('title', $title)

@section('content')
    @php
        $user = Auth::user();
        $imgPath = null;

        if (!empty($user->photo)) {
            $imgPath = $user->photo;
        } elseif (!empty($user->google_avatar)) {
            $imgPath = $user->google_avatar;
        }

        if ($imgPath) {
            $imgUrl = Storage::url($imgPath);
        } else {
            $imgUrl = asset('default-user.png');
        }

        if ($imgPath && Storage::disk('public')->exists($imgPath)) {
            $ts = Storage::disk('public')->lastModified($imgPath);
            $imgUrl .= '?v=' . $ts;
        }
    @endphp

    <style>
        /* container */
        .profile-wrapper {
            max-width: 820px;
            margin: 24px auto 80px;
            padding: 0 16px;
        }

        /* avatar layout */
        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 24px auto 8px;
        }

        .avatar-wrapper {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            padding: 6px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #1fb879;
            display: block;
        }

        /* default: kamera disembunyikan dan avatar tidak bisa diklik */
        .camera-icon {
            display: none;
            /* tersembunyi by default */
            position: absolute;
            bottom: 0;
            right: 0;
            transform: translate(30%, 30%);
            background: rgba(0, 0, 0, 0.65);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: .2s ease;
            border: 3px solid white;
            z-index: 30;
        }

        .profile-wrapper .camera-icon {
            display: none !important;
            /* sembunyikan default, pakai !important untuk override style lain */
        }

        /* saat editing, tampilkan kamera */
        .profile-wrapper.editing .camera-icon {
            display: flex !important;
        }

        /* pointer events: hanya aktif jika editing */
        .profile-wrapper .avatar-container {
            pointer-events: none;
        }

        .profile-wrapper.editing .avatar-container {
            pointer-events: auto;
            cursor: pointer;
        }



        /* profile card */
        .profile-card {
            background: #fff;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.06);
            margin-top: 12px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #2b2b2b;
            margin-top: 8px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #2b2b2b;
            margin-bottom: 15px;
            padding-left: 10px;
            border-left: 5px solid #28a745;
        }

        @media (max-width: 576px) {
            .avatar-wrapper {
                padding: 6px;
            }

            .avatar-container {
                width: 120px;
                height: 120px;
            }
        }
    </style>

    <div class="profile-wrapper">
        <!-- Form membungkus avatar + fields agar submit bekerja -->
        <form action="{{ route('test.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')

            {{-- AVATAR --}}
            <div id="profileArea" class="text-center">
                <label for="photoInput" class="avatar-container" aria-hidden="true">
                    <div class="avatar-wrapper">
                        <img src="{{ $imgUrl }}" id="profilePreview" class="avatar-img" alt="Avatar">
                    </div>

                    <div class="camera-icon" id="cameraIcon" title="Ubah foto profil">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                </label>

                <input type="file" id="photoInput" name="photo" class="d-none" accept="image/*">
                <h2 class="title mt-3">Profile</h2>
                <p class="text-muted">Kelola Informasi Pribadi Anda</p>
            </div>

            <!-- content card -->
            <div id="cardArea" class="profile-card">
                <div class="section-title">Informasi Pribadi</div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control editable"
                            value="{{ old('name', Auth::user()->name) }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control editable"
                            value="{{ old('email', Auth::user()->email) }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control editable"
                            value="{{ old('phone', Auth::user()->phone) }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="birthdate" class="form-control editable"
                            value="{{ old('birthdate', Auth::user()->birthdate) }}" readonly>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Berat Badan (kg)</label>
                        <input type="text" name="weight" class="form-control editable"
                            value="{{ old('weight', Auth::user()->weight) }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <input type="text" name="height" class="form-control editable"
                            value="{{ old('height', Auth::user()->height) }}" readonly>
                    </div>
                </div>

                <div class="text-end">
                    <button type="button" id="editBtn" class="btn btn-success px-4">Edit Profile</button>
                    <button type="submit" id="saveBtn" class="btn btn-primary px-4 d-none">Simpan Perubahan</button>
                </div>
            </div>
        </form>

        <div class="container text-center mt-4 mb-5">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger px-4">Logout</button>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const editBtn = document.getElementById('editBtn');
            const saveBtn = document.getElementById('saveBtn');
            const profileWrapper = document.querySelector('.profile-wrapper');
            const editableInputs = document.querySelectorAll('.editable');
            const photoInput = document.getElementById('photoInput');
            const profilePreview = document.getElementById('profilePreview');

            // optional: buat tombol cancel agar user bisa membatalkan edit
            let cancelBtn = document.getElementById('cancelBtn');
            if (!cancelBtn) {
                cancelBtn = document.createElement('button');
                cancelBtn.type = 'button';
                cancelBtn.id = 'cancelBtn';
                cancelBtn.className = 'btn btn-outline-secondary me-2 d-none';
                cancelBtn.textContent = 'Batal';
                // letakkan cancel sebelah save (tepat sebelum saveBtn)
                saveBtn.parentNode.insertBefore(cancelBtn, saveBtn);
            }

            function enterEditMode() {
                profileWrapper.classList.add('editing');
                editBtn.classList.add('d-none');
                saveBtn.classList.remove('d-none');
                cancelBtn.classList.remove('d-none');
                editableInputs.forEach(i => i.removeAttribute('readonly'));
            }

            function exitEditMode(resetPreview = false) {
                profileWrapper.classList.remove('editing');
                editBtn.classList.remove('d-none');
                saveBtn.classList.add('d-none');
                cancelBtn.classList.add('d-none');
                editableInputs.forEach(i => i.setAttribute('readonly', 'readonly'));
                if (resetPreview) {
                    // reload page to get saved image, atau jika perlu kembalikan src lama
                    location.reload();
                }
            }

            editBtn.addEventListener('click', function() {
                enterEditMode();
                if (editableInputs.length) editableInputs[0].focus();
            });

            cancelBtn.addEventListener('click', function() {
                exitEditMode(true); // kembalikan preview ke versi server (reload)
            });

            photoInput.addEventListener('change', function(e) {
                const file = e.target.files && e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    profilePreview.src = ev.target.result;
                };
                reader.readAsDataURL(file);
            });
        })();
    </script>
@endsection
