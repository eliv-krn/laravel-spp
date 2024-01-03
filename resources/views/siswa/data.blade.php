@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Siswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(session()->has('success'))
                  <div class="alert alert-info alert-dismissible">
                    <h5><i class="icon fas fa-info"></i> Informasi</h5>
                    {{ session()->get('success') }}
                  </div>
                @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>NISN</th>
                      <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>SPP</th>
                      <th style="width: 180px">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @forelse ($siswa as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nisn }}</td>
                      <td>{{ $data->nis }}</td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->nama_kelas }}</td>
                      <td>{{ $data->alamat }}</td>
                      <td>{{ $data->no_telp }}</td>
                      <td>{{ $data->tahun . ' (' . number_format($data->nominal) . ')' }}</td>
                      <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('siswa.destroy', $data->nisn) }}" method="POST">
                          <a href="{{ route('siswa.show', $data->nisn) }}" class="btn btn-sm btn-dark">Detail</a>
                          <a href="{{ route('siswa.edit', $data->nisn) }}" class="btn btn-sm btn-primary">Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                      </td>
                    </tr>
                  </tbody>
                  @empty
                  Belum ada data siswa
                  @endforelse
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $siswa->links() }}
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->  
  @endsection