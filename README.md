A test project for trying out various web service libraries in various languages.

Services
========

The same web service is implemented in three different technologies.  Each service contains a client test.  Each client test can be run against any service; python client against ruby server etc.

express
-------
*NodeJS* server.

Default port: `3000`

To start server:

    npm start


flask
-----
*Python* server.

Default port: `5000`

To start server:

    python ms_person.py


silex
=====
*Php* server

Default port: '8080'

To start server:
    
	php -S localhost:8080 -t web web/index.php


sinatra
-------
*Ruby* server.

Default port: `4567`

To start server:

    ruby ms_person.rb


Testing
=======
Each service implementation has it own test client (test.[py|rb|js|php]).
Each service can also be tested through curl.


	curl -X GET http://127.0.0.1:8080/
	curl -X GET http://127.0.0.1:8080/people
	curl -X GET http://127.0.0.1:3000/person/123
	curl -X POST -H "Accept: application/json" -d '{"first name": "BAT", "last name": "MAN"}' http://127.0.0.1:3000/person
	curl -X DELETE http://127.0.0.1:3000/person/9
	curl -X PUT -H "Accept: application/json" -H "Content-type: application/json" -d '{"first name": "BAT", "last name": "WOMAN"}' http://127.0.0.1:3000/person/9

HOW TO
======

View network traffic
--------------------

	sudo tcpdump -XX -i lo port 5000

express_demo
------------
This is not a proper web service.  It is a web based demo showing how a typical small express app is structured.



_Conor Mooney_

