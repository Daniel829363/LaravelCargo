<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
        <a href="..\product/create" class="submit btn btn-primary mt-2">Добавить товар в точке А</a>
        <a href="..\product/create2" class="submit btn btn-primary mt-2 ">Добавить товар в пути</a>
        <a href="..\product/create3" class="submit btn btn-primary  mt-2">Добавить товар в точке В</a>
        <a href="..\product/create4" class="submit btn btn-primary mt-2 ">Добавить товар выдачи</a>
    </x-slot>
            @include('products.allProducts')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
