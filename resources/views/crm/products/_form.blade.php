@include('forms._input', [
    'label'=>'Имя продукта', //
    'name'=>'name',
    'type'=>'text',
    'placeholder'=>'Введите имя продукта',
    'value'=>isset($product) ? $product->getName() : '',
])

@include('forms._input', [
    'label'=>'Описание',
    'name'=>'description',
    'type'=>'text',
    'placeholder'=>'Введите описание',
    'value'=>isset($product) ? $product->getDescription() : '',
 ])

@include('forms._input', [
    'label'=>'Цена',
    'name'=>'price',
    'type'=>'number',
    'placeholder'=>'Цена',
    'value'=>isset($product) ? $product->getPrice() : '',
 ])

@include('forms._file', [
    'label'=>'Фотография',
    'name'=>'file',
 ])
