########### TO DO #####################
Backend Mini Project (Bank Account)
The goal of this mini project is to write a simple micro web service to mimic a “Bank Account”.
Through this web service, one can query about the balance, deposit money, and withdraw
money. Just like any Bank, there are restrictions on how many transactions/amounts it can
handle. The details are described below.

Write a simple “Bank Account” web service using REST API design principles. You can
use either the CodeIgniter or Laravel framework.
<blockquote>
   ○ Program should have 3 REST API endpoints: Balance, Deposit, and Withdrawal<br/>
   ○ No requirement for authentication - assume the web service is for one account<br/>
   only and is open to the world<br/>
   ○ No requirement for the backend store - you can store it in a file or database (your
   decision)<br/>
   ○ Balance endpoint - this will return the outstanding balance<br/>
   ○ Deposit endpoint - credits the account with the specified amount<br/>
   ■ Max deposit for the day = $150K<br/>
   ■ Max deposit per transaction = $40K<br/>
   ■ Max deposit frequency = 4 transactions/day<br/>
   ○ Withdrawal endpoint - deducts the account with the specified amount<br/>
   ■ Max withdrawal for the day = $50K<br/>
   ■ Max withdrawal per transaction = $20K<br/>
   ■ Max withdrawal frequency = 3 transactions/day<br/>
   ■ Cannot withdraw when balance is less than withdrawal amount<br/>
</blockquote>
The service should handle all the error cases and return the appropriate error HTTP
status code and error message (Eg. If an attempt is to withdraw greater than $20k in a
single transaction, the error message should say “Exceeded Maximum Withdrawal Per
Transaction”).
Write tests against your web service.
Make sure your code is readable and can be run.
Check in your code to github and write instructions on readme on how to run.
Share with us the github repository via this email: ​ wesley@pezesha.com​ , cc:
hilda@pezesha.com​ , and we will review your project from there.



########### TECHNOLOGIES USED ####################
1. Laravel             - REST API service<br/>
2. MySQL               - Database storage<br/>
2. HTML5 & CSS3        - GUI creation<br/>
3. Angularjs           - Backend - Frontend communication<br/>
3. Angular-http-server - Front-end server<br/>



########## PROJECT WEB SERVICE TEST ###############
1. - Deposit / Balance / Withdraw <br/>
   - http://127.0.0.1:8000/bank/1?account_balance=10 <br/>
   - http://127.0.0.1:8000/bank/1 <br/>
   - http://127.0.0.1:8000/deduct/1?account_balance=10 <br/>
   - tests["Status code is 200"] = responseCode.code === 200; <br/>
   - Pass

2. - Deposit / Balance / Withdraw
   - http://127.0.0.1:8000/bank/1?account_balance=10 <br/>
   - http://127.0.0.1:8000/bank/1 <br/>
   - http://127.0.0.1:8000/deduct/1?account_balance=10 <br/>
   - tests["Content-Type is present"] = postman.getResponseHeader("Content-Type"); <br/>
   - Pass

3. - Deposit / Balance / Withdraw
   - http://127.0.0.1:8000/bank/1?account_balance=10 <br/>
   - http://127.0.0.1:8000/bank/1 <br/>
   - http://127.0.0.1:8000/deduct/1?account_balance=10 <br/>
   - tests["Response time is less than 200ms"] = responseTime < 200; <br/>
   - Pass  

4. - Deposit / Balance / Withdraw
   - http://127.0.0.1:8000/bank/1?account_balance=10 <br/>
   - http://127.0.0.1:8000/bank/1 <br/>
   - http://127.0.0.1:8000/deduct/1?account_balance=10 <br/>
   - tests["Content-Type is present"] = responseHeaders.hasOwnProperty("Content-Type"); <br/>
   - Pass  



########## PROJECT TEST ###########################
1. 3 APIs :
     -     Deposit : http://127.0.0.1:8000/bank/1   [ PUT ]
     -     Balance : http://127.0.0.1:8000/bank/1   [ GET ]
     -     Withdraw: http://127.0.0.1:8000/deduct/1 [ PUT ]

2. Authentication disabled : True
3. Back - end storage      : MySQL
4. Balance endpoint        : Pass
5. Deposit endpoint        : Validation

                            ■ Max deposit for the day = $150K             : Pass
                            ■ Max deposit per transaction = $40K          : Pass
                            ■ Max deposit frequency = 4 transactions/day  : Pass

6. Withdraw                : Validation

                           ■ Max withdrawal for the day = $50K                            : Pass
                           ■ Max withdrawal per transaction = $20K                        : Pass
                           ■ Max withdrawal frequency = 3 transactions/day                : Pass
                           ■ Cannot withdraw when balance is less than withdrawal amount  : Pass



########## INSTALLATION INSTRUCTION ##############
  - You need Internet to run the project effectively since it relies on external libraries; JQuery, Bootstrap..

System Requirments

1. Laravel 5.4
   -
   PHP >= 5.6.4<br/>
   OpenSSL PHP Extension<br/>
   PDO PHP Extension<br/>
   Mbstring PHP Extension<br/>
   Tokenizer PHP Extension<br/>
   XML PHP Extension<br/>

   https://laravel.com


2. Angular-http-server [ ready installed in the project folder - front-end ]
  -
  https://github.com/simonh1000/angular-http-server    


3. Run Project

  - Create folder with your desired name and clone Microbank-REST-Project [ https://github.com/kidalikevin/Microbank-REST-Project.git ]

  - Running Laravel API Rest.
       After done, open Api-Back-end folder and run terminal from inside this then execute this command, [  php artisan serve    ] , this should initiate laravel in-build server running on port 8000, http:/localhost:8000

       Ensure you have Phpmyadmin is installed in your machine. Create a database inside with the name microbank,
       In the clone project we have folder for database, import that table to Phpmyadmin where you created the new database
       Navigate to this file to provide your database login credentials to allow Laravel REST API to communicate with the database micrbank: ../Api-Back-end/config/database.php

  - Running Angular Front-end.
       Navigate to Front-end folder and run terminal from this folder executing this command to initialize server.. [ angular-http-server ], the server for Front-end will start running on this port 8080.
       You can now access the project by going to http://localhost:8080

  - Below is the running of the system on live server:
