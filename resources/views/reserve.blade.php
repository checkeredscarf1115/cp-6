@extends('layouts.app')

@section('content')
<div class="row">
    <select class="col-2 mx-2" onchange="showSelectTime('select_time', this)"  >
        <option value="0" selected>372</option>
        <option value="1">375</option>
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

    <input class="col-2 mx-2" type="date">
    
    <select class="col-2 d-none" id="select_time">
        <option>Остановка 1</option>
        <option>Остановка 2</option>
        <option>Остановка 3</option>
        <option>Остановка 4</option>
        <option>Остановка 5</option>
        <option>Остановка 6</option>
        <option>Остановка 7</option>
        <option>Остановка 8</option>
    </select>
</div>
@endsection