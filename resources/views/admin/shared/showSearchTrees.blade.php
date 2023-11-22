<div class="table-responsive">
    <table class="table table-striped" id="listados">
        <thead>
            <th>ÁRBOL</th>
        </thead>
        <tbody>
            @foreach ($trees as $tree)
                <tr>
                    <td class="tree-cell" id="{{ $tree->id }}" >{{ $tree->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>