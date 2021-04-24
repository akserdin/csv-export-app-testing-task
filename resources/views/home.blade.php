<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>CSV exporter testing task</title>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-3">Completed testing task</h1>
                        <p>See original code <a href="https://github.com/F3SYSTEMS1/developer-test" target="_blank">here</a></p>
                    </div>
                </div>
            </div>

            <csv-generator :column-limit="5"></csv-generator>
        </div>

        <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
