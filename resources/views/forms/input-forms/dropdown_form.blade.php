<form action="store_dropdown" method="POST" autocomplete="off">
    @csrf
    @isset($dropdown)
        <input type="hidden" name="id" value="{{ $dropdown->dropdown_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($dropdown)) ? $dropdown->dropdown_name : null }}" name="dropdown_name" type="text" required placeholder=" " />
                <label>Dropdown Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="category_id" required >
                    <option value="" disabled selected>Category</option>
                    @foreach (\App\Models\DropdownCategory::all() as $cat)
                        <option value="{{ $cat->category_id }}" @if (isset($dropdown) && $dropdown->category_id === $cat->category_id) selected @endif>{{ $cat->category }}</option>
                    @endforeach
                </select>
                <label>Category</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; backgroung: #ddd">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>