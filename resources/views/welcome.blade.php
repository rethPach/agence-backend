<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="dist/vendors/vendor.css">
    <style>
      .sidebar-nav .glyphicon {
        float: right;
        margin-top: 14px;
        margin-right: 60px
      }
    </style>
  </head>
  <body ng-app="agence-app">
     <div id="wrapper">
        <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
            <li class="sidebar-brand gris">
                <a href="#"><img src="dist/images/logo.gif"></a>
            </li>
            <li>
              <a href="#!/ganancias-netas" style="text-align: center;">
                <span>Ganancias Netas</span>
                <span class="glyphicon glyphicon-piggy-bank"></span>
              </a>
            </li>
            <li>
              <a href="#!/agence-home" style="text-align: center;">
                <span>Desempeno</span>
                <span class="glyphicon glyphicon-stats"></span>
              </a>
            </li>
          </ul>
        </div>
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12">
                  <ui-view></ui-view>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript" src="dist/app.js"></script>
    <script type="text/javascript" src="dist/vendors/vendor.js"></script>
  </body>
</html>