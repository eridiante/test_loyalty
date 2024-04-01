# Running the PHP Project using Docker

This project is intended to be run in a Docker environment. Below are the instructions for running the project.

## Running the Project

1. Make sure you have Docker and Docker Compose installed.

2. Clone the repository:

    ```bash
    git clone git@github.com:eridiante/test_loyalty.git
    ```

3. Navigate to the project directory:

    ```bash
    cd test_loyalty

    ```

4. Start the Docker containers using docker-compose:

    ```bash
    docker-compose up -d
    ```

5. Enter the container:

    ```bash
    docker exec -it test_app bash
    ```

6. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

## Running Tests

To run tests using PHPUnit, execute the following command inside the container:

    ```bash
    vendor/bin/phpunit
    ```

Available Routes
After successfully starting the project, you can use the following routes:

GET /api/v1/users/{userId}/permissions - Get user permissions.
GET /api/v1/users/{userId}/groups - Get user groups.
POST /api/v1/users/{userId}/groups/{groupId} - Add a user to a group.
DELETE /api/v1/users/{userId}/groups/{groupId} - Remove a user from a group.

Example URL to get user groups with user ID 2:

http://localhost:8088/api/v1/users/2/groups
