<?php 
/*

!!API - SERVING RESTFUL API-s!!

> Exposing APIs using REST allows practically everyone to programmatically access your application
	>> Because REST embraces the basic protocol of the Web as its syntax, no special libraries are necessary. 
	>> If a developer is capable of making HTTP requests, he can call your RESTful APIs

> REST does not prescribe a specific syntax for requests, the schema of the data passed back and forth, or even 
how to serialize data. Instead, it’s an architectural style that provides a set of patterns and general rules. 
	>> Each site is then free to implement its APIs according to its needs, as long as it can follow the guidelines
	
> A resource is the fundamental unit of REST. Resources can be people, objects, or anything you wish to act upon. 
	>> Resources are identified by location, using URLs. (Or by name, using a URN.)
	>> Resources have representations, which are various ways to describe the resource. 
		>> Usually the representations use standard data formats, such as JSON, XML, HTML, PDF, PNG...
		
> It’s a standard pattern to format URLs using /version/resource/key. 
	>> npr. Rasmus Lerdorf could be located at http://api.example.com/v1/people/rasmus
This resource can be represented in JSON as:
{
	"firstName": "Rasmus"
	"lastName": "Lerdorf"
}	

	
> In REST, the HTTP methods, such as GET and POST, describes the requested action. So, to process a RESTful request 
you need to know both the URL and the HTTP method

> Each method has a well-defined set of behaviors. 
	+) GET tells the server you want to retrieve an existing resource
	+) POST means you want to add a new resource
	+) PUT to modify a resource or create a specifically named resource
	*) DELETE, of course, deletes the resource


> Safe methods, such as GET, don’t modify resources (which is why they’re safe). Other methods, such as POST and DELETE, 
are not safe. 
	>> They are allowed to have the side effect of updating the system, by creating, modifying, or deleting a resource

> Nonsafe methods are further subdivided into two based on idempotency. When a method is idempotent, calling it multiple 
times is equivalent to calling it once. 
	>> npr. once you’ve called DELETE on a resource, trying to DELETE it again may return an error, but won’t cause anything 
	else to be deleted. 
	>> npr. making a POST request twice can cause two new resources to be created
HTTP method behavior
HTTP method		Description 		Safe 	Idempotent
GET 			Read a resource 	Yes 	Yes
POST 			Create a resource 	No 		No
PUT 			Update a resource 	No 		Yes
DELETE 			Delete a resource 	No 		Yes


> REST uses HTTP status codes to indicate whether the request has succeeded or failed

> It’s perfectly okay for a resource to have multiple representations. 
	>> An XML version of http://api.example.com/v1/people/rasmus could be
		<person>
			<firstName>Rasmus</firstName>
			<lastName>Lerdorf</lastName>
		</person>
	
	>> Another example is a text document that has both an HTML and a PDF version, or an image that comes in both 
	JPEG and PNG formats

> Though an understanding of the fundamentals of RESTful design is necessary to create a RESTful API of your own, 
you don’t need to implement all the scaffolding code from scratch. 
> Unfortunately, there’s no one-size-fits-all official PHP RESTful framework (FIND THEM & SEE DIFFERENCES)

*/

?>