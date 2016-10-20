@extends('layouts.master')

@section('page_title')
Export Tukin
@endsection

@section('css')

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
                <form action="{{url('export')}}" method="post">
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
                    <button class="btn btn-success btn-fill" type="submit">Export</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
@include('notification')
@endsection