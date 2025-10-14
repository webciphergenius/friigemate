@props(['title' =>'Go Freightmate', 'logo' => null] )
<header class="mainHead">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/">
                    <img src="{{ asset('assets/images/Go_FreightMate_logo.png') }}" alt="brand-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/#home" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#screen">Screens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#feature">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#team">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#myblg">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#footer">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tel:8885094480"><i class="fa fa-phone"></i> (888) 509-4480</a>
                        </li>
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="https://www.facebook.com/profile.php?id=61577783482435" target="_blank"><img src="{{ asset('assets/images/facebook.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://youtube.com/@gofreightmate?si=KgThF0f_TcgdmwMf" target="_blank"><img src="{{ asset('assets/images/youtube.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/gofreightmate?igsh=OTdsZ2ZqY24ycHAx&utm_source=qr" target="_blank"><img src="{{ asset('assets/images/insta.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="https://www.tiktok.com/@gofreightmate?_t=ZS-90Xr1wJJ5Wa&_r=1" target="_blank"><img src="{{ asset('assets/images/tiktok.png') }}" alt="social-icon"></a></li>
                    </ul>
                    <!-- <a href="/registration" class="getstartedBtn">Get Started</a> -->
                </div>
            </div>
        </nav>
    </div>
</header>
<style>
/* Blogs SH */
.sm\:grid-cols-\[minmax\(min-content\2c 10\%\)_1fr_minmax\(min-content\2c 10\%\)\] {
    display: flex;
}
.min-h-screen div#navbarSupportedContent {
    visibility: visible;
}
.space-y-10 {
    flex-basis: 80%;
}
.relativeBlogs {
    flex-basis: 30%;
}
h2.whitespace-nowrap.text-xl.font-semibold span.text-primary.font-bold {
    display: none;
}
body.antialiased main {
    margin-top: 150px;
    padding-top: 18px;
}
body.antialiased header.mainHead {
    background: #21233c;
    padding: 10px 0;
}
body.antialiased h1.mb-6.text-4xl.font-semibold {
    font-size: 32px !important;
    line-height: 1.2;
}
.mb-5.flex.items-center.justify-between.gap-x-3.py-5 {
    display: none;
}
.blogDetailBanner {
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f68743 url(../../../../images/inner-banner.png) no-repeat;
    background-size: cover;
    background-position: center bottom;
    margin-bottom: 60px;
}
.blogDetailBanner * {
    color: #fff;
}
a.bg-primary-600.hover\:bg-primary-700.rounded-lg.px-8.py-4.font-semibold.text-white.transition-all.duration-300 {
    padding: 14px 60px !important;
    border-radius: 5px;
    font-weight: 400;
    display: inline-block;
}
textarea#author-comment {
    border: 1px solid #e5e6ea !important;
}
h2.whitespace-nowrap.text-xl.font-semibold {
    font-size: 24px !important;
}
h2.group-hover\/blog-item\:text-primary-700.mb-3.line-clamp-2.text-xl.font-semibold.hover\:text-blue-600 {
    font-size: 16px !important;
    font-weight: 500 !important;
    line-height: 1.2;
}
.group\/blog-item.flex.flex-col.gap-y-5 .flex.items-center.gap-4 {
    display: none;
}
a.flex.items-center.justify-center.md\:gap-x-5.rounded-full {
    padding: 16px 40px !important;
    border-radius: 4px;
    text-transform: capitalize;
    background: #f58642;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
}
.relative.mb-6.flex.items-center.gap-x-8 {
    margin-bottom: 30px;
}
.relatedList .group\/blog-item.flex.flex-col.gap-y-5 {
    flex-direction: row;
    gap: 10px;
}
.relatedList .group\/blog-item.flex.flex-col.gap-y-5 .h-\[250px\].w-full {
    flex-basis: 60%;
}
.relatedList .group\/blog-item.flex.flex-col.gap-y-5 .h-\[250px\].w-full, .relatedList .group\/blog-item.flex.flex-col.gap-y-5 .h-\[250px\].w-full img {
    border-radius: 0 !important;
    height: 100px;
    width: 100px;
    min-width: 100px;
    max-width: 100px;
}
.relatedList a {
    margin-bottom: 20px;
    display: block;
}

body.antialiased .container {
    max-width: 1320px;
    padding: 0 10px;
}
.footerWidget.web-list h5 {
    font-size: 1.25rem;
    font-weight: 500;
    padding-bottom: 10px;
}
form#comments {
    display: none;
}
.sidesearch {
    margin-bottom: 35px;
}
form#searchForm {
    border: 1px solid #ededed;
}
form#searchForm input[type="search"] {
    width: 100%;
    padding: 15px;
}
.sideCat {
    margin-bottom: 30px;
}
.sideCat li {
    padding-bottom: 5px;
}
.blogTags {
    margin-top: 40px;
}
ul.blogTagsList {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}
ul.blogTagsList a {
    border: 1px solid #ccc;
    font-size: 13px;
    padding: 5px 10px;
    display: block;
}
.hover\:text-primary-600:hover {
    color: rgb(255 241 223) !important;
}
@media only screen and (max-width: 768px) {
 body.antialiased h1.mb-6.text-4xl.font-semibold {
    font-size: 28px !important;
}
h3.mb-2.text-2xl.font-semibold {
    font-size: 24px !important;
}
}
/* Blogs EH */
</style>