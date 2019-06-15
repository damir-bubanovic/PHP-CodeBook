<?php 
/*
!!INTER - SECURITY - brute force attack!!

> The problem is the balance between user accessibility and attacker model

> my solution below & thoughts
*/

/*functions.php*/
function check_brute($db_user_id, $dbc) {
	if($statement = $dbc->prepare("SELECT attempt_id FROM table_users_login_attempts WHERE user_id = ? AND date_time > NOW() - INTERVAL 24 HOUR")) {
		$statement->bind_param('i', $db_user_id);
		$statement->execute();
		$statement->store_result();
		
		if($statement->num_rows > 4) {
			return true;
		} else {
			return false;
		}
	}
}

function insert_brute($db_user_id, $dbc) {
	if($statement = $dbc->prepare("INSERT INTO table_users_login_attempts (user_id, date_time) VALUES (?, NOW())")) {
		$statement->bind_param('i', $db_user_id);
		$statement->execute();
	}
}


/*login.php*/
if(check_brute($db_user_id, $dbc)) {
	header('Location: ./locked.php');
} else {				
	if(password_verify($login_password, $db_password)) {
		header('Location: ./sucess.php');
	} else { 
		insert_brute($db_user_id, $dbc);
		$output_form = true;
	}
}


/*
FIRST SOLUTION:

If not password correct for a certain number of time:
    block the user
    send a reset link to the user

> User: 	could be blocked, and they don't like to reset
> Attacker: blocked all users by trying to authenticate to all users 
			(especially if all logins are publicly available)
*/

/*
SECOND SOLUTION:

If not password correct:
    sleep(amount_of_time)
	
> User: 	can be annoying to wait 'amount_of_time' for each error
> Attacker: keep trying, with lower test / seconds
*/

/*
THIRD SOLUTION:

If not password correct:
    sleep(amount_of_time)
    amount_of_time = amount_of_time * 2
	
> User: 	less annoying for few password mistakes
> Attacker: block the user to connect by sending lot of incorrect password
*/

/*
FOURTH SOLUTION:

If not password correct for a certain number of time:
    submit a catchpa
	
> User: 	need to resolve the CAPTCHA (not too complex)
> Attacker: need to resolve the CAPTCHA (must be complex)
*/

/*
FIFTH SOLUTION:

If not password correct for a certain number of time:
    block the ip
    (eventually) send a reset link
	
> User: 	user may be blocked because he cannot correctly remember his password.
> Attacker: trying the same password with different user, because blocking is based 
			on number of login by user.
*/

/*
FINAL SOLUTION:

If several login attempts failed whatever is the user by an IP :
    print a CAPTCHA for this IP
	
> User: 	user cannot be IP blocked but must remember its password.
> Attacker: difficult to have an efficient brute-force attack.
*/
?>