
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
                    <div class="alert alert-success mt-4">
                        {{session('status')}}
                    </div>
                @endif
                <a href="{{route('add-post')}}" class="btn btn-success mb-4">Add new article</a>
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <h5 class="card-header"> {{$post->name}}</h5>
                        <div class="card-body">
                            <p>{{$post->created_at}}</p>
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{$post->text}}</p>
                            <a href="{{route('edit-post', $post->id)}}" class="btn btn-primary"> Edit</a>
                            <form action="{{route('delete-post', $post->id)}}" method="post" style="display:inline-block">
                            @csrf
                                @method('DELETE')

                            <button type="submit" class="btn btn-danger"> Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
