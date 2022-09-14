<form action="store_salary" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $staff->salary_id }}">
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ $staff->fullname }}" name="firstname" type="text" readonly placeholder=" " />
        <label>Staff Name</label>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="department_id" required placeholder=" " >
                    <option value="{{ $staff->department_id }}" selected>{{ $staff->department }}</option>
                    @forelse (\App\Models\Dropdown::where('category_id', 1)->get() as $dropdown)
                        <option value="{{ $dropdown->dropdown_id }}">{{ $dropdown->dropdown_name }}</option>
                    @empty
                        <option value="" disabled selected>No Data Found</option>
                    @endforelse
                </select>
                <label>Department</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="salary_type_id" required placeholder=" " >
                    <option value="{{ $staff->salary_type_id }}" selected>{{ $staff->salary_type }}</option>
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
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="position_id" required placeholder=" " >
                    <option value="{{ $staff->position_id }}" selected>{{ $staff->position }}</option>
                    @forelse (\App\Models\Dropdown::where('category_id', 2)->get() as $dropdown)
                        <option value="{{ $dropdown->dropdown_id }}">{{ $dropdown->dropdown_name }}</option>
                    @empty
                        <option value="" disabled selected>No Data Found</option>
                    @endforelse
                </select>
                <label>Position</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $staff->salary }}" type="number" min="0" step="0.01" name="salary" required placeholder=" " />
                <label>Basic Salary</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $staff->ssnit_number }}" type="text" name="ssnit_number" placeholder=" " />
                <label>SSNIT Number</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $staff->banker }}" type="text" name="banker" placeholder=" " />
                <label>Bank Name</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $staff->bank_branch }}" type="text" name="bank_branch" placeholder=" " />
                <label>Bank Branch</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $staff->bank_account }}" type="number" name="bank_account" placeholder=" " />
                <label>Bank Account Number</label>
            </div>
        </div>
    </div>

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>