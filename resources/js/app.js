import "./bootstrap";
import "../css/app.css";
import { showSelectTime, setDate } from "./my";

setDate("input_date");
window.showSelectTime = showSelectTime;
showSelectTime("select_time", "select_route", "input_date");
window.setSelectedSeats = setSelectedSeats;

let seats = [];

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
