@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Eccuerd!</h3>
    @foreach ($errors ->all() as $error)
    <li>
        {{$error}}
    </li>
    @endforeach
</div>
@endif
<div class="form-group">
       <label for="">Category Name</label>
       <input type="text" value="{{$category->name}}" name="name" class = "form-control"/>
    </div>

    <div class="form-group">
        <label for="">Category Parent</label>
        <select name = "parent_id" class = "form-control">
            <option value="">Primary Category</option>
            @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @if(old('parent_id') == $parent->id) selected @endif>
    {{ $parent->name }}
</option>

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>description</label>
        <textarea  name = "description" class = "form-control">{{old('description', $category->description)}}</textarea>
    </div>

    <div class="form-group">
        <x-form.label for="image">Image</x-form.label>
        <x-form.input type="file" name="image" class="form-control" />
        @if ($category->image)
          <img src = "{{asset ('storage/' . $category->image) }}" alt = "" height = "50" >
        @endif
    </div>

<div class="form-group">
  <label for="">status</label>
  <div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status') == 'active')>
      <label class="form-check-label">
        active
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status') == 'archived')>
      <label class="form-check-label">
      archived
      </label>
    </div>
  </div>
</div>


    <div class="form-group">
        <button type="submit" name = "save" class="btn btn-primary">save</button>
    </div>
