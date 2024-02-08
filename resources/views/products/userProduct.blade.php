

<div class="container">

    <div class="card bg-light mt-3">
        <div class="card-header">
            Текущие товары
        </div>


        <div class="card-body">

            <form action="{{ route('products.filterUser') }}" method="GET" class="row g-3">
            <div class="row-md-3">
                <button id="activity" name="activity" value="" type="submit" class="btn btn-primary" style="margin-top:25px;">Все</button>
                <button id="activity" name="activity" value="receipt_A" type="submit" class="btn btn-primary" style="margin-top:25px;">На складе</button>
                <button id="activity" name="activity" value="dispatch_A" type="submit" class="btn btn-primary" style="margin-top:25px;">В пути</button>
                <button id="activity" name="activity" value="receipt_B" type="submit" class="btn btn-primary" style="margin-top:25px;">Готов к выдаче</button>
                <button id="activity" name="activity" value="issue" type="submit" class="btn btn-primary" style="margin-top:25px;">Выданы</button>
            </div>
            </form>
            <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Трек код</th>
                    <th>Код</th>
                    <th>Вес</th>
                    <th>Цена</th>
                    <th>Дата</th>
                    <th>Оплачено</th>
                    <th></th>
                </tr>

                @if (count($products->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '==', null)) > 0)
                <tr>
                    <th colspan="7">

        Готово к выдаче
                    </th>
                </tr>
        @endif
                <tr>
                    @foreach ($products as $product)
                    @if ($product->receipt_A !==null && $product->dispatch_A !==null && $product->receipt_B !==null && $product->issue ==null)
                        <td class="table-text">
                            {{ $product->trek_kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->weight }}
                        </td>
                        <td class="table-text">
                            {{ $product->price }}
                        </td>
                        <td class="table-text">
                            {{ $product->receipt_B }}
                        </td>

                        <td class="table-text">
                            @if ($product->payment)
                            Да
                            @else
                            Нет
                            @endif
                        </td>
                        <td>
                            <!-- Ваши кнопки действий, например, редактирование и удаление -->

                            <a href="/details/product/{{$product->id}}" class="btn btn-primary">
                                 Посмотреть
                            </a>

                        </td>
                            @if (!($product->payment))
                        <td >
                            <form action="{{ route('payment.checkout',$product) }}" >
                                <button class="btn btn-primary" value="{{ $product->price }}" name="payment">Оплатить</button>
                            </form>
                        </td>
                            @endif

                    </tr>
                    @endif
                    @endforeach
                    @if (count($products->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '=', null)) > 0)
                    <tr>
                    <th colspan="7">
                        В пути
                    </th>
                </tr>
                <tr>
                    @foreach ($products as $product)
                    @if ($product->receipt_A !==null && $product->dispatch_A !==null && $product->receipt_B ==null)
                        <td class="table-text">
                            {{ $product->trek_kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->weight }}
                        </td>
                        <td class="table-text">
                            {{ $product->price }}
                        </td>
                        <td class="table-text">
                            {{ $product->dispatch_A }}
                        </td>
                        <td class="table-text">
                            @if ($product->payment)
                            Да
                            @else
                            Нет
                            @endif
                        </td>
                        <td>
                            <!-- Ваши кнопки действий, например, редактирование и удаление -->

                            <a href="/details/product/{{$product->id}}" class="btn btn-primary">
                                 Посмотреть
                            </a>
                        </td>
                            @if (!($product->payment))
                        <td>
                            <form action="{{ route('payment.checkout',$product) }}" >
                                <button class="btn btn-primary" value="{{ $product->price }}" name="payment">Оплатить</button>
                            </form>
                        </td>
                            @endif
                    </tr>
                    @endif
                    @endforeach
                @endif
                @if (count($products->where('receipt_A', '!=', null)->where('dispatch_A', '=', null)->where('receipt_B', '=', null)) > 0)
                    <tr>

                    <th colspan="7">

        В пункте А
                    </th>
                </tr><tr>
                    @foreach ($products as $product)
                    @if ($product->receipt_A !==null && $product->dispatch_A ==null && $product->receipt_B ==null)
                        <td class="table-text">
                            {{ $product->trek_kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->weight }}
                        </td>
                        <td class="table-text">
                            {{ $product->price }}
                        </td>
                        <td class="table-text">
                            {{ $product->receipt_A }}
                        </td>
                        <td class="table-text">
                            @if ($product->payment)
                            Да
                            @else
                            Нет
                            @endif
                        </td>
                        <td>
                            <!-- Ваши кнопки действий, например, редактирование и удаление -->

                            <a href="/details/product/{{$product->id}}" class="btn btn-primary">
                                 Посмотреть
                            </a>
                        </td>
                            @if (!($product->payment))
                        <td>
                            <form action="{{ route('payment.checkout',$product) }}" >
                                <button class="btn btn-primary" value="{{ $product->price }}" name="payment">Оплатить</button>
                            </form>
                        </td>
                            @endif
                    </tr>
                    @endif
                    @endforeach
        @endif
        @if (count($products->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '!=', null)) > 0)
                    <tr>
                    <th colspan="7">
        Выдано
                    </th>
                </tr>
                        <tr>
                    @foreach ($products as $product)
                    @if ($product->receipt_A !==null && $product->dispatch_A !==null && $product->receipt_B !==null && $product->issue !==null)
                        <td class="table-text">
                            {{ $product->trek_kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->kod }}
                        </td>
                        <td class="table-text">
                            {{ $product->weight }}
                        </td>
                        <td class="table-text">
                            {{ $product->price }}
                        </td>
                        <td class="table-text">
                            {{ $product->issue }}
                        </td>
                        <td class="table-text">
                            @if ($product->payment)
                            Да
                            @else
                            Нет
                            @endif
                        </td>
                        <td>
                            <!-- Ваши кнопки действий, например, редактирование и удаление -->

                            <a href="/details/product/{{$product->id}}" class="btn btn-primary">
                                 Посмотреть
                            </a>
                        </td>
                            @if (!($product->payment))
                        <td>
                            <form action="{{ route('payment.checkout',$product) }}" >
                                <button class="btn btn-primary" value="{{ $product->price }}" name="payment">Оплатить</button>
                            </form>
                        </td>
                            @endif
                    </tr>
                    @endif
                    @endforeach
        @endif

                </tr>
            </table>
        </div>
    </div>
    </div>
</div>









