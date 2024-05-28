import "./bootstrap";
import { Modal } from "bootstrap";
import "../css/app.css";
import { showSelectTime, setDate } from "./my";

var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf("/") + 1);
if (sPage == "reserve") {
    setDate("input_date");
    window.showSelectTime = showSelectTime;
    showSelectTime("select_time", "select_route", "input_date");
    window.setSelectedSeats = setSelectedSeats;
    window.onSearchClick = onSearchClick;
    window.showReserveButton = showReserveButton;
    window.onReserveClick = onReserveClick;
}
if (sPage == "reservations") {
    window.onCancelReservation = onCancelReservation;
    window.onCancelPressed = onCancelPressed;
}

let seats = [];
let msg = document.getElementById("message");
let selectRoute = document.getElementById("select_route");
let selectBusStop = document.getElementById("select_bus_stop");
let inputDate = document.getElementById("input_date");
let selectTime = document.getElementById("select_time");

function setSelectedSeats(div, cell) {
    let index = seats.indexOf(cell.innerHTML);
    if (index > -1) {
        // only splice array when item is found
        seats.splice(index, 1); // 2nd parameter means remove one item only
        cell.classList.remove("seat-selected");
        cell.classList.add("seat-available");
    } else {
        seats.push(cell.innerHTML);
        cell.classList.remove("seat-available");
        cell.classList.add("seat-selected");
    }

    div.innerHTML = "Выбрано: " + seats.toString();
}

function showReserveButton(id) {
    let elem = document.getElementById(id);
    if (seats.length > 0 && elem.classList.contains("invisible")) {
        elem.classList.remove("invisible");
        elem.classList.add("visible");
    } else if (seats.length <= 0) {
        elem.classList.remove("visible");
        elem.classList.add("invisible");
    }
}

function onSearchClick(id) {
    let search_res = document.getElementById(id);
    search_res.classList.remove("d-none");
}

function onReserveClick() {
    msg.innerHTML = `Места ${seats.toString()} были успешно забронированы для маршрута ${
        selectRoute.value
    } на ${inputDate.value} на время ${selectTime.value}`;
    msg.classList.remove("d-none");
}

//reservation

function onCancelReservation() {
    myModal.hide();
    let row = document.getElementById(itemToBeCancelled);
    // console.log(row);
    row.remove();
    setTimeout(function () {
        document.getElementById("table_header").focus();
    }, 0);
}
var myModal = new Modal(document.getElementById("myModal"), {
    keyboard: false,
});
let itemToBeCancelled;

function onCancelPressed(rowId) {
    let id = rowId.replace(/\D/g, "");
    console.log(id);
    let route = document.getElementById("route" + id).innerHTML;
    let bus_stop = document.getElementById("bus_stop" + id).innerHTML;
    let date = document.getElementById("date" + id).innerHTML;
    let timestamp = document.getElementById("timestamp" + id).innerHTML;
    let seat = document.getElementById("seat" + id).innerHTML;

    let mb = document
        .getElementById("myModal")
        .getElementsByClassName("modal-body")[0];
    mb.innerHTML = `Вы действительно хотите отменить бронирование по маршруту ${route}, ${bus_stop}, на ${date}, ${timestamp}, с номерами ${seat}?`;

    myModal.show();

    itemToBeCancelled = rowId;
}
