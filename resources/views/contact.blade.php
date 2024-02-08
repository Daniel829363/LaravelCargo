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
            {{ __('Контактные Данные') }}
        </h2>
        @if(session('success'))
            <div class="alert alert-success">
             {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
         {{ session('error') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if(Auth::user()->role ==="admin")
                    <div class="contact-info">
                        <form action="{{ route('update.contact') }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                        <div class="contact-info-item">
                            <span>Адрес склада пункта А:</span><br><br>
                                <input type="text" name="addres_a" id="addres_a" class="form-control" value="{{ $contacts->first()->addres_a }}">
                                <br>
                                <button class="copy-button btn-primary btn" data-clipboard-text="$contacts->first()->addres_a">Копировать</button>
                                <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Изменить
                                    </button>
                        </div>

                        <div class="contact-info-item">
                            <span>Адрес головного офиса выдачи:</span><br><br>
                            <input type="text" name="addres_b" id="addres_b" class="form-control" value="{{ $contacts->first()->addres_b }}">
                            <br>
                                <button class="copy-button btn-primary btn" data-clipboard-text="$contacts->first()->addres_b">Копировать</button>
                                <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Изменить
                                    </button>
                        </div>
                        <div class="contact-info-item">
                            <span>Электронная почта:</span>
                            <input type="text" name="mail" id="mail" class="form-control" value="{{ $contacts->first()->mail }}">
                            <button type="submit" class="btn btn-primary mt-2">
                                        <i class="fa fa-plus"></i> Изменить
                                    </button>
                        </div>

                        <div class="contact-info-item">
                            <span>График работы:</span>
                            <input type="text" name="grafic" id="grafic" class="form-control" value="{{ $contacts->first()->grafic }}">
                            <button type="submit" class="btn btn-primary mt-2">
                                        <i class="fa fa-plus"></i> Изменить
                                    </button>
                        </div>
                    </form>
                        <div class="contact-info-item col-sm-9">
    <span>Служба поддержки:</span><br><strong>WhatsApp:</strong>

    @foreach ($contacts as $contact)
        <form action="{{ route('update2.contact', $contact) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PATCH')
            @if ($contact->whatsapp != null)
            <div style="display: flex; flex-direction: row; justify-content: start; align-items: center;">
                    +996- <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ $contact->whatsapp }}"></div>
                    <div style="display: flex; flex-direction: row; justify-content: start; align-items: center;"><button type="submit" class="btn btn-primary mt-2 mb-2">
                        Изменить
                    </button></form><form action="{{ route('del1.contact', $contact) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PATCH') <!-- Используйте DELETE вместо PATCH для удаления -->
            <button type="submit" class="btn btn-danger mt-2 mb-2 ml-2">
                Удалить
            </button>
        </form>
                </div>
            @endif



    @endforeach

                    <form action="{{ route('create.contact') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="" style="display: flex;flex-direction: row; justify-content: center; align-items: center; ">+996- <input type="text" name="whatsapp" id="whatsapp" class="form-control "><button type="submit" class="btn btn-primary mt-2 mb-2">
                                        <i class="fa fa-plus"></i> Добавить
                                    </button></div>


                </form>
                    <br><strong>Tel:</strong>
                            @foreach ($contacts as $contact)
        <form action="{{ route('update2.contact', $contact) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PATCH')
            @if ($contact->tel != null)
                <div style="display: flex; flex-direction: row; justify-content: start; align-items: center;">
                    +996- <input type="text" name="tel" id="tel" class="form-control" value="{{ $contact->tel }}"></div>
                    <div style="display: flex; flex-direction: row; justify-content: start; align-items: center;">
                    <button type="submit" class="btn btn-primary mt-2 mb-2">
                        Изменить
                    </button></form><form action="{{ route('del2.contact', $contact) }}" method="POST" class="form-horizontal">
            @csrf
            @method('PATCH') <!-- Используйте DELETE вместо PATCH для удаления -->
            <button type="submit" class="btn btn-danger mt-2 mb-2 ml-2">
                Удалить
            </button>
        </form>
                </div>
            @endif



    @endforeach
                    <form action="{{ route('create.contact') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="" style="display: flex;flex-direction: row; justify-content: center; align-items: center; ">+996- <input type="text" name="tel" id="tel" class="form-control "><button type="submit" class="btn btn-primary mt-2 mb-2">
                                        <i class="fa fa-plus"></i> Добавить
                                    </button></div>


                </form>

                    @else
                    <div class="contact-info">

                        <div class="contact-info-item">
                            <span>Адрес склада пункта А:</span><br><br>
                            <p>
                                {{ $contacts->first()->addres_a }}<br><br>
                                <button class="copy-button btn-primary btn" data-clipboard-text="$contacts->first()->addres_a">Копировать</button>
                            </p>
                        </div>

                        <div class="contact-info-item">
                            <span>Адрес головного офиса выдачи:</span><br><br>
                            <p>
                                {{ $contacts->first()->addres_b }} <br><br>
                                <button class="copy-button btn-primary btn" data-clipboard-text="$contacts->first()->addres_b">Копировать</button>
                            </p>
                        </div>

                        <div class="contact-info-item">
                            <span>Служба поддержки:</span><br><p>WhatsApp:</p>
                            @foreach ($contacts as $c)
                            @if ($c->whatsapp!=null)
                    <a href="https://wa.me/+996{{$c->whatsapp}}">+996 {{$c->whatsapp}}</a><br>
                    @endif
                    @endforeach
                    <br><p>Tel:</p>
                            @foreach ($contacts as $c)
                            @if ($c->tel!=null)
                            <a href="tel:+996{{$c->tel}}">+996 {{$c->tel}}</a><br>
                    @endif
                    @endforeach
                    <br>
                            <a href="mailto:{{$contacts->first()->mail}}">{{ $contacts->first()->mail }}</a><br>
                        </div>

                        <div class="contact-info-item">
                            <span>График работы:</span>
                            <p>{{$contacts->first()->grafic}}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Include Clipboard.js script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <script>
        // Initialize Clipboard.js
        var clipboard = new ClipboardJS('.copy-button');

        // Show a message when copying is successful
        clipboard.on('success', function (e) {
            alert('Скопировано в буфер обмена: ' + e.text);
        });

        // Show a message when copying fails
        clipboard.on('error', function (e) {
            alert('Не удалось скопировать текст. Воспользуйтесь функцией копирования вашего браузера.');
        });
    </script>
</body>
</x-app-layout>
