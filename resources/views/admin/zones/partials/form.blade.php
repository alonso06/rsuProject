<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('are', 'Zona') !!}
            {!! Form::text('are', null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
