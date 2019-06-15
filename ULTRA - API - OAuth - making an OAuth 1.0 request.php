<?php 
/*

!!API - MAKING AN OAuth 1.0 REQUEST!!

> want to make an OAuth 1.0 signed request

> use the PECL oauth extension

> OAuth 1.0 enables API providers to let their users securely give third-party developers
access to their accounts by not providing their usernames and passwords
	>> Instead, you use two sets of public and private tokens to sign your requests. 
		>>> One set of tokens is for your application - that’s used for every request. 
		>>> The other set is user specific - they differ from user to user

> Using the PECL oauth extension you need to know the general authorization flow, nicknamed the OAuth Dance
	1. You get an initial set of user tokens. 
		>> These are also called request tokens or temporary tokens, because they’re only used during the 
		authorization process and not to make actual API calls.
	2. You redirect the user to the API provider.
	3. The user signs into that site, which authenticates the user and asks him to authorize your application 
	to make API calls on his behalf.
	4. After the user authorizes your application, the API provider redirects the user back to your application, 
	passing along two pieces of data: the same temporary public key you provided to match up each reply with its 
	corresponding user and a PIN to prevent against session fixation attacks.
	5. You exchange the PIN for permanent OAuth tokens for the user.
	6. You make API calls on behalf of the user.

*/

?>