
{!! Form::model($zone, ['route' => ['admin.zones.update', $zone], 'method' => 'put']) !!}
@include('admin.zones.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}