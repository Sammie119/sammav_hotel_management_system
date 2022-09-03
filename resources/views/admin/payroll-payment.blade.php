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
                {{-- <button class="btn btn-sm sammav-btn float-end create" value="new_salary" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add Payment</button> --}}
                <form class="d-flex float-end input-group-sm" role="search">
                    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" >
                    <button class="btn btn-sm me-2"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-control" name="salary_month" required placeholder=" ">
                                    <option value="" selected disabled>--Select Month--</option>
                                    <option {{ (date('m') === '01') ? 'selected' : null }}>January</option>
                                    <option {{ (date('m') === '02') ? 'selected' : null }}>February</option>
                                    <option {{ (date('m') === '03') ? 'selected' : null }}>March</option>
                                    <option {{ (date('m') === '04') ? 'selected' : null }}>April</option>
                                    <option {{ (date('m') === '05') ? 'selected' : null }}>May</option>
                                    <option {{ (date('m') === '06') ? 'selected' : null }}>June</option>
                                    <option {{ (date('m') === '07') ? 'selected' : null }}>July</option>
                                    <option {{ (date('m') === '08') ? 'selected' : null }}>August</option>
                                    <option {{ (date('m') === '09') ? 'selected' : null }}>September</option>
                                    <option {{ (date('m') === '10') ? 'selected' : null }}>October</option>
                                    <option {{ (date('m') === '11') ? 'selected' : null }}>November</option>
                                    <option {{ (date('m') === '12') ? 'selected' : null }}>December</option>
                                </select>
                                <label>Month</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-3 mb-md-0">
                                <select class="form-control" name="salary_year" required placeholder=" " >
                                    <option value="" selected disabled>--Select Year--</option>
                                    <?php 
                                       for($i = 2022 ; $i <= date('Y'); $i++){
                                            $thisYear = (date('Y') == $i) ? 'selected' : null;
                                          echo "<option ". $thisYear .">$i</option>";
                                       }
                                    ?>
                                </select>
                                <label>Year</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input type="text" name="description" class="form-control" required placeholder=" " >
                                <label>Description</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <button type="submit" class="btn btn-success"><i class="fas fa-spinner"></i> Generate Payroll</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Salary Type</th>
                            <th>B. Salary</th>
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
                                <td>{{ number_format($salary->salary, 2) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('view_paid_salaries', ['id' => $salary->salary_id]) }}" class="btn btn-info btn-sm view" title="View Details"><i class="fas fa-eye"></i></a>
                                        <button class="btn btn-success btn-sm edit" value="{{ $salary->salary_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details"><i class="fas fa-edit"></i></button>
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

                    @include('includes.add-salary-payment-input',[
                        'first_class' => 'add-all-allowances', //Main container
                        'second_class' => 'add-allowance',
                        'first_input' => 'incomes[]',
                        'second_input' => 'amount_incomes[]',
                        'third_input' => 'rate_incomes[]',
                        'no_data' => 'allowance', //No data found disappear
                    ])

                    @include('includes.add-salary-payment-input',[
                        'first_class' => 'add-all-deduction', //Main container
                        'second_class' => 'add-deduction',
                        'first_input' => 'deductions[]',
                        'second_input' => 'amount_deductions[]',
                        'third_input' => 'rate_deductions[]',
                        'no_data' => 'deduction', //No data found disappear
                    ])
              
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Salary Payment Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_salary_paymemt/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

            };
            
        </script>
        
    @endpush
@endsection