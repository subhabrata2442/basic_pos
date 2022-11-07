<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fire Fighter</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
            font-family: 'Open Sans', sans-serif !important;
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .text-center {
            text-align: center !important;
        }

        .eror-page-sec {
            background-size: cover !important;
            height: 100vh;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .black-overlay::after {
            position: absolute;
            content: "";
            bottom: 0;
            left: 0;
            background-color: rgba(23, 19, 42, .3) !important;
            background: url({{ asset('assets/img/brick.svg') }}) center center;
            z-index: -1;
            height: 100%;
            width: 100%;
            opacity: .6;
        }

        .eror-page-text h2 {
            color: #fff;
            font-size: 143px;
            text-shadow: 3px 6px 1px #cdcdcd;
            font-weight: 800;
            margin: 0;
            line-height: 1;
            letter-spacing: 13px;
        }

        .eror-page-text h4 {
            color: #fff;
            font-size: 40px;
        }

        .eror-page-text p {
            color: #fff;
            margin-top: 10px;
        }

    </style>
    <section class="eror-page-sec black-overlay d-flex justify-content-center align-items-center"
        style="background: url({{ asset('assets/img/404-bg.jpg') }}) no-repeat center center;">
        <div class="eror-page-text text-center">
            <h2>404</h2>
            <h4>Oops, nothing here...</h4>
            <p>Please check URL,</p>
        </div>
    </section>
</body>
