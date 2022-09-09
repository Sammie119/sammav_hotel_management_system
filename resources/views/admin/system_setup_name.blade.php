@extends('layouts.admin.app')

@section('title', 'HMS | Hotel Setup')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hotel Setup</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Hotel Setup</li>
        </ol>
    
        @include('includes.input-errors')

        <div class="card mb-4">
        
            <div class="card-body">
                <form action="store_setup" method="POST" autocomplete="off">
                    @csrf
                    @isset($hos)
                        <input type="hidden" name="id" value="{{ $hos->id }}" />
                    @endisset
                    <div class="form-floating mb-3">
                        <input class="form-control" value="{{ (isset($hos)) ? $hos->name : null }}" name="name" type="text" required placeholder=" " />
                        <label>Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" value="{{ (isset($hos)) ? $hos->address : null }}" name="address" type="text" required placeholder=" " />
                        <label>Address</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" value="{{ (isset($hos)) ? $hos->phone1 : null }}" name="phone1" type="text" required placeholder=" " />
                                <label>Phone 1</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" value="{{ (isset($hos)) ? $hos->phone2 : null }}" name="phone2" type="text" placeholder=" " />
                                <label>Phone 2</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <div class="form-floating">
                                    <input class="form-control" value="{{ (isset($hos)) ? $hos->text_logo : null }}" name="text_logo" type="text" placeholder=" " />
                                    <label>Text Logo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-floating">
                                    <input class="form-control" value="{{ (isset($hos)) ? $hos->facebook : null }}" name="facebook" type="text" placeholder=" " />
                                    <label>Facebook</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" value="{{ (isset($hos)) ? $hos->email : null }}" name="email" type="email" placeholder=" " />
                        <label>Email</label>
                    </div>
                 
                
                    <hr width="100%" style="background: #bbb">
                
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><button type="submit" class="btn btn-block sammav-btn">Submit</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection