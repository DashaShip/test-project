@include('forms._input', [
    'label'=>'Категория', //
    'name'=>'name',
    'type'=>'text',
    'placeholder'=>'Введите категирию',
    'value'=>isset($category) ? $category->getName() : '',
])

@include('forms._input', [
    'label'=>'Ссылка',
    'name'=>'slug',
    'type'=>'text',
    'placeholder'=>'Ссылка',
    'value'=>isset($category) ? $category->getSlug() : '',
 ])


@include('forms._select', [
    'name'=>'parent_id',
    'label'=>'Надкатегория',
    'list'=>$categoryList,
])
