<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Keyword Alert</title>
    
</head>
<body>
    <main id="content" role="main">   


        <!-- Contacts -->
        <div class="position-relative">
            <div class="bg bg-light bg-img-start">
                <div class="container content-space-t-2 content-space-t-lg-2 content-space-b-1">
                    <!-- Heading -->
                    <!-- <div class="w-lg-50 text-center mx-lg-auto mb-7">
            <img class="navbar-brand-logo" src="./assets/img/logo-boondock1.png" alt="Logo">
          
           </div> -->
                    <!-- End Heading -->

                    <div class="mx-auto" style="max-width: 37rem;">
                        <!-- Card -->
                        <div class="card zi-2">
                            <div class="card-body">

                                <!-- Card -->
                                 <div class="w-lg-50 text-center mx-lg-auto mb-7">
                                        <a href="https://dev.boondockdev.com/">
                                                    <img class="navbar-brand-logo" src="./assets/img/logo-boondock1.png"
                                                        alt="Logo">
                                        </a>
                                        </div>
                                        <div class="bg bg-soft-danger py-1 mb-5" >
                                            <p class="text-black ps-3 mt-2">Alert
                                                Notification : <span class="badge bg-primary mx-2">{{ count($keywords) }}</span>
                                                Keywords Detected</p>
                                        </div>
                                        <p class="text-black">Hello <span class="text-primary">{{ $ownerName }} </span>,</p>
                                        <p class="text-black"> We hope this email finds you well. We are writing to inform you about an alert triggered by our keyword monitoring system. Received from Dock <span class="text-dark-blue">{{ $dockName }}</span>.</p>
                                       
                                

                                            <div class="row my-5">
                                                <p class="text-black">Alert Details:   </p>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        Alert Time 
                                                    </div>
                                                    <div class="col-8">
                                                        [Date and Time]
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        Keywords <span class=" text-primary mx-1">{{ count($keywords) }}</span> 
                                                    </div>
                                                    <div class="col-8">
                                                        <ul>
                                                            @foreach ($keywords as $keyword)
                                                                <li class=" mx-1 badge bg-soft-primary text-primary">{{ $keyword }}</li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        Transcription 
                                                    </div>
                                                    <div class="col-8">
                                                        This is a transcription line
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                      <p class="mt-2"> Alert  Audio </p>
                                                    </div>
                                                    <div class="col-8">
                                                        <audio controls style="width: 240px; height: 40px;">
                                                            <source src="{{ $audioFileUrl }}" type="">
                                                           <span class="small text-muted"> Your browser does not support the audio element.</span>
                                                        </audio>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                      <p class="">Dock Location found at</p>
                                                    </div>
                                                    <div class="col-8">
                                                        <a href="#" class="alert-link">location link</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-black">Thank you for your attention to this matter. If you have any further questions or require additional assistance, please do not hesitate to reach out to us.</p>
                                    <span class="divider-end"></span>
                             
                                    <div class="card-body text-center">

                                        <p class="small text-muted">We
                                            value your trust and are
                                            here to assist you. Contact
                                            our support team at <a
                                                href="mailto:support@boondock.live">support@boondock.live</a>
                                            for any assistance.</p>

                                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->

                                        <!-- Socials -->
                                        <ul class="list-inline mb-0 center text-center">
                                            <li class="list-inline-item">
                                                <a class="btn btn-ghost-secondary btn-sm btn-icon rounded-circle"
                                                    href="#">
                                                    <i class="bi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="btn btn-ghost-secondary btn-sm btn-icon rounded-circle"
                                                    href="#">
                                                    <i class="bi-slack"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="btn btn-ghost-secondary btn-sm btn-icon rounded-circle"
                                                    href="#">
                                                    <i class="bi-github"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="btn btn-ghost-secondary btn-sm btn-icon rounded-circle"
                                                    href="#">
                                                    <i class="bi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="btn btn-ghost-secondary btn-sm btn-icon rounded-circle"
                                                    href="#">
                                                    <i class="bi-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Socials -->
                                        <div class="w-md-85 text-lg-center mx-lg-auto mt-2">
                                            <p class="text-muted small"> <a href="https://dev.boondockdev.com/">BooondockEcho</a>
                                                | © 2023. All rights
                                                reserved.</p>

                                        </div>
                                    </div>
                                
                                <!-- End Card -->

                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>

            <!-- Shape -->
            <div class="shape shape-bottom zi-1">
                <svg width="3000" height="500" viewBox="0 0 3000 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 500H3000V0L0 500Z" fill="#fff" />
                </svg>
            </div>
            <!-- End Shape -->
        </div>
        <!-- End Contacts -->
    </main>
</body>
</html>