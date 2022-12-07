<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <form method="post" action="{{route('update-post', $post->id)}}">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail">Title</label>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="name" value="{{$post->name}}" class="form-control" id="exampleInputEmail">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Text</label>

                        @error('text')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <textarea name="text"  class="form-control" id="exampleFormControlTextarea1" rows="10">{{$post->text}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>

    </div>

</x-app-layout>
