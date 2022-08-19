<form action="store_customer" method="POST" autocomplete="off">
    @csrf
    @isset($customer)
        <input type="hidden" name="id" value="{{ $customer->customer_id }}" />
    @endisset
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($customer)) ? $customer->name : null }}" name="name" type="text" required placeholder=" " />
        <label>Customer Name</label>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->phone : null }}" name="phone" required type="number" placeholder=" " />
                <label>Phone</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->location : null }}" name="location" type="text" placeholder=" " />
                <label>Location</label>
            </div>
        </div>
    </div>
    
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($customer)) ? $customer->email : null }}" name="email" type="email" placeholder=" " />
        <label>Email</label>
    </div>
    
    <hr width="104%" style="margin-left: -15px; backgroung: #ddd">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>