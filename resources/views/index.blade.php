<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="{{asset('mini-logo.PNG')}}">
    <title>Mode Developer</title>
    <link href="{{asset('fontawesome/css/all.css')}}"
    rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
 <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

 <style>

    .border-edit{
    border-top: 2px solid #D50000 !important;
    }
    .v-application--is-ltr .v-list-item__action:first-child, .v-application--is-ltr .v-list-item__icon:first-child{
        margin-right: 15px !important;
    }
    .v-application--is-ltr .v-list-group--no-action > .v-list-group__items > div > .v-list-item{
        padding-left: 55px !important;
    }
    .title-color{
        background-color: #D50000 !important;
        color: white !important;
    }


 </style>
  </head>
  <body>
    <noscript>
      <strong>We're sorry but vueshop doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app" height="100%"></div>
    <!-- built files will be auto injected -->
  </body>
  @if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
  @endif
  <script src="{{ asset('js/app.js') }}"></script>
  <script>

</script>
</html>
