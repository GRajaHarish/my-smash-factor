@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Customer Register') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">

                        <form action="{{ route('Customers.registerCustomer') }}" method="POST">
                            @error('success')
                            <div class="alert alert-success">{{$message}}</div>
                            @enderror
                            @error('fail')
                            <div class="alert alert-success">{{$message}}</div>
                            @enderror
                            @csrf
                            @method('POST')

                            <div class="card-body">

                                <div class="input-group mb-3">
                                    <input type="text" name="FirstName"  id="FirstName"
                                           class="form-control @error('FirstName') is-invalid @enderror"
                                           placeholder="{{ __('First Name') }}" value="@if(isset($customers)) {{$customers->FirstName}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('FirstName')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="LastName" id="LastName"
                                           class="form-control @error('LastName') is-invalid @enderror"
                                           placeholder="{{ __('Last Name') }}" value="@if(isset($customers)) {{$customers->LastName}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-circle"></span>
                                        </div>
                                    </div>
                                    @error('LastName')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="DisplayName" id="DisplayName"
                                           class="form-control @error('DisplayName') is-invalid @enderror"
                                           placeholder="{{ __('Display Name') }}" value="@if(isset($customers)) {{$customers->DisplayName}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-address-book"></span>
                                        </div>
                                    </div>
                                    @error('DisplayName')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                

                                <div class="input-group mb-3">
                                    <input type="email" name="Email" id="Email"
                                           class="form-control @error('Email') is-invalid @enderror"
                                           placeholder="{{ __('Email') }}" value="@if(isset($customers)) {{$customers->Email}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('Email')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <select name="Role"
                                           class="form-control @error('Role') is-invalid @enderror"
                                           placeholder="{{ __('Customer Type') }}"  >
                                           @if(isset($customers)) 

                                             @if ($customers->IsGuest == 1)
                                                 @php$Guestselect ="selected";
                                                 $Memberselect ="";
                                                 @endphp
                                             @else
                                             @php $Guestselect ="";
                                             $Memberselect ="selected";@endphp
                                             @endif
                                           
                                           
                                           @endif
                                    <option value="1" @php if(isset($Guestselect)){ echo $Guestselect;}@endphp>Guest</option>
                                    <option value="2" @php if(isset($Memberselect)){ echo $Memberselect;}@endphp>Member</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" name="PhoneNo" id="PhoneNo"
                                           class="form-control @error('PhoneNo') is-invalid @enderror"
                                           placeholder="{{ __('Phone No') }}" value="@if(isset($customers)) {{$customers->PhoneNo}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                        </div>
                                    </div>
                                    @error('PhoneNo')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="ReferalCode" id="ReferalCode"
                                           class="form-control @error('ReferalCode') is-invalid @enderror"
                                           placeholder="{{ __('Referal Code') }}" value="@if(isset($customers)) {{$customers->ReferalCode}}  @endif" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                        </div>
                                    </div>
                                    @error('ReferalCode')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>


                              

                                

                            </div>
                          
                            @if (request()->route()->parameter('id'))
                            <div class="card-footer">
                            <button type="button" id="update_data" class="btn btn-primary" onclick="updateCustomer({{request()->route()->parameter('id')}})">{{ __('Update') }}</button> 
                            <!--<button type="submit" id="update_data" class="btn btn-primary" value="{{ $customers->CustomerID }}">{{ __('Update') }}</button>-->
                        
                        </div>
                            @else
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                            @endif
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script>



function updateCustomer(id){
    
    $.ajax({
		
		
			url :"{{ route('Customer.update') }}",
            method:"post",
			data:{
                _token:'{{ csrf_token() }}',
				id:id,
                FirstName:$('#FirstName').val(),
                LastName:$('#LastName').val(),
                Email :$('#Email').val(),
				DisplayName: $('#DisplayName').val(),
				PhoneNo:$('#PhoneNo').val(),
				ReferalCode: $('#ReferalCode').val()
			},
			success: function(dataResult){
                dataResult = JSON.parse(dataResult);
			}
		});
    }
    

    </script>
@endsection

