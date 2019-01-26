<!-- Login Form -->
<style type="text/css">
body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      #errorMsg {
      	color: red;
      	font-weight: bold;
      	text-align: center;
      }
</style>
<script src="<?php echo URL::base();?>public/js/forms.js"></script>
<form onsubmit="return checkForm(this)" class="form-signin" action="<?php echo URL::site('login/login')?>" method="POST">
	<h2 class="form-signin-heading"><?php echo $title?></h2>
	<input type="text" class="input-block-level" placeholder="користувач" name="username">
	<input type="password" class="input-block-level" placeholder="пароль" name="password">
	<?php
	// little spike :-)
	if ((Session::instance()->get('authProblem')) == 1) {
		echo "<div id=\"errorMsg\">Error login or password</div>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "setTimeout(function() {\n";
			echo "errorMsg.style.display = \"none\";\n";
		echo "}, 1000);\n";
		echo "</script>\n";
		Session::instance()->set('authProblem', 0);
	}
 
	?>
	<button class="btn btn-large btn-primary" type="submit" value="send">Вхід</button>
</form>
<!-- /Login Form -->