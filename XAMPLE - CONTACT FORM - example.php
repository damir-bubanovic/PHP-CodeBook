<?php
	<br />
	<h2>Pitajte nas sve što vas zanima!</h2>
	<br />
	<label>ime:</label>
	<input type="text" <?php if($error_name) print 'class="error"'; ?>name="name" value="<?php print $name; ?>"/><span class="req">&#42;</span><br />
	<label>e-mail:</label>
	<input type="text" <?php if($error_email) print 'class="error"'; ?> name="email" value="<?php print $email; ?>"/><span class="req">&#42;</span><br />
	<label>poruka:</label>
	<textarea cols="1" rows="8" name="message"><?php print $message; ?></textarea><br />
	<button type="submit" name="contact_form_submit" value="1" title="Pošalji">POŠALJI</button>
	<?php	if( $_POST['contact_form_submit'] == 1 ) echo '<div class="systemMessage">'.$systemMessage.'</div>'; ?>
</form>