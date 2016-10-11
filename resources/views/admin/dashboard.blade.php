@extends('layouts.master')

@section('page_title')
Dashboard
@endsection

@section('css')

@endsection

@section('content')

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-warning text-center">
                            <i class="ti-user"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Pegawai</p>
                            {{$pegawai-1}}
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        {{-- <i class="ti-reload"></i> Updated now --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="fa fa-sitemap"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Unit/Deputi</p>
                            {{$unit}}
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        {{-- <i class="ti-calendar"></i> Last day --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-danger text-center">
                            <i class="fa fa-shield"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Jenis Jabatan</p>
                            {{$jabatan}}
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        {{-- <i class="ti-timer"></i> In the last hour --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-info text-center">
                            <i class="fa fa-sort-amount-asc"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Kelas Jabatan</p>
                            {{$grade}}
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        {{-- <i class="ti-reload"></i> Updated now --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                Statistik Pencapaian
            </div>
            <div class="content">
                <div id="my-chart"></div>
            </div>
        </div>
    </div>
</div>
<div id="modalPegawai" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="simpan-pegawai" method="post">
          {{csrf_field()}}
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Pegawai</h4>
          </div>
          <div class="modal-body">
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
                    <option ></option>
                    @foreach(App\Unit::get() as $data)
                    <option value="{{$data->id}}">{{$data->nama_unit}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select name="jabatan_id" id="jabatan_id" class="form-control border-input" required="" >
                <span id="dataJabatan"></span>
            </select>
        </div>
        <div class="form-group">
          <label>Gaji Pokok</label>
          <input type="number" class="form-control border-input" name="gaji_pokok" placeholder="Gaji Pokok" required="">
      </div>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-default">Simpan</button>
  </div>
</form>
</div>

</div>
</div>
<div id="modalEditPegawai" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="edit-pegawai" method="post">
          <input type="hidden" name="id" id="id" required="" />
          {{csrf_field()}}
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Data Pegawai</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label>NIP</label>
                  <input type="text" id="nip" class="form-control border-input" name="nip" placeholder="Nomor Induk Pegawai" required="">
              </div>
              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" id="name" class="form-control border-input" name="name" placeholder="Nama" required="">
              </div>
              <div class="form-group">
                  <label>Unit Kerja</label>
                  <select name="unit_id" id="unit_id" class="form-control border-input" required="" >
                    <option value=""></option>
                    @foreach(App\Unit::get() as $data)
                    <option value="{{$data->id}}">{{$data->nama_unit}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select name="jabatan_id" id="jabatan_id_edit" class="form-control border-input" required="" >
                <span id="dataJabatan"></span>
            </select>
        </div>
        <div class="form-group">
          <label>Gaji Pokok</label>
          <input type="number" id="gaji_pokok" class="form-control border-input" name="gaji_pokok" placeholder="Gaji Pokok" required="">
      </div>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-default">Simpan</button>
  </div>
</form>
</div>

</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
var dataSales = {
        //BULAN DAN TAHUN
          labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
          series: [
          //TARGET
             [287, 385, 490, 562, 594, 626, 698, 895, 952]
          ]
        };

        var optionsSales = {
          lineSmooth: false,
          low: 0,
          high: 1000,
          showArea: true,
          height: "245px",
          axisX: {
            showGrid: false,
          },
          lineSmooth: Chartist.Interpolation.simple({
            divisor: 3
          }),
          showLine: true,
          showPoint: false,
        };

        var responsiveSales = [
          ['screen and (max-width: 640px)', {
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Line('#my-chart', dataSales, optionsSales, responsiveSales);
</script>
@endsection