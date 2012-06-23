{HEADER}
{JS_test}
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
    <div class="container">
        <div class="row">
            <div class="span3" style="text-align: right">
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест по предмету:</h2>
                <p class="lead">{subject}</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тема теста</h2>
                <p class="lead" id="theme">{theme}</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест добавил:</h2>
                <p class="lead">{user}</p>
                <h2 class="page-header" style="padding: 0; margin-bottom: 7px;">Тест пройден:</h2>
                <p class="lead">{count_test}</p>
            </div>
            <div class="span9">
                <div class="hero-unit" style="padding: 30px 60px 30px 60px;">
                    <h1 style="font-size: 35px;" id="ask"></h1>
                    <div class="row">
                    <div class="span8" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="span4 images" style="float: left; margin: 0;">
                            
                        </div>
                        <div class="span4 answer" style="margin: 0;">
                            <ul class="ans nav nav-stacked" >
                                
                            </ul>
                        </div>
                    </div>
                    </div>
                <div class="btn-group" id="testScale">
                  {scale}
                </div>
                </div>
            </div>
            
        
        </div>

{FOOTER}