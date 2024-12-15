<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e6f1e2] flex justify-center min-h-screen">
    <div class="text-center p-8">
        <div class="mb-4 mt-5">
            <div class="flex justify-center">
                <a href="{{ route('index.home')}}"><img src="{{ asset('web/img/home-nl/logoo.svg') }}" alt="Logo"
                    style="width: 150px;"></a>
            </div>
            <p class="text-gray-400 text-sm">Daily blog</p>
        </div>
        <!-- 403 Message -->
        <div style="margin-top: 150px">
            <h1 class="text-9xl font-extrabold text-black hover:text-[#3C3D37]">403</h1>
            <h2 class="text-xl font-semibold mt-4 text-gray-600">SORRY, YOU DON'T HAVE ACCESS</h2>
            <p class="text-base text-gray-400 mt-2">
                Only author can access this page, if you are the author please login as the author
            </p>
        </div>
    </div>
</body>
</html>
