{!! Form::model($proceduretype, ['route' => ['admin.proceduretypes.update', $proceduretype], 'method' => 'put']) !!}
@include('admin.proceduretypes.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}