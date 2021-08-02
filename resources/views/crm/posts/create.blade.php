@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::open(['url'=>route('crm.posts.store'),'method'=>'POST'])}}

                @include('crm.posts._form')

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
