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
            <button type="button" class="btn btn-success float-right" id="btnRegistrar">
                <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Registrar procedimiento zonal
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">

            
            <h4>Árboles pertenecientes a zona: {{ $zone->name }}</h4>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped " id="listados_arboles_zonas">
                    <thead>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>ESPECIE</th>
                        <th>F. NACIMIENTO</th>
                        <th>F. PLANTADO</th>
                        <th>DESCRIPCION</th>
                    </thead>
                    <tbody>
                        @foreach ($treeByZone as $tree)
                            <tr>
                                <td>{{ $tree->id }}</td>
                                <td>{{ $tree->name }}</td>
                                <td>{{ $tree->specie_name }}</td>
                                <td>{{ $tree->birth_date }}</td>
                                <td>{{ $tree->planting_date }}</td>
                                <td>{{ $tree->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de procedimientos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <!--<div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>-->
            </div>
        </div>
    </div>
   
@stop

@section('js')

    <script>
        $('#btnRegistrar').click(function() {

            $.ajax({
                url: "{{ route('admin.procedures.create') }}",
                type: "GET",
                success: function(response) {
                    $('#Modal .modal-body').html(response);
                    $('#Modal').modal('show');
                }
            })
        });


        // $('.btnEditar').click(function() {

        //     var id = $(this).attr('data-id');
        //     $.ajax({
        //         url: "{{ route('admin.zones.edit', 'id') }}".replace('id', id),
        //         type: "GET",
        //         success: function(response) {
        //             $('#Modal .modal-body').html(response);
        //             $('#Modal').modal('show');
        //         }
        //     })
        // });

        // $('.eliminacion').submit(function(e) {

        //     e.preventDefault();

        //     Swal.fire({
        //         title: '¿Seguro de eliminar?',
        //         text: "Este proceso es irreversible!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Si, eliminar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             this.submit();
        //         }
        //     })
        // })


        $('#listados_arboles_zonas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        })

        @if (session('success') != null)
            Swal.fire(
                'Proceso existoso',
                '{{ session('success') }}',
                'success'
            )
        @endif
    </script>
@endsection

