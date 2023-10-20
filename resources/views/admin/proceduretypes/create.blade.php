{!! Form::open(['route' => 'admin.proceduretypes.store']) !!}
@include('admin.proceduretypes.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Registrar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}
