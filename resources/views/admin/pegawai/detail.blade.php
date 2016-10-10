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
<?php
  $data = App\User::where('id','=',$id)->first();
?>
<div class="row">
    <div class="col-md-12">
      <form action="{{url('pegawai/edit-pegawai')}}" method="post">
        <div class="card">
          <div class="header">
              <h4 class="title"><strong>Data Pegawai</strong></h4>
          </div>
          <div class="content">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$data->id}}"/>
            <div class="form-group">
                <label>NIP</label>
                <input type="text" value="{{$data->nip}}" class="form-control border-input" name="nip" placeholder="Nomor Induk Pegawai" required="">
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="{{$data->name}}" class="form-control border-input" name="name" placeholder="Nama" required="">
            </div>
            <div class="form-group">
                <label>Unit Kerja</label>
                <select name="unit_id" id="unit_id" class="form-control border-input" required="" >
                    <option></option>
                    @foreach(App\Unit::get() as $datas)
                      @if($datas->id == $data->unit_id)
                        <option selected="" value="{{$datas->id}}">{{$datas->nama_unit}}</option>
                      @else
                        <option value="{{$datas->id}}">{{$datas->nama_unit}}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-control border-input" required="" >
                   <option></option>
                   @foreach(App\Jabatan::get() as $datass)
                      @if($datass->id == $data->jabatan_id)
                        <option selected="" value="{{$datass->id}}">{{$datass->nama_jabatan}}</option>
                      @else
                        <option value="{{$datass->id}}">{{$datass->nama_jabatan}}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Atasan</label>
                <select name="atasan_id" id="atasan_id" class="form-control border-input">
                   <option></option>
                   @foreach(App\User::where('nip','!=','admin')->get() as $dataAtasan)
                      @if($dataAtasan->id == $data->atasan_id)
                        <option selected="" value="{{$dataAtasan->id}}">{{$dataAtasan->name}}</option>
                      @else
                        <option value="{{$dataAtasan->id}}">{{$dataAtasan->name}}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status Kepegawaian</label>
                <select name="status_pegawai" id="status_pegawai" class="form-control border-input" required="" >
                   <option></option>
                   @foreach(App\StatusPegawai::get() as $datasss)
                      @if($datasss->id == $data->status_pegawai)
                        <option selected="" value="{{$datasss->id}}">{{$datasss->nama}}</option>
                      @else
                        <option value="{{$datasss->id}}">{{$datasss->nama}}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>NPWP</label>
                <input type="text" value="{{$data->npwp}}" class="form-control border-input" name="npwp" placeholder="NPWP" required="">
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
              <input type="text" value="{{$data->nm_bank}}" class="form-control border-input" name="nm_bank" placeholder="Nama Bank" required="">
          </div>
          <div class="form-group">
              <label>Nama Rekening</label>
              <input type="text" class="form-control border-input" value="{{$data->nmrek}}" name="nmrek" placeholder="Nama Rekening" required="">
          </div>
          <div class="form-group">
              <label>No Rekening</label>
              <input type="text" class="form-control border-input" value="{{$data->rekening}}" name="rekening" placeholder="No Rekening" required="">
          </div>
        </div>
      </div>
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Hukuman Disiplin</strong></h4>
        </div>
        <div class="content">
          <table class ="table table-responsive table-full-width" id="hukuman-table">
            <thead>
              <tr>
                  <th style="text-align: center;">Status Hukuman</th>
                  <th style="text-align: center;">Jenis Hukuman</th>
                  <th style="text-align: center;">Dimulai Pada</th>
                  <th style="text-align: center;">Berakhir Pada</th>
              </tr>
            </thead>
            <tbody>
              @foreach(App\HukumanPegawai::where('user_id','=',$id)->get() as $dataHukumanPegawai)
                <?php
                  $dataHukuman = App\HukumanDisiplin::where('id','=',$dataHukumanPegawai->hukuman_id)->first();
                ?>
                <tr>
                  <td style="text-align: center;">{{$dataHukuman->status_hukuman}}</td>
                  <td style="text-align: center;">{{$dataHukuman->jenis_hukuman}}</td>
                  <td style="text-align: center;">{{date("d F Y", strtotime($dataHukumanPegawai->dimulai))}}</td>
                  <td style="text-align: center;">
                  @if($dataHukumanPegawai->berakhir == "1970-01-01 00:00:00")
                  Permanen
                  @else
                  {{date("d F Y", strtotime($dataHukumanPegawai->berakhir))}}
                  @endif</td>
                </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
      </div>
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Data Tunjangan</strong></h4>
        </div>
        <div class="content">
          <div class="form-group">
              <label>Gaji Pokok</label>
              <input type="number" value="{{$data->gjpokok}}" class="form-control border-input" name="gjpokok" placeholder="Gaji Pokok" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Istri</label>
              <input type="number" value="{{$data->tjistri}}" class="form-control border-input" name="tjistri" placeholder="Tunjangan Istri" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Anak</label>
              <input type="number" value="{{$data->tjanak}}" class="form-control border-input" name="tjanak" placeholder="Tunjangan Anak" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Umum PNS</label>
              <input type="number" value="{{$data->tjupns}}" class="form-control border-input" name="tjupns" placeholder="Tunjangan Umum PNS" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Struktural</label>
              <input type="number" value="{{$data->tjstruk}}" class="form-control border-input" name="tjstruk" placeholder="Tunjangan Struktural" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Fungsional</label>
              <input type="number" value="{{$data->tjfungs}}" class="form-control border-input" name="tjfungs" placeholder="Tunjangan Fungsional" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Daerah</label>
              <input type="number" value="{{$data->tjdaerah}}" class="form-control border-input" name="tjdaerah" placeholder="Tunjangan Daerah" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Daerah Terpencil</label>
              <input type="number" value="{{$data->tjpencil}}" class="form-control border-input" name="tjpencil" placeholder="Tunjangan Daerah Terpencil<" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Lainnya</label>
              <input type="number" value="{{$data->tjlain}}" class="form-control border-input" name="tjlain" placeholder="Tunjangan Lainnya" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Kompensasi</label>
              <input type="number" value="{{$data->tjkompen}}" class="form-control border-input" name="tjkompen" placeholder="Tunjangan Kompensasi" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Pembulatan</label>
              <input type="number" value="{{$data->pembul}}" class="form-control border-input" name="pembul" placeholder="Tunjangan Pembulatan" required="">
          </div>
          <div class="form-group">
              <label>Tunjangan Beras</label>
              <input type="number" value="{{$data->tjberas}}" class="form-control border-input" name="tjberas" placeholder="Tunjangan Beras" required="">
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