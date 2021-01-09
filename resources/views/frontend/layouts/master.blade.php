<!DOCTYPE html>
<html lang="en" ng-app="sunshineApp">

<head>
    ...
</head>

<body class="animsition">
    ...

    <script src="{{ asset('themes/cozastore/js/main.js') }}"></script>

    <!-- Include AngularJS -->
    <script src="{{ asset('vendor/angularjs/angular.min.js') }}"></script>
    <!-- Include thư viện quản lý Cart - AngularJS -->
    <script src="{{ asset('vendor/ngCart/dist/ngCart.js') }}"></script>

    <script>
        // Khởi tạo ứng dụng AngularJS, sử dụng plugin ngCart
        // Do Laravel và AngularJS đều sử dụng dấu `Double bracket` để render dữ liệu
        // => để tránh bị xung đột cú pháp, ta sẽ đổi cú pháp render dữ liệu của AngularJS thành <% %>
        var app = angular.module('sunshineApp', ['ngCart'],
            function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });
    </script>

    <!-- Các custom script dành riêng cho từng view -->
    @yield('custom-scripts')
</body>

</html>