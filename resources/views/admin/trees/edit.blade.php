{!! Form::model($tree, ['route' => ['admin.trees.update', $tree], 'method' => 'put','id' => 'miFormulario']) !!}
@include('admin.trees.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Actualizar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}

