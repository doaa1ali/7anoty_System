@extends('Layout.master')

@section('Show-Books')
    <main>
    
        <div class="container">
            <div class="show">
                <img src="{{ asset('uploads/author/images/' . $author->profile_image) }}" >
            </div>

            <div>
                <h3>{{ $author->name }}</h3>
                <span>{{ $author->email }}</span>
            </div><br>

            <div class="author-details">
                <h3>Bio:</h3>
                <p class="bio">{{ $author->bio }}</p>

                <h3>Job Description:</h3>
                <p class="job-description">{{ $author->job_description }}</p>
                
                <h3>Books:</h3>
                @if($author->books->isEmpty())
                    <p>No books available for this author.</p>
                @else
                    <ul class="book-list">
                        @foreach($author->books as $book)
                            <li class="book-item">
                                <span class="book-title">{{ $book->name }}</span> 
                                <span class="book-price">${{ $book->price }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="buttons-container">
                <a href="{{ route('author.edit', $author->id) }}" class="save">Edit</a> 
                <a href="{{ route('author.index')}}" class="cancel">Back</a>
            </div>

        </div>
    </main>
@endsection
