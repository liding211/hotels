<div id="entry_block">
	<div id="forms">
	<!-- registration form -->
	<div id="reg_form">
		<p id="form_title">REGISTRATION</p>
		<p>First time with us? Tell us about yourself!</p>
        <form name="reg_form" class="reg" method="post" 
            action="<?=$sf_request->getUri();?>">
			<table>
				<tr id="first_name">
					<td>First name*</td>
					<td>
						<input type="textfield" id="registration_first_name"
                           name="registration[first_name]">
					</td>
				</tr>
				<tr id="last_name">
					<td>Last name*</td>
					<td>
						<input type="textfield" id="registration_last_name" 
                           name="registration[last_name]">
					</td>
				</tr>
				<tr id="email">
					<td>E-mail*</td>
					<td>
						<input type="textfield" id="registration_email" 
                           name="registration[email]">
					</td>
				</tr>
				<tr id="phone">
					<td>Phone number*</td>
					<td>
						<input type="textfield" id="registration_phone" 
                           name="registration[phone]">
					</td>
				</tr>
				<tr id="reg_submit">
					<td colspan=2 >
                        <input type="submit" name="submit"
                            id="reg" value="registration" disabled>
                    </td>
				</tr>
                <?php if ($sf_request->hasErrors()): ?>
                <tr>
                    <td colspan="2">
                        <?php 
                            foreach ($sf_request->getErrorNames() as $name): 
                                if(in_array($name, $error_names_list['registration']) ){
                        ?>
                                  <span style="color: red;">
                                      <?php echo $sf_request->getError($name) . '<br />' ?>
                                  </span>
                                  <?php
                                }
                            endforeach; 
                        ?>
                    </td>
                </tr>
                <?php endif; ?>
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
						<input type="textfield" id="signin_email" name="signin[email]">
					</td>
				</tr>
				<tr id="login_submit">
					<td colspan=2 >
						<input type="submit" name="submit" id="login" 
                            value="signin" disabled>
					</td>
                </tr>
                <?php if ($sf_request->hasErrors()): ?>
                <tr>
                    <td colspan="2">
                        <?php 
                            foreach ($sf_request->getErrorNames() as $name): 
                                if(in_array($name, $error_names_list['signin']) ){
                        ?>
                                  <span style="color: red;">
                                      <?php echo $sf_request->getError($name) ?>
                                  </span>
                                  <?php
                                }
                            endforeach; 
                        ?>
                    </td>
                </tr>
                <?php endif; ?>
			</table>
		</form>
	</div>
	<!-- end of login form -->
	</div>
</div>
<script type="text/javascript" src="/js/form_validater.js"></script>	
<script type="text/javascript" src="/js/enter.ajax.js"></script>