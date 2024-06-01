import "./bootstrap";
import { Modal } from "bootstrap";
import "../css/app.css";

function setDate(elementDateId) {
    document.getElementById(elementDateId).value = new Date(
        new Date().setDate(new Date().getDate() + 1)
    )
        .toISOString()
        .split("T")[0];
}

let myModal;
let itemToBeCancelled;

var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf("/") + 1);
if (sPage == "reserve") {
    setDate("input_date");
    // showSelectTime("select_time", "select_route", "input_date");
    window.setSelectedSeats = setSelectedSeats;
    window.onSearchClick = onSearchClick;
    window.showReserveButton = showReserveButton;
    window.setTimeList = setTimeList;
    window.httpGet = httpGet;
    window.onReservationCreateSubmit = onReservationCreateSubmit;
    window.onReserveFieldChanged = onReserveFieldChanged;
}
if (sPage == "reservations") {
    window.onCancelReservation = onCancelReservation;
    window.onCancelPressed = onCancelPressed;
    myModal = new Modal(document.getElementById("myModal"), {
        keyboard: false,
    });
}

let seats = [];
let msg = document.getElementById("message");
let selectRoute = document.getElementById("select_route");
let selectBusStop = document.getElementById("select_bus_stop");
let inputDate = document.getElementById("input_date");
let selectTime = document.getElementById("select_time");

function onReservationCreateSubmit(url) {
    let reserve_form = document.forms.reserve_form;
    let formData = new FormData(reserve_form);
    let object = {};
    formData.forEach(function (value, key) {
        object[key] = value;
    });
    console.log(object);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr);
            onSuccessReserve(xhr.responseText);
        } else if (xhr.status >= 400) {
            console.log(xhr);
            onFailReserve(xhr.responseText);
        }
    };
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(object));
}

function onReserveFieldChanged() {
    let search_res = document.getElementById("search_result");
    search_res.classList.add("d-none");
    seats = [];
}

function httpGet(url) {
    let params = `route=${selectRoute.value}&date=${inputDate.value}&time=${selectTime.value}&bus_stop=${selectBusStop.value}`;

    fetch(url + "?" + params)
        .then(function (response) {
            return response.json();
        })
        .then(function (json) {
            console.log(json);
            createBusModel(json);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function createBusModel(json) {
    let bus_model = document.getElementById("bus_model");
    while (bus_model.firstChild) {
        bus_model.removeChild(bus_model.firstChild);
    }

    let seats_total = json[1]["seats_total"];

    let seat_per_row;
    if (seats_total > 21) {
        seat_per_row = 4;
    } else {
        seat_per_row = 3;
    }

    for (let i = 0; i < Math.ceil(seats_total / seat_per_row); i++) {
        let row = document.createElement("div");
        row.classList.add("row", "justify-content-center");
        bus_model.appendChild(row);

        if (i == Math.floor(seats_total / seat_per_row) - 1) {
            for (let j = 1; j <= seat_per_row + 1; j++) {
                createCell(row, seat_per_row, i, j);
            }
            break;
        } else {
            for (let j = 1; j <= seat_per_row; j++) {
                if (
                    (j == seat_per_row - 1 && seat_per_row == 4) ||
                    (j == seat_per_row && seat_per_row == 3)
                ) {
                    let e = document.createElement("div");
                    e.classList.add("col-auto", "invisible", "m-1");

                    row.appendChild(e);
                }
                createCell(row, seat_per_row, i, j);
            }
        }
    }
}

function createCell(row, seat_per_row, i, j) {
    let a = document.createElement("a");
    a.classList.add(
        "col-auto",
        "text-center",
        "seat-available",
        "m-1",
        "text-black"
    );
    a.href = "#";
    a.id = "seat" + eval(j + i * seat_per_row);
    a.addEventListener("click", function () {
        setSelectedSeats(a);
        showReserveButton();
    });
    a.innerHTML = j + i * seat_per_row;
    a.value = j + i * seat_per_row;
    row.appendChild(a);
}

function setTimeList(timeLists) {
    while (selectTime.options.length > 0) {
        selectTime.remove(0);
    }

    // console.log(timeLists);
    let route = selectRoute.value;
    let day = new Date(inputDate.value).getDay();
    timeLists.forEach((i) => {
        if (i["routes_route"] == route && i["day_of_the_week"] == day) {
            let opt = document.createElement("option");
            opt.value = i["arrival_time"];
            opt.innerHTML = i["arrival_time"];
            selectTime.appendChild(opt);
        }
    });
}

function setSelectedSeats(cell) {
    if (cell.classList.contains("seat-reserved")) {
        return;
    }

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

    document.getElementById("label_selected_seats").innerHTML =
        "Выбрано: " + seats.toString();
    document.getElementById("selected_seats").value = seats.toString();
}

function showReserveButton() {
    let elem = document.getElementById("reserve_button");
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

function onSuccessReserve(text) {
    seats.forEach((i) => {
        let elem = document.getElementById("seat" + i);
        elem.classList.remove("seat-selected");
        elem.classList.add("seat-reserved");
        elem.removeAttribute("onclick");
        elem.removeAttribute("href");
        elem.classList.add("text-decoration-none");
    });

    seats = [];
    document.getElementById("reserve_button").classList.add("invisible");
    document.getElementById("label_selected_seats").innerHTML = "";

    const obj = JSON.parse(text);
    if (obj.code != 0) {
        onFailReserve(text);
        return;
    }

    msg.classList.remove("seat-reserved");
    msg.classList.add("seat-available");

    msg.innerHTML = `Места ${seats.toString()} были успешно забронированы для маршрута ${
        selectRoute.value
    } на ${inputDate.value} на время ${selectTime.value}`;
    msg.classList.remove("d-none");
}

function onFailReserve(text) {
    const obj = JSON.parse(text);

    msg.classList.remove("seat-available");
    msg.classList.add("seat-reserved");
    msg.innerHTML = `Места ${seats.toString()} не смогли быть забронированы для маршрута ${
        selectRoute.value
    } на ${inputDate.value} на время ${selectTime.value}: ${obj.msg}`;
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

function onCancelPressed(rowId) {
    let id = rowId.replace(/\D/g, "");
    // console.log(id);
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
