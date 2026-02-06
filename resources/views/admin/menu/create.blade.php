@extends('layouts.admin')
@section('content')
    <h3 class="fw-bold mb-3">Tambah Menu Baru</h3>

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="8" class="form-control @error('deskripsi') is-invalid @enderror"
                placeholder="Tulis deskripsi menu di sini..."></textarea>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label>Kalori (kkal)</label>
            <input type="number" name="kalori" class="form-control" min="0" placeholder="Contoh: 250">
        </div>

        <div class="mb-3">
            <label>Waktu Memasak (menit)</label>
            <input type="number" name="waktu_memasak" class="form-control" min="0" placeholder="Contoh: 30">
        </div>

        <div class="mb-3">
            <label>Foto Menu</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    {{-- TinyMCE Rich Text Editor --}}
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#deskripsi',
            height: 300,
            menubar: false,
            plugins: 'lists link image preview code',
            toolbar: 'undo redo | bold italic underline | bullist numlist | link image | code preview',
            branding: false,
            placeholder: "Tulis deskripsi menu..."
        });
    </script>
@endsection
