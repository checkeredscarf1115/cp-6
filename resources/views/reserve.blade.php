@extends('layouts.authorzed')

@section('inside-content')
<script>
    var timeLists = {!! json_encode($data['schedule'], JSON_HEX_TAG) !!};
    window.onload = function() {
        setTimeList(timeLists);
    }
</script>
<div class="row seat-available mx-1 py-4 px-2 mb-4 d-none" id="message">
    Были успешно забронированы
</div>

{{-- <form action="{{ route('reserve') }}" method="POST"> --}}
<div class="row mx-2">
    <select name="route" class="col-2 mx-2" id="select_route" onchange="setTimeList(timeLists);"  >
        @foreach ($data['routes'] as $route)
            <option  value={{ $route->route }}>{{ $route->route }}</option>
        @endforeach
    </select>   

    <select name="bus_stop" class="col-2 mx-2" id="select_bus_stop">
        @foreach ($data['bus_stops'] as $bus_stop)
            <option value={{ str_replace(' ', '_', $bus_stop->bus_stop) }}>{{ $bus_stop->bus_stop }}</option>
        @endforeach
    </select>

    <input name="date" class="col-2 mx-2" type="date" id="input_date" onchange="setTimeList(timeLists);">
    
    <select name="time" class="col-2 mx-2" id="select_time"></select>

    <div class="col-1 mx-2 btn theme-color" onclick="httpGet('{{ route('reserve_bus') }}'); onSearchClick('search_result')">Поиск</div>
</div>

<div class="d-none" id="search_result">
    <div class="pt-2" id="selected">Выбрано: </div>

    <hr class="border-4"/>

    <button type="submit" name="clicked" value="reserve" class="btn theme-color invisible" id="reserve_button" onclick="onReserveClick()">Забронировать</button>

    <div class="row">
        <div class="container py-2" id="bus_model">
            
        </div>
    </div>
</div>
{{-- </form> --}}

@endsection