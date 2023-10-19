<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre de árbol') !!}
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('zone_id', 'Zona') !!}
            {!! Form::select('zone_id', $zones, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('family_id', 'Familia') !!}

            {!! Form::select('family_id', $families, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('specie_id', 'Especie') !!}

            {!! Form::select('specie_id', $species, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('birth_date', 'Nacimiento') !!}
            {!! Form::date('birth_date', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('planting_date', 'Fecha de plantado') !!}
            {!! Form::date('planting_date', null, ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('latitude', 'Latitud') !!}
            {!! Form::text('latitude', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('longitude', 'Latitud') !!}
            {!! Form::text('longitude', null, [
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
