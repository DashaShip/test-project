@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{Form::model($product, ['method'=>'PATCH', 'url'=>route('crm.products.update', $product),'files'=>true])}}

                @include('crm.products._form', $product)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
