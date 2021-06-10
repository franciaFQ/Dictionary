<!DOCTYPE html>
<html lang="en">
<head>
	<title>Supérate Raíces </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="return false" onsubmit="return false" method="post" autocomplete="off">
                                    <div id="resultado"></div>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="" placeholder="ID" required="true">
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="true">
                            </div>
                               
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                    <!-- <input type="submit" name="submit" value="Login" class="btn btn-success"> -->
                                    <p><button class="btn btn-success" onclick="Validar(document.getElementById('username').value, document.getElementById('password').value);">Login</button></p>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                    	<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        	Sign Up Here
                                    	</a>
                                	</div>
                                </div>
                            </div>    
                        </form>
                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" action="return false" onsubmit="return false" method="post" autocomplete="off">
                                <div id="resultado2"></div>
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="id" class="col-md-3 control-label">ID: </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="id" id="id" placeholder="ID" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Name: </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="firstname"
                                        name="firstname" placeholder="Name" required="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" class="btn btn-info" onclick="signUp(document.getElementById('id').value, document.getElementById('firstname').value);"><i class="icon-hand-right" ></i> Sign Up</button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>           
         </div> 
    </div>
<script src="./js/jquery-3.1.1.min.js"></script>
    <script>
        function Validar(user, pass)
        {
            $.ajax({
                url: "./checklogin.php",
                type: "POST",
                data: "username="+user+"&password="+pass,
                success: function(resp){
                    $('#resultado').html(resp)
                }
            });
        }
        function signUp(user, pass)
        {
            $.ajax({
                url: "./signUp.php",
                type: "POST",
                data: "id="+user+"&name="+pass,
                success: function(resp){
                    $('#resultado2').html(resp)
                }
            });
        }
    </script>
</body>
</html>