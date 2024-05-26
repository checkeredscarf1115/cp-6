export function showSelectTime(selectTimeId, element)
{
    let item = document.getElementById(selectTimeId);
    if (item.style.display = element.value == 1) {
        item.classList.remove('d-none');
        item.classList.add('d-block');
    } else {
        item.classList.remove('d-block');
        item.classList.add('d-none');
    }
}