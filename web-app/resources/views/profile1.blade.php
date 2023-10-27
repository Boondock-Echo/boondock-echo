@extends('layouts.app1')
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
              </ol>
            </nav>

            <h1 class="page-header-title">Settings</h1>
          </div>
          <!-- End Col -->

          <div class="col-sm-auto">
            <a class="btn btn-primary" href="./user-profile-my-profile.html">
              <i class="bi-person-fill me-1"></i> My profile
            </a>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->

      <div class="row">
        {{-- <div class="col-lg-3">
          <!-- Navbar -->
          <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
            <!-- Navbar Toggle -->
            <!-- Navbar Toggle -->
            <div class="d-grid">
              <button type="button" class="navbar-toggler btn btn-white mb-3" data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenu">
                <span class="d-flex justify-content-between align-items-center">
                  <span class="text-dark">Menu</span>

                  <span class="navbar-toggler-default">
                    <i class="bi-list"></i>
                  </span>

                  <span class="navbar-toggler-toggled">
                    <i class="bi-x"></i>
                  </span>
                </span>
              </button>
            </div>
            <!-- End Navbar Toggle -->
            <!-- End Navbar Toggle -->

            <!-- Navbar Collapse -->
            <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
              <ul id="navbarSettings" class="js-sticky-block js-scrollspy card card-navbar-nav nav nav-tabs nav-lg nav-vertical" data-hs-sticky-block-options='{
                     "parentSelector": "#navbarVerticalNavMenu",
                     "targetSelector": "#header",
                     "breakpoint": "lg",
                     "startPoint": "#navbarVerticalNavMenu",
                     "endPoint": "#stickyBlockEndPoint",
                     "stickyOffsetTop": 20
                   }'>
                <li class="nav-item">
                  <a class="nav-link active" href="#content">
                    <i class="bi-person nav-icon"></i> Basic information
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#emailSection">
                    <i class="bi-at nav-icon"></i> Email
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#passwordSection">
                    <i class="bi-key nav-icon"></i> Password
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#preferencesSection">
                    <i class="bi-gear nav-icon"></i> Preferences
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#twoStepVerificationSection">
                    <i class="bi-shield-lock nav-icon"></i> Two-step verification
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#recentDevicesSection">
                    <i class="bi-phone nav-icon"></i> Recent devices
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#notificationsSection">
                    <i class="bi-bell nav-icon"></i> Notifications
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#connectedAccountsSection">
                    <i class="bi-diagram-3 nav-icon"></i> Connected accounts
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#socialAccountsSection">
                    <i class="bi-instagram nav-icon"></i> Social accounts
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#deleteAccountSection">
                    <i class="bi-trash nav-icon"></i> Delete account
                  </a>
                </li>
              </ul>
            </div>
            <!-- End Navbar Collapse -->
          </div>
          <!-- End Navbar -->
        </div> --}}

        <div class="col-lg-12">
          <div class="d-grid gap-3 gap-lg-5">
            <!-- Card -->
            <div class="card">
              <!-- Profile Cover -->
              <div class="profile-cover">
                <div class="profile-cover-img-wrapper">
                  <img id="profileCoverImg" class="profile-cover-img" src="./assets/img/1920x400/img2.jpg" alt="Image Description">

                  <!-- Custom File Cover -->
                  <div class="profile-cover-content profile-cover-uploader p-3">
                    <input type="file" class="js-file-attach profile-cover-uploader-input" id="profileCoverUplaoder" data-hs-file-attach-options='{
                                "textTarget": "#profileCoverImg",
                                "mode": "image",
                                "targetAttr": "src",
                                "allowTypes": [".png", ".jpeg", ".jpg"]
                             }'>
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
              <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar" for="editAvatarUploaderModal">
                <img id="editAvatarImgModal" class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">

                <input type="file" class="js-file-attach avatar-uploader-input" id="editAvatarUploaderModal" data-hs-file-attach-options='{
                            "textTarget": "#editAvatarImgModal",
                            "mode": "image",
                            "targetAttr": "src",
                            "allowTypes": [".png", ".jpeg", ".jpg"]
                         }'>

                <span class="avatar-uploader-trigger">
                  <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
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
                <h2 class="card-title h4">Basic information</h2>
              </div>

              <!-- Body -->
              <div class="card-body">
                <!-- Form -->
                <form>
                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Full name <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Displayed on public forums, such as Front."></i></label>

                    <div class="col-sm-9">
                      <div class="input-group input-group-sm-vertical">
                        <input type="text" class="form-control" name="firstName" id="firstNameLabel" placeholder="Your first name" aria-label="Your first name" value="Mark">
                        <input type="text" class="form-control" name="lastName" id="lastNameLabel" placeholder="Your last name" aria-label="Your last name" value="Williams">
                      </div>
                    </div>
                  </div>
                  <!-- End Form -->
                    <!-- Form -->
                    <div class="row mb-4">
                        <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">NickName<span class="form-label-secondary">(Optional)</span></label>
    
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="addressLine2" id="addressLine2Label" placeholder="Set Nickname" aria-label="Your City">
                        </div>
                      </div>
                      <!-- End Form -->

                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" id="emailLabel" placeholder="Email" aria-label="Email" value="mark@site.com">
                    </div>
                  </div>
                  <!-- End Form -->

                

                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="organizationLabel" class="col-sm-3 col-form-label form-label">Company Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="organization" id="organizationLabel" placeholder="Your organization" aria-label="Your organization" value="Htmlstream">
                    </div>
                  </div>
                  <!-- End Form -->

                 

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

                 

                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="addressLine1Label" class="col-sm-3 col-form-label form-label">Address </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="addressLine1" id="addressLine1Label" placeholder="Your address" aria-label="Your address" value="45 Roker Terrace, Latheronwheel">
                    </div>
                  </div>
                  <!-- End Form -->

                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">City </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="addressLine2" id="addressLine2Label" placeholder="Your address" aria-label="Your City">
                    </div>
                  </div>
                  <!-- End Form -->
                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="addressLine2Label" class="col-sm-3 col-form-label form-label">State </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="addressLine2" id="addressLine2Label" placeholder="Your address" aria-label="Your State">
                    </div>
                  </div>
                  <!-- End Form -->

                  <!-- Form -->
                  <div class="row mb-4">
                    <label for="zipCodeLabel" class="col-sm-3 col-form-label form-label">Zip code <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="You can find your code in a postal address."></i></label>

                    <div class="col-sm-9">
                      <input type="text" class="js-input-mask form-control" name="zipCode" id="zipCodeLabel" placeholder="Your zip code" aria-label="Your zip code" value="KW5 8NW" data-hs-mask-options='{
                               "mask": "AA0 0AA"
                             }'>
                    </div>
                  </div>
                  <!-- End Form -->

                 

                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
                <!-- End Form -->
              </div>
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
    <!-- End Content -->

    <!-- Footer -->

    
    <!-- End Footer -->
  </main>
@endsection