<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="info-container">
                        <div class="info-row">
                            <span class="info-activity">Данные товара</span>
                        </div>
                        <form action="{{ route('products.update', $product) }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            <div class="info-row">
                                <label for="trek_kod" class="info-label">Трек код:</label>
                                <input type="text" name="trek_kod" id="trek_kod" class="form-control" value="{{ $product->trek_kod }}">
                            </div>
                            <div class="info-row">
                                <label for="kod" class="info-label">Код:</label>
                                <input type="text" name="kod" id="kod" class="form-control" value="{{ $product->kod }}">
                            </div>
                            <div class="info-row">
                                <label for="weight" class="info-label">Вес:</label>
                                <input type="number" name="weight" id="weight" class="form-control" step="0.1" value="{{ $product->weight }}">
                            </div>
                            <div class="info-row">
                                <label for="receipt_A" class="info-label">Дата получения A:</label>
                                <input type="datetime-local" name="receipt_A" id="receipt_A" class="form-control" value="{{ $product->receipt_A }}">
                            </div>
                            <div class="info-row">
                                <label for="dispatch_A" class="info-label">Дата отправки A:</label>
                                <input type="datetime-local" name="dispatch_A" id="dispatch_A" class="form-control" value="{{ $product->dispatch_A }}">
                            </div>
                            <div class="info-row">
                                <label for="receipt_B" class="info-label">Дата получения B:</label>
                                <input type="datetime-local" name="receipt_B" id="receipt_B" class="form-control" value="{{ $product->receipt_B }}">
                            </div>
                            <div class="info-row">
                                <label for="issue" class="info-label">Дата выпуска:</label>
                                <input type="datetime-local" name="issue" id="issue" class="form-control" value="{{ $product->issue }}">
                            </div>
                            <div class="info-row">
                                <label for="price" class="info-label">Цена:</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>
                            <div class="form-group" style="margin: 25px 0 0 10px;">
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
