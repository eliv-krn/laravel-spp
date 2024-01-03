@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Kelas</li>
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
                <h3 class="card-title">Data Kelas</h3>
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
                      <th>Nama Kelas</th>
                      <th>Kompetensi Keahlian</th>
                      <th style="width: 130px">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @forelse ($kelas as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nama_kelas }}</td>
                      <td>{{ $data->kompetensi_keahlian }}</td>
                      <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kelas.destroy', $data->id_kelas) }}" method="POST">
                          <!--
                          <a href="{{ route('kelas.show', $data->id_kelas) }}" class="btn btn-sm btn-dark">SHOW</a>
                          -->
                          <a href="{{ route('kelas.edit', $data->id_kelas) }}" class="btn btn-sm btn-primary">Edit</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                      </td>
                    </tr>
                  </tbody>
                  @empty
                  Belum ada data kelas
                  @endforelse
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $kelas->links() }}
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