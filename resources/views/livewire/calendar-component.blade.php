<div>
    <div id="calendar">
        {{-- The whole world belongs to you. --}}
        {{ $therapist->name }}
    </div>
    
    @push('scripts')
        @vite(['resources/js/booking-calendar.js'])
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Access the calendar variable from the window object
                var calendar = window.calendar;
                console.log("Calendar Accessible", calendar);
            });
        </script> 
    @endpush
</div>
