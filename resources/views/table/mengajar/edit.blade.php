@extends('layout.main')
@section('title', "Tabel Mengajar")

@section('content')
    <div class="row">
        <div class="col">
            @error('nama_Mengajar')
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
                    <form action="/table/mengajar/update/{{ $mengajar->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Nama Guru</label>
                            <select class="form-select form-control select2" aria-label="Default select example" name="guru_id" required>
                                <option value="" selected disabled>Pilih Guru</option>
                                @foreach ($guru as $datas)
                                    @if ($mengajar->guru_id == $datas->id)
                                        <option value="{{ $datas->id }}" selected>{{ $datas->nama_guru }}</option>
                                    @else
                                        <option value="{{ $datas->id }}">{{ $datas->nama_guru }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Mapel</label>
                            <select class="form-select form-control select2" aria-label="Default select example" name="mapel_id" required>
                                <option value="" selected disabled>Pilih Mapel</option>
                                @foreach ($mapel as $datas)
                                    @if ($mengajar->mapel_id == $datas->id)
                                        <option value="{{ $datas->id }}" selected>{{ $datas->nama_mapel }}</option>
                                    @else
                                        <option value="{{ $datas->id }}">{{ $datas->nama_mapel }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Kelas</label>
                            <select class="form-select form-control select2" aria-label="Default select example" name="kelas_id" required>
                                <option value="" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $datas)
                                    @if ($mengajar->kelas_id == $datas->id)
                                        <option value="{{ $datas->id }}" selected>{{ $datas->nama_kelas }}</option>
                                    @else
                                        <option value="{{ $datas->id }}">{{ $datas->nama_kelas }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <a href="/table/mengajar/index" class="btn btn-secondary rounded me-1">Kembali</a>
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