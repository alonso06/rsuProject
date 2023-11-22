@extends('adminlte::page')

@section('title', 'Evoluciones')

@section('content_header')

@stop

@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">

            <button type="button" class="btn btn-success float-right" data-tree-id="{{ $tree_id }}" id="btnRegistrar">
                <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Registrar
            </button>
            <h4>Listado de evoluciones del árbol - {{ $name_tree }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="listados">
                    <thead>
                        <th>ID</th>
                        <th>FECHA</th>
                        <th>ESTADO</th>
                    </thead>
                    <tbody>
                        @foreach ($evolutions as $evolution)
                            <tr>
                                <td>{{ $evolution->id }}</td>
                                <td>{{ $evolution->date }}</td>
                                <td>{{ $evolution->name_state }}</td>
                                <td width="20px">
                                    <button class="btn btn-success btn-sm btnEditar" data-id="{{ $evolution->id }}"><i
                                            class="fas fa-edit"></i></button>
                                </td>
                                <td width="20px">
                                    <form action="{{ route('admin.evolutions.destroy', $evolution->id) }}" method="post"
                                        class="eliminacion">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                <td width="20px">
                                    <a href="{{ route('admin.evolutions.show', $evolution->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{-- Registrar evolución --}}
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Evoluciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    <script>
        $('#btnRegistrar').click(function() {

            var treeId = $(this).data('tree-id');
            console.log(treeId);
            $.ajax({
                url: "{{ route('admin.evolutions.createTree', 'tree_id') }}".replace('tree_id', treeId),
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
                url: "{{ route('admin.evolutions.edit', 'id') }}".replace('id', id),
                type: "GET",
                success: function(response) {

                    $('#Modal .modal-body').html(response);

                    var nameTree = $('#searchTree').data('name-tree');

                    console.log(nameTree);

                    $('#Modal #searchTree').val(nameTree);

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

        $.ajax({
            url: "{{ route('admin.evolutions.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
               if (response.error) {
                    $('#Modal .modal-body').html('<div class="alert alert-danger">' + response.error +
                    '</div>');
                }
            }
        });


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
