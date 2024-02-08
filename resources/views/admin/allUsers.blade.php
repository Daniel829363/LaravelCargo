

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
           {{ __('Users') }}
        </div>
            <div class="table-responsive">

        <div class="card-body">

            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning float-end" href="{{ route('users.export') }}">Export User Data</a>
            </form>
            @if($errors->has('file'))
    <spam style="color: red;">{{ $errors->first('file') }}</spam>
@endif
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="8">
                        List Of Users

                    </th>

                </tr>
                <tr>
                    <th colspan="8">
                        <form action="{{ route('admin.users.filter') }}" method="GET" class="row g-3">
    <div class="col-sm-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
    </div>
    <div class="col-sm-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}">
    </div>
    <div class="col-sm-3">
        <label for="number" class="form-label">Number</label>
        <input type="text" class="form-control" id="number" name="number" value="{{ request('number') }}">
    </div>
    <div class="col-sm-3">
        <label for="code" class="form-label">Code</label>
        <input type="text" class="form-control" id="code" name="code" value="{{ request('code') }}">
    </div>
    <div class="col-sm-3">
        <label for="role" class="form-label">Роль</label>
        <select class="form-select" id="role" name="role">
            <option value="">Все роли</option>
            <option value="client" >Клиент</option>
            <option value="employee" }}>Сотрудник</option>
            <option value="admin" >Администратор</option>
        </select>
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-primary" style="margin-top:25px;">Применить фильтр</button>
    </div>
</form>
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Code</th>
                    <th>Role</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="https://wa.me/996{{ $user->number }}">0{{ $user->number }}</a></td>
                    <td>{{ $user->code }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="col-sm-1"><a href="{{ url('userEdit', $user) }}" class="btn btn-primary">Изменить</a></td>
                    <td class="col-sm-1"><form action="{{ route('user.destroy',$user) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary">Удалить</button></form></td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
</div>

