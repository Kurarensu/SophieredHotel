<x-app-layout>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">

    @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
     @endif

    <div class="sm:flex-auto"></div>
      
      <button type="button" onclick="window.location.href='{{ url('roles') }}';" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Roles</button>
      <button type="button" onclick="window.location.href='{{ url('permissions') }}';" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Permissions</button>
      <button type="button" onclick="window.location.href='{{ url('users') }}';" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Users</button>
    </div>

    <div class="sm:flex-auto">
      <h1 class="text-base font-semibold leading-6 text-gray-900">Users</h1>
      <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
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
                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    @endcan

                    @can('delete user')
                    <a href="{{ url('users/'.$user->id.'/delete') }}" class="text-indigo-600 hover:text-indigo-900">Delete</a>
                    @endcan
                </td>
            </tr>
            @endforeach

            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</x-app-layout>