<!DOCTYPE html>
<html>

<head>
    <title>Library System</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <home-component></home-component>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
