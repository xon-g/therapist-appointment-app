<div>


<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Book Apointment') }}
    </h2>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex">

                <div class="w-2/5 flex flex-col">
                    <div class="text-xl font-bold">
                        {{ $therapist->name }}
                    </div>
                    <div class="pt-5 pb-5">
                        {{ $therapist->address }}
                    </div>
                    <div class="flex-wrap">
                        @foreach ($therapist->services as $service)
                        <span class="bg-white text-black rounded-lg p-0.5 leading-8">{{$service->name}}</span>
                        @endforeach
                    </div>
                </div>

                <div class="w-3/5">
                    <!-- Content for the right div -->
                    Calendar
                </div>

            </div>
        </div>
    </div>
</div>

</div>
