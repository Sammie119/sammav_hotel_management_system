<form action="store_payroll" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="staff_id" value="{{ $staff->staff_id }}">
    <div class="form-floating mb-3">
        <input class="form-control bg-white" value="{{ $staff->fullname }}" type="text" readonly placeholder=" " />
        <label>Staff Name</label>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" required placeholder=" " >
                    <option selected>{{ $staff->department }}</option>
                </select>
                <label>Department</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" required placeholder=" " >
                    <option selected>{{ $staff->salary_type }}</option>
                </select>
                <label>Salary Type</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" required placeholder=" " >
                    <option selected>{{ $staff->position }}</option>
                </select>
                <label>Position</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ $staff->salary }}" type="number" name="basic_salary" readonly placeholder=" " />
                <label>Basic Salary</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ $staff->salary }}" type="number" min="0" step="0.01" name="tax" required placeholder=" " />
                <label>Income/PAYE Tax</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ $staff->salary }}" type="number" min="0" step="0.01" name="employer_ssf" required placeholder=" " />
                <label>Employer SSF</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ $staff->salary }}" type="number" min="0" step="0.01" name="ssf_employee" required placeholder=" " />
                <label>SSF Employee</label>
            </div>
        </div>
    </div>

    <hr width="104%" style="margin-left: -15px; background: #bbb">
    
    @include('includes.add-salary-payment-display', [
        'header' => 'Allowances',
        'first_class' => 'add-all-allowances', //Main container
        'second_class' => 'add-allowance',
        'no_data' => 'allowance', //No data found disappear
        ])

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    @include('includes.add-salary-payment-display', [
        'header' => 'Deductions',
        'first_class' => 'add-all-deduction', //Main container
        'second_class' => 'add-deduction',
        'no_data' => 'deduction', //No data found disappear
        ])

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>
