@extends('layouts.dashboard');

@section('title' , 'Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Category</li>
@endsection

@section('content')
<div>
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary">Create</a>
    <a href="{{route('dashboard.categories.trash')}}" class="btn btn-dark">Trash</a>

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
            <th>Parent_name</th>
            <th>Status</th>
            <th>Created_At</th>
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
            <td>{{$category->parent_name}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at}}</td>
            <td><img src = "{{asset('storage/'. $category->image )}}" alt = "" height = '50'></td>

            <td>
                <a href="{{ route('dashboard.categories.edit',[$category->id]) }}">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.categories.destroy',[$category->id]) }}" method="post">
                  @csrf
                  <input type = "hidden" name = "_method" value = "delete">
                  <button type="submit" class = "btn btn-danger btn-sm btn-block">Delete</button>

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
