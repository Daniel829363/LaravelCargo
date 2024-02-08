<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
        <a href="..\employee/user/create" class="submit btn btn-primary">Create new User</a>
        @if(session('success'))
            <div class="alert alert-success">
             {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
         {{ session('error') }}
            </div>
        @endif
    </x-slot>
            @include('employee.allUsers')


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
