@extends('layouts.authorzed')

@section('inside-content')
<div class="row seat-available mx-1 py-4 px-2 mb-4 d-none" id="message">
    Были успешно забронированы
</div>

<div class="row mx-2">
    <select class="col-2 mx-2" id="select_route" onchange="showSelectTime('select_time', 'select_route', 'input_date')"  >
        <option value="1" selected>1</option>
        <option value="2">2</option>
    </select>   

    <select class="col-2 mx-2" id="select_bus_stop">
        <option>Остановка 1</option>
        <option>Остановка 2</option>
        <option>Остановка 3</option>
        <option>Остановка 4</option>
        <option>Остановка 5</option>
        <option>Остановка 6</option>
        <option>Остановка 7</option>
        <option>Остановка 8</option>
    </select>

    <input class="col-2 mx-2" type="date" id="input_date" onchange="showSelectTime('select_time', 'select_route', 'input_date')">
    
    <select class="col-2 mx-2" id="select_time"></select>

    <div class="col-1 mx-2 btn theme-color" onclick="onSearchClick('search_result')">Поиск</div>
</div>

<div class="d-none" id="search_result">
    <div class="pt-2" id="selected">Выбрано: </div>

    <hr class="border-4"/>

    <button class="btn theme-color invisible" id="reserve_button" onclick="onReserveClick()">Забронировать</button>

    <div class="row">
        <div class="container py-2">
            @for ($i = 0; $i < 10; $i++)
                <div class="row justify-content-center">
                    @if ($i == 9)
                        @for ($j = 1; $j <= 5; $j++)
                            @if (in_array($j + $i * 4, $seats_reserved))
                                <div class="col-auto text-center seat-reserved m-1 text-black">{{ $j + $i * 4 }}</div>
                            @else
                                <a id="{{ "seat".$j + $i * 4 }}" href="#" onclick="setSelectedSeats(selected, this); showReserveButton('reserve_button', this)" class="col-auto text-center seat-available m-1 text-black">{{ $j + $i * 4 }}</a>
                            @endif
                        @endfor

                    @else
                    
                        @for ($j = 1; $j <= 4; $j++)
                            @if ($j == 3)
                                    <div class="col-auto invisible m-1">0</div> 
                            @endif
                            @if (in_array($j + $i * 4, $seats_reserved))
                                <div class="col-auto text-center seat-reserved m-1 text-black">{{ $j + $i * 4 }}</div>
                            @else
                                <a id="{{ "seat".$j + $i * 4 }}" href="#" onclick="setSelectedSeats(selected, this); showReserveButton('reserve_button', this)" class="col-auto text-center seat-available m-1 text-black">{{ $j + $i * 4 }}</a>
                            @endif
                        @endfor
                    @endif
                </div>
            @endfor
        </div>
    </div>
</div>


@endsection