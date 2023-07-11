<div>
    <div id="calendar">
        {{-- The whole world belongs to you. --}}
    </div>

    <div class="flex flex-column pt-5">
        <div class="w-1/2 flex flex-column">
            <div id="startTime">00:00</div>
            <div>&nbsp; -- &nbsp;</div>
            <div id="endTime">00:00</div>
        </div>
    
        <div class="w-1/2 flex justify-end">
            <div class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-lg btn btn-primary">
                Book Now
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function () {
            var Calendar = window.Calendar;
            var dayGridPlugin = window.dayGridPlugin;
            var timeGridPlugin = window.timeGridPlugin;
            var interactionPlugin = window.interactionPlugin;

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
                selectMinDistance: '01:00:00',
                validRange: function(nowDate) {
                    return {
                        start: nowDate, // valid range starts from today
                        end: '9999-12-31' // valid range ends at some future date
                    };
                },  
                select: function (selectionInfo) {
                    if (selectionInfo.view.type==="dayGridMonth") {
                        calendar.changeView('timeGridWeek', selectionInfo.startStr);
                    } else {
                        console.log(selectionInfo)
                        setMinimumDuration(selectionInfo, 60);
                        var start = new Date(selectionInfo.startStr);
                        var end = new Date(selectionInfo.endStr)
                        var startTime = document.getElementById('startTime');
                        var endTime = document.getElementById('endTime');
                        startTime.innerHTML = start.toLocaleString('en-US', {hour:'numeric', minute:'numeric'});
                        endTime.innerHTML = end.toLocaleString('en-US', {hour:'numeric', minute:'numeric'});

                    }
                    
                }

            });
            window.calendar.render();
        });


        function setMinimumDuration(info, minutes) {
            var start = new Date(info.startStr);
            var end = new Date(info.endStr);
    
            // Calculate the duration in minutes
            var duration = Math.abs((end - start) / (1000 * minutes));

            // Check if the selection duration is less than the argument
            if (duration < 60) {
                end = new Date(start.getTime() + 60 * 60 * 1000);
                window.calendar.select(start, end); // Update the selection
                alert('Please select a minimum duration of 1 hour.');
            }
        }

    </script>
</div>
