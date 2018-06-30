<!DOCTYPE html>
<html>
    <head>
        <?php
   	        $title_page = "Login"; 
   	        include('..//template_plugins//pages_template_head.php');
        ?>
        <script type="text/javascript" src="../../content/js/encryption/encription_sha256.js"></script>
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
                                <label for="user_number">Numero de empleado</label>
                                <input type="number" class="form-control" id="user_number" aria-describedby="numberHelp" placeholder="Ingresa numero de empleado">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" id="user_password" class="form-control" placeholder="Password">
                            </div>
                            <button type="button" id="loginbtn" class="btn btn-primary">Ingresar</button>
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
		 $("#user_number").keydown(function (e) {
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


		
		$("#user_number").on("change keyup", function() {
			$('#error_nomina').text('');
			$('#error_validation').text('');
		});
		$("#user_password").on("change keyup", function() {
			$('#error_password').text('');
			$('#error_validation').text('');
		});
		
		$('#loginbtn').click(function(){
			$result = true;
			$username = $("#user_number").val();
			$password = SHA256($("#user_password").val());
		        
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
						'user_username': $username,
						'user_password': $password
					},
					success: function(response){
        				if(response.result == true){
							//alert('test');
        					window.location.replace("../../index.php")
							//$('#error_validation').text('credenciales correctas');
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