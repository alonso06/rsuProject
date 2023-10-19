@extends('adminlte::page')

@section('title', 'Mostrar Zona')

@section('content_header')

@stop
@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <h4>Vista de Zona</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{ $zone->name }}
            </div>
            <div class="form-group">
                {!! Form::label('area', 'Area') !!}
                {{ $zone->are }}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Descripción') !!}
                {{ $zone->description }}
            </div>
        </div>
    </div>
   
@stop
