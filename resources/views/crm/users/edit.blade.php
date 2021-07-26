@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{Form::model($user, ['method'=>'PATCH', 'url'=>route('crm.users.update', $user)])}}

                @include('crm.users._form', $user)

                <button class="btn btn-success">Сохранить</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
