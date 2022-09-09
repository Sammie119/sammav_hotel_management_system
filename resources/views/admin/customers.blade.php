@extends('layouts.admin.app')

@section('title', 'HMS | Guests')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Guests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Guests</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Guests List
                <button class="btn btn-sm sammav-btn float-end create" value="new_customer" data-bs-target="#getModal" data-bs-toggle="modal" title="New Dropdown">Add Guest</button>
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @forelse ($customers as $key => $customer)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->location }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm edit" value="{{ $customer->customer_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm delete" value="{{ $customer->customer_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button>
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
    @include('modals.confirm-modal')

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

                $('#editModal').on('shown.bs.modal', function () {

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('Add Guest');
                    
                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Customer');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_customer/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
                    
                    var id=$(this).val();
                    $.get('delete-modal/delete_customer/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

            };
            
        </script>
        
    @endpush
@endsection