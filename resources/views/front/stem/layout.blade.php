<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Novaly">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Novaly Business Consulting HTML5 Template">
    <meta name="keywords" content=" Business, Consulting, Marketing, Agency, Creative, multipage, template" />
    <title>{{$bs->website_title}} @yield('pagename')</title>
    <link href="{{asset('assets/stem/images/favicon.png')}}" rel="shortcut icon" type="image/png">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/stem/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/stem/css/responsive.css')}}">
  </head>
  <body>
    @includeIf('front.stem.header')
        {{-- @includeIf('front.stem.header') --}}
        <div id="skip-content-div">
            @yield('content')
        </div>
      
        @includeIf('front.stem.footer')
        @includeIf('front.stem.script')
    </body>
    </html>
