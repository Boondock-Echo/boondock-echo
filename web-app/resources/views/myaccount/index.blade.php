@extends('layouts.app1')


@section('content')
    <main id="content" role="main" class="main">

        {{-- DIV START --}}
        <div class="content container-fluid">
          
            <!-- End Page Header -->
  <!-- Stats -->
  <div class="row">
    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Total Users In Account</h6>

                <div class="row align-items-center gx-2">
                    <div class="col">
                        <span class="js-counter display-4 text-dark">
                            {{-- @foreach ($totalUsers as $key => $firstAccount)
                                @if ($loop->last)
                                    {{ $key + 1 }}
                                @endif
                            @endforeach --}}
                            {{$totalUsers}}
                        {{-- </span>
                        <span class="text-body fs-5 ms-1">from {{ $totalAccount }}</span> --}}
                    </div>
                    <!-- End Col -->

                    {{-- <div class="col-auto">
      <span class="badge bg-soft-success text-success p-1">
        <i class="bi-graph-up"></i> 15.0%
      </span>
    </div> --}}
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </div>
        <!-- End Card -->
    </div>

    <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
        <!-- Card -->
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Active users in Accounts</h6>

                <div class="row align-items-center gx-2">
                    <div class="col">
                        <span
                            class="js-counter display-4 text-dark">{{ count($accountusers->where('email_verified_at', '!=', null)) }}</span>
                        <span class="text-body fs-5 ms-1">from  {{$totalUsers}}</span>
                    </div>


                </div>
                <!-- End Row -->
            </div>
        </div>
        <!-- End Card -->
    </div>


</div>
<!-- End Stats -->
            <div class="row">


                <div class="col-lg-12">
                    <div class="d-grid gap-3 gap-lg-5">
                        {{-- @foreach ($firstAccounts as $key => $firstAccount) --}}

                        <!-- Card -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title h4">Account information</h2>
                                {{-- @if (auth()->user()->company !== null)
                                <h2 class="card-title h6">Account Id : US-B000{{ $firstAccountId }}</h2>
                                @endif --}}
                            </div>

                            <!-- Body -->
                            <div class="card-body">
                                <!-- Form -->
                                <form method="POST"
                                action="{{ route('myaccount.update', $firstAccount->id) }}">
                                @method('PATCH')
                                @csrf
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Account Name </label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="account_name" id="account_name"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->account_name}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Owner Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nick_name" disabled id="nick_name"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                @foreach ($users as $user)
                                                @if ($user->id == $firstAccount->owner) value="{{ $user->name }}" @endif
                                                @endforeach >
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Owner Email</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" disabled id="nick_name"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                @foreach ($users as $user)
                                                @if ($user->id == $firstAccount->owner) value="{{ $user->email }}" @endif
                                                @endforeach >
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Billing Address</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="billing_address" id="billing_address"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->billing_address}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Billing City</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="billing_city" id="billing_city"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->billing_city}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Billing State</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="billing_state" id="billing_state"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->billing_state}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Billing Zip</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="billing_zip" id="billing_zip"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->billing_zip}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="addressLine2Label"
                                            class="col-sm-3 col-form-label form-label">Billing Amount</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="billing_amount" id="billing_amount"
                                                placeholder="Set Nickname" aria-label="Your City"
                                                value="{{$firstAccount->billing_amount}}">
                                        </div>
                                    </div>

                                    <div class="form-group mt-4 mb-4">
                                        <div class="row">
                                            <label for="active" class="col-sm-3 col-form-label form-label"><b>Active</b></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="active" name="active">
                                                    <option value="1" class="form-control mb-2">Yes</option>
                                                    <option value="0" class="form-control mb-2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- <button type="submit" class="btn btn-primary">Update Account</button>
                                    <button type="submit" class="btn btn-primary">Delete Account</button> --}}
                                    <div class="card-header card-header-content-md-between">
                                        
                                        <form method="POST" action="{{ route('myaccount.update', $firstAccount->id) }}"
                                            style="display:inline">
                                            @method('PUT')
                                            @csrf
                                        <div class="mb-2 mb-md-0">
                                            <button type="submit" class="btn btn-primary">Update Account</button>
                                        </div>
                                    </form>
                                        <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">

                                            @if(auth()->user()->id == $firstAccount->owner)
                                            <form method="POST" action="{{ route('myaccount.destroy', $firstAccount->id) }}"
                                                style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger ">
                                                    <i class="bi-trash me-1"></i> Delete Account
                                                </button>
                                            </form>
                                            @endif

                                        </div>
                                    </div>
                                </form>

                            <!-- End Body -->
                        </div>
                        <!-- End Card -->
                      
                        <!-- Card -->

                        <!-- End Card -->





                        <!-- Card -->

                        <!-- End Card -->
                    </div>

                    <!-- Sticky Block End Point -->
                    <div id="stickyBlockEndPoint"></div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        {{-- DIV END  --}}

        <!-- End Card -->


        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    {{-- <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p> --}}
                </div>
                <!-- End Col -->


                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->
    </main>


    <!-- create user -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Body -->
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('accounts.store') }}" method="post">
                        @csrf
                    
                        <div class="row mb-4">
                            <label for="account_name" class="col-sm-3 col-form-label form-label">Account Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="account_name" name="account_name" required>
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="owner" class="col-sm-3 col-form-label form-label">Owner</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="owner" name="owner">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="billing_address" class="col-sm-3 col-form-label form-label">Billing Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_address" name="billing_address">
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="billing_city" class="col-sm-3 col-form-label form-label">Billing City</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_city" name="billing_city">
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="billing_state" class="col-sm-3 col-form-label form-label">Billing State</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_state" name="billing_state">
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="billing_zip" class="col-sm-3 col-form-label form-label">Billing Zip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_zip" name="billing_zip">
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="billing_amount" class="col-sm-3 col-form-label form-label">Billing Amount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="billing_amount" name="billing_amount">
                            </div>
                        </div>
                    
                        <div class="row mb-4">
                            <label for="active" class="col-3 col-form-label form-label"><b>Active dedwe</b></label>
                            <div class="col-9">
                                <select class="form-control" id="active" name="active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </form>
                    

                    <!-- End Step Form -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- Edit user -->



@endsection
