<!DOCTYPE html>
<html lang="en-US" dir="ltr" class="dual-nav">

<head>
    @include("layoutprodis.head")
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        {{-- Header --}}
        @include("layoutprodis.header")

        <div class="content">
            @yield('content')
            <footer class="footer position-absolute">
                @include("layoutprodis.footer")
            </footer>
        </div>
        {{-- footer --}}

        </div>

    </main>
    @include("layoutprodis.script")
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
</body>
<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->


</html>