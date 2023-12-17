@extends('layout.main')
@section('title', "Tabel Kelas")

@section('content')
    <div class="row">
        <div class="col">
            @error('nama_kelas')
                <div id="error-message" class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mt-2">@yield('title')</h3>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="card-body">
                    <form action="/table/kelas/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Nama Kelas</label>
                            <input required name="nama_kelas" type="text" required class="form-control" id="floatingInput3">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Jurusan</label>
                            <select class="form-select form-control select2" aria-label="Default select example" name="jurusan_id" required>
                                <option value="" selected disabled>Pilih Jurusan</option>
                                @foreach ($jurusan as $datas)
                                    <option value="{{ $datas->id }}">{{ $datas->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <a href="/table/kelas/index" class="btn btn-secondary rounded me-1">Kembali</a>
                            <button class="btn btn-success rounded" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
<script>
    // Membuat pesan error menghilang setelah 3-5 detik
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 3000); // Ubah angka ini menjadi 5000 jika Anda ingin 5 detik
</script>
@endsection