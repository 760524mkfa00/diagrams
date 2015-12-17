<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Floor Plans</title>
    <link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #000000;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
            background-image: url(img/drawing.jpg);
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #464646;
        }


        .title {
            position: absolute;
            bottom: 80px;
            right: 80px;
            font-size: 96px;
        }

        .quote {
            font-size: 24px;
            margin:40px 0 0 40px;
        }

        #header footer {
            position: absolute;
            right:80px;
            bottom:40px;
        }

        .dark input[type="button"], .dark input[type="submit"], .dark input[type="reset"], .dark .button {
            background: none repeat scroll 0 0 rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 1px #fff inset;
            color: #fff;
        }
        .dark a {
            border-bottom-color: rgba(255, 255, 255, 0.5);
            color: #fff;
        }
        input[type="button"], input[type="submit"], input[type="reset"], .button {
            background: none repeat scroll 0 0 #3d3d3d;
            border: 0 none;
            border-radius: 0.25em;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            padding: 0.85em 3em;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: all 0.25s ease-in-out 0s;
        }
        a {
            border-bottom: 1px dotted rgba(0, 0, 0, 0.25);
            color: inherit;
            text-decoration: none;
            transition: border-bottom-color 0.25s ease-in-out 0s;
        }
    </style>
</head>
<body>
<div class="dark">
    <div id="header" class=" dark">
        <header>
            <div class="title">Welcome to Floor Plan</div>
            <div class="quote">Floor Plan Solutions by Kieran</div>
        </header>
        <footer>
            <a class="button" href="{{ action('Auth\AuthController@getLogin') }}">Proceed to login phase</a>
        </footer>

    </div>
</div>
</body>
</html>
