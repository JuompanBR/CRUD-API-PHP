# 01. CRUD API in Vanilla PHP

This repository contains the source code for a simple **CRUD** API written in vanilla PHP.

The API creates, reads, updates and deletes a **users** table inside a database called **assignment_1** in MySQL.

## 2. Repository Structure

The endpoints are written as standalone files inside the 
**src/handlers** sub-directory.<br>
All classes are defined in the **src/Classes** sub-directory.<br>
All configurations files for the database connection and response messages are defined in the **src/Configs** sub-directory.

## 3. How to run
### 3.1 Necessary services and dependencies
I'm still expecting to upgrade the project with docker and nginx, but for now make sure your have MySQL installed with PHP and run the SQL commands located in the **src/Sql** 
sub-directory first.

HAving installed, PHP, MYSQL, and composer
> 1. **Generate autoload**<br>
> compose init<br>
> composer dump-autoload -o
### 3.2 Running migrations
> 1. **Create a new database** <br>
> CREATE DATABASE assignment_1;
>
> 2. **Create the necessary table** <br>
> CREATE TABLE users (
>    id INT AUTO_INCREMENT PRIMARY KEY, 
>    username VARCHAR(255) NOT NULL,
>    password VARCHAR(255) NOT NULL,
>    email VARCHAR(255) NOT NULL
> );

## 4. Good to know

In this project, I practised the Design Patterns skills I learned early while building the project. I use a layered architecture in this case and these design patterns but non-exhaustive:

Factory Class

Singleton pattern

Strategy pattern

Composite pattern

Dependency injection

Decorator pattern

Please feel free to get in touch with me in case of an idea @ boris.goummo@cm.maviance.com

## 5. To do
- Create a front controller to handle all incoming requests
- Use a migration tool e.g. Flyway to handle the migrations

## 6. To Learn
- Learn about common advanced comparison operators
