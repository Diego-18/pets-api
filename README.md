# Pets

This is an API-REST for registration and control of pets.

### Install

<details>
    
1 - Create a database in mysql with the name pets.

2 - The repository is downloaded.

3 - The following command is executed:
```
composer install
```
command to install the dependencies.

4 - Rename the .env.template file to .env and modify the database connection environment variables such as user, password, port and database name.

5 - Execute the following command to add the tables and columns to the database
```
php artisan migrate
```
6 - Run php server with laravel using the following command
```
php artisan serve
```
7 - To access the data we place the following addresses in our browser.

</details>

## Data Base
The documentation of the creation of the database and diagrams of the same, can be found in the **database** directory of the same project.

## Functionality

Here you can find information about how the api works and which are the required fields for its operation.

To visualize the api operation it is necessary to use postman, thunder Client or any tool to make requests.

![Postman](https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white)

## Collections

<details>

<br/>
In the case of the parameters, {id} is replaced by the id number of the record to be managed.
    
### Categories Collections
```
GET    http://localhost:8000/api/categories                 // Search all records

GET    http://localhost:8000/api/category/{id}              // Search record for id

POST   http://localhost:8000/api/category                   // Add record 

PUT     http://localhost:8000/api/category/{id}             // Update record existing

DELETE  http://localhost:8000/api/category/{id}             // Delete record existing
```

In order to manage the **categories** we need to send you the following **params**:

<details>
    
### Create and Update Categories
~~~
{
    "name": "example" (string - required)
}
~~~
    
</details>

### Tags Collections
```
GET    http://localhost:8000/api/tags                   // Search all records

GET    http://localhost:8000/api/tag/{id}              // Search record for id

POST   http://localhost:8000/api/tag                   // Add record 

PUT     http://localhost:8000/api/tag/{id}             // Update record existing

DELETE  http://localhost:8000/api/tag/{id}             // Delete record existing
```

In order to manage the **tags** we need to send you the following **params**:

<details>
    
### Create and Update Tags
~~~
{
    "name": "example" (string - required)
}
~~~
    
</details>

### Pets Collections
```
GET     http://localhost:8000/api/pet/{id}                  //  Find pet by ID 

GET     http://localhost:8000/api/pet/findByStatus          //  Finds Pets by Status

POST    http://localhost:8000/api/pet                       //  Create new records

PUT     http://localhost:8000/api/pet                       //  Update record existing

DELETE  http://localhost:8000/api/pet/{id}                  //  Delete record existing
```

In order to manage the **technicians** we need to send you the following **params**:

<details>
    
### Create and Update Pets
~~~
{
    "name": "example"       (string - required)
    "category_fk": 1        (integer - required)
    "photoUrls": "example"  (string - required)
    "tag_fk": 1             (integer - required)
    "status": "available"   (string - required) (Accept: available, pending, sold)
}
~~~
    
### Search for Status
~~~
{
    "status": "available"   (string - required) (Accept: available, pending, sold)
}
~~~
    
</details>
</details>
    
## Technologies used

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Browsers support

![Firefox](https://img.shields.io/badge/Firefox-FF7139?style=for-the-badge&logo=Firefox-Browser&logoColor=white)
![Google Chrome](https://img.shields.io/badge/Google%20Chrome-4285F4?style=for-the-badge&logo=GoogleChrome&logoColor=white)
![Safari](https://img.shields.io/badge/Safari-000000?style=for-the-badge&logo=Safari&logoColor=white)
![Opera](https://img.shields.io/badge/Opera-FF1B2D?style=for-the-badge&logo=Opera&logoColor=white)
