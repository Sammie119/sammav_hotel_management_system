<form action="store_sms" method="POST" autocomplete="off">
    @csrf
    {{-- @isset($message)
        <input type="hidden" name="id" value="{{ $message->message_id }}" />
    @endisset --}}
    <label>Message:</label>
    <div class="form-floating mb-3">
        <textarea name="message" rows="5" style="width: 100%">{{ (isset($message)) ? substr($message->message, 15) : null }}</textarea>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" name="all_guests" type="checkbox" value="all_guests" id="flexAll_guests" onchange="getAllGuest()">
        <label class="form-check-label" for="flexAll_guests">
            Send to all Guests
        </label>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" name="all_staff" type="checkbox" value="all_staff" id="flexAll_staff" onchange="getAllStaff()">
        <label class="form-check-label" for="flexAll_staff">
            Send to all Staff
        </label>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"><strong>Receivers</strong></a>
        </li>
        <input type="text" class="form-control" list="staff_name" placeholder="Type to add recipient name" id="recipient_name" style="width: 60%; margin-left: 30px; margin-bottom: 2px;">
        <button type="button" class="btn btn-success add-all-receiver" style="margin-left: 30px; border-radius: 40px; margin-bottom: 2px;" > <i class="fas fa-plus"></i> Add Receiver</button> 
        <datalist id="staff_name">
            @forelse (\App\Models\VWStaff::orderBy('fullname')->get() as $name)
                <option>{{ $name->fullname }}</option>
            @empty
                <option value="" disabled selected>No Data Found</option>
            @endforelse
            @forelse (\App\Models\Customer::orderBy('name')->get() as $name)
                <option>{{ $name->name }}</option>
            @empty
                <option value="" disabled selected>No Data Found</option>
            @endforelse
        </datalist>
    </ul>

    <div class="row mt-2">
        <div class="col-md-8">Receiver's Name</div>
        <div class="col-md-3">Phone</div>
        <div class="col-md-1">Action</div>
    </div>
    
    <div class="add-receiver">

        <div class="row mt-2 no_data">
            <div class="col-md-12">
                No data Found
            </div>
        </div>
        
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Send SMS</button></div>
    </div>
</form>

<script>
    function remove(input) {
        input.parentNode.parentElement.remove()
    }

    function getAllGuest(){
        if(document.getElementById('flexAll_guests').checked == true){
            document.getElementById('recipient_name').disabled = true;
        }
        else {
            if(document.getElementById('flexAll_staff').checked == true){
                document.getElementById('recipient_name').disabled = true;
            }
            else{
                document.getElementById('recipient_name').disabled = false;
            }
        }
    }

    function getAllStaff(){
        if(document.getElementById('flexAll_staff').checked == true){
            document.getElementById('recipient_name').disabled = true;
        }
        else {
            if(document.getElementById('flexAll_guests').checked == true){
                document.getElementById('recipient_name').disabled = true;
            }
            else{
                document.getElementById('recipient_name').disabled = false;
            }
        }
    }
</script>