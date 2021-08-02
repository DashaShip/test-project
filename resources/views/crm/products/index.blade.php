@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                {{Form::open(['url'=>route('crm.products.index'),'method'=>'GET'])}}
                <div class="row">
                    <div class="col-10">
                        @include('forms._input', [
    'name'=>'search',
    'placeholder'=>'Продукты...',
])

                    </div>
                    <div class="col-2">
                        <button class="btn btn-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="row justify-content-start">
                    <div class="col-auto">
                        <a href="{{route('crm.products.create')}}" class="btn btn-success">
                            Создать новый продукт
                        </a>
                    </div>
                </div>
                <div class="row pb-2 mt-5">
                    <div class="col-12">
                        Список продуктов
                    </div>
                </div>
                <div class="row pb-2 mt-4">
                    <div class="col-1">
                        Id
                    </div>
                    <div class="col-1">
                        Имя
                    </div>
                    <div class="col-2">
                        Описание
                    </div>
                    <div class="col-2">
                        Цена
                    </div>
                    <div class="col-3">
                        Фото
                    </div>
                    <div class="col-3">
                        Действия
                    </div>
                </div>

                @forelse($products as $product)

                    <div class="row pb-2 mt-4">
                    <div class="col-1">
                        {{$product->getKey()}}
                    </div>
                    <div class="col-1">
                        {{$product->getName()}}
                    </div>
                        <div class="col-2">
                            {{$product->getDescription()}}
                        </div>
                        <div class="col-2">
                            {{$product->getPrice()}}
                        </div>
                        <div class="col-3">
                            <img src="{{$product-> getImagePath()}}" alt="" style="width: 100px">
                        </div>
                    <div class="col-1">
                        <a href="{{route('crm.products.edit', $product)}}" class="btn btn-success">
                            <l class="fas fa-pen"></l>
                        </a>
                    </div>
                    <div class="col-1">
                        {{Form::open(['method'=>'DELETE','url'=>route('crm.products.destroy',$product)])}}
                        <button class="btn btn-danger">
                            <l class="fas fa-trash"></l>
                        </button>
                        {{Form::close()}}
                    </div>

                    </div>
            @empty
                <div> Продуктов нет </div>
            @endforelse

            </div>
        </div>
    </div>
@endsection
