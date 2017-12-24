@extends('layouts.app')

@section('content')
<div class="container">
    <section class="row text-center placeholders">
    	@php
    	use App\Models\Sandwitch;
    	use App\Models\Boisson;
    	use App\Models\Dessert;
    	@endphp
            <div class="col-6 col-sm-4 placeholder">
              <h4>{{Sandwitch::count()}}</h4>
              <div class="text-muted">Nombre de Sandwitches</div>
            </div>
            <div class="col-6 col-sm-4 placeholder">
              <h4>{{Boisson::count()}}</h4>
              <span class="text-muted">Nombre de Boissons</span>
            </div>
            <div class="col-6 col-sm-4 placeholder">
              <h4>{{Dessert::count()}}</h4>
              <span class="text-muted">Nombre de Desserts</span>
            </div>
          </section>
</div>
@endsection
