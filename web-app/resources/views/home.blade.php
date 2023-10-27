@extends('layouts.app1')
@section('content')
<main id="content" role="main" class="main">
  <!-- Content -->
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="page-header-title">Dashboard</h1>
        </div>
        <!-- End Col -->

        <div class="col-auto">
          <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#inviteUserModal">
            <i class="bi-person-plus-fill me-1"></i> Invite users
          </a>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Page Header -->

    <!-- Stats -->
   
    <!-- End Stats -->

    
    <!-- End Row -->

    <!-- Card -->
   
    <!-- End Card -->

  
  </div>
  <!-- End Content -->

  <!-- Footer -->

  <div class="footer">
    <div class="row justify-content-between align-items-center">
      <div class="col">
          <p class="fs-6 mb-0">Copyright &copy; Boondock Echo <span class="d-none d-sm-inline-block">2023 </span></p>
      </div>
      <!-- End Col -->

      <div class="col-auto">
        <div class="d-flex justify-content-end">
          <!-- List Separator -->
          <ul class="list-inline list-separator">
            <li class="list-inline-item">
              <a class="list-separator-link" href="#">FAQ</a>
            </li>

            <li class="list-inline-item">
              <a class="list-separator-link" href="#">License</a>
            </li>

            <li class="list-inline-item">
              <!-- Keyboard Shortcuts Toggle -->
              <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                <i class="bi-command"></i>
              </button>
              <!-- End Keyboard Shortcuts Toggle -->
            </li>
          </ul>
          <!-- End List Separator -->
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>

  <!-- End Footer -->
</main>
@endsection