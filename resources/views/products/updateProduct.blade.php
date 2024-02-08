<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление пользователя') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="info-container">
                        <form action="{{ route('product.update') }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            <div class="info-row">
                                <span class="info-label" for="trek_kod">Трек-код</span>
                                <input type="text" name="trek_kod" id="product-trek_kod" class="form-control" value="{{ $product->trek_kod }}">
                            </div>
                            <div class="info-row">
                                <span class="info-label" for="user-email">Код товара:</span>
                                <input type="text" name="kod" id="product-kod" class="form-control" value="{{ $product->kod }}">
                            </div>
                            <div class="info-row">
                                <span class="info-label">Вес:</span>
                                <input type="number" name="weight" id="product-weight" class="form-control" step="0.01" value="{{ $product->weight }}">
                            </div>
                            <div class="info-row">
                                <span class="info-label" for="user-number">Цена:</span>
                                <input type="number" name="price" id="product-price" class="form-control" value="{{ $product->price }}">
                            </div>

                            <div class="info-row">
                                <label for="status" class="info-label">Выберите статус:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="receipt_A">Получен в пункт А</option>
                                    <option value="dispatch_A">Отправлен с пункта А</option>
                                    <option value="receipt_B">Получен в пункт B</option>
                                    <option value="issue">Выдан клиенту</option>
                                </select>
                            </div>


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
</x-app-layout>
