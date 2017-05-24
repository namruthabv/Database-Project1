# Database-Project1
Database Project created with PHP, MYSQL, and Sakila Database.

Executed with Apache tomcat and was also deployed on Mysql server.

NOTE : Sakila Database is used for creating the project. 

Link for Sakila Database with Schema: https://dev.mysql.com/doc/sakila/en/sakila-structure.html

Purpose: To display Customer Information and Films rented by Customer along with “Similar films” (navigable link), the click on “Similar films” will redirect to SimilarFilms.php .
SimilarFilms.php will display up to 10 films with same category having at least one common actor. Films having most Common actors are listed first (decreasing order by count of common_actor).

- h6.php : PHP file supporting display of Customer information with films rented and redirection to “Similar films”
- SimilarFilms.php : Displays 10 films having same category of the Film with common actors information.
- connect.php : Configuration file for connecting with MYSQL server.
