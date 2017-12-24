@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Boisson
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($boisson, ['route' => ['boissons.update', $boisson->id], 'method' => 'patch']) !!}

                        @include('boissons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection