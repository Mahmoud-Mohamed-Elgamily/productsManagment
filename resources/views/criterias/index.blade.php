@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/criteria.css">
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Criterias</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('criterias.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('criterias.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

