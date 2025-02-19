
@extends('Layout.master')

@section('Show-Books')
    <main>
        <div>
        <div class="container">

            <h1>Add New Author</h1>

            <form action="{{ route('author.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label for="name">Name of Author:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" >
                @error('name')
                    <p style="color: red; font-size: 14px; text-align: left;">{{ $message }}</p>
                @enderror

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" >
                @error('email')
                    <p style="color: red; font-size: 14px; text-align: left;">{{ $message }}</p>
                @enderror

                <label for="profile_image">Image for you:</label>
                <input type="file" id="profile_image" name="profile_image" value="{{ old('profile_image') }}" >
                @error('profile_image')
                    <p style="color: red; font-size: 14px; text-align: left;">{{ $message }}</p>
                @enderror

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio">{{ old('bio') }}</textarea>
                @error('bio')
                    <p style="color: red; font-size: 14px; text-align: left;">{{ $message }}</p>
                @enderror

                <label for="job_description">Job_Description:</label>
                <textarea id="job_description" name="job_description" >{{ old('job_description') }}</textarea>
                @error('job_description')
                    <p style="color: red; font-size: 14px; text-align: left;">{{ $message }}</p>
                @enderror

                <button type="submit" class="save">Save</button> 
                <button type="button" onclick="window.location.href='{{ route('author.index') }}';" class="cancel">Cancel</button>
            </form>
        </div>
    </main>
@endsection
