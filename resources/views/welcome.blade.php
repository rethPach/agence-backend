<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="dist/vendors/vendor.css">
  </head>
  <body ng-app="agence-app">
     <div id="wrapper">
        <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
            <li class="sidebar-brand gris">
                <a href="#"><img src="dist/images/logo.gif" style="margin-left: 2em"></a>
            </li>
            <li><a href="#!/ganancias-netas">Ganancias Netas</a></li>
            <li><a href="#!/agence-home">Desempeno</a></li>
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