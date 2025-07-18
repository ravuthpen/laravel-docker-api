<!DOCTYPE html>
<html lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/themefy_icon/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/niceselect/css/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/owl_carousel/css/owl.carousel.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/gijgo/gijgo.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/font_awesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/tagsinput/tagsinput.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/datepicker/date-picker.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/vectormap-home/vectormap-2.0.2.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/scroll/scrollable.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/datatable/css/jquery.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/datatable/css/responsive.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/datatable/css/buttons.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/text_editor/summernote-bs4.css')}}" />
    <link rel="stylesheet" href="{{asset('public/vendors/morris/morris.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendors/material_icon/material-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('public/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('public/css/colors/default.css')}}" id="colorSkinCSS">
     @yield('head')
</head>
<body class="crm_body_bg">
 <nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href=""><p style="font-weight: bold;font-size: 20px;text-align: center;">NASA UNITED </p></a>
        <a class="small_logo" href=""><p style="font-weight: bold;font-size: 20px;text-align: center;">NASA UNITED</p> </a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">

        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{URL::to('public/send.png')}}" alt="">
                </div>
                <div class="nav_title">
                    <span>Send Management </span>
                </div>
            </a>
        </li>
    </ul>
</nav>
<section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area d-flex align-items-center">

                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">

                        <div class="profile_info">
                            <img src="{{URL::to('public/bank.png')}}" alt="#">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <p>Neurologist </p>
                                    <h5>Dr. Robar Smith</h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="#">My Profile </a>
                                    <a href="#">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            @yield('content')
        </div>
    </div>
<div class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>{{Carbon\Carbon::now()->year}} © NASA UNITED </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script src="{{asset('public/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('public/js/popper.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/metisMenu.js')}}"></script>
<script src="{{asset('public/vendors/count_up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('public/vendors/chartlist/Chart.min.js')}}"></script>
<script src="{{asset('public/vendors/count_up/jquery.counterup.min.js')}}"></script>
<script src="{{asset('public/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('public/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/vendors/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/vendors/datepicker/datepicker.js')}}"></script>
<script src="{{asset('public/vendors/datepicker/datepicker.en.js')}}"></script>
<script src="{{asset('public/vendors/datepicker/datepicker.custom.js')}}"></script>
<script src="{{asset('public/js/chart.min.js')}}"></script>
<script src="{{asset('public/vendors/chartjs/roundedBar.min.js')}}"></script>
<script src="{{asset('public/vendors/progressbar/jquery.barfiller.js')}}"></script>
<script src="{{asset('public/vendors/tagsinput/tagsinput.js')}}"></script>
<script src="{{asset('public/vendors/text_editor/summernote-bs4.js')}}"></script>
<script src="{{asset('public/vendors/am_chart/amcharts.js')}}"></script>
<script src="{{asset('public/vendors/scroll/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('public/vendors/scroll/scrollable-custom.js')}}"></script>
<script src="{{asset('public/vendors/apex_chart/apex-chart2.js')}}"></script>
<script src="{{asset('public/vendors/apex_chart/apex_dashboard.js')}}"></script>
<script src="{{asset('public/vendors/chart_am/core.js')}}"></script>
<script src="{{asset('public/vendors/chart_am/charts.js')}}"></script>
<script src="{{asset('public/vendors/chart_am/animated.js')}}"></script>
<script src="{{asset('public/vendors/chart_am/kelly.js')}}"></script>
<script src="{{asset('public/vendors/chart_am/chart-custom.js')}}"></script>
<script src="{{asset('public/js/dashboard_init.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
</body>
</html>
