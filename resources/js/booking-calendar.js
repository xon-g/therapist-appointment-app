import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';


var calendarEl = document.getElementById('calendar');
var calendar = new Calendar(calendarEl, {
    // Configure your calendar options here
    plugins: [dayGridPlugin],
    headerToolbar: {
        start:'prev next today',
        center: 'title',
        end: 'dayGridMonth dayGridWeek dayGridDay'
    },
    selectable: true,

});
calendar.render();

console.log('Calendar Loaded');