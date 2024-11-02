<!DOCTYPE html>
<html lang="zxx" class="js">
@include('cashier.theme.header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('cashier.theme.sidemenu')
            <div class="nk-wrap ">
                @include('cashier.theme.header-top')
                <div class="nk-content ">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @extends('cashier.theme.footer')
            </div>
        </div>
    </div>
    <script src="/assets/js/bundle.js?ver=3.0.3"></script>
    <script src="/assets/js/scripts.js?ver=3.0.3"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.0.3"></script>
</body>

</html>
