@extends('layouts.master')

@section('page_title')
Export Tukin
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">


  .badge-warning {
    background: #FF9800;
}
.badge-info {
    background: #2196F3;
}
.badge-success {
    background: #4CAF50;
}
.badge-danger {
    background: #f44336;
}
</style>
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
}
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="header">
                <h4 class="title">Export Tukin</h4>
            </div>
            <div class="content">
                <form action="{{url('export')}}" method="post" id="exportForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <select required="" name="unit_id" id="unit_id" class="form-control border-input">
                            <option></option>
                            @foreach(App\Unit::get() as $dataUnit)
                            <option value="{{$dataUnit->id}}">{{$dataUnit->nama_unit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Report</label>
                        <select required="" name="type" id="type" class="form-control border-input">
                            <option></option>
                            <option value="1">Realisasi Per Jabatan</option>
                            <option value="2">Realisasi</option>
                            <option value="3">Rekap & Total</option>
                            <option value="4">Tanda Terima</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bulan</label>
                        <select required="" name="bulan" id="bulan" class="form-control border-input">
                            <option></option>
                            <?php
                            $i = 1;
                            $month = strtotime('2011-01-01');
                            while($i <= 12)
                            {
                                $month_name = date('F', $month);
                                echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                                $month = strtotime('+1 month', $month);
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tahun</label>
                        <select required="" name="tahun" id="tahun" class="form-control border-input">
                            <option></option>
                            <?php
                            $i = 1;
                            $month = strtotime('2016-01-01');
                            while($i <= 12)
                            {
                                $month_name = date('Y', $month);
                                echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                                $month = strtotime('+12 month', $month);
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-success btn-fill" onclick="showModal();">Export</a>
                    </div>
                    <input type="hidden" name="pejabat_pembuat_komitmen" id="val_pejabat_pembuat_komitmen"/>
                    <input type="hidden" name="bendahara" id="val_bendahara"/>
                    <input type="hidden" name="belanja_pegawai" id="val_belanja_pegawai"/>
                </form>
            </div>

        </div>
    </div>
</div>
<div id="exportModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set Tanda Tangan</h4>
    </div>
    <div class="modal-body">
        <div class="content">
            <div class="form-group" id="pejabat_pembuat_komitmen">
                <label>Pejabat Pembuat Komitmen</label>
                <div class="col-md-12">
                    <select required="" name="data_pejabat_pembuat_komitmen" id="data_pejabat_pembuat_komitmen" class="form-control border-input" style="width: 100%;">
                        @foreach(App\User::get() as $dataPegawaiC)
                        <option value="{{$dataPegawaiC->id}}">{{$dataPegawaiC->name}} - {{$dataPegawaiC->nip}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="bendahara">
                <label>Bendahara</label>
                <div class="col-md-12">
                    <select required="" name="data_bendahara" id="data_bendahara" class="form-control border-input" style="width: 100%;">
                        @foreach(App\User::get() as $dataPegawaiB)
                        <option value="{{$dataPegawaiB->id}}">{{$dataPegawaiB->name}} - {{$dataPegawaiB->nip}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="belanja_pegawai">
                <label>Belanja Pegawai</label>
                <div class="col-md-12">
                    <select required="" name="data_belanja_pegawai" id="data_belanja_pegawai" class="form-control border-input" style="width: 100%;">
                        @foreach(App\User::get() as $dataPegawaiA)
                        <option value="{{$dataPegawaiA->id}}">{{$dataPegawaiA->name}} - {{$dataPegawaiA->nip}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="btn btn-default" onclick="exportNow();">Export</a>
    </div>
</div>

</div>
</div>
@endsection

@section('js')
@include('notification')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    function showModal(){

        if($('#type').val() == "1"){
         $('#exportModal').modal('show');
         $('#pejabat_pembuat_komitmen').show();
         $('#bendahara').show();
         $('#belanja_pegawai').hide();
     }else if($('#type').val() == "2"){
         $('#exportModal').modal('show');
         $('#pejabat_pembuat_komitmen').show();
         $('#bendahara').hide();
         $('#belanja_pegawai').show();
     }else if($('#type').val() == "3"){
         $('#exportModal').modal('show');
         $('#pejabat_pembuat_komitmen').show();
         $('#bendahara').show();
         $('#belanja_pegawai').show();
     }else{
         $('form#exportForm').submit();
     }
 }

     function exportNow(){
        $('#val_pejabat_pembuat_komitmen').val($('#data_pejabat_pembuat_komitmen').val());
        $('#val_bendahara').val($('#data_bendahara').val());
        $('#val_belanja_pegawai').val($('#data_belanja_pegawai').val());
        $('#exportModal').modal('hide');
        $('form#exportForm').submit();
    }
    $(document).ready(function(){
        $("#data_pejabat_pembuat_komitmen").select2();
        $("#data_bendahara").select2();
        $("#data_belanja_pegawai").select2();
    });
</script>
@endsection