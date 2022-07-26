<!-- Main Header -->
@include('layouts.includes.header')
<!-- End Main Header -->

<!-- Sidemenu -->
@include('layouts.includes.sidebar')
<!-- End Sidemenu -->

<!-- Main Content -->
@yield('main-content')
<!-- End Main Content -->

<!-- Footer-->
@include('layouts.includes.footer')
<!--End Footer-->

<!-- Sidebar Setting  -->
@include('layouts.includes.side-setting')
<!-- End Sidebar Setting -->

<!-- Country-selector modal -->
@include('layouts.includes.country-selector')
<!-- Country-selector modal -->

<!-- FooterEnd -->
@include('layouts.includes.footer-end')
<!--End FooterEnd -->