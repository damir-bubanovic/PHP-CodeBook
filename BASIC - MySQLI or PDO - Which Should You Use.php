<?php 
/*
USER COMMENT DESCRIBING THE SITUATION:



I've worked with PDO on several websites and I don't find it to be as useful or ... good as everyone here seems to think.

I still feel that building a mysqli database abstraction layer is the way to go.
Make your own class, with your own methods that handle whatever you need.
Put it in a file, include it and that's it.

When you switch to another database (for example a MSSQL database), duplicate the file, use "search and replace" on "mysqli_" 
and replace with "mssql_", edit the function that adds LIMIT to your queries and change the include mentioned earlier to point 
to the new file. 
This can be applied to the other listed databases as well.
Doesn't sound like a lot of work to me.

The only valid argument I can see in using PDO is multiple database support, which shouldn't matter because:
- you probably have a plan while developing a website, including a "what am I going to do next" plan, and I'm pretty sure that 
"durr hurr I'ma change ma database" doesn't belong there
- you probably won't need the other 11 databases supported by PDO. It's like buying a Veyron to drive 5 km to work everyday 
instead of a Fiesta

More features doesn't mean it's better.

So if you only use MySQL, like to make sure your code works awesome and feels comfortable, why use PDO instead of making your own 
wrapper using the mysqli functions included with php ?
The binding parameter problem and the object mapping one is already solved by using your custom wrapper, so why not use the 
native functions so you can get that 3% extra performance ?

I couldn't find a real reason to use PDO in my php applications that use MySQL.
And I can't find one for those MySQL applications that will be converted to MSSQL later. Or Postgre, Oracle.

*/

http://code.tutsplus.com/tutorials/pdo-vs-mysqli-which-should-you-use--net-24059

?>