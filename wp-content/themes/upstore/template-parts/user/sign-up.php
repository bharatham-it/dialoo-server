<form action="submit_function_register_user" id="user-registration" method="post" autocomplete="off">
	<div class="login-form">
	<?php
		$args= array('id' => 'user_login','name' => 'user_login', 'label' => 'Fullname', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/text', '', $args);
	?>
	<?php
		$args= array('id' => 'user_email','name' => 'user_email', 'label' => 'Email', 'required' => 'required','class' => 'email','datainvalidmessage' => "Please enter only email"  );
		echo get_template_part( 'template-parts/form/text', '', $args);
	?>
	<?php
		$args= array('id' => 'user_pass','name' => 'user_pass', 'label' => 'Password', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/password', '', $args);
	?>
	<?php
		$args= array('id' => 'confirmpassword','name' => 'confirmpassword', 'label' => 'Confirm Password', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/password', '', $args);
	?>
	<?php
			$exclude = array('Administrator', 'Editor', 'Author', 'Subscriber', 'Contributor','Upstore Admin','Supervisor','Sales Man');
			$rolenames = get_role_names($exclude);
		$args= array('id' => 'role','name' => 'role', 'label' => 'User Role', 'required' => 'required', 'items' => $rolenames, 'sid' => 'farmer'  );
		echo get_template_part( 'template-parts/form/select', '', $args);
	?>
	<?php
		$args= array('id' => 'agree','name' => 'agree', 'label' => 'I Agree the terms and conditions.', 'required' => 'required'  );
		echo get_template_part( 'template-parts/form/switch', '', $args);
	?>
	<?php
		$args= array('id' => 'submit','name' => 'submit', 'label' => 'Sign Up', 'required' => ''  );
		echo get_template_part( 'template-parts/form/submit', '', $args);
	?>
	<?php
		$args= array('aid' => 'show-signin','aname' => 'show-signin', 'alabel' => 'Sign In','label' => 'Already have an account yet ?', 'alink' => '#', 'required' => ''  );
		echo get_template_part( 'template-parts/form/stretched', 'link', $args);
	?>
	</div>
</form>