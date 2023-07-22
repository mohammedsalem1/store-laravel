@props([
     'type' => 'text' , 'name' , 'id' , 'label' =>false
    ])
@if($label)
<label for ="">{{$label}}</label>
@endif
<input type="{{$type}}"
       name = "{{$name}}"
       @class([
            'form-control',
             'is-invalid' => $errors->has($name)
            ])
            value ="{{@old($name, $value)}}">

        @error($name)
         <div class="text-danger">
            {{$message}}
         </div>
         @enderror
