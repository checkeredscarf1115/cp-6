@extends('layouts.authorzed')

@section('inside-content')
<div class="row">
    <select class="col-2 mx-2" id="select_route" onchange="showSelectTime('select_time', 'select_route', 'input_date')"  >
        <option value="1" selected>1</option>
        <option value="2">2</option>
    </select>   

    <select class="col-2 mx-2">
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

    <div class="col-1 mx-2 btn btn-primary">Поиск</div>
</div>

<div class="pt-2" id="selected">Выбрано: </div>

<hr class="border-4"/>

<div class="row">
    <div class="container py-5">
        @for ($i = 0; $i < 10; $i++)
            <div class="row justify-content-center">
                @if ($i == 9)
                    @for ($j = 1; $j <= 5; $j++)
                        <a href="#" onclick="setSelectedSeats(selected, this)" class="col-auto text-center seat-available m-1 text-black">{{ $j + $i * 4 }}</a>
                    @endfor

                @else
                
                    @for ($j = 1; $j <= 4; $j++)
                        @if ($j == 3)
                                <div class="col-auto invisible m-1">0</div> 
                        @endif
                        <a href="#" onclick="setSelectedSeats(selected, this)" class="col-auto text-center seat-available m-1 text-black">{{ $j + $i * 4 }}</a>
                    @endfor
                @endif
            </div>
        @endfor
    </div>
</div>
@endsection