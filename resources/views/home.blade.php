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
                        <h1 class="mt-3">Developer test</h1>
                        <p>
                            From the table below you will need to add the following functionality
                        </p>
                        <ul>
                            <li>Add a new column to the table</li>
                            <li>Add a new row to the table</li>
                            <li>Remove a row from the table</li>
                            <li>Complete the logic in the /api/csv-export route, which will generate a csv file into the browser.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <csv-generator :column-limit="5"></csv-generator>
        </div>

        <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
