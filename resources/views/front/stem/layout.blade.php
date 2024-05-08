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
    <!-- common base color change -->
    <link href="{{url('/')}}/assets/front/css/common-base-color.php?color={{$bs->base_color}}&color1={{$bs->secondary_base_color}}&color2={{$be->hero_overlay_color}}" rel="stylesheet">
    <!-- base color change -->
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
