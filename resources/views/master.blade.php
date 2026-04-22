<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    @include("layouts.head")
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        {{-- Sidabar --}}
        @include("layouts.sidebar")
        {{-- Header --}}
        @include("layouts.header")
        <div class="content">
            @yield('content')
            {{-- footer --}}
            @include("layouts.footer")
        </div>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
</body>
<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
@include("layouts.script")

</html>