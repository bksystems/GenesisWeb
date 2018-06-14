<!DOCTYPE html>
<html>
    <head>
        <?php
   	        $title_page = "Login"; 
   	        include('..//template_plugins//pages_template_head.php');
        ?>
        <script type="text/javascript" src="../../content/js/hash_md5.min.js"></script>
        <title><?php echo $title_page;?></title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-3 mx-auto mb-2">
                <div class="card">
                    <div class="card-header">Iniciar sesión</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="button" id="loginbtn" class="btn btn-primary">Submit</button>
                        </form>
                        <div id="error_validation" class="login-validation-error"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$("#login-validation").css("display", "none");
		 $("#user_nomina").keydown(function (e) {
		        // Allow: backspace, delete, tab, escape, enter and .
		        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		             // Allow: Ctrl+A, Command+A
		            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
		             // Allow: home, end, left, right, down, up
		            (e.keyCode >= 35 && e.keyCode <= 40)) {
		                 // let it happen, don't do anything
		                 return;
		        }
		        // Ensure that it is a number and stop the keypress
		        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		            e.preventDefault();
		        }
		    });


		
		$("#user_nomina").on("change keyup", function() {
			$('#error_nomina').text('');
			$('#error_validation').text('');
		});
		$("#user_password").on("change keyup", function() {
			$('#error_password').text('');
			$('#error_validation').text('');
		});
		
		$('#loginbtn').click(function(){
			$result = true;
			$username = $("#user_nomina").val();
			$password = $("#user_password").val();
		    $password = md5($password);
		        
			if($username == ""){
				$('#error_nomina').text('Este campo es obligatorio');
				$result = false;
			}
			if($password == ""){
				$('#error_password').text('Este campo es obligatorio');
				$result = false;
			}

			if($result){		
				$("#login-validation").css("display", "block");
				$.ajax({
					type: "POST",
					dataType:'json',
					url: '../../web_services/web/users/login.init.php',
					data:{
						'username': $username,
						'password': $password,
						'access_type': 'web',
						'access_system': 'noting',
						'ip_address': 'noting',
						'serial_number': 'noting',
						'imei': 'noting',
						'sim_card_number': 'noting'
					},
					success: function(response){
						var jsonObj = response.data;
        				if(jsonObj[0].success == true){
        					window.location.replace("../../index.php")
        				}else{
							$("#login-validation").css("display", "none");
							$('#error_validation').text('credenciales incorrectas');
						}
					},
					error: function(data){
						//alert(data);
						$("#login-validation").css("display", "none");
						$('#error_validation').text('credenciales incorrectas');
					}
				});
			}
		});
	});
</script>