<form action="store_price" method="POST" autocomplete="off">
    @csrf
    @isset($setprice)
        <input type="hidden" name="id" value="{{ $setprice->price_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($setprice)) ? $setprice->service : null }}" type="text" readonly placeholder=" " />
                <label>Service Name</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($setprice)) ? $setprice->price : null }}" name="price" type="number" min="0" step="0.1" required placeholder=" " />
                <label>Price</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>