<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container" >
                        <div class="card bg-light mt-3">
                            <div class="card-header">
                                Данные о товаре
                            </div>
                        <table class="table table-bordered mt-3">
                            <tr>
                                <th colspan="4" class="table-info">
                                   @if ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null && $product->issue != null)
                                   Товар выдан
                                   @elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null)
                                   Товар готов к выдаче
                                   @elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B == null)
                                   Товар в пути
                                   @elseif ($product->receipt_A != null && $product->dispatch_A == null && $product->receipt_B == null)
                                   Товар на складе
                                   @endif

                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Трек код:</td>
                                <td>{{ $product->trek_kod }}</td>
                            </tr>
                            <tr>
                                <td>Код:</td>
                                <td>{{ $product->kod }}</td>
                            </tr>
                            <tr>
                                <td>Вес:</td>
                                <td>{{ $product->weight }}</td>
                            </tr>
                            <tr>
                                <td>Цена:</td>
                                <td>{{ $product->price }}</td>
                            </tr>

                                                    @if ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null && $product->issue != null)
                            <tr>
                                    <td>Получен на склад:</td>
                                    <td>{{ $product->receipt_A }}</td>
                            </tr>
                            <tr>
                                    <td>Отправлен:</td>
                                    <td>{{ $product->dispatch_A }}</td>
                            </tr>
                            <tr>
                                    <td>Готов к выдаче:</td>
                                    <td>{{ $product->receipt_B }}</td>
                            </tr>
                            <tr>
                                    <td>Выдан:</td>
                                    <td>{{ $product->issue }}</td>
                            </tr>

                            @elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null)
                                <tr>
                                    <td>Получен на склад:</td>
                                    <td>{{ $product->receipt_A }}</td>
                                </tr>
                                <tr">
                                    <td>Отправлен:</td>
                                    <td>{{ $product->dispatch_A }}</td>
                                </tr>
                                <tr>
                                    <td>Готов к выдаче:</td>
                                    <td>{{ $product->receipt_B }}</td>
                                </tr>
                            @elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B == null)
                                <tr>
                                    <td>Получен на склад:</td>
                                    <td>{{ $product->receipt_A }}</td>
                                </tr>
                                <tr>
                                    <td>Отправлен:</td>
                                    <td>{{ $product->dispatch_A }}</td>
                                </tr>
                            @elseif ($product->receipt_A != null && $product->dispatch_A == null && $product->receipt_B == null)
                                <tr>
                                    <td>Получен на склад:</td>
                                    <td>{{ $product->receipt_A }}</td>
                                </tr>
                            @endif
                        </table>



                        <!-- @if ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null && $product->issue != null)
    <div class="info-row">
        <span class="info-label">Получен на склад:</span>
        <span class="info-value">{{ $product->receipt_A }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Отправлен:</span>
        <span class="info-value">{{ $product->dispatch_A }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Готов к выдаче:</span>
        <span class="info-value">{{ $product->receipt_B }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Выдан:</span>
        <span class="info-value">{{ $product->issue }}</span>
    </div>
@elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null)
    <div class="info-row">
        <span class="info-label">Получен на склад:</span>
        <span class="info-value">{{ $product->receipt_A }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Отправлен:</span>
        <span class="info-value">{{ $product->dispatch_A }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Готов к выдаче:</span>
        <span class="info-value">{{ $product->receipt_B }}</span>
    </div>
@elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B == null)
    <div class="info-row">
        <span class="info-label">Получен на склад:</span>
        <span class="info-value">{{ $product->receipt_A }}</span>
    </div>
    <div class="info-row" style="margin-top:30px;">
        <span class="info-label">Отправлен:</span>
        <span class="info-value">{{ $product->dispatch_A }}</span>
    </div>
@elseif ($product->receipt_A != null && $product->dispatch_A == null && $product->receipt_B == null)
    <div class="info-row">
        <span class="info-label">Получен на склад:</span>
        <span class="info-value">{{ $product->receipt_A }}</span>
    </div>
@endif -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
