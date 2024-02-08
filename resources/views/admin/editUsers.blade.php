<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="info-container" >
                        <div class="info-row" >
                            <span class="info-activity">Данные пользователя</span>
                        </div>
                        <form action="{{ route('user.update',$user) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <div class="info-row" >
                            <span class="info-label"for="user-name" class="col-sm-3 control-label">ФИО</span>
                            <input  class="form-control" type="text" name="name" id="user-name" value="{{ $user->name }}">
                        </div>
                        <div class="info-row">
                            <span class="info-label" for="user-email" class="col-sm-3 control-label">Электронная почта:</span>
                            <input type="email" name="email" id="user-email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="info-row">
                            <span class="info-label">Пароль:</span>
                            <input type="password" name="password" id="user-password" class="form-control">
                        </div>
                        <div class="info-row">
                            <span class="info-label" for="user-number" class="col-sm-3 control-label">Номер (без 0 и 996):</span>
                                <input type="number" name="number" id="user-number" class="form-control" value="{{ $user->number }}">
                        </div>
                        <div class="info-row">
                            <span class="info-label" for="user-code" class="col-sm-3 control-label">Код клиента:</span>
                            <input type="text" name="code" id="user-code" class="form-control" value="{{ $user->code }}">
                        </div>
                        <div class="info-row">
                            <span class="info-label" for="role" >Выберите Роль:</span>
                            <select name="role" id="role" class="form-control">
            <option value="client" @if ($user->role === 'client') selected @endif>Клиент</option>
            <option value="employee" @if ($user->role === 'employee') selected @endif>Сотрудник</option>
            <option value="admin" @if ($user->role === 'admin') selected @endif >Администратор</option>
        </select>

                        </div>
                        <div class="form-group" style="margin:25px 0 0 10px;">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default" style="background-color: #3490dc;width:150px; color: white; border: none; padding: 8px 15px; border-radius: 10px; cursor: pointer;">
                                    <i class="fa fa-plus"></i> Изменить
                                </button>
                            </div>
                        </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


