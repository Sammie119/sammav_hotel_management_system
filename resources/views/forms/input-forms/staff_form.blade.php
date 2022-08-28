<form action="store_staff" method="POST" autocomplete="off">
    @csrf
    @isset($staff)
        <input type="hidden" name="id" value="{{ $staff->staff_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->firstname : null }}" name="firstname" type="text" required placeholder=" " />
                <label>First Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->othernames : null }}" name="othernames" type="text" required placeholder=" " />
                <label>Other Names</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col-8">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" value="{{ (isset($staff)) ? $staff->date_of_birth : null }}" name="date_of_birth" id="dob" max="<?php echo date('Y-m-d'); ?>" type="date" required placeholder=" " />
                        <label>Date of Birth</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control bg-white" value="{{ (isset($staff)) ? \App\Models\VWStaff::where('staff_id', $staff->staff_id)->first('age')->age : 0 }}" id="age" type="text" readonly placeholder=" " />
                        <label>Age</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->phone : null }}" name="phone" type="number" required placeholder=" " />
                <label>Phone Number</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($staff)) ? $staff->address : null }}" name="address" type="text" placeholder=" " />
        <label>Address</label>
    </div>

    @empty($staff)
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select class="form-control" name="department_id" required placeholder=" " >
                        <option value="" disabled selected>Department</option>
                        @forelse (\App\Models\Dropdown::where('category_id', 1)->get() as $dropdown)
                            <option value="{{ $dropdown->dropdown_id }}">{{ $dropdown->dropdown_name }}</option>
                        @empty
                            <option value="" disabled selected>No Data Found</option>
                        @endforelse
                    </select>
                    <label>Department</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select class="form-control" name="position_id" required placeholder=" " >
                        <option value="" disabled selected>Position</option>
                        @forelse (\App\Models\Dropdown::where('category_id', 2)->get() as $dropdown)
                            <option value="{{ $dropdown->dropdown_id }}">{{ $dropdown->dropdown_name }}</option>
                        @empty
                            <option value="" disabled selected>No Data Found</option>
                        @endforelse
                    </select>
                    <label>Position</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-control" name="salary_type_id" required placeholder=" " >
                        <option value="" disabled selected>Salary Type</option>
                        @forelse (\App\Models\Dropdown::where('category_id', 3)->get() as $dropdown)
                            <option value="{{ $dropdown->dropdown_id }}">{{ $dropdown->dropdown_name }}</option>
                        @empty
                            <option value="" disabled selected>No Data Found</option>
                        @endforelse
                    </select>
                    <label>Salary Type</label>
                </div>
            </div>
        </div>
    @endempty
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="level_of_education" required placeholder=" " >
                    <option value="" selected disabled>Level of Education</option>
                    <option @if (isset($staff) && $staff->level_of_education === 'None') selected @endif >None</option>
                    <option @if (isset($staff) && $staff->level_of_education === 'Basic') selected @endif >Basic</option>
                    <option @if (isset($staff) && $staff->level_of_education === 'Secnodary') selected @endif >Secnodary</option>
                    <option @if (isset($staff) && $staff->level_of_education === 'Tertiary') selected @endif >Tertiary</option>
                </select>
                <label>Level of Education</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->qualification : null }}" type="text" name="qualification" placeholder=" " />
                <label>Qualification</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->relative_name : null }}" type="text" name="relative_name" placeholder=" " />
                <label>Relative Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->relative_contact : null }}" type="number" name="relative_contact" placeholder=" " />
                <label>Relative Number</label>
            </div>
        </div>
    </div>

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>