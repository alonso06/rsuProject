<div class="form-group">
    {!! Form::label('dni', 'DNI') !!}
    {!! Form::text('dni', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'NOMBRE') !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('lastname', 'APELLIDOS') !!}
    {!! Form::text('lastname', null, [
        'class' => 'form-control',
        'required',
    ]) !!}
</div>