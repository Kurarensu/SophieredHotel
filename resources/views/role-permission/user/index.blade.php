<x-app-layout>

<div class="mb-8">
  <nav class="flex" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
            </svg>
            <span class="sr-only">Home</span>
          </a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
          </svg>
          <a href="{{ url('roles') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Roles</a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
          </svg>
          <a href="{{ url('permissions') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Permissions</a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
          </svg>
          <a href="{{ url('users') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Users</a>
        </div>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
          </svg>
          <a href="{{ url('guests') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Guest</a>
        </div>
      </li>
    </ol>
  </nav>
</div>

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

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
  
  <div class="sm:flex sm:items-center">

    <div class="sm:flex-auto">
      <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
      <!-- <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p> -->
    </div>

    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
      @can('create user')
      <button type="button" onclick="window.location.href='{{ url('users/create') }}';" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
      Add user
      </button>
      @endcan
    </div>
  </div>
  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">ID</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">NAME</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">EMAIL</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">ROLES</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">ACTION</th>
            </tr>
          </thead>
          <tbody class="bg-white">
          @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="whitespace-nowrap px-3 py-4 text-center text-sm text-gray-500">
                        No guest records available.
                    </td>
                </tr>
            @else
            @foreach ($users as $user)
            <tr class="even:bg-gray-50">
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->id }}</td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ $user->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $rolename)
                            <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                        @endforeach
                    @endif
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-3">
                    @can('update user')
                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Edit</a>
                    @endcan

                    @can('delete user')
                        <a href="{{ url('users/'.$user->id.'/delete') }}"
                          class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                          onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                          Delete
                        </a>
                    @endcan

                </td>
            </tr>
            @endforeach
            @endif

            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</x-app-layout>