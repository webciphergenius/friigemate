<template>
      <header class="mainHead">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<div class="popup-overlay" id="popup">
    <div class="popup-content">
        <button class="close-btn" id="closeBtn">&times;</button>
        <div class="pop-header">
            <div class="pop-logo">
                <img src="../../images/Go_FreightMate_logo.png" alt="brand-logo">
            </div>
            <h3>WANT TO MOVE FREIGHT <span class="highlight">SMARTER</span> AND <span class="highlight">FASTER?</span></h3>
            <h5>Stay <b>on time and in control</b> with <span class="highlight"><b>Go FreightMate™.</b></span></h5>
            <p>Let us handle the heavy lifting—track shipments, connect with <br>drivers, and streamline deliveries all in one place.</p>
        </div>
        <div class="pop-body">
            <div class="pop-left-img">
                <img src="../../images/pop-img-left.png" alt="pop-img-left">
            </div>
            <div class="pop-left-form">
                <h4>Sign up for early access</h4>
                <p>Be the first to test Go FreightMate™ and unlock smoother shipping.</p>
                <form @submit.prevent="submitPopupForm" id="popForm">
                    <input type="text" name="userName" id="userName" v-model="popupForm.userName" placeholder="Your Name">
                    <input type="email" name="userEmail" id="userEmail" v-model="popupForm.userEmail" placeholder="Your Email*" required>
                    <input type="submit" value="Let's move freight!" class="submitBtnpop">
                </form>
                <p v-if="popupSuccessMessage" class="success">{{ popupSuccessMessage }}</p>
                <p v-if="popupErrorMessage" class="error">{{ popupErrorMessage }}</p>
            </div>
        </div>
    </div>
</div>
        <div class="container">
            
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand fw-bold" href="/"><img src="../../images/Go_FreightMate_logo.png" alt="brand-logo"></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Home
                            </a>
                           
                      </li>
                     
                      <li class="nav-item">
                        <a class="nav-link" href="#screen">Screens</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#feature">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#team">Our Team</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#myblg">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="tel:8885094480"><i class="fa fa-phone"></i> (888) 509-4480</a>
                      </li>
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="https://www.facebook.com/profile.php?id=61577783482435" target="_blank"><img src="../../images/facebook.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://youtube.com/@gofreightmate?si=KgThF0f_TcgdmwMf" target="_blank"><img src="../../images/youtube.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/gofreightmate?igsh=OTdsZ2ZqY24ycHAx&utm_source=qr" target="_blank"><img src="../../images/insta.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://www.tiktok.com/@gofreightmate?_t=ZS-90Xr1wJJ5Wa&_r=1" target="_blank"><img src="../../images/tiktok-head-icon.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://www.linkedin.com/company/gofreightmate/" target="_blank"><img src="../../images/linkedin-head-icon.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://x.com/gofreightmate?s=21" target="_blank"><img src="../../images/twitter-head-icon.png" alt="social-icon"></a></li>
                    </ul>
                    <!-- <a href="/registration" class="getstartedBtn">Get Started</a> -->
                </div>
            </div>
              </nav>
        </div>
        
    </header>
    
    <div class="wrapperMain">
        <section class="pgHero" id="home">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="../../images/go-freightmate-video.mp4" type="video/mp4" />
            </video>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <figure class="m-0">
                            <img
                                src="../../images/hero-with-newlogo.png"
                                alt="hero-image"
                                class="w-75"
                            />
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <div class="heroContent text-end text-white">
                            <h1 class="fw-bold">
                                Redefining Freight
                                Management
                            </h1>
                            <p>
                                Effortless logistics, smarter solutions, and
                                unmatched reliability.
                            </p> 
                            <!-- <a
                                href="https://gofreightmate.com/registration"
                                class="btn border border-2 rounded-0 text-white p-3 my-3 bold"
                                >Get Started Today</a
                            >  -->
                            <div class="heroBtns">
                                <a href="https://apps.apple.com/in/app/go-freightmate/id6748914156" target="_blank"><img
                                        src="../../images/app-store-icon.png"
                                        alt="app-store"
                                /></a>
                                <a href="javascript:void(0)" class="hover-msg"><img
                                        src="../../images/play-store-icon.png"
                                        alt="play-store"
                                /></a>
                            </div>
                            <i class="my-3 d-block"
                                >* Requires iOS 7.0 or higher</i
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="statMain sameSpace">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <div class="statBlock">
                            <figure>
                                <img
                                    src="../../images/stat-01icon.png"
                                    alt="stat-icon"
                                />
                            </figure>
                            <h4>Efficient Solutions</h4>
                            <p>
                                Streamline your freight operations with
                                cutting-edge tools designed to save you time and
                                maximize efficiency.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="statBlock">
                            <figure>
                                <img
                                    src="../../images/stat-02icon.png"
                                    alt="stat-icon"
                                />
                            </figure>
                            <h4>Seamless Connectivity</h4>
                            <p>
                                Connect with shippers and carriers instantly
                                through our integrated platform for unmatched
                                collaboration.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="statBlock">
                            <figure>
                                <img
                                    src="../../images/stat-03icon.png"
                                    alt="stat-icon"
                                />
                            </figure>
                            <h4>Cloud-Based Platform</h4>
                            <p>
                                Access your freight data anywhere, anytime with
                                our secure, cloud-based logistics solution.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="logisticsMain">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <figure class="logisticsFigure text-center m-0">
                            <img
                                src="../../images/smart-with-newlogo.png"
                                alt="logistics-image"
                                class="w-75"
                            />
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <div class="logisticsBlock">
                            <h2>
                                Go Freightmate: Smarter Freight, Simplified
                                Logistics
                            </h2>
                            <p>
                                Effortlessly manage your shipments with
                                Go Freightmate®, your all-in-one logistics
                                platform. Designed to connect shippers and
                                carriers seamlessly, our intuitive app makes
                                freight management easier, faster, and more
                                efficient.
                            </p>
                            <strong>Key Features:</strong>
                            <ul class="logisticList">
                                <li>
                                    <strong>Real-Time Tracking:</strong> Always
                                    know where your freight is with live
                                    updates.
                                </li>
                                <li>
                                    <strong>Secure Transactions:</strong>
                                    Conduct encrypted, worry-free payments for
                                    every shipment.
                                </li>
                                <li>
                                    <strong>Seamless Communication:</strong>
                                    Instantly connect and collaborate with
                                    shippers and carriers.
                                </li>
                                <li>
                                    <strong>Cloud Integration:</strong> Access
                                    your freight data anytime, anywhere, from
                                    any device.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="partnerMain">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="partnerBlock">
                            <h2>
                                Go Freightmate: Your Logistics Partner on the Go
                            </h2>
                            <p>
                                Take control of your freight management with
                                Go Freightmate®—the ultimate solution for seamless
                                shipping. Easily create, manage, and track
                                shipments, all from the palm of your hand.
                            </p>
                            <p>
                                <strong
                                    >Available on iPhone, iPad, and Android
                                    devices</strong
                                ><br />
                                Compatible with Android 5.5+ and iOS 7.0+
                            </p>
                            <p>
                                <strong>Streamlined for Efficiency:</strong
                                ><br />
                                Input shipment details effortlessly. Get
                                real-time updates and notifications. Stay
                                connected with carriers and shippers.
                            </p>
                            <p>
                                <strong
                                    >Simplify Your Freight Journey
                                    Today!</strong
                                ><br />
                                Compatible with Android 5.5+ and iOS 7.0+
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <figure class="partnerFigure text-center m-0">
                            <img
                                src="../../images/partner-with-newlogo.png"
                                alt="partner-image"
                                class="w-45"
                            />
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="portfolioSec">
            <div class="container">
                <div class="secHeading text-center">
                    <h2>Explore Go Freightmate in Action</h2>
                    <p>
                        See why Go Freightmate® is the go-to platform for smarter
                        logistics. Our intuitive design <br />and powerful
                        features make freight management effortless.
                    </p>
                </div>
                <div class="slider-data text-center my-5">
                    <h5>What You'll Love:</h5>
                    <ul class="bulletList">
                        <li>
                            <strong>Real-Time Tracking:</strong> Monitor your
                            shipments from pick-up to delivery.
                        </li>
                        <li>
                            <strong>Seamless Booking:</strong> Choose the right
                            truck type for your needs.
                        </li>
                        <li>
                            <strong>Payment Made Easy:</strong> Secure,
                            transparent, and hassle-free transactions.
                        </li>
                        <li>
                            <strong>User-Friendly Dashboard:</strong> All your
                            logistics tools in one place.
                        </li>
                    </ul>
                    <p>
                        Discover how Go Freightmate simplifies your freight
                        operations and transforms <br />the way you manage
                        logistics.
                    </p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="wrapperSlider">
                    <div class="portfolio-slider" id="screen">
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore01img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore02img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore03img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore04img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore05img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore06img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore07img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                        <div class="portfolio-item text-center">
                            <figure>
                                <img
                                    src="../../images/explore07img.png"
                                    alt="portfolio-image"
                                />
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="featuredMate" id="feature">
            <div class="container text-center">
                <h2 class="fw-bold">Features In This App</h2>
                <p class="text-muted">
                    Go Freightmate® is packed with powerful features designed to
                    make freight <br />management seamless and efficient. Here's
                    what sets us apart:
                </p>

                <div
                    class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4"
                >
                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (1).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Free Trial</h5>
                            <p class="text-muted">
                                Experience all the features of Go Freightmate at no
                                cost.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (2).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Unique Design</h5>
                            <p class="text-muted">
                                A clean, intuitive interface for effortless
                                navigation.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (3).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Cross-Platform</h5>
                            <p class="text-muted">
                                Accessible on iOS, Android, and desktop devices.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (4).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">User Friendly</h5>
                            <p class="text-muted">
                                Designed with simplicity and ease of use in
                                mind.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (5).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Mailer Engine</h5>
                            <p class="text-muted">
                                Communicate directly with carriers and shippers.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (6).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Notifications</h5>
                            <p class="text-muted">
                                Get instant updates on shipments and
                                transactions.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (7).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Free Updates</h5>
                            <p class="text-muted">
                                Enjoy regular improvements and new features at
                                no extra charge.
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <img
                                src="../../images/Vector (8).png"
                                alt="featured-icon"
                            />
                            <h5 class="mt-3">Fast Support</h5>
                            <p class="text-muted">
                                Our dedicated team is always here to help.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="howWorks">
            <div class="container">
                <div class="secHeading text-center">
                    <h2>How Go Freightmate™ Works</h2>
                    <p>Go FreightMate™ makes moving freight simple for everyone. <br>Shippers post what they need moved—drivers pick it up, track it, and deliver it—all through one easy-to-use app. With real-time updates, <br>instant communication, and same-day delivery options, Go FreightMate™ keeps business moving smoothly for both sides.</p>
                </div>
                <div class="mainWorkBlock">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="logisticsBlock">
                                <h3>How Go Freightmate™ Works</h3>
                                <p>
                                    Simplify logistics with Go Freightmate®—your
                                    all-in-one platform for seamless freight
                                    management. Here's how it works:
                                </p>
                                <ul class="logisticList">
                                    <li>
                                        <strong>Post Your Freight:</strong>
                                        Quickly list your shipment details and
                                        requirements.
                                    </li>
                                    <li>
                                        <strong>Find the Perfect Match:</strong>
                                        Our smart algorithm connects you with
                                        the best carriers for your needs.
                                    </li>
                                    <li>
                                        <strong>Track in Real-Time:</strong>
                                        Monitor your freight every step of the
                                        way with live updates.
                                    </li>
                                    <li>
                                        <strong
                                            >Secure and Hassle-Free
                                            Payment:</strong
                                        >
                                        Enjoy transparent and encrypted
                                        transactions.
                                    </li>
                                </ul>
                                <p>
                                    Go Freightmate® makes freight handling faster,
                                    easier, and more efficient.
                                </p>
                                <!-- <a
                                    href="javascript:void(0)"
                                    class="webBtn yellowBtn"
                                    >Discover More</a
                                > -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <figure class="logisticsFigure text-center m-0">
                                <img
                                    src="../../images/how-works-img.png"
                                    alt="logistics-image"
                                    class="w-75"
                                />
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="skilledMain">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <figure class="logisticsFigure text-center m-0">
                            <img
                                src="../../images/image-13.png"
                                alt="logistics-image"
                                class="w-75"
                            />
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <div class="logisticsBlock">
                            <h2>Experienced and Skilled</h2>
                            <p>
                                Go Freightmate® brings decades of logistics
                                expertise to your fingertips. Our platform is
                                designed to provide seamless freight management,
                                ensuring precision and efficiency every step of
                                the way.
                            </p>
                            <strong>What We Deliver</strong>
                            <ul class="logisticList">
                                <li>
                                    <strong>Real-Time Updates:</strong> Stay
                                    informed with live shipment tracking and
                                    instant status changes.
                                </li>
                                <li>
                                    <strong>Streamlined Operations:</strong>
                                    Manage all your shipments effortlessly in
                                    one place.
                                </li>
                                <li>
                                    <strong>Reliable Expertise:</strong> Trust
                                    in a platform backed by industry knowledge
                                    and advanced technology.
                                </li>
                            </ul>
                            <p>
                                Take control of your logistics with Go Freightmate
                                and experience the difference expertise makes.
                            </p>
                            <!-- <a
                                href="javascript:void(0)"
                                class="webBtn yellowBtn"
                                >How It Works</a
                            > -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="teamSec" id="team">
            <div class="container">
                <div class="secHeading text-center">
                    <h2>Our Executive Team</h2>
                    <p>
                        Meet the dedicated professionals driving Go Freightmate® to
                        success. With years of experience and a <br />commitment
                        to innovation, our team ensures we deliver the best
                        logistics solutions for our clients.
                    </p>
                </div>
                <div class="row text-center">
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/rick-img.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Richard Marthens</h5>
                            <p>Chief Executive Officer/Founder</p>
                            <!-- <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/facebook-icon.png" alt="facebook-icon" />
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/instagram-icon.png" alt="instagram-icon" />
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/linkedin-icon.png" alt="linkedin-icon" />
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/twitter-icon.png" alt="twitter-icon" />
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/tik-tok-icon.png" alt="tik-tok-icon" />
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                        <img src="../../images/youtube-icon.png" alt="youtube-icon" />
                                    </a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/doreen.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Doreen Julye</h5>
                            <p>Chief Operating Officer</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/dev-sir-img.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Devender Kumar</h5>
                            <p>Chief Technology Officer</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/rich-photo.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Rich Silivanch</h5>
                            <p>Creative Director</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/peter-tysdale-img.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Peter Tysdale</h5>
                            <p>Chief Financial Officer</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/michael-moskowitz-img.jpg"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Michael Moskowitz</h5>
                            <p>VP/Sales Operations</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/shanita-img.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Shanita Julye</h5>
                            <p>Office & Logistics Manager</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="teamBlock">
                            <figure>
                                <img
                                    src="../../images/reena-img.png"
                                    alt="team-image"
                                />
                            </figure>
                            <h5>Reena Shaw</h5>
                            <p>Director of Marketing & Media</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="solutionSec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <figure class="logisticsFigure text-center m-0">
                            <img
                                src="../../images/logistics-img.png"
                                alt="logistics-image"
                                class="w-50"
                            />
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <div class="logisticsBlock">
                            <h3>
                                Go Freightmate®: Your Logistics Solution on the Go
                            </h3>
                            <p>
                                Manage, track, and optimize your freight with
                                ease using Go Freightmate®. Whether you're a
                                shipper or carrier, our platform connects you to
                                the best logistics solutions at your fingertips.
                            </p>
                            <strong>What We Deliver</strong>
                            <ul class="logisticList">
                                <li>
                                    <strong>Find the Right Truck:</strong>
                                    Browse a variety of truck types tailored to
                                    your shipping needs.
                                </li>
                                <li>
                                    <strong>Real-Time Availability:</strong> Get
                                    instant access to available trucks and
                                    competitive rates.
                                </li>
                                <li>
                                    <strong>Effortless Booking:</strong> Post
                                    your load and connect with trusted carriers
                                    in just a few clicks.
                                </li>
                            </ul>
                            <p>
                                <strong
                                    >Download the Go Freightmate App Today!</strong
                                >
                                <br />
                                Available now on the App Store and Google Play
                                for iOS and Android devices. Experience smarter
                                logistics, wherever you are.
                            </p>
                            <div class="heroBtns">
                                <a href="https://apps.apple.com/in/app/go-freightmate/id6748914156" target="_blank"><img
                                        src="../../images/app-store-icon.png"
                                        alt="app-store"
                                /></a>
                                <a href="javascript:void(0)" class="hover-msg"><img
                                        src="../../images/play-store-icon.png"
                                        alt="play-store"
                                /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="helpSec sameSpacing">
            <div class="container">
                <div class="secHeading text-center">
                    <h2>Troubles with Go Freightmate™? We're Here to Help!</h2>
                    <p>
                        We understand that navigating new platforms can
                        sometimes be challenging. That's why Go Freightmate® is
                        backed by <br />a dedicated support team and a suite of
                        resources to ensure a smooth experience for all our
                        users.
                    </p>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="bulletBlock">
                            <h5>Common Issues We Can Help With:</h5>
                            <ul class="bulletList">
                                <li>
                                    <strong>Account Setup:</strong> Need help
                                    creating your profile or setting up your
                                    account? We've got you covered.
                                </li>
                                <li>
                                    <strong>Booking Assistance:</strong>
                                    Encountering issues while posting loads or
                                    finding carriers? Let us assist.
                                </li>
                                <li>
                                    <strong>Real-Time Tracking:</strong>
                                    Troubles with live updates or tracking your
                                    shipments? Reach out for quick fixes.
                                </li>
                                <li>
                                    <strong>Payment Queries:</strong> Questions
                                    about secure transactions or payment
                                    processing? We're here to clarify.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bulletBlock">
                            <h5>How to Reach Us:</h5>
                            <ul class="bulletList">
                                <li>
                                    <strong>FAQs:</strong> Check our
                                    comprehensive FAQ section for immediate
                                    answers.
                                </li>
                                <li>
                                    <strong>Live Chat:</strong> Connect with our
                                    support team directly through the app.
                                </li>
                                <li>
                                    <strong>Email Support:</strong> Drop us a
                                    message at support@freightmate.com for
                                    detailed assistance.
                                </li>
                            </ul>
                            <p>
                                At Go Freightmate®, we're committed to ensuring
                                your logistics operations are seamless and
                                hassle-free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="text-center helpbtn">
                    <a href="#footer" class="webBtn yellowBtn"
                        >Contact Support</a
                    >
                </div>
            </div>
        </section>

        

        <section class="newsSec sameSpacing" id="myblg">
            <div class="container">
                <div class="secHeading text-center">
                    <h2>Our Latest News</h2>
                    <p>Stay up to date with what's happening at Go FreightMate™ — from new app features and driver success stories to shipper <br>partnerships and event highlights. We're on the move, and so is the future of local delivery.</p>
                </div>
                
                <!-- Loading State -->
                <div v-if="blogLoading" class="text-center py-5">
                    <p>Loading blog posts...</p>
                </div>
                
                <!-- Error State -->
                <div v-else-if="blogError" class="text-center py-5">
                    <p class="text-danger">{{ blogError }}</p>
                </div>
                
                <!-- Blog Posts -->
                <div v-else-if="blogPosts.length > 0" class="row newsBlock">
                    <div v-for="post in blogPosts" :key="post.id" class="col-sm-4 newsBox">
                        <figure>
                            <img
                                :src="post.cover_photo_path"
                                :alt="post.photo_alt_text || post.title"
                            />
                        </figure>
                        <div class="newData">
                            <span class="newsMeta">{{ post.formatted_date }}</span>
                            <h4>{{ post.title }}</h4>
                            <p>{{ post.excerpt }}</p>
                            <ul class="newsBottom list-inline text-end">
                                <li class="list-inline-item">
                                    <img
                                        src="../../images/heart-icon.png"
                                        alt="heart-icon"
                                    />
                                    0
                                </li>
                                <li class="list-inline-item">
                                    <img
                                        src="../../images/comment-icon.png"
                                        alt="comment-icon"
                                    />
                                    0
                                </li>
                                <li class="list-inline-item">
                                    <a :href="'/blogs/' + post.slug">More Details</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- No Posts State -->
                <div v-else class="text-center py-5">
                    <p>No blog posts available yet. Check back soon!</p>
                    <p><small>Debug: Loading={{blogLoading}}, Error={{blogError}}, Posts={{blogPosts.length}}</small></p>
                </div>
            </div>
        </section>

        <section class="newsletterSec sameSpacing">
            <div class="container text-center">
                <div class="secHeading">
                    <h3>Stay Connected with Go Freightmate</h3>
                    <p>
                        Never miss an update or exclusive offer. Subscribe to
                        our <br />newsletter and stay ahead in the world of
                        logistics.
                    </p>
                </div>
               <form @submit.prevent="subscribeToNewsletter" class="newsletterForm d-flex">
      <input
        type="email"
        v-model="newsletterEmail"
        placeholder="Your email address"
        required
      />
      <input type="submit" value="Submit" />
    </form>
    <p v-if="newsletterSuccessMessage" class="success">{{ newsletterSuccessMessage }}</p>
    <p v-if="newsletterErrorMessage" class="error">{{ newsletterErrorMessage }}</p>
            </div>
        </section>
    </div>
    <footer class="mainfooter" id ="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="footerWidget web-icon">
                                <img src="../../images/footer-logo-img.png" alt="footer-logo" class="fadlo"></img>
                                <br>
                                   <br>
                                     

                                <p><strong>Go Freightmate®: Efficient. Reliable. Trusted.</strong><br>
                                Transforming the logistics landscape, Go Freightmate® connects businesses and drivers with seamless freight management tools. From real-time tracking to secure payments, we're here to make your logistics journey effortless and efficient.</p>
                                <a class="footerPhone" href="tel:8885094480"><i class="fa fa-phone"></i> (888) 509-4480</a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="footerWidget web-list">
                                <h5>Useful Links</h5>
                                <ul class="footer-list">
                                    <li>How It Works?</li>
                                    <li><a href="https://gofreightmate.com/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="https://gofreightmate.com/terms-of-service">Terms of Service</a></li>
                                    <li><a href="https://gofreightmate.com/sitemap">Site Map</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="col-sm-2">
                            <div class="footerWidget web-list">
                                <h5>Support</h5>
                                <ul class="footer-list">
                                    <li>FAQs</li>
                                    <li>Editor Help</li>
                                    <li>Life Chatting</li>
                                    <li>Contact Us</li>
                                </ul>
                            </div>
                        </div> -->
                        <div class="col-sm-2">
                            <div class="footerWidget footerApp">
                                <div class="heroBtns">
                                    <a href="https://apps.apple.com/in/app/go-freightmate/id6748914156" target="_blank"><img src="../../images/app-store-icon.png" alt="app-store"></a>
                                    <a href="javascript:void(0)" class="hover-msg"><img src="../../images/play-store-icon.png" alt="play-store"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row bottom-footer">
                        <div class="col-sm-8">
                            <div class="bottomLeft">
                                <span>© 2025 <strong>Go Freightmate.</strong> All Rights Reserved</span><br>
                                <span>Site design & development by <a href="https://contemporarymediagrp.com" target="_blank">Contemporary Media Group, LLC</a></span>
                            </div>
                        </div>
                        <div class="col-sm-4 text-end">
                            <ul class="list-inline info-List">
                                <li class="list-inline-item"><a href="#">Site Map </a></li>
                                <li class="list-inline-item"><a href="https://gofreightmate.com/privacy-policy"> Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footerForm">
                      <form @submit.prevent="submitForm" class="footerContact">
                            <h5><img src="../../images/message-icon.png" alt="message-icon"> Quick Contact Form</h5>
                            <input type="text" name="username" id="username" v-model="form.username"  placeholder="Your Name*" required>
                            <input type="email" name="email" id="email" v-model="form.email" placeholder="Email Address*" required>
                            <textarea name="message" id="message" v-model="form.message" placeholder="Your Message ..."></textarea>
                            <div class="contactSubmit text-end">
                                <input type="submit" value="Send">
                            </div>
                            <p v-if="successMessage" class="success">{{ successMessage }}</p>
    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</template>
<script setup>
import { ref, onMounted, watchEffect, nextTick } from "vue";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import $ from "jquery";
import "slick-carousel";

// Counter Logic
const counter = ref(0);
const counterElement = ref(null);

const startCounterAnimation = () => {
  let start = 0;
  const end = parseInt(counter.value, 10) || 0;

  if (start !== end) {
    const duration = 4000; // Animation duration
    let startTime = null;

    const step = (timestamp) => {
      if (!startTime) startTime = timestamp;
      const progress = Math.min((timestamp - startTime) / duration, 1);
      counter.value = Math.ceil(progress * end);
      if (progress < 1) {
        requestAnimationFrame(step);
      }
    };

    requestAnimationFrame(step);
  }
};

// Watch counter value and start animation
watchEffect(() => {
  if (counterElement.value) {
    startCounterAnimation();
  }
});

// Slick Slider Initialization
const initSlickSliders = async () => {
  await nextTick(); // Wait for Vue to update the DOM

  $(".my-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    centerMode: true,
    speed: 300,
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: true,
    responsive: [
      { breakpoint: 991, settings: { slidesToShow: 2 } },
      { breakpoint: 767, settings: { slidesToShow: 1 } },
    ],
  });

  $(".portfolio-slider").slick({
    slidesToShow: 7,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    centerMode: true,
    speed: 300,
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: false,
    responsive: [
      { breakpoint: 991, settings: { slidesToShow: 5 } },
      { breakpoint: 767, settings: { slidesToShow: 1 } },
    ],
  });
};

onMounted(() => {
  initSlickSliders();
});
</script>
<script>
import axios from 'axios';
export default {
 name: "HomePage",
  data() {
    return {
      form: {
        username: '',
        email: '',
        message: '',
      },
      successMessage: "",
      errorMessage: "",
      newsletterEmail: "",
      newsletterSuccessMessage: "",
      newsletterErrorMessage: "",
      popupForm: {
        userName: '',
        userEmail: '',
      },
      popupSuccessMessage: "",
      popupErrorMessage: "",
      blogPosts: [],
      blogLoading: false,
      blogError: "",
    };
  },
  methods: {
    async submitForm() {
      console.log(this.form); 
      this.successMessage = "";
      this.errorMessage = "";
      
      try {
        const response = await axios.post('/contact', this.form);
        console.log('Form submitted successfully:', response.data);
        this.successMessage = 'Message sent successfully!';
        this.resetForm();
      } catch (error) {
        console.error('Error submitting form:', error.response ? error.response.data : error);
        
        // Show detailed error message from server
        if (error.response && error.response.data) {
          this.errorMessage = error.response.data.message || 'Failed to send message. Please try again.';
          
          // Log debug info if available
          if (error.response.data.debug) {
            console.error('Debug info:', error.response.data.debug);
          }
        } else {
          this.errorMessage = 'Failed to send message. Please check your connection.';
        }
      }
    },
    resetForm() {
      this.form = {
        username: '',
        email: '',
        message: '',
      };
    },
    // Function to submit the newsletter form
    async subscribeToNewsletter() {
      try {
        const response = await axios.post("/newsletter", {
          email: this.newsletterEmail,
        });

        console.log(response.data);
        this.newsletterSuccessMessage = "Subscribed successfully!";
        this.newsletterErrorMessage = "";
        this.newsletterEmail = ""; // Reset form
      } catch (error) {
        console.error(error.response.data);
        this.newsletterErrorMessage = "Failed to subscribe. Please enter a valid email.";
        this.newsletterSuccessMessage = "";
      }
    },
    // Function to fetch blog posts
    async fetchBlogPosts() {
      console.log('🔄 Starting to fetch blog posts...');
      this.blogLoading = true;
      this.blogError = "";
      
      try {
        console.log('📡 Making API call to /api/blog/posts');
        const response = await axios.get('/api/blog/posts');
        console.log('✅ API response received:', response.data);
        
        if (response.data.success && response.data.posts) {
          console.log('📝 Found posts:', response.data.posts.length);
          this.blogPosts = response.data.posts;
        } else {
          console.log('⚠️ No posts in response');
          this.blogError = "No blog posts available.";
        }
      } catch (error) {
        console.error('❌ Error fetching blog posts:', error);
        this.blogError = "Failed to load blog posts: " + error.message;
      } finally {
        this.blogLoading = false;
        console.log('🏁 Blog loading completed');
      }
    },
    // Function to submit the popup form
    async submitPopupForm() {
      this.popupSuccessMessage = "";
      this.popupErrorMessage = "";
      
      try {
        const response = await axios.post("/popup", this.popupForm);
        console.log(response.data);
        this.popupSuccessMessage = "Thank you! We'll be in touch soon.";
        this.popupErrorMessage = "";
        this.popupForm.userName = "";
        this.popupForm.userEmail = ""; // Reset form
        
        // Close popup after successful submission
        const popup = document.getElementById('popup');
        if (popup) {
          setTimeout(() => {
            popup.style.display = 'none';
          }, 2000);
        }
      } catch (error) {
        console.error(error.response ? error.response.data : error);
        this.popupErrorMessage = "Failed to submit. Please try again.";
        this.popupSuccessMessage = "";
      }
    },
  },
  mounted() {
    console.log('🚀 HomePage component mounted!');
    console.log('📊 Initial state:', {
      blogLoading: this.blogLoading,
      blogError: this.blogError,
      blogPosts: this.blogPosts.length
    });
    
    // Fetch blog posts when component is mounted
    this.fetchBlogPosts();
    
    // Handle smooth scrolling for anchor links
    const headerOffset = 120; // height of sticky header
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', (e) => {
        e.preventDefault();
        const target = document.querySelector(anchor.getAttribute('href'));
        if (!target) return;

        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.scrollY - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth"
        });
      }); 
    });
  },
};
window.addEventListener('scroll', function () {
  const header = document.querySelector('.mainHead');
  if (window.scrollY > 150) {
    header.classList.add('sticky');
  } else {
    header.classList.remove('sticky');
  }
});
window.addEventListener('load', () => {
    setTimeout(() => {
        const popup = document.getElementById('popup');
        const closeBtn = document.getElementById('closeBtn');
        if (!popup || !closeBtn) return;

        popup.style.display = 'flex';

        closeBtn.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        popup.addEventListener('click', (event) => {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    }, 2000);
});
// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//   anchor.addEventListener('click', function (e) {
//     e.preventDefault();
//     const target = document.querySelector(this.getAttribute('href'));
//     const headerOffset = 120; // height of your sticky header
//     const elementPosition = target.getBoundingClientRect().top;
//     const offsetPosition = elementPosition + window.scrollY - headerOffset;

//     window.scrollTo({
//       top: offsetPosition,
//       behavior: "smooth"
//     });
//   });
// });
</script>
<style>
header.mainHead {
    background: #21233cb3 !important;
    position: fixed !important;
    z-index: 9;
}
</style>