<template>
        <header class="mainHead">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand fw-bold" href="/"><img src="../../images/logo.png" alt="brand-logo"></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              About
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Screens</a></li>
                              <li><a class="dropdown-item" href="#">Features</a></li>
                              <li><a class="dropdown-item" href="#">Our Team</a></li>
                              <li><a class="dropdown-item" href="#">Blog</a></li>
                            </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Screens</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Our Team</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                      </li>
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="#"><img src="../../images/facebook.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/youtube.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/insta.png" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="../../images/tiktok.png" alt="social-icon"></a></li>
                    </ul>
                  </div>
                </div>
              </nav>
        </div>
    </header>
    <!-- Bootstrap CDN Here -->
</template>

<script>
export default {
    name: "HeaderSection",
};
</script>

<style scoped>
h1 {
    color: green;
}
</style>
