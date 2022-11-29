<?php
class accesos_VI
{
    function __construct(){}
 
    function iniciarSesion()
    {
        ?>
       <!DOCTYPE html>
          <html lang="en">
            <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
              <!-- Meta, title, CSS, favicons, etc. -->
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="icon" href="30.png"  />
              <title>tienda telefonos</title>

              <!-- Bootstrap -->
            
              <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
              <!-- Font Awesome -->

              <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
              <!-- NProgress -->
            
              <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
              <!-- Animate.css -->
              
              <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

              <!-- Custom Theme Style -->
              
              <link href="build/css/custom.min.css" rel="stylesheet">
              <!--style type="text/css">
                .login1{
                  background-image: url('login.jpg');
                  heigh: 100%;
                  width: 100%;
                }
                </style-->
            </head>

            <body  class="login" >
              <!--img src="login.jpg"-->
              <div class="login">
                <a class="hiddenanchor" id="signup"></a>
                <a class="hiddenanchor" id="signin"></a>

                <div class="login_wrapper">
                  <div class="animate form login_form">
                    <section class="login_content">
                      <form action="index.php" method="post">
                        <h1>Login Form</h1>
                        <div class="input-group mb-2">
                          <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" name="clave" class="form-control" placeholder="clave">
                        </div>
                        <div>
                      
                          <button type="submit" class="btn btn-danger ">Iniciar Sesi&oacute;n</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">


                          <div class="clearfix"></div>
                         

                          <div>
                              
                              <p>virtualTecno</p>
                            
                          </div>
                        </div>
                      </form>
                  
                  </div>
                </div>
              </div>
            </body>
          </html>

        <?php
      
    }
 
  
}
?>
    
 

