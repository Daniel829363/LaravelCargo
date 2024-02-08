<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ваш код  ') }} {{$user->code}}
        </h2>
    </x-slot>
    @if(session('success'))
            <div class="alert alert-danger">
             {{ session('success') }}
            </div>
        @endif
                    @include('products.userProduct',['products' => $products])



</x-app-layout>
