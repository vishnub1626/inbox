<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
</head>

<body>
    <div class="container py-3 mx-auto">
        <div class="flex flex-row items-center w-full px-3 pb-3 border-b-2 border-blue-600 md:justify-center">
            <p class="mr-2">
                <svg viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 text-blue-800 mail">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                </svg>
            </p>
            <p class="text-3xl font-medium text-blue-800">Inbox</p>
        </div>

        <div class="px-3 mt-2 md:mt-0 md:px-0">
            @yield('content')
        </div>
    </div>
</body>

</html>
