@extends('layouts.master')

@section('page_title')
Edit Jabatan
@endsection

@section('css')
@endsection

@section('content')
<div class="row">
      <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                  <div class="card">
                        <div class="header">
                              <h4 class="title">Tambah Jabatan</h4>
                        </div>
                        <div class="content">
                              <form role="form" class="form-horizontal" method="post" action="">
                                    <div class="form-group">
                                          <div class="col-md-12">
                                                <label for="unit" class="contro-label">Unit/Deputi</label>
                                                <select name="unit" id="unit" class="form-control border-input">
                                                      @forelse($unit as $unit)
                                                            <option value="{{$unit->id}}" @if($unit->id == $jabatan->unit_id) selected @endif>{{$unit->nama_unit}}</option>
                                                      @empty
                                                      @endforelse
                                                </select>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-md-4">
                                                <label for="kelas_jabatan" class="contro-label">Kelas Jabatan</label>
                                                <select name="kelas_jabatan" id="kelas_jabatan" class="form-control border-input">
                                                      @forelse($grade as $kelas_jabatan)
                                                            <option value="{{$kelas_jabatan->id}}" @if($kelas_jabatan->id == $jabatan->kelas_jabatan) selected @endif>{{$kelas_jabatan->grade}}</option>
                                                      @empty
                                                      @endforelse
                                                </select>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="col-md-12">
                                                <label for="" class="control-label">Nama Jabatan</label>
                                                <input type="text" name="nama_jabatan" class="form-control border-input" id="nama_jabatan" value="{{$jabatan->nama_jabatan}}">
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                                          <input type="hidden" name="id" value="{{$jabatan->id}}">
                                          <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
                                          </div>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection