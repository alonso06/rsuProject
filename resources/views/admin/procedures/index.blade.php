@extends('adminlte::page')

@section('title', 'Procedimientos')

@section('content_header')

@stop

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">

            <button type="button" class="btn btn-success float-right" id="btnRegistrar">
                <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Registrar
            </button>
            <h4>Listado de Procedimientos</h4>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped " id="listados">
                    <thead>
                        <th>ID</th>
                        <th>FECHA</th>
                        <th>TIPO DE PROCEDIMIENTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>ÁRBOL</th>
                        <th>RESPONSABLE</th>
                        <th></th>
                        <th></th>
                        {{-- <th></th> --}}
                    </thead>
                    <tbody>
                        @foreach ($procedures as $procedure)
                            <tr>
                                <td>{{ $procedure->id }}</td>
                                <td>{{ $procedure->date }}</td>
                                <td>{{ $procedure->procedure_type_name }}</td>
                                <td>{{ $procedure->description }}</td>
                                <td>{{ $procedure->tree_name }}</td>
                                <td>{{ $procedure->responsibles_name }}</td>
                                <td width="20px">
                                    <button class="btn btn-success btn-sm btnEditar" data-id="{{ $procedure->id }}"><i
                                            class="fas fa-edit"></i></button>
                                </td>
                                <td width="20px">
                                    <form action="{{ route('admin.procedures.destroy', $procedure->id) }}" method="post"
                                        class="eliminacion">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                {{-- <td width="20px">
                                    <a href="{{ route('admin.procedures.show', $procedure->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td> --}}
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

        $('.btnEditar').click(function() {

            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('admin.procedures.edit','id') }}".replace('id',id),
                type: "GET",
                success: function(response) {
                    $('#Modal .modal-body').html(response);
                    $('#Modal').modal('show');
                }
            })
        });

        $('.eliminacion').submit(function(e) {

            e.preventDefault();

            Swal.fire({
                title: '¿Seguro de eliminar?',
                text: "Este proceso es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        })

        $('#listados').DataTable({
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
