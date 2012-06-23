
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      @media (min-width: 1200px) {
          #testScale .btn-small {
              padding: 7px 12px;
              font-size: 15px;
              line-height: normal;
          }
          .btn-group .btn.large:first-child {
              margin-left: 0;
              -webkit-border-top-left-radius: 6px;
              -moz-border-radius-topleft: 6px;
              border-top-left-radius: 6px;
              -webkit-border-bottom-left-radius: 6px;
              -moz-border-radius-bottomleft: 6px;
              border-bottom-left-radius: 6px;
            }
            .btn-group .btn.large:last-child,
            .btn-group .large.dropdown-toggle {
              -webkit-border-top-right-radius: 6px;
              -moz-border-radius-topright: 6px;
              border-top-right-radius: 6px;
              -webkit-border-bottom-right-radius: 6px;
              -moz-border-radius-bottomright: 6px;
              border-bottom-right-radius: 6px;
            }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"></a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Главная</a></li>
              <li><a href="#about">Предметы</a></li>
              <li><a href="#contact">Правила</a></li>
              <li class="divider-vertical"></li>
              <form class="navbar-form pull-left"  >
                    <input type="text" class="span3" placeholder="Найти">
              </form>
            </ul>
            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Вход
                      <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#about">Вход</a></li>
                          <li><a href="#contact">Правила</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="span3" style="text-align: right">
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест по предмету:</h2>
                <p class="lead">История</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тема теста</h2>
                <p class="lead">Дворцовые перевороты</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест добавил:</h2>
                <p class="lead">Муковкин Дмитрий</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест пройден:</h2>
                <p class="lead">10 раз</p>
            </div>
            <div class="span9">
                <div class="hero-unit" style="padding: 30px 60px 30px 60px;">
                    <h1 style="font-size: 35px;">Вопрос, который будет оооочень длинным</h1>
                    <div class="row">
                    <div class="span8" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="span4" style="float: left; margin: 0;">
                            <img src="../../uploads/tests/47/b_u9v1jo.jpg" />
                        </div>
                        <div class="span4" style="margin: 0;">
                            <ul class="ans nav nav-stacked" >
                                <li class="a ">lknkвававамl</li>
                                <li class="a ">lknkвамвамвамl</li>
                                <li class="a">lknkвамвавамвамвl</li>
                                <li class="a ">lknkl</li>
                                <li class="a ">lknвамвkl</li>
                            </ul>
                        </div>
                    </div>
                    </div>
                <div class="btn-group" id="testScale">
                  <button class="btn btn-small btn-success">&nbsp;&nbsp;</button>
                  <button class="btn btn-small btn-danger">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  <button class="btn btn-small">&nbsp;&nbsp;</button>
                  
                </div>
                </div>
            </div>
            
        
        </div>
     
      <!-- Example row of columns -->
      <div class="row">
        
      </div>

      <hr>

      <footer>
        <p>&copy; sfml.tom.ru 2011</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-collapse.js"></script>


  </body>
</html>