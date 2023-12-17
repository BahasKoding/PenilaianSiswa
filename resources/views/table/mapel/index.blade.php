@extends('layout.main')
@section('title', "Tabel Mapel")

@section('content')
	<div class="row">
    <div class="col">
      @if(session('success'))
      <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
      @if(session('error'))
      <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
      </div>
      @endif
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
          <div>
            <a href="/table/mapel/create">
              <button type="button" class="btn btn-default">Tambah Data</button>
            </a>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mapel as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_mapel }}</td>
                    <td>
                        {{-- Edit --}}
                        <a href="/table/mapel/edit/{{ $data->id }}"  class="btn btn-outline-info btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                        </a>

                        {{-- Delete --}}
                        <form action="/table/mapel/destroy/{{ $data->id }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                          </button>
                      </form>
                      
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function () {
      $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      // $('#example2').DataTable({
      //   "paging": true,
      //   "lengthChange": false,
      //   "searching": false,
      //   "ordering": true,
      //   "info": true,
      //   "autoWidth": false,
      //   "responsive": true,
      // });
    });

    // Menggunakan JavaScript untuk mengatur delay dan menghilangkan alert
    setTimeout(function() {
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.style.display = 'none'; // Menghilangkan alert
        }
    }, 3000); // Delay selama 3 detik (3000 milidetik)

    document.addEventListener('DOMContentLoaded', function () {
        const errorAlert = document.getElementById('errorAlert');

        setTimeout(function () {
          var errorAlert = document.getElementById('errorAlert');
          if (errorAlert) {
            errorAlert.style.display = 'none'; // Menghilangkan alert
          }
        }, 3000);
    });

  </script>
@endsection  

