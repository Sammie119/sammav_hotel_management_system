<form action="delete_tax/{{ $id }}" method="get">

    <p>Are you sure you want to delete this record?</p>

    <hr width="106.5%" style="margin-left: -15px; background: #bbb">

    <div class="float-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    </div>
</form>