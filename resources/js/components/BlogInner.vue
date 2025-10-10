<template>
    <header class="mainHead">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

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
                            <a class="nav-link" href="#home" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="#"><img src="../../images/facebook.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/youtube.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/insta.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/tiktok.png" alt="social-icon"></a></li>
                    </ul>
                    <a href="/registration" class="getstartedBtn">Get Started</a>
                </div>
            </div>
              </nav>
        </div>
    </header>
  <div v-if="blog" class="max-w-3xl mx-auto p-6">
    <img :src="blog.image" alt="" class="w-full rounded-lg mb-6" />
    <h1 class="text-3xl font-bold mb-4">{{ blog.title }}</h1>
    <p class="text-gray-700 leading-relaxed" v-html="blog.content"></p>
  </div>

  <div v-else class="text-center p-6">
    <p>Loading blog post...</p>
  </div>
    <footer class="mainfooter" id ="footer">
        <div class="container">
            <div class="row">
              <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="footerWidget web-icon">
                                <img src="../../images/footer-logo-img.png" alt="footer-logo" class="fadlo"></img>
                                <br><br>
                                <p><strong>Go Freightmate®: Efficient. Reliable. Trusted.</strong><br>
                                Transforming the logistics landscape, Go Freightmate® connects businesses and drivers with seamless freight management tools. From real-time tracking to secure payments, we're here to make your logistics journey effortless and efficient.</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="footerWidget web-list">
                                <h5>Useful Links</h5>
                                <ul class="footer-list">
                                    <li><a href="#">How It Works?</a></li>
                                    <li><a href="https://gofreightmate.com/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="https://gofreightmate.com/terms-of-service">Terms of Service</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="footerWidget web-list">
                                <h5>Support</h5>
                                <ul class="footer-list">
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Editor Help</a></li>
                                    <li><a href="#">Life Chatting</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="footerWidget footerApp">
                                <div class="heroBtns">
                                    <a href="javascript:void(0)"><img src="../../images/app-store-icon.png" alt="app-store"></a>
                                    <a href="javascript:void(0)"><img src="../../images/play-store-icon.png" alt="play-store"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row bottom-footer">
                        <div class="col-sm-8">
                            <div class="bottomLeft">
                                <span>© 2025 <strong>Go Freightmate.</strong> All Rights Reserved</span><br>
                                <span>Site design & development by <a href="#">Contemporary Media Group, LLC</a></span>
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
                <div class="col-sm-3">
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

<script>
import axios from "axios";

export default {
  name: "BlogInner",
  props: ["slug"],
  data() {
    return {
      blog: null,
    };
  },
  async mounted() {
    try {
      const response = await axios.get(`/api/blog/${this.slug}`);
      this.blog = response.data;
    } catch (error) {
      console.error("Error loading blog:", error);
    }
  },
};
</script>

<style scoped>
img {
  object-fit: cover;
}
</style>