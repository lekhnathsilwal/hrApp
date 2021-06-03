<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HrApp</title>
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/font-awesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/metisMenu/dist/metisMenu.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/animate.css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/dist/css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" />
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}"/>
    <link rel="stylesheet" href="{{asset('fonts/pe-icon-7-stroke/css/helper.css')}}"/>
    <link rel="stylesheet" href="{{asset('styles/style.css')}}">
    <link rel="icon" href="{{url('/img/logo/hr.png')}}" type="image" sizes="16x16">
    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
    <style type="text/css">
        .pp{
            height: 100px;
            width: 100px;
            position: relative;
            overflow:hidden;
            background-image:url('{{(Auth::guard('admin')->user()->profile_picture=="nopp.jpg")?url('/img/avatar/'.Auth::guard('admin')->user()->profile_picture):url('/uploads/admin/profile_picture/'.Auth::guard('admin')->user()->profile_picture)}}');
            background-size: cover;
            margin-left: 20px;
            background-position: center;
        }
        .updatePp{
            height: 30px;
            display: none;
            background: rgba(214, 226, 254, 0.95);
            width: 100%;
            position: absolute;
            bottom: 0;
            font-size: 10px;
        }
        .pp:hover .updatePp{
            display: block;
        }
        .updatePp>i{
            font-size: 10px;
        }
    </style>
    @yield('custom-css')
    @yield('custom-js')
</head>
<body class="fixed-navbar sidebar-scroll">
@include('includes.header')
@include('includes.navbar')
<div id="wrapper">
    @yield('content_header')
    @yield('content')
{{--    <footer class="footer">--}}
{{--        <span class="pull-right">--}}
{{--            Example text--}}
{{--        </span>--}}
{{--        Company 2015-2020--}}
{{--    </footer>--}}
</div>
<!-- Vendor scripts -->
<script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/jquery-flot/jquery.flot.js')}}"></script>
<script src="{{asset('vendor/jquery-flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('vendor/jquery-flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('vendor/flot.curvedlines/curvedLines.js')}}"></script>
<script src="{{asset('vendor/jquery.flot.spline/index.js')}}"></script>
<script src="{{asset('vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('vendor/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('vendor/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('vendor/sparkline/index.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- DataTables buttons scripts -->
<script src="{{asset('vendor/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<!-- App scripts -->
<script src="{{asset('scripts/homer.js')}}"></script>
<script src="{{asset('scripts/charts.js')}}"></script>
<script>
    $(function () {
        /**
         * Flot charts data and options
         */
        var data1 = [ [0, 55], [1, 48], [2, 40], [3, 36], [4, 40], [5, 60], [6, 50], [7, 51] ];
        var data2 = [ [0, 56], [1, 49], [2, 41], [3, 38], [4, 46], [5, 67], [6, 57], [7, 59] ];
        var chartUsersOptions = {
            series: {
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
            },
            grid: {
                tickColor: "#f0f0f0",
                borderWidth: 1,
                borderColor: 'f0f0f0',
                color: '#6a6c6f'
            },
            colors: [ "#62cb31", "#efefef"],
        };
        $.plot($("#flot-line-chart"), [data1, data2], chartUsersOptions);
        /**
         * Flot charts 2 data and options
         */
        var chartIncomeData = [
            {
                label: "line",
                data: [ [1, 10], [2, 26], [3, 16], [4, 36], [5, 32], [6, 51] ]
            }
        ];
        var chartIncomeOptions = {
            series: {
                lines: {
                    show: true,
                    lineWidth: 0,
                    fill: true,
                    fillColor: "#64cc34"

                }
            },
            colors: ["#62cb31"],
            grid: {
                show: false
            },
            legend: {
                show: false
            }
        };
        $.plot($("#flot-income-chart"), chartIncomeData, chartIncomeOptions);
    });
</script>
<script>
    document.getElementById("cam").addEventListener("click", function(event){
        event.preventDefault();
        //https://www.youtube.com/watch?v=sL5-FhULalM
        'use strict';
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const errorMsgElement = document.getElementById('spanErrorMsg');
        const constraints = {
            audio: false,
            video:true,
        };
        async function init(){
            try{
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                handleSuccess(stream);
            }
            catch(e){
                errorMsgElement.innerHTML = `navigator.getUserMedia.error:${e.toString()}`;
            }
        }
        // Success
        function handleSuccess(stream){
            window.stream = stream;
            video.srcObject = stream;
        }
        //Initialise
        init();
        //Draw Image
        let context = canvas.getContext('2d');
        snap.addEventListener("click", function(){
            context.drawImage(video, 0, 0, 250, 188);
            const myCanvas = document.querySelector("#canvas");
            const dataURI = myCanvas.toDataURL();
            document.getElementById("image_URI").value = dataURI;
        });
    });
</script>
</body>
</html>
