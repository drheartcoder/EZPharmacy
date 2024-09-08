<!DOCTYPE html>
<html>
    <head>
        <title>Something went Wrong</title>

        {{-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> --}}

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
                font-family: 'Arial';
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
                font-size: 2em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Oops.</div>
                <p>Something went wrong while displaying this page.</p>
                <p>Please be patient , we are looking into it. </p>
                <p><a href="{{ back() }}">Click here</a> to Go Back </p>
            </div>
        </div>
    </body>
</html>
