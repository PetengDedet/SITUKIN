@extends('layouts.master')

@section('page_title')
Setting
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
                <h4 class="title">Edit Password</h4>
            </div>
            <div class="content">
                <form role="form" class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="" class="control-label">Pasword</label>
                            <input type="password" name="password" class="form-control border-input" id="password" value="" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="" class="control-label">Pasword Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control border-input" id="password_confirmation" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
                        </div>
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