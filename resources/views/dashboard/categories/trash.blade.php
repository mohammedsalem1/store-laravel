@extends('layouts.dashboard');

@section('title' , 'Trash Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Category</li>
@endsection

@section('content')
<div>


  <x-alert type="success" />
  <x-alert type="info" />

  <form action = "{{URL::current()}}" method = "get" class="d-flex justify-content-between mb-4">
    <input type = "text" name = "name" placeholder = "Name" class = "form-control" value = "{{request('name')}}">
    <select name = "status" class = "form-control">
        <option value = "" >All</option>
        <option value  = "active"  @selected(request('status') == 'active')>active</option>
        <option value = "archived" @selected(request('status') == 'archived')>archived</option>
    </select>
      <button class = "btn btn-dark mx-2">
        Search
      </button>
  </form>

  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted_At</th>
            <th>image</th>

            <th colspan = '2'></th>
        </tr>
    </thead>
     <tbody>

        @if($categories->count())
        @foreach($categories as $category)
        <tr>

            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->deleted_at}}</td>
            <td><img src = "{{asset('storage/'. $category->image )}}" alt = "" height = '50'></td>

            <td>
            <form action="{{route('dashboard.categories.restore',[$category->id]) }}" method="post">
                  @csrf
                  @method('put')
                  <button type="submit" class = "btn btn-primary btn-sm btn-block">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{route('dashboard.categories.force-delete',[$category->id]) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class = "btn btn-danger btn-sm btn-block">forceDelete</button>
                </form>
            </td>
        </tr>
     </tbody>
     @endforeach
     @else
     <tr>
        <td colspan = "7">No category define</td>
     </tr>
     @endif
  </table>
  {{ $categories->withQueryString()->links() }}
@endsection
