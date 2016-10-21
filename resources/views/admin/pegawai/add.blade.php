@extends('layouts.master')

@section('page_title')
Detail Pegawai
@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
<script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

@endsection
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
  }
</style>
@section('content')
<div class="row">
    <div class="col-md-12">
      <form action="{{url('pegawai/simpan-pegawai')}}" method="post">
        <div class="card">
          <div class="header">
              <h4 class="title"><strong>Data Pegawai</strong></h4>
          </div>
          <div class="content">
            {{csrf_field()}}
            <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control border-input" name="nip" placeholder="Nomor Induk Pegawai" required="">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control border-input" name="name" placeholder="Nama" required="">
            </div>
            <div class="form-group">
                <label>Unit Kerja</label>
                <select name="unit_id" id="unit_id" class="form-control border-input" required="" >
                    <option></option>
                    @foreach(App\Unit::get() as $datas)
                        <option value="{{$datas->id}}">{{$datas->nama_unit}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-control border-input" required="" >
                   <option></option>
                </select>
            </div>
            <div class="form-group">
                <label>Atasan</label>
                <select name="atasan_id" id="atasan_id" class="form-control border-input" >
                   <option></option>
                   @foreach(App\User::where('nip','!=','admin')->get() as $dataAtasan)
                      <option value="{{$dataAtasan->id}}">{{$dataAtasan->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status Kepegawaian</label>
                <select name="status_pegawai" id="status_pegawai" class="form-control border-input" required="" >
                   <option></option>
                   @foreach(App\StatusPegawai::get() as $datasss)
                      <option value="{{$datasss->id}}">{{$datasss->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>NPWP</label>
                <input type="text" class="form-control border-input" name="npwp" placeholder="NPWP" required="">
            </div>
            <div class="form-group">
                <label>Golongan</label>
                <input type="text" class="form-control border-input" name="golongan" placeholder="Golongan" required="">
            </div>
            <div class="form-group">
                <label>Kelas Jabatan</label>
                <select name="kelas_jabatan" id="kelas_jabatan" class="form-control border-input" required="" >
                   <option></option>
                   @foreach(App\Grade::get() as $dataJabatan)
                        <option value="{{$dataJabatan->grade}}">{{$dataJabatan->grade}}</option>
                   @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status Kawin</label>
                <select name="kelas_jabatan" id="kelas_jabatan" class="form-control border-input" required="" >
                   <option></option>
                   @foreach(App\Grade::get() as $dataJabatan)
                        <option value="{{$dataJabatan->grade}}">{{$dataJabatan->grade}}</option>
                   @endforeach
                </select>
            </div>
          </div>
      </div>
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Data bank</strong></h4>
        </div>
        <div class="content">
          <div class="form-group">
              <label>Nama Bank</label>
              <input type="text" class="form-control border-input" name="nm_bank" placeholder="Nama Bank" required="">
          </div>
          <div class="form-group">
              <label>Nama Rekening</label>
              <input type="text" class="form-control border-input" name="nmrek" placeholder="Nama Rekening" required="">
          </div>
          <div class="form-group">
              <label>No Rekening</label>
              <input type="text" class="form-control border-input" name="rekening" placeholder="No Rekening" required="">
          </div>
        </div>
      </div>
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Data Tunjangan</strong></h4>
        </div>
        <div class="content">
          <div class="form-group">
              <label>Gaji Pokok</label>
              <input type="number" class="form-control border-input" name="gjpokok" placeholder="Gaji Pokok" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Istri</label>
              <input type="number" class="form-control border-input" name="tjistri" placeholder="Tunjangan Istri" >
          </div>
          <div class="form-group">
              <label>Tunjangan Anak</label>
              <input type="number" class="form-control border-input" name="tjanak" placeholder="Tunjangan Anak" >
          </div>
          <div class="form-group">
              <label>Tunjangan Umum PNS</label>
              <input type="number" class="form-control border-input" name="tjupns" placeholder="Tunjangan Umum PNS" >
          </div>
          <div class="form-group">
              <label>Tunjangan Struktural</label>
              <input type="number" class="form-control border-input" name="tjstruk" placeholder="Tunjangan Struktural" >
          </div>
          <div class="form-group">
              <label>Tunjangan Fungsional</label>
              <input type="number" class="form-control border-input" name="tjfungs" placeholder="Tunjangan Fungsional" >
          </div>
          <div class="form-group">
              <label>Tunjangan Daerah</label>
              <input type="number" class="form-control border-input" name="tjdaerah" placeholder="Tunjangan Daerah" >
          </div>
          <div class="form-group">
              <label>Tunjangan Daerah Terpencil</label>
              <input type="number" class="form-control border-input" name="tjpencil" placeholder="Tunjangan Daerah Terpencil<" >
          </div>
          <div class="form-group">
              <label>Tunjangan Lainnya</label>
              <input type="number" class="form-control border-input" name="tjlain" placeholder="Tunjangan Lainnya" >
          </div>
          <div class="form-group">
              <label>Tunjangan Kompensasi</label>
              <input type="number" class="form-control border-input" name="tjkompen" placeholder="Tunjangan Kompensasi" >
          </div>
          <div class="form-group">
              <label>Tunjangan Pembulatan</label>
              <input type="number" class="form-control border-input" name="pembul" placeholder="Tunjangan Pembulatan" >
          </div>
          <div class="form-group">
              <label>Tunjangan Beras</label>
              <input type="number" class="form-control border-input" name="tjberas" placeholder="Tunjangan Beras" >
          </div>
          <span style="text-align: center;">
          <button type="submit" width="300px" class="btn btn-success btn-fill">Simpan</button>
          </span>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">
var urlRoot = '{{url('/')}}';
  $(document).ready(function(){
    $('#hukuman-table').DataTable({
      "language": {
        "emptyTable": "Pegawai ini tidak mempunyai riwayat hukuman disiplin"
      }
    });

    $("#unit_id").change(function () {
      //load for jabatan
      var values = "unit_id=" + $('select[name=unit_id]').val() + "&_token={{csrf_token()}}";
      $.ajax({
        url: urlRoot + "/jabatanjson",
        type: "post",
        data: values ,
        success: function (response) {
          $('#jabatan_id').html('');
          var html = "";
            for(i = 0; i < response.Jabatan.length; i++){
              html += "<option value='" + response.Jabatan[i].id + "'>" + response.Jabatan[i].nama_jabatan + "</option>";
            }
            $('#jabatan_id').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });

      //load for atasan
      $.ajax({
        url: urlRoot + "/pegawaijson",
        type: "post",
        data: values ,
        success: function (response) {
          $('#atasan_id').html('');
          var html = "";
            for(i = 0; i < response.User.length; i++){
              html += "<option value='" + response.User[i].id + "'>" + response.User[i].name + "</option>";
            }
            $('#atasan_id').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
    });
  });
</script>
@endsection