@include('forms._input', [
    'label'=>'Имя',
    'name'=>'name',
    'type'=>'text',
    'placeholder'=>'Введите имя',
    'value'=>isset($user) ? $user->getName() : '',
])

@include('forms._input', [
    'label'=>'Email',
    'name'=>'email',
    'type'=>'email',
    'placeholder'=>'Введите email',
    'value'=>isset($user) ? $user->getEmail() : '',
 ])

@include('forms._input', [
    'label'=>'Пароль',
    'name'=>'password',
    'type'=>'password',
    'placeholder'=>'Введите пароль',
    'value'=> '',
 ])

@include('forms._multiselect', [
    'label'=>'Выбрать роль',
    'list'=>\App\Models\Role::pluck('name','id'),
    'name'=>'roles[]',
    'selected'=>isset($user) ? $user->getRoles()->pluck('name','id'):[],
    'required'=>'required',
])

