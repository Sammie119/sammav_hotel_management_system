@extends('layouts.admin.app')

@section('title', 'HMS | Payroll')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Payroll/Payment</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Salary Setup</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Payment List
                <button class="btn btn-sm sammav-btn float-end create" value="new_salary" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add Payment</button>
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
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Salary Type</th>
                            <th>B. Salary</th>
                            <th>Allowances</th>
                            <th>Deductions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @forelse ($salary as $key => $salary)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $salary->fullname }}</td>
                                <td>{{ $salary->position }}</td>
                                <td>{{ $salary->salary_type }}</td>
                                <td>{{ $salary->salary }}</td>
                                <td>{{ "0.00" }}</td>
                                <td>{{ "0.00" }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm edit" value="{{ $salary->salary_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-success btn-sm edit" value="{{ $salary->salary_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm delete" value="{{ $salary->salary_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button>
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

                $('#getModal').on('shown.bs.modal', function () {

                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Salary Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_salary/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    
                    var id=$(this).val();
                    $.get('delete-modal/delete_room/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

            };
            
        </script>
        
    @endpush
@endsection