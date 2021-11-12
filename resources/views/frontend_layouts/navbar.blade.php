<nav class="navbar navbar-expand-lg navbar-dark nav-bar-8bit">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <img width="35px" height="auto" src=" data:image/png;base64,iVBORw0KGgoAAA
        ANSUhEUgAAAFAAAABGCAYAAABbnhMrAAAAr0lEQVR4nO3QsQ3DMBAEQbXiwIH6L9DuwUvIfHAWuPww1+t9f
        +z3Xf8+MH0AAQIcPYAAAY4eQIBDAE8LYAxgDGAMYAxgDGAMYAxgDGBsOaABBLjjAAIEOHoAAQIcPYBPAZ4WwBjAGMA
        YwBjAGMAYwBjAGMDYckADCHDHAQQIcPQAAgQ4egCfAjwtgDGAMYAxgDGAMYAxgDGAMYCx5YAGEOCOAwgQ4OgBBAhw9ADGfQHuOT+QtWmc2QAAAABJRU5ErkJggg==" alt="Opps!">
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link {{ request()->is('/') ? 'bg-white text-dark' : '' }}" href="{{route('landingPage')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('skills-certifications') ? 'bg-white text-dark' : '' }}" href="{{route('skillsAndCertifications')}}">Skills and Certifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('blog') ? 'bg-white text-dark' : '' }}" href="{{route('frontEndBlog')}}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('contact') ? 'bg-white text-dark' : '' }}" href="{{route('frontEndContactMe')}}">Contact Me</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            @if (Route::has('login'))   
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-outline-success" target="_blank">Dashboard</a>
                    @endauth
            @endif
        </div>
    </div>
</nav>