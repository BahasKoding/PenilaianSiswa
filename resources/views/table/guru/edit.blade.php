@extends('layout.main')
@section('title', "Tabel Guru")

@section('content')
    <div class="row">
        <div class="col">
            @error('nip')
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
                    <form action="/table/guru/update/{{ $guru->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">NIP</label>
                            <input required name="nip" type="text" required class="form-control" id="floatingInput3" value="{{ $guru->nip }} ">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Nama Guru</label>
                            <input required name="nama_guru" type="text" required class="form-control" id="floatingInput3" value="{{ $guru->nama_guru }} ">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Jenis Kelamin</label>
                            <select class="form-select form-control select2" aria-label="Default select example" name="jk" required>
                                <option value="L" {{ $guru->jk == "L" ? 'selected' : ''  }}>Laki-laki</option>
                                <option value="P" {{ $guru->jk == "P" ? 'selected' : ''  }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="floatingInput3">Alamat</label>
                            <textarea name="alamat" class="form-control">{{ $guru->alamat }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="floatingInput3">Password</label>
                            <input required name="password" type="password" required class="form-control" id="floatingInput3" value="{{ $guru->password }} ">
                        </div>
                        <div class="input-group">
                            <a href="/table/guru/index" class="btn btn-secondary rounded me-1">Back?</a>
                            <button class="btn btn-success rounded" type="submit">Update</button>
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