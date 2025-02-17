@extends('Layout.master')

@section('Show-Books')

    <div class="page-header">
        <h1>Authors Table</h1>
        <div class="header-actions">
            <button class="create-btn">
                <a href="{{ route('author.create') }}">
                    <span class="fas fa-plus"></span> Create New Author
                </a>
            </button>
            <form action="{{route('author.search')}}" method="GET" class="search-container">
                <input type="text" name="query" id="searchInput" placeholder="Enter Author Name...">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>    
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th> Name </th>
                    <th>Email</th>
                    <th>Profile Image </th>
                    <th>Bio</th>
                    <th>Job Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->email }}</td>
                        <td>
                            @if($author->profile_image)
                                <img src="{{ asset('uploads/author/images/' . $author->profile_image) }}"  width="80" height="80" style="border-radius: 50%; ">
                            @else                   
                                <p>No Image</p>
                            @endif
                        </td>
                        <td>{{ $author->bio }}</td>
                        <td>{{ $author->job_description }}</td>
                        <td class="actions">
                            <a href="" class="show-btn">Show</a>
                            <a href="" class="edit-btn">Edit</a>
                            <form action="{{ route('author.delete', $author->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this Author?')">Delete</button>
                            </form> 
                        </td>
                    </tr>
                @endforeach   
            </tbody>
        </table>
    </div>

@endsection
