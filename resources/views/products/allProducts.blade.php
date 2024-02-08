
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Текущие товары
        </div>
            <div class="table-responsive">


        <div class="card-body">
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <div class="col-md-3">
                    <label for="status" class="form-label">Статус</label>
                    <select class="form-select" id="status" name="status">
                        <option value=""> - - - </option>
                        <option value="receipt_A" >В пункте А</option>
                        <option value="dispatch_A" >В пути</option>
                        <option value="receipt_B" }}>В пункте В</option>
                        <option value="issue" >Выдан</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-success">Import User Data</button>

                <a class="btn btn-warning float-end " href="{{ route('products.export') }}">Export User Data</a>

            </form>

            @if($errors->has('file'))
    <spam style="color: red;">{{ $errors->first('file') }}</spam>
@endif
<br>



            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="8">
                        List Of Users

                    </th>
                </tr>
                <tr>
                    <th colspan="8">
                         <form action="{{ route('products.filter') }}" method="GET" class="row g-3">
    <div class="col-md-3">
        <label for="trek_kod" class="form-label">Трек код</label>
        <input type="text" class="form-control" id="trek_kod" name="trek_kod" value="{{ request('trek_kod') }}">
    </div>
    <div class="col-md-3">
        <label for="kod" class="form-label">Код</label>
        <input type="text" class="form-control" id="kod" name="kod" value="{{ request('kod') }}">
    </div>
    <div class="col-md-3">
        <label for="activity" class="form-label">Статус</label>
        <select class="form-select" id="activity" name="activity">
            <option value="">Все</option>
            <option value="receipt_A" >На складе</option>
            <option value="dispatch_A" }}>В пути</option>
            <option value="receipt_B" >Готов к выдаче</option>
            <option value="issue" >Выдан</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary" style="margin-top:25px;">Применить фильтр</button>
    </div>
</form>
                    </th>
                </tr>
                <tr>
                    <th>Трек код</th>
                    <th>Код</th>
                    <th>Вес</th>
                    <th>Цена</th>
                    <th>Статус</th>
                </tr>
                <tr>
                    @foreach ($products as $product)
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
                        <td>
                            @if ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null && $product->issue != null)Выдан
@elseif ($product->receipt_A != null && $product->dispatch_A != null && $product->receipt_B != null )В пункте Б
@elseif ($product->receipt_A != null && $product->dispatch_A != null)Товар в пути
@elseif ($product->receipt_A != null)В пункте А
@endif
                        </td>
                        <td class="col-sm-1"><a href="/details/product/{{$product->id}}" class="btn btn-primary">Посмотреть</a></td>
                        <td class="col-sm-1">
                            <!-- Ваши кнопки действий, например, редактирование и удаление -->
                            <a href="{{ route('product.edit', $product) }}"  class="btn btn-primary">Изменить
                            </a>
                        </td>
                        <td class="col-sm-1">
                            <form method="POST" action="{{ route('products.delete', $product) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
