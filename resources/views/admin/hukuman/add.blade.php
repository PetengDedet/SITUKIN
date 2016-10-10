@extends('layouts.master')

@section('page_title')
Tambah Hukuman Disiplin
@endsection

@section('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endsection
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
  }
</style>
@section('content')

<div class="row">
  <div class="col-md-12">
    <form action="{{url('hukuman-pegawai/simpan')}}" method="post">
      {{csrf_field()}}
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Data Hukuman Displin</strong></h4>
        </div>
        <div class="content">
          <div class="form-group">
              <label>Pegawai</label>
              <select required="" name="user_id" id="user_id" class="form-control border-input">
                <option></option>
                @foreach(App\User::get() as $dataPegawai)
                <option value="{{$dataPegawai->id}}">{{$dataPegawai->name}} - {{$dataPegawai->nip}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Hukuman</label>
              <select required="" name="hukuman_id" id="hukuman_id" class="form-control border-input">
                <option></option>
                @foreach(App\HukumanDisiplin::get() as $dataHukuman)
                <option value="{{$dataHukuman->id}}">{{$dataHukuman->status_hukuman}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
          <button class="btn btn-success btn-fill" type="submit">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
var urlRoot = '{{url('/')}}';
  $(document).ready(function(){
    $("#user_id").select2();
    $("#hukuman_id").select2();
  });
</script>
@endsection