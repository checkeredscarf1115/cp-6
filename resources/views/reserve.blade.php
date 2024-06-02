@extends('layouts.authorzed')

@section('inside-content')
<script>
    var timeLists = {!! json_encode($data['schedule'], JSON_HEX_TAG) !!};
    window.onload = function() {
        setTimeList(timeLists);
    }
</script>
<div class="row mx-1 py-4 px-2 mb-4 d-none" id="message">
    Были успешно забронированы
</div>
<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
<form onsubmit="onReservationCreateSubmit('{{ route('reserve.create') }}')" id="reserve_form" target="dummyframe">
@csrf
<div class="row mx-2">
    
    <label for="route" class="col-2 mx-2 px-1">Маршрут</label>
    <label for="bus_stop" class="col-2 mx-2 px-1">Остановка</label>
    <label for="date" class="col-2 mx-2 px-1">Дата</label>
    <label for="time" class="col-2 mx-2 px-1">Время</label>
</div>

<div class="row mx-2">
    <select name="route" class="col-2 mx-2" id="select_route" onchange="onReserveFieldChanged();setTimeList(timeLists);"  >
        @foreach ($data['routes'] as $route)
            <option  value={{ $route->route }}>{{ $route->route }}</option>
        @endforeach
    </select>   
    
    
    <select name="bus_stop" class="col-2 mx-2" id="select_bus_stop">
        @foreach ($data['bus_stops'] as $bus_stop)
            <option value={{ str_replace(' ', '_', $bus_stop->bus_stop) }}>{{ $bus_stop->bus_stop }}</option>
        @endforeach
    </select>

    
    <input name="date" class="col-2 mx-2" type="date" id="input_date" onchange="onReserveFieldChanged();setTimeList(timeLists);">

    
    <select name="time" class="col-2 mx-2" id="select_time" onchange="onReserveFieldChanged();"></select>

    <div class="col-1 mx-2 btn theme-color" onclick="httpGet('{{ route('reserve_bus') }}'); onSearchClick('search_result')">Поиск</div>
</div>

<div class="d-none" id="search_result">
    <div class="pt-2" id="label_selected_seats">Выбрано: </div>
    <input type="hidden" id="selected_seats" name="selected_seats">

    <hr class="border-4"/>

    <button type="submit" name="btn" value="reserve" class="btn theme-color invisible" id="reserve_button">Забронировать</button>

    <div class="row">
        <div class="container py-2" id="bus_model">
            
        </div>
    </div>
</div>
</form>

@endsection