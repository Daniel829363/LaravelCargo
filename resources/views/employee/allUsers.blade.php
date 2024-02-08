<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Import Export Excel to Database Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
           {{ __('Users') }}
        </div>

        <div class="card-body">

            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="8">
                        List Of Users

                    </th>

                </tr>
                <tr>
                    <th colspan="8">
                        <form action="{{ route('employee.users.filter') }}" method="GET" class="row g-3">
    <div class="col-md-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
    </div>
    <div class="col-md-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}">
    </div>
    <div class="col-md-3">
        <label for="number" class="form-label">Number</label>
        <input type="text" class="form-control" id="number" name="number" value="{{ request('number') }}">
    </div>
    <div class="col-md-3">
        <label for="code" class="form-label">Code</label>
        <input type="text" class="form-control" id="code" name="code" value="{{ request('code') }}">
    </div>

    <div class="col-md-3">
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

                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="https://wa.me/996{{ $user->number }}">0{{ $user->number }}</a></td>
                    <td>{{ $user->code }}</td>

                    <td class="col-sm-1"><a href="{{ url('employeeUserEdit', $user) }}" class="btn btn-primary">Изменить</a></td>

                </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>

</body>
</html>
