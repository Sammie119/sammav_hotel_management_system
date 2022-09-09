<form action="store_tax" method="POST" autocomplete="off">
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->first_0 }}" name="first_0" type="number" step="0.01" min="0" required placeholder=" " />
                <label>First - 0%</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->next_5 }}" name="next_5" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Next - 5%</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->next_10}}" name="next_10" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Next - 10%</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->next_17_5 }}" name="next_17_5" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Next - 17.5%</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->next_25 }}" name="next_25" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Next - 25%</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->exceeding }}" name="exceeding" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Exceeding - 30%</label>
            </div>
        </div>
    </div>

    <div>
        <h6>SSNIT</h6>
    </div>

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->ssf_employer }}" name="ssf_employer" type="number" step="0.01" min="0" required placeholder=" " />
                <label>SSF Employer</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ $tax->ssf_employee }}" name="ssf_employee" type="number" step="0.01" min="0" required placeholder=" " />
                <label>SSF Employee</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Send SMS</button></div>
    </div>
</form>