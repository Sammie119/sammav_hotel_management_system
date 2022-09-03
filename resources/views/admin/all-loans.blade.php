@extends('layouts.admin.app')

@section('title', 'HMS | Loans')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loans</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Loans</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Loan List
                <button class="btn btn-sm sammav-btn float-end create" value="new_loan" data-bs-target="#getModal" data-bs-toggle="modal" title="New Loan">Enter Loan</button>
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
                            <th>Staff Name</th>
                            <th>Loan Desc.</th>
                            <th>Amount</th>
                            <th>Amnt/Month</th>
                            <th>Amnt Paid</th>
                            <th>Balance</th>
                            <th>Months Left </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        
                        @forelse ($loans as $key => $loan)
                            @php
                                $amount = $loan->amount;
                                $amnt_paid = $loan->loan_pay->last()->total_amount_paid;
                                $balance = $amount - $amnt_paid;
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $loan->staff->fullname }}</td>
                                <td>{{ $loan->description }}</td>
                                <td>{{ number_format($amount, 2) }}</td>
                                <td>{{ number_format($loan->amount_per_month, 2) }}</td>
                                <td>{{ number_format($amnt_paid, 2) }}</td>
                                <td>{{ number_format($balance, 2) }}</td>
                                <td>{{ $loan->number_of_months - $loan->loan_pay->last()->months_paid }}</td>
                                <td>{{ getLoanStatus($loan->status) }}</td>
                                <td>
                                    <div class="btn-group">
                                          <button class="btn btn-info btn-sm view" value="{{ $loan->loan_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details"><i class="fas fa-eye"></i></button>
                                          <button class="btn btn-success btn-sm edit" value="{{ $loan->loan_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                          <button class="btn btn-danger btn-sm delete" value="{{ $loan->loan_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button>
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

                    $('.staff').focus();

                    $('.staff').bind('change',function(){   
                        var staff = $('.staff').val();
                        // var staff_id = document.querySelector('.staff_id').value;
                        
                        $.ajax({
                            type:'GET',
                            url:"get-staff-info",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                staff
                                },
                            success:function(data) {
                                if(data === ''){
                                    return;
                                }
                                else {
                                    $("#position").val(data.position);
                                    $("#basic_salary").val(data.salary);
                                    $("#staff_id").val(data.staff_id);
                                }
                            }
                        });
                    });

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('Enter New Loan');

                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.view', function(){
                    $('.modal-title').text('View Loan Details');

                    var viewModal=$(this).val();
                    $.get('view-modal/view_loan/'+viewModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Loan Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_loan/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
            
                    var id=$(this).val();
                    $.get('delete-modal/delete_loan/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });
            };
            
        </script>
        
    @endpush
@endsection