# "Nurse Management with CRUD in Symfony"

Project installation and use

> - David Ortet
> - Marc Pla
> - Antonio Herrero

## Brief description

This project is a Nurse Management API built with Symfony, providing CRUD (Create, Read, Update, Delete) operations for managing nurse data. It allows users to create, update, retrieve, and delete nurse records, as well as perform nurse login verification via API endpoints.

![CRUD](https://media.licdn.com/dms/image/D4E12AQEs6G5nlBeiSg/article-cover_image-shrink_600_2000/0/1700011947400?e=2147483647&v=beta&t=ce2K9k-QgyoJZVdpxZJPsDjjex5nG_odjJEp1B0qRSY)

> We are going to use **POST** to create, **GET** to read, **PUT** to update and **DELETE** to delete a nurse.

For the **database management** and object-relational mapping (**ORM**), we are going to use a set of libraries and tools called **Doctrine** that offers multiple benefits like:

> **Database Abstraction**
>> Doctrine provides a layer of abstraction that allows you to interact with the database without writing SQL queries directly.

> **Migrations**
>> Includes a migration system that helps manage changes to the database structure in a controlled manner for keeping the database in sync with the data model as the application changes.

> **Validation and Business Rules**
>> We can define validation and business logic in our entity, ensuring that data is consistent and valid before being persisted to the database.

> **Unit testing**
>> Using Doctrine allows for more effective unit testing, as we can mock database interactions and test our app's logic in isolation.

In summary, implementing a CRUD with Doctrine not only simplifies database management but also improves code quality, facilitates maintenance and allows for better data handling in our app.

## Installation

Clone the Repository: To clone the repository, use the following command in your terminal:
git clone https://github.com/woocky17/M12_Proyecto_Inicial

Install Dependencies: After cloning the repository, navigate to the project directory and install the required dependencies using Composer:
composer install

Migrate the Database: If you have a database configured, run the following commands to create and migrate the database schema:
php bin/console doctrine:migrations:migrate

Start the Symfony Server: You can start the Symfony local server with the following command:
symfony server:start



## Implementation and functionality
The project provides several API endpoints for managing nurse data:


Get All Nurses
http://127.0.0.1:8000/NurseController/nurse

Get Nurse by ID
http://127.0.0.1:8000/NurseController/1




Readme documentation: [Basic Syntax](https://www.markdownguide.org/basic-syntax/#overview).
