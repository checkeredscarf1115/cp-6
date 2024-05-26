export function showSelectTime(selectTimeId, selectRouteId, inputDateId)
{
    let item = document.getElementById(selectTimeId);
    let route = document.getElementById(selectRouteId);
    let date = document.getElementById(inputDateId);
    let day = new Date(date.value).getDay();

    while (item.options.length > 0) {
        item.remove(0);
    }

    if (day == 6 || day == 0) {
        if (item.style.display = route.value == 1) {
            createSelectTimeOptions(6, 0, 20, item)
        } else {
            createSelectTimeOptions(6, 0, 30, item)
        }
    } else {
        if (item.style.display = route.value == 1) {
            createSelectTimeOptions(5, 30, 15, item)
        } else {
            createSelectTimeOptions(5, 20, 20, item)
        }
    }
}


function createSelectTimeOptions(hours, minutes, interval, item) {
    while (hours < 10) {
        let opt = document.createElement('option');

        if (hours.toString().length == 1 && minutes.toString().length == 1) {
            opt.value = `0${hours}:0${minutes}`;
            opt.innerHTML = `0${hours}:0${minutes}`;
        } else
        if (hours.toString().length == 1) {
            opt.value = `0${hours}:${minutes}`;
            opt.innerHTML = `0${hours}:${minutes}`;
        } else
        if (minutes.toString().length == 1) {
            opt.value = `${hours}:0${minutes}`;
            opt.innerHTML = `${hours}:0${minutes}`;
        } else {
            opt.value = `${hours}:${minutes}`;
            opt.innerHTML = `${hours}:${minutes}`;
        }

        item.appendChild(opt);

        minutes += interval;
        if (minutes >= 60) {
            hours++;
            minutes -= 60;
        }
    }
}


export function setDate(elementDateId) {
    console.log(document.getElementById(elementDateId));
    document.getElementById(elementDateId).value = new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().split('T')[0];;
}