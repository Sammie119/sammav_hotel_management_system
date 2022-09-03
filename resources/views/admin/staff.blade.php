@extends('layouts.admin.app')

@section('title', 'HMS | Staff')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Staff</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Staff</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Staff List
                <button class="btn btn-sm sammav-btn float-end create" value="new_staff" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add Staff</button>
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
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Qualification</th>
                            <th>Department</th>
                            <th>Salary Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @forelse ($staff as $key => $staff)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $staff->fullname }}</td>
                                <td>{{ $staff->date_of_birth }}</td>
                                <td>{{ $staff->age }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>{{ $staff->qualification }}</td>
                                <td>{{ $staff->department }}</td>
                                <td>{{ $staff->salary_type }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm view" value="{{ $staff->staff_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-success btn-sm edit" value="{{ $staff->staff_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm delete" value="{{ $staff->staff_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button>
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
                    //Age Calculator
                    $('#dob').bind('change',function(){  
                        var lre = /^\s*/;
                        var datemsg = "";
                        
                        var inputDate = document.getElementById("dob").value;
                        inputDate = inputDate.replace(lre, "");
                        document.getElementById("dob").value = inputDate;
                        getAge(new Date(inputDate));
                        
                        function getAge(birth) {
                        
                            var today = new Date();
                            var nowyear = today.getFullYear();
                            var nowmonth = today.getMonth() + 1;
                            var nowday = today.getDate();
                        
                            var birthyear = birth.getFullYear();
                            var birthmonth = birth.getMonth() + 1;
                            var birthday = birth.getDate();
                        
                            var age = nowyear - birthyear;
                            var age_month = nowmonth - birthmonth;
                            var age_day = nowday - birthday;


                            if(age_month < 0 || (age_month == 0 && age_day < 0) ) {
                                    age = parseInt(age) -1;
                                    //age = age -1;
                                }
                            // document.getElementById("age").value = age;
                            $('#age').val(age);
                        
                        }
                    });

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('Add New Staff');
                    
                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Staff Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_staff/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.view', function(){
                    $('.modal-title').text('View Staff Details');

                    var viewModal=$(this).val();
                    $.get('view-modal/view_staff/'+viewModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
                    
                    var id=$(this).val();
                    $.get('delete-modal/delete_staff/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

            };
            
        </script>
        
    @endpush
@endsection