@extends(Auth()->user()->role === 2 ? 'layouts.admin.app' : 'layouts.user.app')

@section('title', 'HMS | User Profile')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">User Profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User Profile</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
        
            <div class="card-body">
                <form action="store_profile" method="POST" autocomplete="off">
                    @csrf
                    @isset($user)
                        <input type="hidden" name="id" value="{{ $user->user_id }}" />
                    @endisset
                    <div class="form-floating mb-3">
                        <input class="form-control" value="{{ (isset($user)) ? $user->name : null }}" name="name" type="text" required placeholder=" " />
                        <label>Name</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" value="{{ (isset($user)) ? $user->username : null }}" name="username" type="text" required placeholder=" " />
                                <label>Username</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" name="role" required >
                                    <option value="{{ $user->role }}" selected>{{ getUserRole($user->role) }}</option>
                                </select>
                                <label>Role</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-control" name="department" required placeholder=" " >
                                    @php
                                       $department = \App\Models\Dropdown::find($user->department);
                                    @endphp
                                    <option value="{{ $department->dropdown_id }}" selected>{{ $department->dropdown_name }}</option>
                                </select>
                                <label>Department</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" name="position" required placeholder=" " >
                                    @php
                                       $position = \App\Models\Dropdown::find($user->position);
                                    @endphp
                                    <option value="{{ $position->dropdown_id }}" selected>{{ $position->dropdown_name }}</option>
                                </select>
                                <label>Position</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" value="{{ (isset($user)) ? $user->p_contact : null }}" type="number" name="p_contact" required placeholder=" " />
                                <label>Personal Contact</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" value="{{ (isset($user)) ? $user->o_contact : null }}" type="number" name="o_contact" placeholder=" " />
                                <label>Office Contact</label>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" type="password" name="password" placeholder=" " />
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" type="password" name="confirm_password" placeholder=" " />
                                <label>Confirm Password</label>
                            </div>
                        </div>
                    </div>
                 
                
                    <hr width="100%" style="background: #bbb">
                
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection