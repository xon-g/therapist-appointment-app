import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';


var calendarEl = document.getElementById('calendar');
window.calendar = new Calendar(calendarEl, {
    // Configure your calendar options here
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    headerToolbar: {
        start:'prev next today',
        center: 'title',
        end: 'dayGridMonth timeGridWeek timeGridDay'
    },
    selectable: true,
    select: function (selectionInfo) {
        console.log(selectionInfo);
        if (selectionInfo.view.type==="dayGridMonth") {
            window.calendar.changeView('timeGridWeek', selectionInfo.startStr);
        }

        var start = selectionInfo.start.toISOString();
        var end = selectionInfo.end.toISOString();
        console.log("start: ",start, " end: ", end)
    }

});
calendar.render();

console.log('Calendar Loaded');