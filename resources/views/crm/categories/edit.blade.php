@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{Form::model($category, ['method'=>'PATCH', 'url'=>route('crm.categories.update', $category)])}}

                @include('crm.categories._form', $category)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
