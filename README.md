# CodeManagerPlateform

This project, CodeManagerPlatform, allows the management of various promo codes for a marketing campaign. It uses the CodeIgniter framework for the development of the application.


## Installation

1. Clone this repository to your local machine.
2. Make sure Docker is installed on your machine.
3. Run the following command to start the application with Docker:

```bash
docker-compose up -d        
``` 

## Features

### For Clients (Businesses)

Once authenticated, clients (businesses) can :

- Generate a list of promo codes.
- Benefit from a discount by using a valid promo code.
- Import promo codes.
- Provide unique codes to end customers.

### For Administrators

Administrators can :

- Manage different clients (businesses).

## Technologies Used

- **CodeIgniter** : PHP framework used for application development.
- **MySQL** : Relational database management system for storing user and promo code data.
- **Docker** : Application containerization using Docker.
  
## Database Structure

Here is the database structure used in the application :

```sql
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    status BOOLEAN DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS code (
    id INT NOT NULL AUTO_INCREMENT,
    code_unique VARCHAR(255) NOT NULL,
    code_promo VARCHAR(255) NOT NULL,
    status VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ci_sessions (
    id VARCHAR(40) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    timestamp INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    data BLOB NOT NULL,
    PRIMARY KEY (id),
    KEY ci_sessions_timestamp (timestamp)
);

```
