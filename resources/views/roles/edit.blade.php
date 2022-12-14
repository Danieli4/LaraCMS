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
                <form method="post" action="{{route('roles.update',$role->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail">Title</label>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="name" value="{{$role->name}}" class="form-control" id="exampleInputEmail">
                    </div>
                    @error('permissions')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @foreach($permissions as $permission)
                        <div class="form-group form-check">
                            <input type="checkbox" name="permissions" value="{{$permission->id}}"
                                   @if($role->hasPermissionTo($permission->name))
                                       checked
                                   @endif
                                   name="permissions[]" class="form-check-input" id="exampleCheck{{$permission->id}}">
                            <label class="form-check-label" for="exampleCheck{{$permission->id}}">{{$permission->name}}</label>

                        </div>
                    @endforeach


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>

    </div>

</x-app-layout>
