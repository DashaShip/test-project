@include('forms._input', [
    'label'=>'Имя роли', //
    'name'=>'name',
    'type'=>'text',
    'placeholder'=>'Введите имя роли',
    'value'=>isset($role) ? $role->getName() : '',
])

@include('forms._input', [
    'label'=>'Полное имя роли',
    'name'=>'display_name',
    'type'=>'text',
    'placeholder'=>'Введите полное имя роли',
    'value'=>isset($role) ? $role->getDisplayName() : '',
 ])

@include('forms._input', [
    'label'=>'Описание',
    'name'=>'description',
    'type'=>'text',
    'placeholder'=>'Описание',
    'value'=>isset($role) ? $role->getDescription() : '',
 ])
