<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::hidden('tree_id', $tree_id, [
                'class' => 'form-control '
            ]) !!}
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
                {!! Form::label('height', 'Alto') !!}
                {!! Form::text('height', null, [
                    'class' => 'form-control',
                    'required',
                ]) !!}
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('width', 'Ancho') !!}
                {!! Form::text('width', null, [
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
        var nameTree = $('#searchTree').val();
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
        
        var treeId = $(this).attr('id'); 


        $('#searchTree').val(treeName);

        $('input[name="tree_id"]').val(treeId);
    });
</script>
