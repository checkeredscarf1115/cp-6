@extends('layouts.authorzed')

@section('inside-content')
<div class="row">
    <select class="col-2 mx-2" id="select_route" onchange="showSelectTime('select_time', 'select_route', 'input_date')"  >
        <option value="1" selected>1</option>
        <option value="2">2</option>
    </select>   

    <select class="col-2">
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
    
    <select class="col-2 " id="select_time">

    </select>
</div>
@endsection