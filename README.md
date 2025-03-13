# Card Distribution Application

This project is a simple web application that distributes a standard deck of 52 playing cards to `n` people. The application consists of a frontend (HTML/JavaScript) and a backend (PHP) that handles the card distribution logic.

---

## Table of Contents
1. [Project Structure](#project-structure)
2. [Files Explained](#files-explained)
3. [Docker Setup](#docker-setup)
   - [Dockerfile](#dockerfile)
   - [docker-compose.yml](#docker-compose.yml)
4. [How to Run the Application](#how-to-run-the-application)
5. [Testing the Application](#testing-the-application)
6. [Troubleshooting](#troubleshooting)


## Project Structure

tyrell_question_a/    
└── Dockerfile\
└── docker-compose.yml  
└── index.html\
└── card_distribution.php

## Files Explained

### 1. **`index.html`**
- This is the frontend file that contains the user interface.
- It includes a form where users can input the number of people to distribute the cards to.
- When the form is submitted, JavaScript sends a `GET` request to `card_distribution.php` and displays the result.

### 2. **`card_distribution.php`**
- This is the backend PHP script that handles the card distribution logic.
- It takes a `GET` parameter `people` (number of people) and distributes a standard deck of 52 cards randomly.
- The output is returned as plain text, formatted according to the requirements.

### 3. **`Dockerfile`**
- This file defines the Docker image for the application.
- It uses the official `php:8.2-apache` image as the base.
- It copies the application files into the container and exposes port 80 for HTTP traffic.

### 4. **`docker-compose.yml`**
- This file defines the Docker services for the application.
- It builds the Docker image using the `Dockerfile` and maps port `8080` on the host to port `80` in the container.
- It also uses a volume to sync the local files with the container for easy development.

## Docker Setup

### Dockerfile

```Dockerfile
# Use the official PHP Apache image
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the application files into the container
COPY . .

# Expose port 80
EXPOSE 80
```

-   **`FROM php:8.2-apache`**: Uses the official PHP image with Apache pre-installed.
    
-   **`WORKDIR /var/www/html`**: Sets the working directory to Apache's document root.
    
-   **`COPY . .`**: Copies all files from the local directory to the container.
    
-   **`EXPOSE 80`**: Exposes port 80 for HTTP traffic.

### docker-compose.yml

```docker-compose.yml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
```
-   **`version: '3.8'`**: Specifies the Docker Compose file format version.
    
-   **`services`**: Defines the services (containers) to run.
    
-   **`web`**: The name of the service.
    
    -   **`build: .`**: Builds the Docker image using the  `Dockerfile`  in the current directory.
        
    -   **`ports`**: Maps port  `8080`  on the host to port  `80`  in the container.
        
    -   **`volumes`**: Syncs the local directory with the container's  `/var/www/html`  directory for live updates.

## How to Run the Application  

### Prerequisites
-   Docker and Docker Compose installed on your machine.
### Steps

1.  Clone the repository or navigate to the project directory:
    bash ```cd tyrell_question_a```
    
2.  Build and start the Docker container:
    bash ```docker-compose up```
    
3.  Open your browser and navigate to:
    ```http://localhost:8080/index.html```
    
4.  Enter the number of people and click  **Distribute Cards**  to see the result. eg: 4
	  sample outpur results : 
    
    C4,DJ,S4,D6,HQ,DA,S5,SQ,H2,C2,CX,D5,CK\
    H5,S3,H3,C8,D9,C6,D7,DK,SX,CJ,H8,H4,S7\
    C7,CA,SJ,H9,S6,S2,SA,H7,DQ,D2,S9,HA,D3\
    DX,H6,SK,S8,HX,HK,C3,C9,HJ,D8,C5,CQ,D4

## Testing the Application

### Direct PHP Script Test

   1. You can test the PHP script directly by visiting:
   
      ```http://localhost:8080/card_distribution.php?people=4```

-   This should return the distributed cards in plain text.

### Frontend Test

1.  Open  `http://localhost:8080/index.html`.
    
2.  Enter a number (e.g.,  `4`) and click  **Distribute Cards**.
    
3.  The result should be displayed below the form.

## Troubleshooting

### 1.  **404 Error (File Not Found)**

1.  Ensure the files are in the correct directory (`/var/www/html`  inside the container).
    
2. Check the Apache logs: 
	
	bash ```docker-compose logs web```
	
### 2.  **PHP Script Not Executing**

-   Ensure the PHP script is accessible and has no syntax errors.
    
-   Test the script directly in the browser

	```http://localhost:8080/card_distribution.php?people=4```

### 3.  **JavaScript Errors**

-   Open the browser console (F12) and check for errors.
    
-   Ensure the  `fetch`  request is being sent to the correct URL.

### 4.  **Docker Container Issues**

-   Restart the container :

	```docker-compose down``` 
	```docker-compose up``` 
	
- Check the container logs :

	```docker-compose logs web``` 