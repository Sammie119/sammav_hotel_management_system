@extends('layouts.admin.app')

@section('title', 'HMS | Tax')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tax & SSNIT</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tax</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tax and SSNIT
                <button class="btn btn-sm sammav-btn float-end create" value="new_tax" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">New Tax</button>
            </div>
            <div class="card-body">
                <table class="table table-hover" style="text-align: right">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First(0)</th>
                            <th>Next(5%)</th>
                            <th>Next(10%)</th>
                            <th>Next(17.5%)</th>
                            <th>Next(25%)</th>
                            <th>exceeding(30%)</th>
                            <th>SSF Employer</th>
                            <th>SSF Employee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee_table">
                        @foreach ($taxs as $key => $tax)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ number_format($tax->first_0, 2) }}</td>
                                <td>{{ number_format($tax->next_5, 2) }}</td>
                                <td>{{ number_format($tax->next_10, 2) }}</td>
                                <td>{{ number_format($tax->next_17_5, 2) }}</td>
                                <td>{{ number_format($tax->next_25, 2) }}</td>
                                <td>{{ number_format($tax->exceeding, 2) }}</td>
                                <td>{{ $tax->ssf_employer }}%</td>
                                <td>{{ $tax->ssf_employee }}%</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-sm delete" value="{{ $tax->id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>  
                        @endforeach                       
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
                    

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('New Tax');
                    
                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);

                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
                    
                    var id=$(this).val();
                    $.get('delete-modal/delete_tax/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

            };
            
        </script>
        
    @endpush
@endsection