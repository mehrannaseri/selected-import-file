# selected-import-file

I used mvc method to implement this task.
Also, I have only implemented the import of the json file and developed it for the xml file or any other file using the Design Pattern Factory.
To make the process of importing the file in the database faster, I used php generators.

In addition, I used composer for better management of required resources and libraries

# Installation and Run:

For installation and run after clone you need to run 

```composer install```

then create a new database on your machine and import ```importJsonXml.sql``` on your database

You also need to copy the ```.env.example``` file into your own ```.env``` file

## Run 

for run endpoint first run ```php -S localhost:8000``` on project root

and call ```http://localhost:8000/import-file``` on postman

