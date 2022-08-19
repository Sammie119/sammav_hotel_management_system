<form action="delete_customer/{{ $id }}" method="get">

    <p>Are you sure you want to delete this Record?</p>

    <hr width="106.5%" style="margin-left: -15px; backgroung: #ddd">

    <div class="float-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
    </div>
</form>