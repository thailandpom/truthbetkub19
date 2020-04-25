<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" content="public">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="truthbetkub19.com">
    <meta name="keywords" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.truthbetkub19.com">
    <meta property="og:title" content="โปรโมชั่น สิทธิพิเศษ | truthbetkub19.com">
    <meta property="og:image" content="">
    <meta property="og:description" content="โปรโมชั่น สิทธิพิเศษ truthbetkub19.com">
    <title>truthbetkub19.com</title>
    @yield('seo')
    <link rel="shortcut icon" type="image/png" href="{{ asset('/front-ends-assets/images/logo.svg')}}">
    <link rel="stylesheet" href="{{ asset('/front-ends-assets/css/bootstrap.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/front-ends-assets/css/animate.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Prompt&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sarabun:300&amp;display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('/front-ends-assets/css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('/front-ends-assets/css/navbar.scss')}}">
    <link rel="stylesheet" href="{{ asset('/front-ends-assets/css/new.css')}}">

    @yield('style')
    
  </head>

  <body>
      @include('layout.header')
      @yield('content')
      @include('layout.footer')
  </body>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script>
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {       
            $('#return-to-top').fadeIn(200);    
        } else {
            $('#return-to-top').fadeOut(200);   
        }

        if($(this).scrollTop() == $("body").height()){
            $('#return-to-bottom').fadeOut(200);
        }
        else{
            $('#return-to-bottom').fadeIn(200);
        }
    });
    $('#return-to-top').click(function() {      
        $('body,html').animate({
            scrollTop : 0                       
        }, 500);
    });

    $('#return-to-bottom').click(function() {      
        $('body,html').animate({
            scrollTop : $("body").height()                    
        }, 500);
    });
  </script>
</html>