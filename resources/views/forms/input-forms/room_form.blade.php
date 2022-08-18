<form action="store_room" method="POST" autocomplete="off">
    @csrf
    @isset($room)
        <input type="hidden" name="id" value="{{ $room->room_id }}" />
    @endisset
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($room)) ? $room->room_name : null }}" name="room_name" type="text" required placeholder=" " />
        <label>Room Name</label>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($room)) ? $room->room_number : null }}" name="room_number" type="text" required placeholder=" " />
                <label>Room Number</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="room_type_id" required >
                    <option value="" disabled selected>Room Type</option>
                    @foreach (\App\Models\RoomType::all() as $roomtype)
                        <option value="{{ $roomtype->r_type_id }}" @if (isset($room) && $roomtype->r_type_id === $room->room_type_id) selected @endif>{{ $roomtype->name }}</option>
                    @endforeach
                </select>
                <label>Room Type</label>
            </div>
        </div>
    </div>
    
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($room)) ? $room->description : null }}" name="description" type="text" required placeholder=" " />
        <label>Description</label>
    </div>
    
    <hr width="104%" style="margin-left: -15px; backgroung: #ddd">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
    </div>
</form>