<form action="store_image" enctype="multipart/form-data" method="POST" autocomplete="off">
    @csrf
    @isset($image)
        <input type="hidden" name="id" value="{{ $image->image_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="room_type_id" required >
                    <option value="" disabled selected>Room Type</option>
                    @foreach (\App\Models\RoomType::all() as $roomtype)
                        <option value="{{ $roomtype->r_type_id }}" @if (isset($image) && $roomtype->r_type_id === $image->room_type_id) selected @endif>{{ $roomtype->name }}</option>
                    @endforeach
                </select>
                <label>Room Type</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($image)) ? $image->image_alt : null }}" name="image_alt" type="text" required placeholder=" " />
                <label>Image Alt</label>
            </div>
        </div>
    </div>
    @if (isset($image))
        <div class="form-floating mb-3">
            <input class="form-control"  name="image_src" multiple type="file" accept="image/*" placeholder=" " />
            <img src="{{ asset('storage/'.$image->image_src) }}" alt="{{ $image->image_alt }}">
        </div>
    @else
        <div class="form-floating mb-3">
            <input class="form-control" name="image_src[]" multiple type="file" accept="image/*" required placeholder=" " />
        </div>
    @endif
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>