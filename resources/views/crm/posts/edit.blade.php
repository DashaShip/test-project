@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{Form::model($post, ['method'=>'PATCH', 'url'=>route('crm.posts.update', $post),'files'=>true])}}

                @include('crm.posts._form', $post)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
