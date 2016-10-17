@extends('layouts.master')

@section('page_title')
Export
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
                <h4 class="title">Export</h4>
            </div>
            <div class="content">
                Pilih Export mode
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
@include('notification')
@endsection