<div>
    @if (session('success'))
        <div class="p-5 mb-5 bg-[#55CC80]">
            {{ session('success') }}
        </div>
    @else
        @if (session('error'))
            <div class="p-5 mb-5 bg-[#FA5661]" >
                {{ session('error') }}
            </div>
        @endif
        <div id="calendar">
            {{-- The whole world belongs to you. --}}
        </div>
        <div class="flex flex-column pt-5">
            <div class="w-1/2 flex flex-column">
                <div id="startTime">00:00</div>
                <div>&nbsp; to &nbsp;</div>
                <div id="endTime">00:00</div>
            </div>
        
            <div class="w-1/2 flex justify-end">
                <div onclick="clickBook()" class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-lg btn btn-primary">
                    Book Now
                </div>
            </div>
        </div>
    @endif
        
    
    <script>
        var selectedStartTimeValue;
        var selectedEndTimeValue;

        function renderCalendar(args) {
            var {initialView} = args;

            var Calendar = window.Calendar;
            var dayGridPlugin = window.dayGridPlugin;
            var timeGridPlugin = window.timeGridPlugin;
            var interactionPlugin = window.interactionPlugin;
    
            var calendarEl = document.getElementById('calendar');
            window.calendar = new Calendar(calendarEl, {
                // Configure your calendar options here
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: initialView,
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
                        selectedStartTimeValue = selectionInfo.startStr;
                        selectedEndTimeValue = setMinimumDuration(selectionInfo, 60);
    
                        var start = new Date(selectedStartTimeValue);
                        var end = new Date(selectedEndTimeValue)
    
                        var startTime = document.getElementById('startTime');
                        var endTime = document.getElementById('endTime');
                        startTime.innerHTML = start.toLocaleString('en-US', {hour:'numeric', minute:'numeric'});
                        endTime.innerHTML = end.toLocaleString('en-US', {hour:'numeric', minute:'numeric'});
                    }   
                }
            });
            window.calendar.render();
        }

        document.addEventListener('livewire:load', function () {
            renderCalendar({initailView: 'dayGridMonth'})
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

                var endFormat = new Date(end.toLocaleString());
                endFormat.setMinutes(endFormat.getMinutes() - endFormat.getTimezoneOffset());
                return endFormat.toISOString().substring(0, 19)+getTimezone()
            } else {return info.endStr}
        }

        function getTimezone() {
            var date = new Date(); // Current date and time
            var timezoneOffset = -date.getTimezoneOffset();

            // Convert the offset to hours and minutes
            var hours = Math.floor(Math.abs(timezoneOffset) / 60);
            var minutes = Math.abs(timezoneOffset) % 60;

            // Format the timezone string
            var timezone = (timezoneOffset >= 0 ? '+' : '-') + hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
            return timezone;
        }

        async function clickBook() {
            if (!selectedStartTimeValue || !selectedEndTimeValue) {
                alert('Please select a minimum duration of 1 hour.');
            } else {
                await @this.bookNow(selectedStartTimeValue, selectedEndTimeValue);
                await renderCalendar({initialView: 'timeGridWeek'});
                await window.calendar.select({
                    start: selectedStartTimeValue,
                    end: selectedEndTimeValue,
                })
            };
        }
    </script>
</div>
