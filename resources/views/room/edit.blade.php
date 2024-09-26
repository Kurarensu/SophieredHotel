<x-app-layout>

    @if ($errors->any())
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">{{ session('status') }}</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul role="list" class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ url('rooms/'.$room->id) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        
        <div class="space-y-12">
              
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create Room</h2>
            

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Room Number</label>
                        <div class="mt-2">
                            <input type="text" name="room_number" id="room_number-name" value="{{ $room->room_number }}" autocomplete="room-number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('room_number') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                        <div class="mt-2">
                            @error('room_type') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror
                            <select id="room_type" name="room_type" autocomplete="roomtype-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option value="deluxe" {{ old('gender', $room->room_type) == 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                                        <option value="premium_deluxe" {{ old('gender', $room->room_type) == 'premium_deluxe' ? 'selected' : '' }}>Premium Deluxe</option>
                                        <option value="junior" {{ old('gender', $room->room_type) == 'junior' ? 'selected' : '' }}>Junior</option>
                                        <option value="family" {{ old('gender', $room->room_type) == 'family' ? 'selected' : '' }}>Family</option>
                                        <option value="presidential" {{ old('gender', $room->room_type) == 'presidential' ? 'selected' : '' }}>Presidential</option>
                                        <option value="agutayan_villa" {{ old('gender', $room->room_type) == 'agutayan_villa' ? 'selected' : '' }}>Agutayan Villa</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Price Per Night</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">P</span>
                            </div>
                            <input type="text" name="price_per_night" id="price_per_night" value="{{ $room->price_per_night }}" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00" aria-describedby="price-currency">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 sm:text-sm" id="price-currency">PHP</span>
                            @error('price_per_night') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div> 
                   
                    
                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                                @error('status') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror
                                <select id="status" name="status" autocomplete="status-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            <option value="available" {{ old('gender', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="occupied" {{ old('gender', $room->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                            <option value="maintenance" {{ old('gender', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                        </div>
                    </div> 

                    <div class="sm:col-span-3">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Upload Image</label>
                        <img src="{{ asset('storage/images/'.$room->image) }}" alt="Uploaded Image" class="w-64 h-auto rounded-lg shadow-md">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"">
                        @error('image') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror
                    </div> 

                </div>
            </div>

           
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <button type="button" onclick="window.location.href='{{ url('guests') }}';" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
    
</x-app-layout>