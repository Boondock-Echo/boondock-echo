{{-- Title  --}}
<title>Profile | Boondock Admin</title>
@extends('layouts.app1')

@section('content')
    <style>
        @media only screen and (min-width: 601px) {
            .hide-in-desktop {
                display: none;
            }

        }

        @media (max-width: 600px) {
            .hide-in-mobile {
                display: none;
            }
        }
    </style>
    <title>Profile | Boondock Admin</title>
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="">
                <div class="row align-items-end mb-3">
                    <div class="col-sm mb-2 mb-sm-0">

                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('inbox') }}">
                            <i class="bi-person-fill me-1"></i> Home
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <div class="row">


                <div class="col-lg-12">

                    <div class="d-grid gap-3 gap-lg-5">
                        <!-- Card -->
                        <div class="card">

                            <form id="formAccountSettings" method="POST"
                                action="{{ route('profile.update', auth()->id()) }}" enctype="multipart/form-data"
                                class="needs-validation" role="form" novalidate>
                                @csrf
                                <!-- Profile Cover -->
                                <div class="profile-cover">
                                    <div class="profile-cover-img-wrapper">
                                        <img id="profileCoverImg" class="profile-cover-img"
                                            src="./assets/img/1920x400/img2.jpg" alt="Image Description">
                                        {{-- <input class="form-control" type="file" id="profile_picture" name="profile_picture" accept="image/*"> --}}
                                        <!-- Custom File Cover -->
                                        <div class="profile-cover-content profile-cover-uploader p-3">
                                            <input class="form-control" type="file" id="profile_picture"
                                                name="profile_picture" accept="image/*">


                                            {{-- <label class="profile-cover-uploader-label btn btn-sm btn-white" for="profileCoverUplaoder">
                      <i class="bi-camera-fill"></i>
                      <span class="d-none d-sm-inline-block ms-1">Upload header</span>
                    </label> --}}
                                        </div>
                                        <!-- End Custom File Cover -->
                                    </div>
                                </div>
                                <!-- End Profile Cover -->

                                <!-- Avatar -->
                                <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar"
                                    for="editAvatarUploaderModal">

                                    @if (auth()->user()->profile_picture !== url('/storage'))
                                        <img id="profile_picture" class="avatar-img"
                                            src="{{ auth()->user()->profile_picture }}" alt="Profile Description">
                                    @else
                                        <img id="profile_picture" class="avatar-img" src="{{ asset('default.jpg') }}"
                                            alt="Default Description">
                                    @endif

                                    {{-- <input type="file" class="js-file-attach avatar-uploader-input"
                                    id="editAvatarUploaderModal"
                                    data-hs-file-attach-options='{
                            "textTarget": "#profile_picture",
                            "mode": "image",
                            "targetAttr": "src",
                            "allowTypes": [".png", ".jpeg", ".jpg"]
                         }'> --}}

                                    <span class="avatar-uploader-trigger">
                                        {{-- <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"> --}}
                                    </span>
                                </label>

                                <!-- End Avatar -->

                                <!-- Body -->
                                <div class="card-body">
                                    <div class="row">

                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Body -->
                        </div>
                        <!-- End Card -->

                        <!-- Card -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title h4">Personal information</h2>
                                @if (auth()->user()->company !== null)
                                    <h2 class="card-title h6">Account Id : US-B000{{ $accountId }}</h2>
                                @endif
                            </div>

                            <!-- Body -->
                            <div class="card-body">
                                <!-- Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Full name
                                        </i></label>

                                    <div class="col-sm-9">
                                        <div class="input-group input-group-sm-vertical">
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Your first name" aria-label="Your first name"
                                                value="{{ auth()->user()->name }}">
                                            <input id="last_name" name="last_name" type="text" class="form-control"
                                                placeholder="Your last name" aria-label="Your last name"
                                                value="{{ auth()->user()->last_name }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">NickName<span
                                            class="form-label-secondary">(Optional)</span></label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nick_name" id="nick_name"
                                            placeholder="Set Nickname" aria-label="Your City"
                                            value="{{ auth()->user()->nick_name }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="phpTimezoneLabel" class="col-sm-3 col-form-label form-label">Time
                                        Zone</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="timezone" id="timezone">
                                            <option disabled>Select a time zone</option>
                                            <option value="Pacific/Kwajalein"
                                                {{ auth()->user()->timezone == 'Pacific/Kwajalein' ? 'selected' : '' }}>
                                                (UTC-12:00) International Date Line West</option>
                                            <option value="America/Los_Angeles"
                                                {{ auth()->user()->timezone == 'America/Los_Angeles' ? 'selected' : '' }}>
                                                (UTC-08:00) Pacific Time (US & Canada)</option>
                                            <option value="America/Chicago"
                                                {{ auth()->user()->timezone == 'America/Chicago' ? 'selected' : '' }}>
                                                (UTC-06:00) Central Time (US & Canada)</option>
                                            <option value="America/Denver"
                                                {{ auth()->user()->timezone == 'America/Denver' ? 'selected' : '' }}>
                                                (UTC-07:00) Mountain Time (US & Canada)</option>
                                            <option value="America/New_York"
                                                {{ auth()->user()->timezone == 'America/New_York' ? 'selected' : '' }}>
                                                (UTC-05:00) Eastern Time (US & Canada)</option>
                                            <option value="Asia/Kolkata"
                                                {{ auth()->user()->timezone == 'Asia/Kolkata' ? 'selected' : '' }}>
                                                (UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                        </select>




                                        {{-- <small id="test" class="form-text text-muted"></small>
                                    </p> <script> document.getElementById("test").innerHTML = Intl.DateTimeFormat().resolvedOptions().timeZone; </script> --}}
                                    </div>
                                </div>





                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>

                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email" aria-label="Email" value="{{ auth()->user()->email }}"
                                            disabled>
                                    </div>
                                </div>
                                <!-- End Form -->



                                <!-- Form -->
                                @if (auth()->user()->company !== null)
                                    <div class="row mb-4">
                                        <label for="organizationLabel" class="col-sm-3 col-form-label form-label">Account
                                            Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="company" id="company"
                                                placeholder="Your organization" aria-label="Your organization"
                                                value="{{ $accountName }}" disabled>
                                        </div>


                                        {{-- <div class="col-sm-auto">
                                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                href="">
                                                <i class="bi-person-plus-fill me-1"></i> Add Accounts
                                            </a>
                                        </div> --}}
                                    </div>
                                @endif
                                <!-- End Form -->
                                {{-- license information details strat --}}
                                <!-- Form  for call sign-->


                                <div class="row mb-4">
                                    <label for="CallSignLabel" class="col-sm-3 col-form-label form-label">Call
                                        Sign</label>

                                    <div class="col-sm-5">
                                        <div class="input-group input-group-sm-vertical">


                                            <input type="text" class="form-control" id="searchValue"
                                                placeholder="Enter Call Sign" aria-label="CallSign"
                                                value="{{ auth()->user()->call_sign }}" required>

                                            <div class="form-check form-check-inline mx-5  mt-2">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" id="fcc-form" class="btn btn-primary">Check
                                                        FCC</button>
                                                    <button style="display: none" id="fcc-form-reload"
                                                        class="btn btn-primary" type="button" disabled>
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        Loading...
                                                    </button>
                                                </div>
                                            </div>
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#fcc-form').click(function() {
                                                        $('#fcc-form').hide();
                                                        $('#fcc-form-reload').show();
                                                        var searchValue = $('#searchValue').val();
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '/fcc',
                                                            data: {
                                                                'searchValue': searchValue
                                                            },
                                                            success: function(response) {
                                                                var status = response.Licenses.License[0].statusDesc;
                                                                var expiration = response.Licenses.License[0].expiredDate;
                                                                var type = response.Licenses.License[0].serviceDesc;
                                                                var operatorClass = response.Licenses.License[0].licenseClassDesc;
                                                                var licenseName = response.Licenses.License[0].licName;

                                                                $('#status').text(status);
                                                                $('#expiration').text(expiration);
                                                                $('#type').text(type);
                                                                $('#operatorClass').text(operatorClass);
                                                                $('#licenseName').text(licenseName);

                                                                $('.response-container').show();
                                                                $('.alert-danger').hide();
                                                                $('#license-info').show();
                                                                $('#license-info-head').show();
                                                                $('#fcc-form').show();
                                                                $('#fcc-form-reload').hide();

                                                                if (status.toLowerCase() === 'active') {
                                                                    $('.alert-success').show();
                                                                    $('.alert-danger').hide();
                                                                } else {
                                                                    $('.alert-success').hide();
                                                                    $('.alert-danger').text(
                                                                        "Your license is inactive. Please contact support for assistance."
                                                                        );
                                                                    $('.alert-danger').show();
                                                                }
                                                            },
                                                            error: function() {
                                                                $('.alert-danger').text(
                                                                    "An error occurred while retrieving license information. Please try again later."
                                                                    );
                                                                $('.alert-danger').show();
                                                                $('.alert-success').hide();
                                                                $('.response-container').hide();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>



                                            <!-- End Form Check -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->
                                <h4 id="license-info-head"
                                    style="{{ Auth::user()->license_status ? '' : 'display: none' }}"
                                    class="page-header-title mb-3">Licences Information </h4>


                                <div class="col-sm-12 col-lg-12 mb-3 mb-lg-5 alert alert-success alert-dismissible fade show hide-in-desktop"
                                    role="alert" style="display: none">
                                    <span class="fw-semibold">Congratulations!</span> Your FCC license is valid. You are
                                    now allowed to use the Boondock Echo Transmit feature!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                                <div class="col-sm-12 col-lg-12 mb-3 mb-lg-5 alert alert-danger alert-dismissible fade show"
                                    role="alert" style="display: none"></div>

                                <div id="license-info" class="row my-1"
                                    style="{{ Auth::user()->license_status ? '' : 'display: none' }}">
                                    <div class="col-6 mb-3">
                                        <dl class="row text-uppercase">
                                            <dt class="col-sm-6">Status</dt>
                                            <dd class="col-sm-6" id="status">{{ Auth::user()->license_status }}</dd>

                                            <dt class="col-sm-6">Expiration</dt>
                                            <dd class="col-sm-6" id="expiration">
                                                {{ Auth::user()->license_expiration_date }}</dd>

                                            <dt class="col-sm-6">Type</dt>
                                            <dd class="col-sm-6" id="type">{{ Auth::user()->license_type }}</dd>



                                            <dt class="col-sm-6">License Name</dt>
                                            <dd class="col-sm-6" id="licenseName">{{ Auth::user()->license_name }}</dd>


                                        </dl>
                                        <!-- End Row -->
                                    </div>
                                </div>

                                {{-- license information details end --}}



                                <!-- Form -->
                                {{-- <div id="accountType" class="row mb-4">
                                                        <label class="col-sm-3 col-form-label form-label">Account type</label>

                                                        <div class="col-sm-9">
                                                        <div class="input-group input-group-sm-vertical">
                                                            <!-- Radio Check -->
                                                            <label class="form-control" for="userAccountTypeRadio1">
                                                            <span class="form-check">
                                                                <input type="radio" class="form-check-input" name="userAccountTypeRadio" id="userAccountTypeRadio1" checked>
                                                                <span class="form-check-label">Individual</span>
                                                            </span>
                                                            </label>
                                                            <!-- End Radio Check -->

                                                            <!-- Radio Check -->
                                                            <label class="form-control" for="userAccountTypeRadio2">
                                                            <span class="form-check">
                                                                <input type="radio" class="form-check-input" name="userAccountTypeRadio" id="userAccountTypeRadio2">
                                                                <span class="form-check-label">Company</span>
                                                            </span>
                                                            </label>
                                                            <!-- End Radio Check -->
                                                        </div>
                                                        </div>
                                                    </div> --}}
                                <!-- End Form -->

                                <div class="row my-4">
                                    <label for="BillingAddressLabel" class="col-sm-3 col-form-label form-label"><b>Billing
                                            Address</b> <span class="form-label-secondary"></span></label>


                                    <div class="col-sm-5">
                                        <div class="input-group input-group-sm-vertical">

                                            <!-- Form Check -->
                                            <div class=" mx-0  mt-2">
                                                <!-- Check ]box -->

                                                <div class=" mb-3">
                                                    <input type="checkbox" id="invalidCheck"
                                                        class="form-check-input is-valid" checked>
                                                    <label><b>Same As FCC Address</b> </label>
                                                </div>
                                                <!-- End Check box -->
                                            </div>
                                            <!-- End Form Check -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addressLine1Label"
                                        class="col-sm-3 col-form-label form-label">Address</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address" id="address"
                                            placeholder="Your Address" aria-label="Your Address"
                                            value="{{ auth()->user()->address }}">
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">City
                                    </label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="city" id="city"
                                            placeholder="Your City" aria-label="Your City"
                                            value="{{ auth()->user()->city }}">
                                    </div>
                                </div>
                                <!-- End Form -->
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">State
                                    </label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="state" id="state"
                                            placeholder="Your State" aria-label="Your State"
                                            value="{{ auth()->user()->state }}">
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="zipCodeLabel" class="col-sm-3 col-form-label form-label">Zip code <i
                                            class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="You can find your code in a postal address."></i></label>

                                    <div class="col-sm-9">
                                        <input type="number" class="js-input-mask form-control" name="zip"
                                            id="zip" placeholder="Your Zip Code" aria-label="Your zip code"
                                            value="{{ auth()->user()->zip }}"
                                            data-hs-mask-options='{
                               "mask": "AA0 0AA"
                             }'>
                                    </div>
                                </div>
                                @if (auth()->user()->company === null)
                                    <div class="row mb-4">
                                        <label for="zipCodeLabel" class="col-sm-3 col-form-label form-label">Don't Have
                                            Account ?</label>

                                        <div class="col-sm-9">
                                            <a class="col-sm-2 btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal" href="">
                                                <i class="fa-solid fa-plus me-2"></i> Create
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <!-- End Form -->



                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                                <!-- End Form -->
                            </div>
                            <!-- End Body -->
                        </div>

                    </div>

                    <!-- Sticky Block End Point -->
                    <div id="stickyBlockEndPoint"></div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Content -->

        <!-- Footer -->


        <!-- End Footer -->
    </main>

    <!-- create user -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
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
                    <form action="{{ route('storecompany') }}" method="post">
                        @csrf

                        <!-- Account Name -->
                        <div class="row mb-4">
                            <label for="account_name" class="col-sm-3 col-form-label form-label">Account Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="account_name" name="account_name"
                                    required>
                            </div>
                        </div>

                        <!-- Owner (Hidden Input) -->
                        <input type="hidden" id="owner" value="{{ auth()->user()->id }}" name="owner">

                        <!-- Billing Address -->
                        <div class="row mb-4">
                            <label for="billing_address" class="col-sm-3 col-form-label form-label">Billing
                                Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_address" name="billing_address">
                            </div>
                        </div>

                        <!-- Billing City -->
                        <div class="row mb-4">
                            <label for="billing_city" class="col-sm-3 col-form-label form-label">Billing City</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_city" name="billing_city">
                            </div>
                        </div>

                        <!-- Billing State -->
                        <div class="row mb-4">
                            <label for="billing_state" class="col-sm-3 col-form-label form-label">Billing State</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_state" name="billing_state">
                            </div>
                        </div>

                        <!-- Billing Zip -->
                        <div class="row mb-4">
                            <label for="billing_zip" class="col-sm-3 col-form-label form-label">Billing Zip</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="billing_zip" name="billing_zip">
                            </div>
                        </div>

                        <!-- Billing Amount -->
                        <div class="row mb-4">
                            <label for="billing_amount" class="col-sm-3 col-form-label form-label">Billing Amount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="billing_amount" name="billing_amount">
                            </div>
                        </div>

                        <!-- Active (Dropdown) -->
                        <div class="row mb-4">
                            <label for="active" class="col-sm-3 col-form-label form-label"><b>Active</b></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="active" name="active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Create Account</button>
                            </div>
                        </div>
                    </form>


                    <!-- End Step Form -->
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- Edit user -->
@endsection
