{!! Form::model($procedure, ['route' => ['admin.procedures.update', $procedure], 'method' => 'put']) !!}
@include('admin.procedures.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}