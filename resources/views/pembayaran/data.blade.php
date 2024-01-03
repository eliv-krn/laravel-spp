@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pembayaran</li>
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
                <h3 class="card-title">Data Pembayaran</h3>
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
                      <th>Nama Siswa</th>
                      <th>Tanggal Bayar</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Jumlah Bayar</th>
                      <th style="width: 120px">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @forelse ($pembayaran as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nisn }}</td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->tanggal_bayar }}</td>
                      <td>{{ $data->bulan_dibayar }}</td>
                      <td>{{ $data->tahun_dibayar }}</td>
                      <td>{{ number_format($data->jumlah_bayar) }}</td>
                      <td class="text-center text-nowrap">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pembayaran.destroy', $data->id_pembayaran) }}" method="POST">
                          {{-- <a href="{{ route('pembayaran.show', $data->id_pembayaran) }}" class="btn btn-sm btn-dark">Detail</a> --}}
                          <a href="{{ route('pembayaran.edit', $data->id_pembayaran) }}" class="btn btn-sm btn-primary">Edit</a>
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
                <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  {{ $pembayaran->links() }}
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