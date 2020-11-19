<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sunshine | @yield('title')</title>

  </head>
  <style>
    .header{
        background-color: red;
        min-height: 100px;
    }
    .footer{
        background-color: blue;
        min-height: 100px;
    }
  </style>
      
  <body>
    <div class="header">Header</div>
    <!-- Main content -->
    <div class="content">
        <div class="row">

            <!-- Content -->
            <main>

                @yield('content')
                
            </main>
            <!-- End content -->
        </div>
    </div>
    <!-- End main content -->
    <div class="footer">Footer</div>
  </body>
</html>