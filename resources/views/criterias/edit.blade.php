@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/css/criteria.css">
@endsection

@section('content')
<section class="content-header">
  <h1>
    Criteria
  </h1>
</section>
<div class="content">
  @include('adminlte-templates::common.errors')
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        {!! Form::model($criteria, ['route' => ['criterias.update', $criteria->id], 'method' => 'patch']) !!}

        @include('criterias.fields')

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
