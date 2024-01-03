@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Data Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Data Pembayaran</li>
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
              <div id="dokumen">
                <div class="card-header">
                  <h3 class="card-title">Laporan Data Pembayaran</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                        <th>Petugas</th>
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
                        <td>{{ $data->nama_petugas }}</td>
                      </tr>
                    </tbody>
                    @empty
                    Belum ada data siswa
                    @endforelse
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="#" class="btn btn-sm btn-primary print">Cetak</a>
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

  @push('js')
  <script src="{{ asset('plugins/print/jQuery.print.min.js') }}"></script>
  <script type="text/javascript">
    $(document).on('click', ".print", function() { 
      $.print("#dokumen"); 
    });
  </script>
  @endpush