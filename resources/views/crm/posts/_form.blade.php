@include('forms._input', [
    'label'=>'Название', //
    'name'=>'name',
    'type'=>'text',
    'placeholder'=>'Введите название статьи',
    'value'=>isset($post) ? $post->getName() : '',
])

@include('forms._input', [
    'label'=>'Описание',
    'name'=>'description',
    'type'=>'text',
    'placeholder'=>'Описание статьи',
    'value'=>isset($post) ? $post->getDescription() : '',
 ])

@include('forms._checkbox', [
    'label'=>'Большой?',
    'name'=>'super',
 ])

@include('forms._file',[
    'lable'=>'Превью',
    'name'=>'file',
    ]
)

@include('forms._file', [
    'label'=>'Картинка в статье',
    'name'=>'files[]', //для большого кол-ва картинок
    'attributes'=>['multiple'],
    ])

@include('forms._input', [
    'label'=>'Время публикации',
    'name'=>'published_at',
    'type'=>'datetime-local',
    'value'=>isset($post)?$post->getPublisheAt()->format('Y-m-d\TH:i'):'',
])
