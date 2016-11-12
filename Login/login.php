<?php
    session_start();
   if(isset($_SESSION["userNSID"])){
       header('Location: home.php');
       exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fraties Login</title>
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="Assets/font-awesome/css/font-awesome.min.css">
        
		<link rel="stylesheet" href="CSS/form-elements.css">
        <link rel="stylesheet" href="CSS/login.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Login</strong> OR <strong>Register</strong></h1>
                            <div class="description">
                            	<p>
	                            	Please log into your <strong>Fraties</strong> account
                                    <br>OR<br> 
                                    Register in few quick easy steps using your NSID!
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login</h3>
	                            		<p>Enter e-mail and password to log in:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
                                    <!-- login form -->
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
                            
				                        	<input type="text" style="color:black" value="<?php echo htmlentities($_POST['form-nsid']);?>" name="form-nsid" placeholder="NSID" class="form-username form-control" id="form-nsidSignIn" required>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
                                            
				                        	<input type="password" style="color:black" name="form-password" placeholder="Password" class="form-password form-control" id="form-passwordSignIn" required><sub style="color:red"><?php include 'Controller/signIn.php';?></sub>
				                        </div>
				                        <button name="signInSubmit" type="submit" class="btn">Sign in!</button>
				                    </form>
			                    </div>
		                    </div>
                        </div>
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
                                    
                                    <!-- register form -->
				                    <form role="form" action="" method="post" class="registration-form">
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-nsid">Email</label>
                                            
                                            
				                        	<input type="text" style="color:black" name="form-nsidRegister" placeholder="NSID" class="form-nsid form-control" id="form-nsidRegister" required>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
                                            
                                            
				                        	<input type="password" style="color:black" name="form-passwordRegister" placeholder="Password" class="form-password form-control" id="form-passwordRegister" required>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-reTypePassword">Re-type Password</label>
                                            
                                            
				                        	<input type="password" style="color:black" name="form-reTypePasswordRegister" placeholder="Re-type Password" oninput="myFunction()" class="form-password form-control" id="form-reTypePasswordRegister" required>
                                            <p style="color:red" id="passNoMatch"></p>
				                        </div>
                                
                                            <script>
                                                function getPass(){
                                                    var pass = document.getElementById("form-passwordRegister").value;
                                                    return pass;
                                                }
                                                function myFunction() {

                                                    var pass = getPass();
                                                    var passLengeth = pass.length;
                                                    
                                                    var retypedPass = document.getElementById("form-reTypePasswordRegister").value;
                                                    var retypedPassLengeth = retypedPass.length;
                                                    if(retypedPassLengeth == passLengeth){
                                                        
                                                        if(retypedPass!=pass){
                                                            document.getElementById("passNoMatch").innerHTML = "Your passwords don't match! Please make sure that Retyped password is same as Password.";
                                                            document.getElementById("registerSubmit").disabled = true;

                                                        }
                                                        else{
                                                            document.getElementById("passNoMatch").innerHTML = "";
                                                            document.getElementById("registerSubmit").disabled = false;
                                                        }
                                                    }
                                                    else if(retypedPass>pass){
                                                        document.getElementById("passNoMatch").innerHTML = "Your passwords don't match! Please make sure that Retyped password is same as Password.";
                                                        document.getElementById("registerSubmit").disabled = true;
                                                    }
                                                    else{
                                                        document.getElementById("passNoMatch").innerHTML = null;
                                                        document.getElementById("registerSubmit").disabled = true;
                                                    }
                                                }
                                            </script>
				                        <button name="registerSubmit" id="registerSubmit" type="submit" class="btn">Sign me up!</button>
				                    </form>
			                    </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="col-sm-8 col-sm-offset-2">
                <div class="footer-border"></div>
            </div>		
        </footer>
        <!-- Javascript -->
        <script src="JS/jquery.backstretch.min.js"></script>
        <script src="JS/loginBackgroundSet.js"></script>
        <!--[if lt IE 10]>
            <script src="JS/placeholder.js"></script>
        <![endif]-->
    </body>
</html>