{!! Form::open(['route' => 'admin.trees.store']) !!}
@include('admin.trees.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Registrar</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
{!! Form::close() !!}

<script>
    let myFamilySelect = document.querySelector('#family_id');
    
    myFamilySelect.addEventListener('change', async (e)=>{
        try {
            const response = await fetch('/admin/species/filterFamily/'+e.target.value);
            const result = await response.json();
            let mySpecieSelect = document.querySelector('#specie_id');
            mySpecieSelect.innerHTML = "";
            for (const iterator of result) {
                let newOption = document.createElement('option');
                newOption.value = iterator.id;
                newOption.text = iterator.name; 
                mySpecieSelect.appendChild(newOption);
            }
        } catch (error) {
            console.log(error);
        }

    })
</script>