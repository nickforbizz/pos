@extends('layouts.frontend')
    
    @section('content')
    <!-- Intro Start -->
    <section id="intro" class="full-height">
        <!-- Intro Panel Start -->
        <div class="intro-panel">
            <div class="container">
                <!-- Row Start -->
                <div class="row d-flex flex-row-reverse">
                    <!-- Btn & Info Start -->
                    <div class="col-lg-7 col-md-7 col-sm-12 d-flex">
                        <div class="align-self-center">
                            <!-- Title and Description -->
                            <div class="intro-content">
                                <h1 class="h1">we connect people for better business</h1>
                                <p>Ne assum iracundia appellantur vel, mea cu alia fugit splendide, est in animal epicuri indoctum. Eam ignota intellegebat ad. Dolor utamur debitis eos at.</p>
                            </div>
                            <div class="icon-btn clearfix">
                                
                                <!-- Btn Start -->
                                <a href="#support" class="btn rounded p-btn bxs-none">
                                    <!-- Icon Btn Start -->
                                    <span class="icon-btn-card">
                                        <!-- Btn Icon -->
                                        <span class="icon-btn-card-item">
                                            <i class="icon ti-email"></i>
                                        </span>
                                        <!-- Btn Text -->
                                        <span class="icon-btn-card-item pl-2">
                                            <span class="icon-head">Contact Us</span>
                                        </span>
                                    </span>
                                    <!-- Icon Btn End -->
                                </a>
                                <!-- Btn End -->
                            </div>
                        </div>
                    </div>
                    <!-- Btn & Info End -->
                    <!-- Mobile Screen Start -->
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <img src="{{ asset('assets/frontend/img/heroimg.png') }}"  id="mobile-img" alt="Mobile screen">
                    </div>
                    <!-- Mobile Screen End -->
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Intro Panel End -->
    </section>
    <!-- Intro End -->
    
    <!-- About Start -->
    <section id="about" class="pt-6">
        <div class="container">
            <!-- Heading Start -->
            <div class="heading text-center">
                <h2 class="h2">All about {{ env('APP_NAME') }}</h2>
                <span class="sub-head">Main moto to connect people for business</span>
            </div>
            <!-- Heading End -->
            <!-- Row Start -->
            <div class="row">
                <div class="col-lg-8 col-md-12 mx-auto">
                    <!-- Row Start -->
                    <div class="row d-flex flex-row-reverse">
                        <!-- App Screen Start -->
                       <div class="col-lg-7 col-md-6 col-sm-12">
                            <div id="appScreen">
                                <img src="{{ asset('assets/frontend/img/02.jpg') }}" class="mob-screen mob-1" alt="Mobile screen 01">
                                <img src="{{ asset('assets/frontend/img/03.jpg') }}" class="mob-screen mob-2" alt="Mobile screen 02">
                            </div>
                        </div>
                        <!-- App Screen End -->
                        <!-- Description Start -->
                        <div class="col-lg-5 col-md-6 col-sm-12 d-flex about-desc">
                            <!-- Description Center Start -->
                            <div class="align-self-center">
                                <span class="h4 mb-4">{{ env('APP_NAME') }} deals with the business</span>
                                <p>Lorem ipsum dolor sit amet, pro populo principes ex. Sensibus petentium vim ut, in sed discere accusata. Eos cu facer populo pericula, in eam fastidii consequat persecuti, sea vocent vivendo eu. Eu qui aeque facilis, te mel ancillae sensibus cotidieque.</p>
                            </div>
                            <!-- Description Center End -->
                        </div>
                        <!-- Description End -->
                    </div>
                    <!-- Row End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- About End -->
    
    <!-- Feature Start -->
    <section id="features" class="pt-6">
        <div class="container">
            <!-- Heading Start -->
            <div class="heading text-center">
                <h2 class="h2">Features</h2>
                <span class="sub-head">Best app features</span>
            </div>
            <!-- Heading End -->
            <!-- Informational Text Start -->
            <div class="info-txt text-center row">
                <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                    <p>Ridens labitur evertitur pri cu, eam ne omnis definiebas. Qui ne habemus maluisset. Te nam timeam legendos.</p>
                </div>
            </div>
            <!-- Informational Text End -->
            <!-- Row Start -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-rocket align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Launch</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div>
                        <!-- Feature Description End -->                        
                    </div>
                    <!-- Feature Card End -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-agenda align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Contact list</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div>
                        <!-- Feature Description End -->                        
                    </div>
                    <!-- Feature Card End -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-bell align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Notification</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div>
                        <!-- Feature Description End -->                        
                    </div>
                    <!-- Feature Card End -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-calendar align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Set Meeting</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div> 
                        <!-- Feature Description End -->                       
                    </div>
                    <!-- Feature Card End -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-location-pin align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Location</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div> 
                        <!-- Feature Description End -->                       
                    </div>
                    <!-- Feature Card End -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Feature Card Start -->
                    <div class="feature-card p-4 d-flex align-items-stretch">
                        <!-- Feature Icon Start -->
                        <div class="align-self-center">
                            <div class="icon-circle white d-flex">
                                <i class="ti-cloud align-self-center mx-auto"></i>
                            </div>
                        </div>
                        <!-- Feature Icon End -->
                        <!-- Feature Description Start -->
                        <div class="pl-3">
                            <span class="h5 mb-1">Cloud</span>
                            <p>Altera persius expetendis ad qui, his mentitum postulant ut, facer iudico ea vix.</p>
                        </div> 
                        <!-- Feature Description End -->                       
                    </div>
                    <!-- Feature Card End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- Feature End -->

    

    
    <!-- Static Start -->
    <div id="counter" class="static py-6 mt-6">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <!-- Static Card Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 text-center app-info">                   
                    <span class="counter-value d-block head pb-1" data-count="4.5">0</span>
                    <span class="d-block">App Ratings</span>
                </div>
                <!-- Static Card End -->
                <!-- Static Card Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 text-center app-info">                   
                    <span class="counter-value d-block head pb-1" data-count="3231">30</span>
                    <span class="d-block">Downloads</span>
                </div>
                <!-- Static Card End -->
                <!-- Static Card Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 text-center app-info">                   
                    <span class="counter-value d-block head pb-1" data-count="12000">12</span>
                    <span class="d-block">Likes</span>
                </div>
                <!-- Static Card End -->
                <!-- Static Card Start -->
                <div class="col-lg-3 col-md-3 col-sm-6 text-center app-info">                   
                    <span class="counter-value d-block head pb-1" data-count="2632">32</span>
                    <span class="d-block">Comment</span>
                </div>
                <!-- Static Card End -->
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Static End -->
    

    


    
    <!-- Support Start -->
    <section id="support" class="pt-6">
        <div class="container">
            <!-- Heading Start -->
            <div class="heading text-center">
                <h2 class="h2">Get the App</h2>
                <span class="sub-head">Download best app for your business</span>
            </div>
            <!-- Heading End -->
            <!-- Informational Text Start -->
            <div class="info-txt text-center row">
                <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                    <p>Ridens labitur evertitur pri cu, eam ne omnis definiebas. Qui ne habemus maluisset. Te nam timeam legendos.</p>
                </div>
            </div>
            <!-- Informational Text End -->


        </div>
        <!-- Contact Start -->
        <div class="contact position-relative">
            <div class="container">
                <!-- Row Start -->
                <div class="row">
                    <div class="col-lg-10 col-md-12 mx-auto">
                        <!-- Contact Card Start -->
                        <div class="d-md-flex xs-shadow contact-card">
                            <!-- Contact Form Start -->
                            <div class="col-lg-7 col-md-7 col-sm-12 contact-form">
                                <div class="px-md-3 py-md-4 py-4">
                                    <span class="head d-block mb-3">Get in touch</span>
                                    <!-- Form Start -->
                                    <form action="#" id="contact-frm" class="position-relative">
                                        <!-- Form Field -->
                                        <div class="form-field mb-3">
                                            <input name="name" id="name" type="text" placeholder="Name" class="form-control fc-line" required>
                                            <label for="name" class="input-line"></label>
                                        </div>
                                        <!-- Form Field -->
                                        <div class="form-field mb-3">
                                            <input name="email" id="email" type="email" placeholder="Email" class="form-control fc-line" required>
                                            <label for="email" class="input-line"></label>
                                        </div>
                                        <!-- Form Field -->
                                        <div class="form-field mb-4">
                                            <textarea name="msg" id="msg" cols="6" rows="3" placeholder="Message" class="form-control fc-line"></textarea>
                                            <label for="msg" class="input-line"></label>
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <input type="submit" value="Send" class="btn btn-rounded p-btn line">
                                        </div>
                                        <!-- Display Message -->
                                        <div id="success"></div>
                                    </form>
                                    <!-- Form End -->
                                </div>
                            </div>
                            <!-- Contact Form End -->
                            <!-- Address Start -->
                            <div class="col-lg-5 col-md-5 col-sm-12 address">
                                <div class="px-md-3 py-md-4 py-4">
                                    <span class="head d-block mb-2">Address</span>
                                    <p>Sed elit erant maiestatis te, cum ad sale dicant vocibus. Mei fabellas salutandi facilisis ea, ius libris platonem ullamcorper ne.</p>
                                    <!-- Address Information Start -->
                                    <div class="add-info mt-5">
                                        <!-- Icon with Text -->
                                        <div class="mb-4 clearfix">
                                            <i class="ti-mobile float-left mr-3"></i>
                                            <span class="d-block float-left">513-255-8743</span>
                                        </div>
                                        <!-- Icon with Text -->
                                        <div class="mb-4 clearfix">
                                            <i class="ti-email float-left mr-3"></i>
                                            <a href="mailto:example@yourdomain.com" class="d-block float-left">info@supertechnomads.com</a>
                                        </div>
                                        <!-- Icon with Text -->
                                        <div class="add mb-4 clearfix">
                                            <i class="ti-location-pin float-left mr-3"></i>
                                            <p class="float-left">4212 Walnut Hill Drive <br>Cincinnati, OH 45202 </p>
                                        </div>
                                    </div>
                                    <!-- Address Information End -->
                                </div>
                            </div>
                            <!-- Address End -->
                        </div>
                        <!-- Contact Card End -->
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Contact End -->
    </section>
    <!-- Support End -->



@endsection


@push('scripts')
<!-- Scripts -->
<script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/lity.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/frontend/js/custom.js') }}"></script>
@endpush