<!DOCTYPE html>
<html>
    <head>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="icon" href="{{url('/')}}/images/front/logo.png" type="image/x-icon" />
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            p
            {
                font-size: 30px;
                font-weight: bold;
            }
        </style>
        <title>
            Site Offline - {{ config('app.project.name') }}
        </title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                 <img src="{{url('/')}}/images/front/logo.png" alt="Site Offline" class="main-logo"  width="100" height="90" />
                <div class="title">Site Offline</div>
                <p>
                    We will be back shortly
                </p>
                <p>
                    This site is down for maintenance. Please check back again soon.
                </p>
            </div>
        </div>
    </body>
</html>
