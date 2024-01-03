@extends('layouts.template')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Data Siswa</h1>
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
              <h3 class="card-title">Form Edit Data Siswa</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="Masukkan NISN" value="{{ old('nisn', $siswa->nisn) }}">
                    @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="Masukkan NIS" value="{{ old('nis', $siswa->nis) }}">
                    @error('nis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="nama">Nama Siswa</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama siswa" value="{{ old('nama', $siswa->nama) }}">
                  @error('nama')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="id_kelas">Kelas</label>
                  <select name="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror" id="id_kelas">
                    <option value="">-- Pilih --</option>
                    @foreach ($kelas as $dt)
                        <option value="{{ old('id_kelas', $dt->id_kelas) }}" {{ ($siswa->id_kelas == $dt->id_kelas) ? ' selected' : '' }}>{{ $dt->nama_kelas }}</option>
                    @endforeach
                  </select>
                  @error('id_kelas')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat" value="{{ old('alamat', $siswa->alamat) }}">
                  @error('alamat')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="no_telp">No. Telepon</label>
                  <input type="number" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="Masukkan nomor telepon" value="{{ old('no_telp', $siswa->no_telp) }}">
                  @error('no_telp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="id_spp">SPP</label>
                  <select name="id_spp" class="form-control @error('id_spp') is-invalid @enderror" id="id_spp">
                    <option value="">-- Pilih --</option>
                    @foreach ($spp as $dt)
                        <option value="{{ old('id_spp', $dt->id_spp) }}" {{ ($siswa->id_spp == $dt->id_spp) ? ' selected' : '' }}>{{ $dt->tahun }}</option>
                    @endforeach
                  </select>
                  @error('id_spp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan password" value="">
                  @error('password')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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