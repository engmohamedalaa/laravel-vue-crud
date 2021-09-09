<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <title>Laravel VUE CRUD APP</title>
    </head>
    <body>
        <div id="app">
            <posts-index></posts-index>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
