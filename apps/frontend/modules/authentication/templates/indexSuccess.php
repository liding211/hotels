<div id="entry_block">
	<div id="forms">
	<!-- registration form -->
	<div id="reg_form">
		<p id="form_title">REGISTRATION</p>
		<p>First time with us? Tell us about yourself!</p>
        <form name="reg_form" class="reg" method="post" 
            action="<?php echo url_for('authentication/registration'); ?>">
			<table>
				<tr id="first_name">
					<td>First name*</td>
					<td>
						<input type="textfield" name="first_name">
					</td>
				</tr>
				<tr id="last_name">
					<td>Last name*</td>
					<td>
						<input type="textfield" name="last_name">
					</td>
				</tr>
				<tr id="email">
					<td>E-mail*</td>
					<td>
						<input type="textfield" name="email">
					</td>
				</tr>
				<tr id="phone">
					<td>Phone number*</td>
					<td>
						<input type="textfield" name="phone">
					</td>
				</tr>
				<tr id="reg_submit">
					<td colspan=2 >
                        <input type="submit" name="submit"
                            id="reg" value="registration" disabled>
                    </td>
				</tr>
			</table>
		</form>
	</div>
	<!-- end of registration form -->
	
	<!-- login form -->
	<div id="login_form">
		<p id="form_title">SIGN</p>
		<p>Regular customer? Enter the e-mail!</p>
		<form method="post" action="<?=$sf_request->getUri();?>"
            method="POST" class="login">
			<table>
				<tr id="client_email">
					<td>E-mail</td>
					<td>
						<input type="textfield" id="email_login" name="email_login">
					</td>
				</tr>
				<tr id="login_submit">
					<td colspan=2 >
						<input type="submit" name="submit" id="login" 
                            value="enter" disabled>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<!-- end of login form -->
	</div>
</div>
<script type="text/javascript" src="js/form_validater.js"></script>	
<script type="text/javascript" src="js/enter.ajax.js"></script>