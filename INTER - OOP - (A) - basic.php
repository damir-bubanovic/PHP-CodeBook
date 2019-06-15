<?php 
/**********************************
!!BASIC OBJECT ORIENTED PROGRAMMING!!
**********************************/
/*
- for simple sites (OOP - adds unnecessary complexity), for complex sites (OOP - adds necessary simplicity)

>> PROCEDURAL CODING - what you did so far, Top to Bottom, nested Functions
>> OBJECT ORIENTED CODING - heirarchy, extended
	+ Better Code Organization & Maintainability
	+ Adds Clarity, Reduces Complexity
	+ Emphasize data over Procedure
	+ Code Reusability
	+ Excellent for Databases
	

/****************** 1) CLASSES iliti OBJECT ******************/
/*
	!* Use CamelCase
> class is like template for objects
> $this keyword referes to the overall class tj. object
> $age is inside class & is public variable
> $password is inside class & is private variable defined in function / method
> ALERT <  
	public - can be accesed form the outside world
	private - can be accesed from within
*/
class Animal {
	public $age;
	
	function Name() {
		print 1;
	}
}

$animal = new Animal();	// 1	



/****************** 2) METHODS ******************/
/*
> function in class is called method and we create it with __construct 
	(Function & Method -> do something)

function - outide class (in the wild code)
method - inside class
*/
class User {
	public function __construct() {
		print 'My name is Damir';
	}
}



/****************** 3) REFERENCE AN INSTANCE & DEFINE NEW CLASS USER ******************/
class Person {
    function sayHello() {
        print 'Hello from inside the class ' . get_class($this) . '<br/>';
    }
	/*One method calling another method*/
    function hello() {
		/*This referes to instance*/
        $this->sayHello();
    }
}

/*Create new class Person*/
$person = new Person();
/*Call method (function) from class Person*/
$person->sayHello();

/*Create new class Person*/
$marko = new Person();
$marko->hello();




/****************** 4) DEFINE CLASS PROPERTIES ******************/
/*
Properties ili Class Variables ili Attributes of Class ili Instance Variables
-> VARIABLES THAT BELONG INSIDE THE CLASS
*/
class Person {
    /*Declare Variables*/
    var $first_name;
    var $last_name;
    var $arm_count = 2;
    var $leg_count = 2;

    function sayHello() {
        print 'Hello from inside the class ' . get_class($this) . '<br/>';
    }
    function hello() {
        $this->sayHello();
    }
    function fullName() {
        return $this->first_name . ' ' . $this->last_name;
    }
}

/*Create new Instance of class Person*/
$person = new Person();
/*Access Varibles from class Person*/
print $person->arm_count;
print $person->leg_count;
/*Set Values of Class Variables*/
$person->arm_count = 3;
print $person->arm_count;
$person->first_name = 'Lucy';
print $person->first_name;


$kristinko = new Person();
$kristinko->first_name = 'Kristinko Indeksic';
$kristinko->last_name = 'Rasputnjin';
/*Setting new class variable values & using pre-set class variable values*/
print 'My Name is ' . $kristinko->first_name . ' ' . $kristinko->last_name . ' and have ' . $kristinko->arm_count . ' arms';

print 'My Father is called ' . $kristinko->fullName();



/****************** 5) CLASS INHERITANCE ******************/
/*
One class inherits attributes (variables) & methods (functions) of another class, first from second class
*/
class car {
    var $wheels = 4;
    var $doors = 4;

    function wheelsDoors() {
        return $this->wheels + $this->doors;
    }
}


class compactCar extends car {
    var $doors = 2;

    function wheelsDoors() {
        return $this->wheels + $this->doors + 100;
    }
}


$car1 = new car();
$car2 = new compactCar();


print $car1->wheels . '<br/>';
print $car1->doors . '<br/>';
print $car1->wheelsDoors() . '<br/>';

print '<br/><br/>';

print $car2->wheels . '<br/>';
print $car2->doors . '<br/>';
print $car2->wheelsDoors() . '<br/>';



/****************** 6) SETTING ACCESS MODIFIERS -> PUBLIC & PRIVATE VARIABLES (SCOPE) ******************/
/*
> controling access within a class (similar to scope)
	- public = Everywhere
	- private = This class only
	- protected = This class & subclass
*/
class Example {
    /*My Variables*/
    public $a = 1;
    protected $b = 2;
    private $c = 3;

    /*Display variables*/
    function showABC() {
        print $this->a;
        print $this->b;
        print $this->c;
    }


    public function helloEveryone() {
        return 'Hello everyone.<br/>';
    }

    private function helloFamily() {
        return 'Hello family.<br/>';
    }

    protected function helloMe() {
        return 'Hello me.<br/>';
    }


    /*Public function by default*/
    function hello() {
        $output = $this->helloEveryone();
        $output .= $this->helloFamily();
        $output .= $this->helloMe();
        return $output;
    }

}


$example = new Example();
print 'public a: ' . $example->a . '<br/>'; /*1*/
print 'protected b: ' . $example->b . '<br/>'; /*Error - cannot access protected property*/
print 'private c: ' . $example->c . '<br/>'; /*Error - cannot access private property*/


$example->showABC(); /*abc*/

print $example->hello(); /*Prints all functions*/



/****************** 7) USING SETTERS & GETTERS ******************/
class setterGetterExample {
    private $a = 1;

    public function getA() {
        return $this->a;
    }

    public function setA($value) {
        $this->a = $value;
    }
}


$example = new setterGetterExample();
/*GET A*/
print $example->getA(); /*1*/

/*SET A*/
$example->setA(25);
print $example->getA(); /*25*/




/****************** 8) WORKING WITH STATIC MODIFIERS ******************/
/*
 > Keyword STATIC
	- attributes & methods are around even if there is no instance
	- we have access to both totalStudents welcomeStudents even if we don't have an instance (look up 3.chapter)
	
> with static method cannot use THIS keyword instead use self

> static variables are shared throughout the inheritance tree
*/
class student {
    static $totalStudents = 0;

    static function welcomeStudents($var = 'Hello') {
        print $var . ' students.';
    }

    static public function addStudents() {
        self::$totalStudents++;
    }

}

/*INSTANCE*/
$myStudent = new student();
print $myStudent->totalStudents;

/*STATIC CALL*/
print student::$totalStudents; /*0*/
print student::welcomeStudents(); /*Hello students.*/
print student::welcomeStudents('Goodbye'); /*Goodbye students.*/
student::$totalStudents = 22;
print student::$totalStudents; /*22*/





/****************** 9) SCOPE RESOLUTION OPERATOR ******************/
/*
:: - this mark is scope resolution operator
*/





/****************** 10) REFERENCING PARENT CLASS ******************/
/*
> with parent we can use it with instances a well
	- we can only use it with parent methods, not attributes
	- we are breaking some static modifiers rules
> very usefull 	- access of original or overiding class
				- access old behaviours from class
*/
class A {
    static $a = 1;

    static function modifiedA() {
        return self::$a + 10;
    }
}


class B extends A {
    static function attrTest() {
        print parent::$a;
    }

    static function methodTest() {
        print parent::modifiedA();
    }
}

/*Returns 1 & 11*/
print B::$a . '<br />';
print B::modifiedA() . '<br />';
/*Returns exacly the same as code before*/
print B::attrTest() . '<br />';
print B::methodTest() . '<br />';






/****************** 11) USING CONSTRUCTORS & DESTRUCTORS ******************/
/*
> special methods that are automaticly called when an object is created or destroyed
	- stop when constructing it & perform construction method (on object)
		>> do things to object before it is constructed (to properties or variables as well)
			> npr. stop & check a database, or do a research on existing classes & their static variables
	- helpfull for any initialization that object may need before its actually being used
*/
class table {
    public $legs;
    static public $totalTables = 0;

    function __construct() {
        $this->legs = 4;
        table::$totalTables++;
    }

    /*Not much usefull - because PHP destroys everything*/
    function __destruct() {
        table::$totalTables--;
    }
}

$myTable = new table();
print $myTable->legs . ' legs are in a table!<br />'; /*4 legs are in a table!*/

$yourTable = new table();

$ourTable = new table();


print table::$totalTables . ' tables have been created!'; /*3 tables have been created!*/





/****************** 12) CLONING OBJECTS ******************/
class Beverage {
    public $name;

    /*This does not work on cloning for the object*/
    function __construct() {
        print 'New beverage was created.<br />';
    }
    /*This works for cloning for the object*/
    function __clone() {
        print 'Existing beverage was cloned.<br />';
    }
}

$a = new Beverage();
$a->name = 'Coffee';
$b = $a; /*always a reference with object*/
$b->name = 'Tea';
print $a->name . '<br />'; /*Tea*/

/*Cloning*/
$c = clone $a;
$c->name = 'Orange Juice';
print $a->name . '<br />'; /*Tea*/
print $c->name . '<br />'; /*Orange Juice*/

/*
New beverage was created.
Tea
Existing beverage was cloned.
Tea
Orange Juice
*/
















/****************** 1) CLASSES ******************/
/*Empty function*/
class animal {
	public function __construct() {
		print 'My name is Bear McBeary' . '<br />';
	}
}
$bear = new animal();	// My name is Bear McBeary

/*Full function*/
class vehicle {
	public function __construct($noise) {
		print 'My car goes ' . $noise . '<br />';
	}
}
$porsch = new vehicle('Vroooom!');	// My car goes Vroooom!
$ford = new vehicle('Repair!');	   // My car goes Repair!

/*Multiple functions ang $this->$that = */
class house {
	public $bedroom; // you can put default value here for variable
	
	public function __construct($bedroom) {
		$this->bedroom = $bedroom;
	}
	
	public function stuffInBedroom() {
		print 'In my bedroom there is ' . $this->bedroom .'<br />';
	}
}
/*New house*/
$marinko = new house('night lamp');
/*Calling method (function) stuffInBedroom*/
$marinko->stuffInBedroom();	// In my bedroom there is night lamp

/*Call function inside another function*/
class Example {
	public $item = ', good morning to Yall!';
	public $name;
	
	function Sample() {
		/*Inside Sample function call Test function*/
		$this->Test();
	}
	
	function Test() {
		print 'Booyakacha';
		/*Call public variable*/
		print $this->item;
	}
}
$learning = new Example();
/*Calling method (function) Sample*/
$learning->Sample();	// Booyakasha, good morning to Yall


/*PUBLIC & PRIVATE*/
class User {	
	public $age;
	private $password;

	public function __construct($age) {		
		$this->age = $age;
		$this->password = 'kikinda24';
	}
	
	public function getPassword($hint) {
		if($hint == 'getit') {
			return $this->password;
		} else {
			return 'Fuck off!';
		}
	}
}

$damir = new User(15);
print $damir->age;		// 15
print $damir->getPassword('getit');	// kikinda24


/*INHERITANCE - PARENT & CHILD*/
class User {	
	public $name;
	public $email;
	
	public function __construct($name, $email) {
		$this->name = $name;
		$this->email = $email;
	}
	
	public function getType() {
		return $this->type;
	}
}
/*code in user class extends to admin - they are the same*/
class Admin extends User {
	/*public values are the same*/
	public $permissionLevel;
	/*admin class by itself sets type to admin*/
	public $type = 'admin';
	
	public function __construct($name, $email, $permissionLevel) {
		/*we are calling parent construct so no need for repetition*/
		parent::__construct($name, $email);
		$this->permissionLevel = $permissionLevel;
	}
	
	/*
	ALERT
	OR - if we want to change things & now user  gets 'Hello from member' as well as admin
	
	public function getType() {
		return 'Hello from ' . parent::getType();
	}
	*/
	
}
/*member - fix so you only have new admin or member*/
class Member extends User {
	public $dateAdded;
	public $type = 'member';
	
	public function __construct($name, $email, $dateAdded) {
		parent::__construct($name, $email);
		$this->dateAdded = $dateAdded;
	}
}


/*ALERT - member sada ne vraća jer $this->type nije definiran u class User, but (OR)*/
$user1 = new User('Damir', 'damir@yahoo.com', 'member');
print $user1->getType();	// member
print '<br />';
/*Permission level 3*/
$user2 = new Admin('Veljko', 'veljko@gmail.com', 3);
print $user2->getType();	// admin
print '<br />';
$user3 = new Member('Marko', 'marko@gmail.com', 'Nov 14 2015');
print $user3->getType();	// member

?>