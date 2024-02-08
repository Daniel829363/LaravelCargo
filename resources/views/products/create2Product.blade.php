<x-app-layout>
    <!DOCTYPE html>
<html>
<head>
    <title>Laravel Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление товара') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-700 leading-tight">Отправлен с пункта А</h3>
                    <div class="info-container">
                        @if(session('success'))
                                    <div class="alert alert-success">
                                 {{ session('success') }}
                                    </div>
                                @endif
                        <form action="{{ route('product.create2') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="info-row">
                                <span class="info-label" for="trek_kod">Трек-код</span>
                                <input type="text" name="trek_kod" id="product-trek_kod" class="form-control">
                            </div>
                            @if(session('error'))
                                    <div class="alert alert-danger">
                                 {{ session('error') }}
                                    </div>
                                @endif
                            <div class="info-row">
                                <span class="info-label" for="user-email">Код товара:</span>
                                <input type="text" name="kod" id="product-kod" class="form-control">
                            </div>
                            <div class="info-row">
                                <span class="info-label">Вес:</span>
                                <input type="number" name="weight" id="product-weight" class="form-control" step="0.01">
                            </div>
                            <div class="info-row">
                                <span class="info-label" for="user-number">Цена:</span>
                                <input type="number" name="price" id="product-price" class="form-control">
                            </div>
                            <input type="hidden" name="status" id="product-status" class="form-control"  value="dispatch_A">


                            <div class="form-group" style="margin:25px 0 0 10px;">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Добавить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
