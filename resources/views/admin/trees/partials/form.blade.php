<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre de árbol') !!}
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('zone_id', 'Zona') !!}
            {!! Form::select('zone_id', $zones, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('family_id', 'Familia') !!}

            {!! Form::select('family_id', $families, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('specie_id', 'Especie') !!}

            {!! Form::select('specie_id', $species, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('birth_date', 'Nacimiento') !!}
            {!! Form::date('birth_date', null, ['class' => 'form-control','required']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('planting_date', 'Fecha de plantado') !!}
            {!! Form::date('planting_date', null, ['class' => 'form-control','required']) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('latitude', 'Latitud') !!}
            {!! Form::text('latitude', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('longitude', 'Longitud') !!}
            {!! Form::text('longitude', null, [
                'class' => 'form-control',
                'required',
            ]) !!}

        </div>
    </div>

</div>

<div id="map2" style="height: 300px; widht:100%" class="border" ></div>


<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
<script>
    var myFamilySelect = document.querySelector('#family_id');
    
    myFamilySelect.addEventListener('change', async (e)=>{
        try {
            const response = await fetch('/admin/species/filterFamily/'+e.target.value);
            const result = await response.json();
            var mySpecieSelect = document.querySelector('#specie_id');
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


<script>
    var latInput = document.getElementById('latitude');
    var lonInput = document.getElementById('longitude');

    function initMap() {

        var lat = parseFloat(latInput.value);
        var lng = parseFloat(lonInput.value);

        if (isNaN(lat) || isNaN(lng)) {
            // Obtener ubicación actual si los campos están vacíos o no contienen valores numéricos válidos
            navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                latInput.value = lat;
                lonInput.value = lng;
                displayMap(lat, lng);
            });
        } else {
            // Utilizar las coordenadas de los campos de entrada
            displayMap(lat, lng);
        }
    }

    function displayMap(lat, lng) {
        var mapOptions = {
            center: {
                lat: lat,
                lng: lng
            },
            zoom: 18
        };

        var map = new google.maps.Map(document.getElementById('map2'), mapOptions);

        var marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng
            },
            map: map,
            title: 'Ubicación',
            draggable: true // Permite arrastrar el marcador
        });

        

        // Actualizar las coordenadas al mover el marcador
        google.maps.event.addListener(marker, 'dragend', function(event) {
            var latLng = event.latLng;
            latInput.value = latLng.lat();
            lonInput.value = latLng.lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer>
</script>
