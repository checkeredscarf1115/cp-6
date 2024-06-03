@extends('layouts.authorzed') @section('inside-content')
<div class="container">
    <div class="row justify-content-center text-center theme-color py-1" id="table_header">
        <div class="col-2">Маршрут</div>
        <div class="col-2">Остановка</div>
        <div class="col-2">Дата</div>
        <div class="col-2">Время</div>
        <div class="col-2">Места</div>
        <div class="col-2"></div>
    </div>

    @for ($i = 0; $i < count($routes); $i++)
    <div
        class="row align-items-end text-center my-2"
        id="{{ 'row'.strval($i) }}"
    >
        <div class="col-2" id="{{ 'route'.$i }}">{{ $routes[$i] }}</div>
        <div class="col-2" id="{{ 'bus_stop'.$i }}">{{ $busStops[$i] }}</div>
        <div class="col-2" id="{{ 'date'.$i }}">{{ $dates[$i] }}</div>
        <div class="col-2" id="{{ 'timestamp'.$i }}">{{ $timestamps[$i] }}</div>
        <div class="col-2" id="{{ 'seat'.$i }}">{{ $seats[$i] }}</div>
        <div class="col-2">
            <a href="#" onclick="promptDeleteReservation({{ json_encode('row'.$i) }})">
                <img
                    src="{{ asset('images/cancel.png') }}"
                    alt="description of myimage"
                />
            </a>


        </div>
    </div>
    @endfor

  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Отмена брони</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
          <button type="button" class="btn theme-color" onclick="deleteReservation({{ json_encode('row'.$i) }})">Да</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
