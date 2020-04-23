Using Windows 10 Education, extract File into C:\wamp64\www\g7t3_paws

1. There are two main directories used for the application executables:
	| /app
	| /microservices
		| /booking (in case docker fails)
		| /customer_amqp
		| /docker
			| /booking
		| /payment
		| /review
		| /serviceprovider
		| doLogout.php
		| land.php
		
2. Start Wamp
	2.1. Go to localhost/phpmyadmin.
	2.2. Username is 'root' and password '' if you are using windows.
	2.3. Go to directory sql scripts and import g7t3_db_esd.sql into phpmyadmin.

3. Start Docker

4. Go to the microservices directory and copy the directory in each of the microservices and paste into the command prompt later. 
For each microservices/
	4.1. /customer_amqp
		4.1.1. Open 2 command prompts, 1 for to run python customer_amqp.py and the other to run python customer_update_amqp.py
		4.1.2. Start rabbitmq
	4.2. /booking
		4.2.1. Open 1 command prompt, Run the docker container
	4.3. /payment
		4.3.1. Open 1 command prompt, run python payment.py
	4.4. /review
		4.4.1. Open 1 command prompt, run python review.py
	4.5. /serviceprovider
		4.5.1. Open 1 command prompt, run python serviceProvider_Trial.py
		
5. Go to localhost/g7t3_paws/land.php

6. There are 2 UIs and 2 accounts:
	--> Customer UI 
		Use 91239123 for Customer Role.
	--> Service Provider UI
		Use 2 for Service Provider Role

7. Login as Customer:
	7.1. Mobile Number: 91239123 
	7.2. Sign in
	
8. Login as Service Provider:
	8.1. Mobile Number: 2
	8.2. Sign in
	
9. You are done with the setup, please follow the video demostration for the User Scenarios. 