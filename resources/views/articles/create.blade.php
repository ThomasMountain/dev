@extends('app')

@section('content')
    <h1>New</h1>

    <hr/>

    {!! Form::open(['url' => 'articles']) !!}

    @include('articles.partials.form', ['submitButtonText' => 'Add Article'])


    {!! Form::close() !!}

    @include('errors.list')

@stop