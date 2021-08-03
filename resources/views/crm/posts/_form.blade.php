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

@if (isset($post))
    Подробное описание
    @trix($post,'content')
@else
    Подробное описание
    @trix(\App\Models\Post::class, 'content')
@endif

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
    'value'=>isset($post)?$post->getPublishedAt()->format('Y-m-d\TH:i'):'',
])
