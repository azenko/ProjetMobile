<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sandwitch Generator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{asset('css/home.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height" id="page">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Votre Menu
                </div>

                @php
                    use App\Models\Sandwitch;
                    $sandwitches = Sandwitch::all()->random(1);

                    use App\Models\Boisson;
                    $boissons = Boisson::all()->random(1);

                    use App\Models\Dessert;
                    $desserts = Dessert::all()->random(1);

                    $form_pricing = 0;
                    $form_pricing += $sandwitches[0]->price;
                    $form_pricing += $boissons[0]->price;
                    $form_pricing += $desserts[0]->price;
                @endphp

                <div class="links">
                    <a href="#">{{$sandwitches[0]->label}} - {{$sandwitches[0]->price/100}} €</a>
                    <a href="#">{{$boissons[0]->label}} - {{$boissons[0]->price/100}} €</a>
                    <a href="#">{{$desserts[0]->label}} - {{$desserts[0]->price/100}} €</a>
                    <a href="#">Total : {{$form_pricing/100}} €</a>
                </div>
            </div>
        </div>

        <script src="{{asset('js/konami.js')}}"></script>
        <script src="{{asset('js/konamirun.js')}}"></script>

    </body>
</html>
