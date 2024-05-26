import './bootstrap';
import '../css/app.css'
import {showSelectTime, setDate} from './my'

setDate('input_date');
window.showSelectTime = showSelectTime;
showSelectTime('select_time', 'select_route', 'input_date');