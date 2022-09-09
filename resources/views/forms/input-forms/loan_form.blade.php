<form action="store_loan" method="POST" autocomplete="off">
    @csrf
    @isset($loan)
        <input type="hidden" name="id" value="{{ $loan->loan_id }}">
    @endisset
    
    <div class="form-floating mb-3">
        <input class="form-control bg-white staff" value="{{ (isset($loan)) ? $staff->fullname : null }}" id=""  list="staff_name" type="text" required placeholder=" " />
        <label>Staff Name</label>

        <datalist id="staff_name">
            @forelse (\App\Models\VWStaff::orderBy('fullname')->get() as $name)
                <option>{{ $name->fullname }}</option>
            @empty
                <option value="" disabled selected>No Data Found</option>
            @endforelse
        </datalist>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <select class="form-control" name="description" required placeholder=" " >
                    <option value="" selected disabled>--Select--</option>
                    @forelse (\App\Models\Dropdown::where('category_id', 6)->get() as $dropdown)
                        <option {{ (isset($loan) && $loan->description === $dropdown->dropdown_name) ? 'selected' : null }}>{{ $dropdown->dropdown_name }}</option>
                    @empty
                        <option value="" disabled selected>No Data Found</option>
                    @endforelse
                </select>
                <label>Loan Description</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control bg-white" id="position" value="{{ (isset($loan)) ? $staff->position : null }}" type="text" readonly placeholder=" " />
                <label>Position</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" type="number" value="{{ (isset($loan)) ? $staff->salary : null }}" id="basic_salary" name="basic_salary" readonly placeholder=" " />
                <label>Basic Salary</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ (isset($loan)) ? $loan->amount : null }}" type="number" min="0" step="0.01" name="amount" required placeholder=" " />
                <label>Loan Amount</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ (isset($loan)) ? $loan->amount_per_month : null }}" type="number" min="0" step="0.01" name="amount_per_month" required placeholder=" " />
                <label>Amount Per Month</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input class="form-control bg-white" value="{{ (isset($loan)) ? $loan->number_of_months : null }}" type="number" min="1" step="1" name="number_of_months" required placeholder=" " />
                <label>Number of Months</label>
            </div>
        </div>
    </div>

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>

    <input type="hidden" name="staff_id" id="staff_id" >
</form>
