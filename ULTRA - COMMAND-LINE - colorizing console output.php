<?php 
/*

!!COMMAND-LINE - COLORIZING CONSOLE OUTPUT!!

> You want to display console output in different colors

*/


/*Use PEAR’s Console_Color2 class*/
$color = new Console_Color2();

$ok = $color->color('green');
$fail = $color->color('red');

$reset = $color->color('reset');

print $ok . "OK " . $reset . "Something succeeded!\n";
print $fail . "FAIL " . $reset . "Something failed!\n";

/*If you’re already using ncurses, incorporate colors by using the appropriate functions*/
ncurses_init();
ncurses_start_color();

ncurses_init_pair(1, NCURSES_COLOR_GREEN, NCURSES_COLOR_BLACK);
ncurses_init_pair(2, NCURSES_COLOR_RED, NCURSES_COLOR_BLACK);
ncurses_init_pair(3, NCURSES_COLOR_WHITE, NCURSES_COLOR_BLACK);

ncurses_color_set(1);
ncurses_addstr("OK ");
ncurses_color_set(3);
ncurses_addstr("Something succeeded!\n");
ncurses_color_set(2);
ncurses_addstr("FAIL ");
ncurses_color_set(3);
ncurses_addstr("Something succeeded!\n");

?>