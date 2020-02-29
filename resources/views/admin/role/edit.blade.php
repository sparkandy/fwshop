@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
             <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    @include('admin.include.sidemenu')
                </div>
               

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{ $role->name }}</div>
                <!-- <div class="card-header">List of Users</div> -->

                 <div class="card-body">
                    <form method="POST" action="{{ url('/fw/role/edit') }}">
                        @csrf
                        <input id="name" type="hidden"  name="roleId" value="{{ $role->id }}" >


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                              
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Permissions</label>

                            <div class="col-md-6">
                                <!-- <input id="name" type="text" class="form-control @error('permissions') is-invalid @enderror" name="permission" value="{{ old('permissions') }}" required autofocus> -->
                                @foreach($permissions as $permission)
                                    <div class="form-check form-check-inline">
                                        @if ($role->permissions->where('id', $permission->id)->count() > 0)
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permissions[]" value="{{ $permission->id }}" checked='checked'>
                                            @else 
                                             <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="permissions[]" value="{{ $permission->id }}">
                                        @endif
                                        <label class="form-check-label" for="inlineCheckbox1">{{ $permission->display_name }}</label>
                                    </div>
                                @endforeach
                              
                                @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
