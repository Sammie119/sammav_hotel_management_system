@extends('layouts.admin.app')

@section('title', 'HMS | SMS')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">SMS</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">SMS</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                SMS List
                <button class="btn btn-sm sammav-btn float-end create" value="new_sms" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Send SMS</button>
                <button class="btn btn-sm sammav-btn float-end balance me-2" value="sms_balance" data-bs-target="#getSmallModal" data-bs-toggle="modal" title="New User">SMS Balance</button>
                <form class="d-flex float-end input-group-sm" role="search">
                    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" >
                    <button class="btn btn-sm me-2"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Message</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Sent by</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @forelse ($sms as $key => $sms)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ substr($sms->message, 15, 30) }}...</td>
                                <td>{{ substr(json_encode($sms->phone_numbers[0]), 0, 30) }}...</td>
                                <td>{{ $sms->created_at->format('d-m-Y') }}</td>
                                <td>{{ getUsername($sms->sent_by) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm view" value="{{ $sms->sms_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-success btn-sm edit" value="{{ $sms->sms_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                        {{-- <button class="btn btn-danger btn-sm delete" value="{{ $sms->sms_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button> --}}
                                    </div>
                                </td>
                            </tr> 
                        @empty
                            <tr>
                                <td colspan="25">No Data Found</td>
                            </tr> 
                        @endforelse
                                               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modals.medium-modal')
    {{-- @include('modals.confirm-modal') --}}
    @include('modals.small-modal')

    @push('scripts')
        <script>
            window.onload = function(){
                $('#search').focus();

            // Table filter
                $('#search').keyup(function(){  
                    search_table($(this).val());  
                });  
                function search_table(value){  
                    $('#employee_table tr').each(function(){  
                        var found = 'false';  
                        $(this).each(function(){  
                            if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){  
                                found = 'true';  
                            }  
                        });  
                        if(found == 'true'){  
                            $(this).show();  
                        }  
                        else{  
                            $(this).hide();  
                        }  
                    });  
                }  

                @if (Session::has('sms'))

                    $('#getSmallModal').modal('show');
                    
                    $('.modal-title').text('SMS Delivery Report');
                    
                    var sms={{ Session::get('sms') }};
                    $.get('delete-modal/sms_report/'+sms, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                @endif

                $('#getModal').on('shown.bs.modal', function () {

                    $(function(){
                        $(".add-all-receiver").on("click", function(){
                             
                            var recipient = document.getElementById('recipient_name').value;
                            // alert(recipient);
                            $.ajax({
                                type:'GET',
                                url:"get-sms-recipient",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    recipient
                                    },
                                success:function(data) {
                                    if(data.phone === 'No_data'){
                                        // Session::flash('error', '')
                                        toastr.options =
                                        {
                                        "closeButton" : true,
                                        "progressBar" : true
                                        }
                                        toastr.error("Selected name does not exist!!!!!");
                                    }
                                    else {
                                        toastr.options =
                                        {
                                        "closeButton" : true,
                                        "progressBar" : true
                                        }
                                        toastr.success("Name added Successfully!!!!!");

                                        if($(".add-receiver").length < 10){
                                            $(".add-receiver").append(
                                                `<div class="row mt-2">
                                                    <div class="col-md-8">
                                                        <div class="mb-md-0">
                                                            <select class="form-control" name="name[]" required placeholder=" " >
                                                                <option selected>${data.name}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-1">
                                                            <select class="form-control" name="phone_numbers[]" required >
                                                                <option>${data.phone}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button class="btn btn-danger btn-sm" onclick="remove(this)" style="margin-top: 3px"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>`
                                            );
                                        }
                                    }
                                }
                            });
                            
                            document.getElementById('recipient_name').value = '';
                            document.querySelector('.no_data').style.display='none';
                        });
                    });

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('Send Custom SMS');
                    
                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.balance', function(){
                    $('.modal-title').text('SMS Bundle Balance');
                    
                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Resend Custom SMS');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_sms/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.view', function(){
                    $('.modal-title').text('View Custom SMS');

                    var viewModal=$(this).val();
                    $.get('view-modal/view_sms/'+viewModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                // $(document).on('click', '.delete', function(){
                //     $('.modal-title').text('Delete Confirmation');
                    
                //     var id=$(this).val();
                //     $.get('delete-modal/delete_sms/'+id, function(result) {
                        
                //         $(".modal-body").html(result);
                        
                //     })
                // });

            };
            
        </script>
        
    @endpush
@endsection