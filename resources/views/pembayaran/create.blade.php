@extends('layouts.template')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Data Pembayaran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
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
              <h3 class="card-title">Form Tambah Data Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('pembayaran.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="petugas">Petugas</label>
                  <input type="text" name="petugas" class="form-control" id="petugas" value="{{ session('user')->nama_petugas }}" readonly>
                </div>
                <input type="hidden" name="id_petugas" class="form-control" id="id_petugas" value="{{ session('user')->id_petugas }}">

                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                    @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="alert alert-info alert-dismissible identitas mt-1">
                    </div>
                </div>

                <div class="form-group">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" placeholder="Masukkan Tanggal Bayar" value="{{ date('Y-m-d') }}">
                    @error('tanggal_bayar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="bulan_dibayar">Bulan Dibayar</label>
                  <select name="bulan_dibayar" class="form-control @error('bulan_dibayar') is-invalid @enderror" id="bulan_dibayar">
                    <option value="">-- Pilih --</option>
                    @foreach ($bulan as $bln)
                        <option value="{{ old('bulan_dibayar', $bln) }}">{{ $bln }}</option>
                    @endforeach
                  </select>
                  @error('bulan_dibayar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="tahun_dibayar">Tahun Dibayar</label>
                  <select name="tahun_dibayar" class="form-control @error('tahun_dibayar') is-invalid @enderror" id="tahun_dibayar">
                    <option value="">-- Pilih --</option>
                    @foreach ($tahun as $th)
                        <option value="{{ old('tahun_dibayar', $th) }}">{{ $th }}</option>
                    @endforeach
                  </select>
                  @error('tahun_dibayar')
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
                        <option value="{{ old('id_spp', $dt->id_spp) }}">{{ $dt->tahun }}</option>
                    @endforeach
                  </select>
                  @error('id_spp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="jumlah_bayar">Jumlah Bayar</label>
                  <input type="number" name="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah_bayar" placeholder="Masukkan jumlah bayar" value="{{ old('jumlah_bayar') }}">
                  @error('jumlah_bayar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-danger">Kembali</a>
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

  @push('js')
  <script type="text/javascript">
    $(document).on('blur', '#nisn', function(e){
      e.preventDefault();
      let nisn = $('#nisn').val();
      $.ajax({
          type: 'GET',
          data: {
            nisn: nisn
          },
          url: "{{ url('getSiswa') }}",
          success: function(data) {
            if(data.nisn === undefined) {
              $(".identitas").html('Data tidak ditemukan!');
            }
            else {
              $(".identitas").html('NISN: '+ data.nisn + '<br>');
              $(".identitas").append('Nama: '+ data.nama + '<br>');
              $(".identitas").append('Kelas: '+ data.nama_kelas + '<br>');
              $(".identitas").append('Kompetensi Keahlian: '+ data.kompetensi_keahlian + '<br>');
            }
          }
      });
	});

  $(document).on('change', '#id_spp', function(e){
      e.preventDefault();
      let id_spp = $('#id_spp').val();
      console.log(id_spp);
      $.ajax({
          type: 'GET',
          data: {
            id_spp: id_spp
          },
          url: "{{ url('getSpp') }}",
          success: function(data) {
            $("#jumlah_bayar").val(data.nominal);
          }
      });
    });
  </script>
  @endpush