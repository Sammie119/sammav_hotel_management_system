@extends('layouts.admin.app')

@section('title', 'HMS | Paid Salaries')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ $staff_name->fullname }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payroll') }}">Payroll</a></li>
            <li class="breadcrumb-item active">Paid Salaries</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Paid Salary List
                {{-- <button class="btn btn-sm sammav-btn float-end create" value="new_salary" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add Payment</button> --}}
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
                            <th>Position</th>
                            <th>Salary Type</th>
                            <th>B. Salary</th>
                            <th>Allowances</th>
                            <th>Gross Sal.</th>
                            <th>Deductions</th>
                            <th>Net Sal.</th>
                            <th>Month</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @forelse ($payments as $key => $payment)
                            <tr>
                                @php
                                    $pay_dep = App\Models\PayrollDependecy::where('id', $payment->depend_id)->first();
                                    $pay_loan = App\Models\LoanPayment::where('loan_pay_id', $payment->loan_pay_id)->first();

                                    $amount_incomes = floatval(array_sum($pay_dep->amount_incomes ?? [0]));
                                    $amount_deductions = floatval(array_sum($pay_dep->amount_deductions ?? [0])) + floatval($pay_dep->tax) + floatval($pay_dep->employee_ssf) + floatval($pay_loan->amount_paid ?? null);

                                @endphp
                                <td>{{ ++$key }}</td>
                                <td>{{ $payment->positon }}</td>
                                <td>{{ $payment->salary_type }}</td>
                                <td>{{ number_format($payment->basic, 2) }}</td>
                                <td>{{ number_format($amount_incomes, 2) }}</td>
                                <td>{{ number_format($payment->gross_income, 2) }}</td>
                                <td>{{ number_format($amount_deductions, 2) }}</td>
                                <td>{{ number_format($payment->net_income, 2) }}</td>
                                <td>{{ $payment->pay_month }}, {{ $payment->pay_year }}</td>
                                <td>
                                    <div class="btn-group">
                                          <button class="btn btn-info btn-sm view" value="{{ $payment->pay_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details"><i class="fas fa-eye"></i></button>
                                          {{-- <button class="btn btn-success btn-sm edit" value="{{ $payment->id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
                                          <button class="btn btn-danger btn-sm delete" value="{{ $payment->id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button> --}}
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

                $(document).on('click', '.view', function(){
                    $('.modal-title').text('View Salary Paid Details');

                    var viewModal=$(this).val();
                    $.get('../view-modal/view_all_payment/'+viewModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Salary Payment Details');

                    var editModal=$(this).val();
                    $.get('../edit-modal/edit_all_payment/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
            
                    var id=$(this).val();
                    $.get('../delete-modal/delete_all_paymemt/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });
            };
            
        </script>
        
    @endpush
@endsection