<form id="user-login"  data-form="ajaxform" action="submit_function_login_user" method="post">
<div class="login-form">
	<?php
		$args= array('id' => 'user_login','name' => 'user_login', 'label' => 'User Name', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/text', '', $args);
	?>
	<?php
		$args= array('id' => 'user_password','name' => 'user_password', 'label' => 'Password', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/password', '', $args);
	?>
	<?php
		$args= array('id' => 'remember','name' => 'remember', 'label' => 'Remember Credentials?', 'required' => ''  );
		echo get_template_part( 'template-parts/form/switch', '', $args);
	?>
	<?php
		$args= array('id' => 'submit','name' => 'submit', 'label' => 'Sign In', 'required' => ''  );
		echo get_template_part( 'template-parts/form/submit', '', $args);
	?>
	<?php
		$args= array('aid' => 'forgot-password','aname' => 'forgot-password', 'alabel' => 'Forgot Pasword?','label' => '', 'alink' => '#',  'required' => '' );
		echo get_template_part( 'template-parts/form/stretched', 'link', $args);
	?>
	<?php
		$args= array('aid' => 'show-signup','aname' => 'show-signup', 'alabel' => 'Sign Up','label' => 'Dont have an account yet ?', 'alink' => '#',  'required' => '' );
		echo get_template_part( 'template-parts/form/stretched', 'link', $args);
	?>
</div>
</form>