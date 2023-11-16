<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('tree_id', 'Árbol') !!}
            <div class="d-flex">
                <div>
                    {!! Form::text('tree_id', null, [
                        'class' => 'form-control ',
                        'placeholder' => 'Buscar árbol',
                        'required',
                    ]) !!}
                </div>
                <div class="ml-3">
                    <button type="button" class="btn btn-success " id="btnSearch">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="iframeSearchTreeContainer">

            </div>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('date', 'Fecha') !!}
            {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

</div>

<fieldset class="border p-2">
    <legend class="w-auto">Tamaño</legend>
    <div class="row">

        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('Alto', 'Alto') !!}
                {!! Form::text('Alto', null, [
                    'class' => 'form-control',
                    'required',
                ]) !!}
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('Ancho', 'Ancho') !!}
                {!! Form::text('Ancho', null, [
                    'class' => 'form-control',
                    'required',
                ]) !!}
            </div>
        </div>

    </div>

</fieldset>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

{{-- Estados --}}
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('state_id', 'Estado') !!}

            {!! Form::select('state_id', $states, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
</div>

<script>
    $('#btnSearch').click(function() {
        var nameTree = $('#tree_id').val();
        $.ajax({
            url: "/admin/trees/searchTree/" + nameTree,
            type: "GET",
            success: function(response) {
                // console.log(response)
                $('.iframeSearchTreeContainer').html(response);

            }
        })
    });

    // Setear valor de tabla en input
    $('.iframeSearchTreeContainer').on('click', '.tree-cell', function() {

        var treeName = $(this).text();
        $('input[name="tree_id"]').val(treeName);

    });
</script>
