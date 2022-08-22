<form action="store_roomtype" method="POST" autocomplete="off">
    @csrf
    @isset($roomtype)
        <input type="hidden" name="id" value="{{ $roomtype->r_type_id }}" />
    @endisset
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($roomtype)) ? $roomtype->name : null }}" name="name" type="text" required placeholder=" " />
        <label>Room Type</label>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($roomtype)) ? $roomtype->description : null }}" name="description" type="text" required placeholder=" " />
        <label>Description</label>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>