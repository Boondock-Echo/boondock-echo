@extends('layouts.app1')

@section('content')
    <main id="content" role="main" class="main">
<div class="card px-5 pt-3 rounded-0 ">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <!-- Header -->
                        <div class="card-header card-header-content-between border-bottom">
                            <h4 class="card-header-title">Overview</h4>

                            <a class="btn btn-ghost-secondary btn-sm" href="#">
                                <i class="bi-file-earmark-arrow-down me-1"></i> Download .CSV
                            </a>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md mb-4 mb-md-0">

                                  <div id="license-info" class="row my-1" style="{{ Auth::user()->license_status ? '' : 'display: none' }}">
                                    <div class="col-12 mb-3">
                                        <dl class="row text-uppercase">
                                            <dt class="col-sm-6 text-dark">License Type</dt>
                                            <dd class="col-sm-6" id="type">
                                                <span class="badge bg-primary rounded-2">
                                                    @php
                                                        $licenseType = $license_code->license_type ?? null;
                                                    @endphp
                                                    {{ $licenseType === 1 ? 'Basic License' : ($licenseType === 2 ? 'Pro License' : ($licenseType === 3 ? 'Advanced License' : 'Unknown License')) }}
                                                </span>
                                            </dd>
                                            <dt class="col-sm-6 text-dark">License Code</dt>
                                            <dd class="col-sm-6" id="LicenseCode">
                                                {{ $license_code->code ?? 'No data found' }}
                                            </dd>
                                            <dt class="col-sm-6 text-dark">Dock Connected</dt>
                                            <dd class="col-sm-6" id="dockname">
                                                {{ $license_code->dock->name ?? 'No data found' }}
                                            </dd>
                                            <dt class="col-sm-6 text-dark">Status</dt>
                                            <dd class="col-sm-6" id="status">
                                                {{ Auth::user()->license_status ?? 'No data found' }}
                                            </dd>
                                            <dt class="col-sm-6 text-dark">Expiration</dt>
                                            <dd class="col-sm-6" id="expiration">
                                                {{ Auth::user()->license_expiration_date ?? 'No data found' }}
                                            </dd>
                                            <dt class="col-sm-6"><span class="card-subtitle">Your plan (billed yearly):</span>
                                                <h3>March - April 2024</h3>
                                            </dt>
                                            <dd class="col-sm-6">
                                                <div class="d-grid d-sm-flex gap-3">
                                                    <button type="button"
                                                        class="btn btn-primary w-100 w-sm-auto btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#accountUpdatePlanModal">Upgrade Plan</button>
                                                </div>
                                            </dd>
                                        </dl>
                                        <!-- End Row -->
                                    </div>
                                </div>
                                

                                    {{-- license information details end --}}


                                    <div>
                                        <span class="card-subtitle">Total per year</span>
                                        <h1 class="text-primary">$264 USD</h1>
                                    </div>
                                </div>
                                <!-- End Col -->


                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Body -->

                        <hr class="my-3">

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row align-items-center flex-grow-1 mb-2">
                                <div class="col">
                                    <h4 class="card-header-title">Storage usage</h4>
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                    <span class="text-dark fw-semibold">4.27 GB</span> used of 6 GB
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <!-- Progress -->
                            <div class="progress rounded-pill mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar" role="progressbar" style="width: 25%; opacity: .6"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <!-- End Progress -->

                            <!-- Legend Indicators -->
                            <ul class="list-inline list-px-2">
                                <li class="list-inline-item">
                                    <span class="legend-indicator bg-primary"></span> Personal usage space
                                </li>
                                <li class="list-inline-item">
                                    <span class="legend-indicator bg-primary opacity"></span> Shared space
                                </li>
                                <li class="list-inline-item">
                                    <span class="legend-indicator"></span> Unused space
                                </li>
                            </ul>
                            <!-- End Legend Indicators -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->


                </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-6">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-header-title">Payment method</h4>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <div class="mb-4">
                                <p>Cards will be charged either at the end of the month or whenever your balance exceeds the
                                    usage threshold. All major credit / debit cards accepted.</p>
                            </div>

                            <!-- List Group -->
                            <ul class="list-group mb-5">
                                <!-- Item -->
                                <li class="list-group-item">
                                    <div class="mb-2">
                                        <h5>Maria Williams <span class="badge bg-primary ms-1">Primary</span></h5>
                                    </div>

                                    <!-- Media -->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="avatar avatar-sm"
                                                src="{{ asset('/assets/svg/brands/mastercard.svg') }}"
                                                alt="Image Description">
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <div class="row">
                                                <div class="col-sm mb-3 mb-sm-0">
                                                    <span class="d-block text-dark">MasterCard •••• 4242</span>
                                                    <small class="d-block text-muted">Checking - Expires 12/22</small>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col-sm-auto">
                                                    <div class="d-flex gap-3">
                                                        <a class="btn btn-white btn-sm" href="javascript:;"
                                                            data-bs-toggle="modal" data-bs-target="#accountEditCardModal">
                                                            <i class="bi-pencil-fill me-1"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm">
                                                            <i class="bi-trash me-1"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                    <!-- End Media -->
                                </li>
                                <!-- End Item -->

                                <!-- Item -->
                                <li class="list-group-item">
                                    <div class="mb-2">
                                        <h5>Maria Williams <span class="text-danger small ms-1">Expired</span></h5>
                                    </div>

                                    <!-- Media -->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="avatar avatar-sm"
                                                src="{{ asset('./assets/svg/brands/visa.svg') }}" alt="Image Description">
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <div class="row">
                                                <div class="col-sm mb-3 mb-sm-0">
                                                    <span class="d-block text-dark">Visa •••• 9016</span>
                                                    <small class="d-block text-muted">Debit - Expires 04/20</small>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col-sm-auto">
                                                    <div class="d-flex gap-3">
                                                        <a class="btn btn-white btn-sm" href="javascript:;"
                                                            data-bs-toggle="modal" data-bs-target="#accountEditCardModal">
                                                            <i class="bi-pencil-fill me-1"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm">
                                                            <i class="bi-trash me-1"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                    <!-- End Media -->
                                </li>
                                <!-- End Item -->
                            </ul>
                            <!-- End List Group -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Card -->
                                    <a class="card card-dashed card-centered" href="javascript:;" data-bs-toggle="modal"
                                        data-bs-target="#accountAddCardModal">
                                        <div class="card-body card-dashed-body py-7">
                                            <span> <img class="avatar avatar-lg avatar-sm mb-2"
                                                    src="{{ asset('/assets/svg/illustrations/oc-add-card.svg') }}"
                                                    alt="Image Description" data-hs-theme-appearance="default">
                                                <img class="avatar avatar-lg avatar-sm mb-2"
                                                    src="{{ asset('/assets/svg/illustrations-light/oc-add-card.svg') }}"
                                                    alt="Image Description" data-hs-theme-appearance="dark">
                                                Add a new card</span>
                                        </div>
                                    </a>
                                    <!-- End Card -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->


                </div>
            </div>
            <!-- End Col -->
        </div>





        <!-- Card -->
        <div class="card  my-3 ">
            <!-- Header -->
            <div class="card-header">
                <h4 class="card-header-title">Order history</h4>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive position-relative">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Updated</th>
                            <th>Invoice</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><a href="#">#3682303</a></td>
                            <td><span class="badge bg-soft-warning text-warning">Pending</span></td>
                            <td>$264</td>
                            <td>22/04/2020</td>
                            <td><a class="btn btn-white btn-sm" href="#"><i
                                        class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>
                            <td>
                                <a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick
                                    view</a>
                            </td>
                        </tr>

                        <tr>
                            <td><a href="#">#2333234</a></td>
                            <td><span class="badge bg-soft-success text-success">Successful</span></td>
                            <td>$264</td>
                            <td>22/04/2019</td>
                            <td><a class="btn btn-white btn-sm" href="#"><i
                                        class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>
                            <td><a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick
                                    view</a></td>
                        </tr>

                        <tr>
                            <td><a href="#">#9834283</a></td>
                            <td><span class="badge bg-soft-success text-success">Successful</span></td>
                            <td>$264</td>
                            <td>22/04/2018</td>
                            <td><a class="btn btn-white btn-sm" href="#"><i
                                        class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>
                            <td><a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick
                                    view</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Table -->
        </div>
        <!-- End Card -->
        <!-- Update Plan Modal -->
        <div class="modal fade" id="accountUpdatePlanModal" tabindex="-1" aria-labelledby="accountUpdatePlanModalLabel"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="accountUpdatePlanModalLabel">Subscription plan</h4>
                        <div class="text-center mb-2 mb-sm-0 ms-3">
                         
                           Current plan 
                            <span class="badge bg-primary rounded-2">
                              @php
                                  $licenseType = $license_code->license_type ?? null;
                              @endphp
                              {{ $licenseType === 1 ? 'Basic License' : ($licenseType === 2 ? 'Pro License' : ($licenseType === 3 ? 'Advanced License' : 'Unknown License')) }}
                          </span>
                          
                      </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Form Switch -->
                        {{-- <div class="d-flex justify-content-center mb-5">
            <div class="form-check form-switch form-switch-between">
              <label class="form-check-label">Monthly</label>
              <input class="js-toggle-switch form-check-input" type="checkbox" checked data-hs-toggle-switch-options='{
                       "targetSelector": "#pricingCount1, #pricingCount2, #pricingCount3"
                     }'>
              <label class="form-check-label form-switch-promotion">
                Annually
                <span class="form-switch-promotion-container">
                  <span class="form-switch-promotion-body">
                    <svg class="form-switch-promotion-arrow" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 99.3 57" width="48">
                      <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M2,39.5l7.7,14.8c0.4,0.7,1.3,0.9,2,0.4L27.9,42"></path>
                      <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M11,54.3c0,0,10.3-65.2,86.3-50"></path>
                    </svg>
                    <span class="form-switch-promotion-text">
                      <span class="badge bg-primary rounded-pill ms-1">Save up to 10%</span>
                    </span>
                  </span>
                </span>
              </label>
            </div>
          </div> --}}
                        <!-- End Form Switch -->

                        <div class="row mb-3">
                            <div class="col-md mb-3">
                                <!-- Card -->
                                <div class="card card-lg form-check form-check-select-stretched h-100 zi-1">
                                    <div class="card-header text-center">
                                        <!-- Form Check -->
                                        <input type="radio" class="form-check-input" name="billingPricingRadio"
                                            id="billingPricingRadio1" value="basic">
                                        <label class="form-check-label" for="billingPricingRadio1"></label>
                                        <!-- End Form Check -->

                                        <span class="card-subtitle text-primary">Basic</span>
                                        <h2 class="card-title display-3 text-dark">Free</h2>
                                        <p class="card-text">Forever free</p>
                                    </div>

                                    <div class="card-body d-flex justify-content-center">
                                        <!-- List Checked -->
                                        <ul class="list-checked list-checked-primary mb-0">
                                            <li class="list-checked-item">1 user</li>
                                            <li class="list-checked-item">Front plan features</li>
                                            <li class="list-checked-item">1 app</li>
                                        </ul>
                                        <!-- End List Checked -->
                                    </div>

                                    <div class="card-footer border-0 text-center">
                                        <div class="d-grid mb-2">
                                            <button type="button"
                                                class="form-check-select-stretched-btn btn btn-white">Select plan</button>
                                        </div>
                                        <p class="card-text small">
                                            <i class="bi-question-circle me-1"></i> Terms &amp; conditions apply
                                        </p>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Col -->

                            <div class="col-md mb-3">
                                <!-- Card -->
                                <div class="card card-lg form-check form-check-select-stretched h-100 zi-1">
                                    <div class="card-header text-center">
                                        <!-- Form Check -->
                                        <input type="radio" class="form-check-input" name="billingPricingRadio"
                                            id="billingPricingRadio2" checked value="starter">
                                        <label class="form-check-label" for="billingPricingRadio2"></label>
                                        <!-- End Form Check -->

                                        <span class="card-subtitle text-primary">Pro</span>
                                        <h2 class="card-title display-3 text-dark">
                                            $<span id="pricingCount1"
                                                data-hs-toggle-switch-item-options='{
                             "min": 22,
                             "max": 32
                           }'>32</span>
                                            <span class="fs-6 text-muted">/ mon</span>
                                        </h2>
                                        <p class="card-text">Or prepay monthly</p>
                                    </div>

                                    <div class="card-body d-flex justify-content-center">
                                        <!-- List Checked -->
                                        <ul class="list-checked list-checked-primary mb-0">
                                            <li class="list-checked-item">3 users</li>
                                            <li class="list-checked-item">Front plan features</li>
                                            <li class="list-checked-item">3 apps</li>
                                            <li class="list-checked-item">Product support</li>
                                        </ul>
                                        <!-- End List Checked -->
                                    </div>

                                    <div class="card-footer border-0 text-center">
                                        <div class="d-grid mb-2">
                                            <button type="button"
                                                class="form-check-select-stretched-btn btn btn-white">Select plan</button>
                                        </div>
                                        <p class="card-text small">
                                            <i class="bi-question-circle me-1"></i> Terms &amp; conditions apply
                                        </p>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Col -->

                            <div class="col-md mb-3">
                                <!-- Card -->
                                <div class="card card-lg form-check form-check-select-stretched h-100 zi-1">
                                    <div class="card-header text-center">
                                        <!-- Form Check -->
                                        <input type="radio" class="form-check-input" name="billingPricingRadio"
                                            id="billingPricingRadio3" value="enterprise">
                                        <label class="form-check-label" for="billingPricingRadio3"></label>
                                        <!-- End Form Check -->

                                        <span class="card-subtitle text-primary">Advance</span>
                                        <h2 class="card-title display-3 text-dark">
                                            $<span id="pricingCount2"
                                                data-hs-toggle-switch-item-options='{
                             "min": 42,
                             "max": 54
                           }'>54</span>
                                            <span class="fs-6 text-muted">/ mon</span>
                                        </h2>
                                        <p class="card-text">Or prepay annually</p>
                                    </div>

                                    <div class="card-body d-flex justify-content-center">
                                        <!-- List Checked -->
                                        <ul class="list-checked list-checked-primary mb-0">
                                            <li class="list-checked-item">Unlimited users</li>
                                            <li class="list-checked-item">Front plan features</li>
                                            <li class="list-checked-item">Unlimited apps</li>
                                            <li class="list-checked-item">Product support</li>
                                        </ul>
                                        <!-- End List Checked -->
                                    </div>

                                    <div class="card-footer border-0 text-center">
                                        <div class="d-grid mb-2">
                                            <button type="button"
                                                class="form-check-select-stretched-btn btn btn-white">Select plan</button>
                                        </div>
                                        <p class="card-text small">
                                            <i class="bi-question-circle me-1"></i> Terms &amp; conditions apply
                                        </p>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->

                      

                        <div class="d-flex justify-content-center justify-content-sm-end gap-3">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upgrade plan</button>
                        </div>
                    </div>
                    <!-- End Body -->
                </div>
            </div>
        </div>
        <!-- End Update Plan Modal -->
        <!-- Add Card Modal -->
        <div class="modal fade" id="accountAddCardModal" tabindex="-1" aria-labelledby="accountAddCardModalLabel"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="accountAddCardModalLabel">Add card</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <form>
                            <!-- Radio Button Group -->
                            <div class="btn-group-sm-vertical">
                                <div class="btn-group btn-group-segment btn-group-fill mb-4" role="group"
                                    aria-label="Account add card radio button group">
                                    <input type="radio" class="btn-check" name="accountAddCardBtnRadio"
                                        id="accountAddCardBtnRadioOption1" autocomplete="off" checked>
                                    <label class="btn btn-sm" for="accountAddCardBtnRadioOption1">Credit or Debit
                                        card</label>

                                    <input type="radio" class="btn-check" name="accountAddCardBtnRadio"
                                        id="accountAddCardBtnRadioOption2" autocomplete="off" disabled>
                                    <label class="btn btn-sm" for="accountAddCardBtnRadioOption2">PayPal <span
                                            class="badge bg-soft-primary text-primary">Coming soon</span></label>
                                </div>
                            </div>
                            <!-- End Radio Button Group -->

                            <!-- Form -->
                            <div class="mb-4">
                                <label for="cardNameLabel" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cardNameLabel" placeholder="Payoneer"
                                    aria-label="Payoneer">
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="mb-4">
                                <label for="cardNumberLabel" class="form-label">Card number</label>
                                <input type="text" class="js-input-mask form-control" name="cardNumber"
                                    id="cardNumberLabel" placeholder="xxxx xxxx xxxx xxxx"
                                    aria-label="xxxx xxxx xxxx xxxx"
                                    data-hs-mask-options='{
                      "mask": "0000 0000 0000 0000"
                    }'>
                            </div>
                            <!-- End Form -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <label for="expirationDateLabel" class="form-label">Expiration date</label>
                                        <input type="text" class="js-input-mask form-control" name="expirationDate"
                                            id="expirationDateLabel" placeholder="xx/xxxx" aria-label="xx/xxxx"
                                            data-hs-mask-options='{
                          "mask": "00/0000"
                        }'>
                                    </div>
                                    <!-- End Form -->
                                </div>

                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <label for="securityCodeLabel" class="form-label">CVV Code <i
                                                class="bi-question-circle text-body ms-1" data-toggle="tooltip"
                                                data-placement="top"
                                                title="A 3 - digit number, typically printed on the back of a card."></i></label>
                                        <input type="text" class="js-input-mask form-control" name="securityCode"
                                            id="securityCodeLabel" placeholder="xxx" aria-label="xxx"
                                            data-hs-mask-options='{
                          "mask": "000"
                        }'>
                                    </div>
                                    <!-- End Form -->
                                </div>
                            </div>
                            <!-- End Row -->

                            <!-- Custom Checkbox -->
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="makePrimaryCheckbox1">
                                <label class="form-check-label" for="makePrimaryCheckbox1">Make this primary card</label>
                            </div>
                            <!-- End Custom Checkbox -->

                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Body -->
                </div>
            </div>
        </div>
        {{-- end of card update modal --}}
        <!-- Edit Card Modal -->
        <div class="modal fade" id="accountEditCardModal" tabindex="-1" aria-labelledby="accountEditCardModalLabel"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="accountEditCardModalLabel">Edit card</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <form>
                            <!-- Form -->
                            <div class="mb-4">
                                <label for="editCardNameLabel" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="editCardNameLabel"
                                    placeholder="Maria Williams" aria-label="Maria Williams" value="Maria Williams">
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="mb-4">
                                <label for="editCardNumberLabel" class="form-label">Card number</label>
                                <input type="text" class="js-input-mask form-control" name="cardNumber"
                                    id="editCardNumberLabel" placeholder="xxxx xxxx xxxx xxxx"
                                    aria-label="xxxx xxxx xxxx xxxx" value="5200 7084 8243 4242"
                                    data-hs-mask-options='{
                      "mask": "0000 0000 0000 0000"
                    }'>
                            </div>
                            <!-- End Form -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <label for="editCardEexpirationDateLabel" class="form-label">Expiration
                                            date</label>
                                        <input type="text" class="js-input-mask form-control" name="expirationDate"
                                            id="editCardEexpirationDateLabel" placeholder="xx/xxxx" aria-label="xx/xxxx"
                                            value="12/2022"
                                            data-hs-mask-options='{
                          "mask": "00/0000"
                        }'>
                                    </div>
                                    <!-- End Form -->
                                </div>

                                <div class="col-sm-6">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <label for="editCardSecurityCodeLabel" class="form-label">CVV Code <i
                                                class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="A 3 - digit number, typically printed on the back of a card."></i></label>
                                        <input type="password" class="js-input-mask form-control" name="securityCode"
                                            id="editCardSecurityCodeLabel" placeholder="xxx" aria-label="xxx"
                                            value="789"
                                            data-hs-mask-options='{
                          "mask": "000"
                        }'>
                                    </div>
                                    <!-- End Form -->
                                </div>
                            </div>
                            <!-- End Row -->

                            <!-- Custom Checkbox -->
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="editCardMakePrimaryCheckbox2"
                                    checked>
                                <label class="form-check-label" for="editCardMakePrimaryCheckbox2">Make this primary
                                    card</label>
                            </div>
                            <!-- End Custom Checkbox -->

                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Body -->
                </div>
            </div>
        </div>
        {{-- card edit modal end --}}
        <!-- Add Address Modal -->
        <div class="modal fade" id="accountAddAddressModal" tabindex="-1" aria-labelledby="accountAddAddressModalLabel"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="accountAddAddressModalLabel">More filters</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Form -->
                        <form>
                            <!-- Form -->
                            <div class="row mb-4">
                                <label for="locationLabel" class="col-sm-3 col-form-label form-label">Location</label>

                                <div class="col-sm-9">
                                    <!-- Select -->
                                    <div class="tom-select-custom mb-4">
                                        <select class="js-select form-select" id="locationLabel">
                                            <option value="test">location</option>
                                        </select>
                                    </div>
                                    <!-- End Select -->

                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="city" id="cityLabel"
                                            placeholder="City" aria-label="City">
                                    </div>
                                    <input type="text" class="form-control" name="state" id="stateLabel"
                                        placeholder="State" aria-label="State">
                                </div>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="row mb-4">
                                <label for="addressLine1Label" class="col-sm-3 col-form-label form-label">Address line
                                    1</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="addressLine1"
                                        id="addressLine1Label" placeholder="Your address" aria-label="Your address">
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
                                    <input type="text" class="js-masked-input form-control" name="zipCode"
                                        id="zipCodeLabel" placeholder="Your zip code" aria-label="Your zip code"
                                        data-hs-mask-options='{
                         "mask": "AA0 0AA"
                       }'>
                                </div>
                            </div>
                            <!-- End Form -->

                            <div class="d-flex justify-content-end gap-sm-3">
                                <button type="button" class="btn btn-white me-2 me-sm-0"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Body -->
                </div>
            </div>
        </div>
        {{-- end of address update modal --}}

      </div>
    </main>
@endsection
