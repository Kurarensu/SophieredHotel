<x-app-layout>

    @if (session('status'))
    <div class="rounded-md bg-green-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
            </svg>
            </div>
            <div class="ml-3">
            <h3 class="text-sm font-medium text-green-800">{{ session('status') }}</h3>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-12">
              
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Add/Edit Permissions</h2>
            

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Role : {{ $role->name }}</label>
                    <div class="mt-2">
                        @error('permission') <span class="mt-2 text-sm text-red-700">{{ $message }}</span> @enderror

                        <fieldset>
    <legend class="text-base font-semibold leading-6 text-gray-900">Permissions</legend>
    <!-- Select All Checkbox -->
    <div class="relative flex items-start py-4">
        <div class="min-w-0 flex-1 text-sm leading-6">
            <label for="select-all" class="select-none font-medium text-gray-900">Select All</label>
        </div>
        <div class="ml-3 flex h-6 items-center">
            <input id="select-all" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
        </div>
    </div>

    <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
        @foreach ($permissions as $permission)
            <div class="relative flex items-start py-4">
                <div class="min-w-0 flex-1 text-sm leading-6">
                    <label for="permission-{{ $permission->id }}" class="select-none font-medium text-gray-900">{{ $permission->name }}</label>
                </div>
                <div class="ml-3 flex h-6 items-center">
                    <input name="permission[]" id="permission-{{ $permission->id }}" type="checkbox" value="{{ $permission->name }}" 
                           {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }} 
                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 permission-checkbox">
                </div>
            </div>
        @endforeach
    </div>
</fieldset>

<!-- JavaScript to handle Select All functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the Select All checkbox and all permission checkboxes
        const selectAllCheckbox = document.getElementById('select-all');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Event listener for Select All checkbox
        selectAllCheckbox.addEventListener('change', function () {
            permissionCheckboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Update Select All checkbox state based on individual checkboxes
        permissionCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    });
</script>


                    </div>
                </div>

            </div>
            </div>

           
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <button type="button" onclick="window.location.href='{{ url('roles') }}';" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</x-app-layout>