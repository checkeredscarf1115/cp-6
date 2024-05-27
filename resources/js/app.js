import "./bootstrap";
import "../css/app.css";
import { showSelectTime, setDate } from "./my";

setDate("input_date");
window.showSelectTime = showSelectTime;
showSelectTime("select_time", "select_route", "input_date");
window.setSelectedSeats = setSelectedSeats;
window.onSearchClick = onSearchClick;
window.showReserveButton = showReserveButton;
window.onReserveClick = onReserveClick;

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
