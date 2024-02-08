<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление пользователя') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="info-container" >
                    <div class="container col-sm-4" >

                        <form action="{{ route('user.create') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class=" " >
                            <span class=""for="user-name" class="col-sm-3 control-label">ФИО</span>
                            <input  class="form-control" type="text" name="name" id="user-name" >
                        </div>
                        <div class=" ">
                            <span class=" " for="user-email" class="col-sm-3 control-label">Электронная почта:</span>
                            <input type="email" name="email" id="user-email" class="form-control">
                        </div>
                        <div class=" ">
                            <span class="  ">Пароль:</span>
                            <input type="password" name="password" id="user-password" class="form-control">
                        </div>
                        <div class="">
                            <span class=" " for="user-number" class="col-sm-3 control-label">Номер:</span>
                            <input type="number" name="number" id="user-number" class="form-control" praceholder="555">
                        </div>
                        <div class=" ">
                            <span class=" " for="user-code" class="col-sm-3 control-label">Код клиента:</span>
                            <input type="text" name="code" id="user-code" class="form-control">
                        </div>
                        <div class=" ">
                            <span class=" " for="role" >Выберите Роль:</span>
                            <select name="role" id="role" class="form-control">
            <option value="client" :selected >Клиент</option>
            <option value="employee">Сотрудник</option>
            <option value="admin" >Администратор</option>
        </select>

                        </div>
                        <div class="form-group" style="margin:25px 0 0 10px;">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary"> Добавить
                                </button>
                            </div>
                        </div>
                        </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
