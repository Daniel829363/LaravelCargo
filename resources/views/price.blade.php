<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Price
        </h2>
        <div class="alert alert-warning col-md-3 rounded mb-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Цена за 1 кг <br> {{$price->rate_dollar*$price->price_delivery}} сом ({{$price->price_delivery}}$)
        </h2>
        </div>
        <div class="col-md-3">
             <label for="price" class="info-label">Вес:</label>
            <input type="number" name="price" id="calculate" class="form-control" step="0.1" value="0"><br>
            <div class="d-flex align-items-center">
                <button class="btn btn-success" id="btn-calculate">Высчитать</button>
                <h2 id="titleCal" class="ms-3"></h2>
            </div>
        </div>
    </x-slot>
@if(Auth::user()->role ==="admin")
         <!DOCTYPE html>
<html>
<head>
    <title>Laravel Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
             {{ session('success') }}
            </div>
        @endif
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Курс доллара</th>
                    <th>Цена в долларах</th>
                </tr>
                <tr>
                    <form action="{{ route('price.edit', $price) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PATCH')
                        <td class="table-text">
                            <input type="number" name="rate_dollar" id="rate_dollar" class="form-control" step="0.1" value="{{ $price->rate_dollar }}">
                        </td>
                        <td class="table-text">
                            <input type="number" name="price_delivery" id="price_delivery" class="form-control" step="0.1" value="{{ $price->price_delivery }}">
                        </td>
                        <td class="col-sm-1">
                            <button type="submit" class="btn btn-primary">
                                    Изменить
                                </button>
                        </td>
                    </form>
                    </tr>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
@endif
<script>
            const button = document.getElementById('btn-calculate');
            const titleCal = document.getElementById('titleCal');

            button.addEventListener('click', function () {
              const value = document.getElementById('calculate');

              titleCal.innerHTML = Math.round(value.value*{{$price->rate_dollar*$price->price_delivery}}) + " сом"
            })
        </script>
</x-app-layout>
