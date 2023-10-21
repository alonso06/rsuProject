<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('procedure_type_id', 'Tipo de procedimiento') !!}
        
            {!! Form::select('procedure_type_id', $procedureTypes, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('tree_id', 'Árbol') !!}
        
            {!! Form::select('tree_id', $trees, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date', 'Fecha de procedimiento') !!}
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('responsible_id', 'Responsable') !!}
        
            {!! Form::select('responsible_id', $responsibles, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>
<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>3]) !!}
</div>
