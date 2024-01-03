@extends('layouts.template')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Siswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Data Siswa</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="number" name="nisn" class="form-control" disabled id="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" class="form-control" disabled value="{{ old('nis', $siswa->nis) }}">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" name="nama" class="form-control" disabled value="{{ old('nama', $siswa->nama) }}">
                </div>
                <div class="form-group">
                  <label for="id_kelas">Kelas</label>
                  <input type="text" name="id_kelas" class="form-control" disabled value="{{ old('nama_kelas', $siswa->nama_kelas) }}">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" class="form-control" disabled value="{{ old('alamat', $siswa->alamat) }}">
                </div>
                <div class="form-group">
                  <label for="no_telp">No. Telepon</label>
                  <input type="number" name="no_telp" class="form-control" disabled value="{{ old('no_telp', $siswa->no_telp) }}">
                </div>
                <div class="form-group">
                  <label for="id_spp">SPP</label>
                  <input type="number" name="id_spp" class="form-control" disabled value="{{ old('tahun', $siswa->tahun) }}">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="{{ route('siswa.index') }}" class="btn btn-danger">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  @endsection