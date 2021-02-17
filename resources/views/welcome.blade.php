<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{csrf_token() }}">
        <script>window.Laravel = {csrfToken: 'csrf-token()'}</script>
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    </head>
    <body>
        @include('app')
    </body>
    
</html>
