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
    @includeIf('front.stem.partials.header')
        {{-- @includeIf('front.stem.partials.header') --}}
        <div id="skip-content-div">
            @yield('content')
        </div>
      
        @includeIf('front.stem.partials.footer')
        @includeIf('front.stem.partials.script')
    </body>
    </html>
