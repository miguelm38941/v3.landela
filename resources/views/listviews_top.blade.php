@extends('base')

@section('listview_common')
    <h3 class="display-4 feature-title">@yield('list_title')</h3>  

    <div class="row" style="margin-top: 20px;">
        @yield('top_table_menu')

        <div class="col-sm-4 mb-2"></div>
        <div class="col-sm-4 mb-2">
        <div class="" style="width: auto; float:right">
            <input class="form-control w-auto d-sm-inline-block" type="text" name="search" placeholder="Recherche">
            <button @yield('search_btn_id') class="btn btn-primary d-sm-inline-block" type="button">Go</button>            
        </div>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif

@endsection


@section('main')
<div class="row">
<div class="col-sm-12">
  
    @yield('listview_common')

    @yield('list_table')
  
<div>
</div>
@endsection