<form action="register_user" method="POST" autocomplete="off">
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
                <input class="form-control" value="{{ (isset($user)) ? $user->username : null }}" name="username" type="text" required @if(isset($user)) readonly @endif placeholder=" " />
                <label>Username</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="role" required >
                    <option value="" disabled selected>User Role</option>
                    <option value="0" @if(isset($user) && ($user->role === 0)) selected @endif >{{ getUserRole(0) }}</option>
                    <option value="1" @if(isset($user) && ($user->role === 1)) selected @endif >{{ getUserRole(1) }}</option>
                </select>
                <label>Role</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="department" required placeholder=" " >
                    <option value="" disabled selected>Department</option>
                    @forelse (\App\Models\Dropdown::where('category_id', 1)->get() as $dropdown)
                        <option value="{{ $dropdown->dropdown_id }}" @if(isset($user) && $user->department === $dropdown->dropdown_id) selected @endif >{{ $dropdown->dropdown_name }}</option>
                    @empty
                        <option value="" disabled selected>No Data Found</option>
                    @endforelse
                </select>
                <label>Department</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="position" required placeholder=" " >
                    <option value="" disabled selected>Position</option>
                    @forelse (\App\Models\Dropdown::where('category_id', 2)->get() as $dropdown)
                        <option value="{{ $dropdown->dropdown_id }}" @if (isset($user) && $user->position === $dropdown->dropdown_id) selected @endif >{{ $dropdown->dropdown_name }}</option>
                    @empty
                        <option value="" disabled selected>No Data Found</option>
                    @endforelse
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

    @empty($user)
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" type="password" name="password" required placeholder=" " />
                    <label>Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" type="password" name="confirm_password" required placeholder=" " />
                    <label>Confirm Password</label>
                </div>
            </div>
        </div>
    @endempty

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>