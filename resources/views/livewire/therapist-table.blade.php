<div>

{{-- Content --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div>
                    <div class="mb-4" onsubmit="return false,">
                        <input wire:model="input"  wire:change="search" type="text" placeholder="Search" class="mr-2 px-2 py-1 rounded text-gray-500">
                        {{-- <input wire:model="services" type="text" placeholder="Search by services" class="mr-2 px-2 py-1 rounded text-gray-500"> --}}
                        <button wire:click="search" class="px-3 py-1 bg-blue-500 text-white rounded">Search</button>
                    </div>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Therapist    </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Services</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($therapists as $therapist)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-bold truncate max-w-[100px]">
                                    <a href="{{ route('appointments.book-appointment', $therapist->id) }}" >{{ $therapist->name }}</a>
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-[150px]">{{ $therapist->services->pluck('name')->implode(', '); }}</td>
                                <td class="px-6 py-4 text-gray-500 max-w-[120px]">{{ $therapist->address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 max-w-[70px]">
                                    <a href="{{ route('appointments.book-appointment', $therapist->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg btn btn-primary">Book Now</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
</div>