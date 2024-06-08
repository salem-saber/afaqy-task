# AFAQY Backend Task

API endpoint that provides the vehicle's expenses list. Vehicle expenses represented by the records of the fuel entries,
insurance payments, and services tables together in one list.

## Features

- Search expenses by vehicle name.
- Filter expenses by one or more type (fuel, insurance, service).
- Filter Minimum cost.
- Filter Maximum cost.
- Filter Minimum creation date.
- Filter Maximum creation date.
- The result can be sorted by "cost" or "creation date".
- The sort direction can be "ascending" or "descending".
- Paginate the result.
- The endpoint can not be exposed more than 5 times per minute.

## Requirements

- PHP >= 8.x
- MySQL >= 5.7
- Composer

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/salem-saber/afaqy-task.git
    ```

2. Go to the project directory:

    ```bash
    cd afaqy-task
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Set up your environment variables by copying the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Set up your database connection in the `.env` file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```

7. Download the database dump file from this link:
   https://drive.google.com/file/d/14h7-ouoeovbiUhY-p93FjbHWEbLX-FZW/view?usp=sharing

8. Import the database dump file to your database

9. Serve the application:

    ```bash
    php artisan serve
    ```

6. The API should now be accessible at `http://localhost:8000/api/vehicle-expenses`.

## Usage

### Endpoints

#### Retrieve a list of expenses with optional filter, sort and pagination

<details open>
 <summary><code>POST</code> <code><b>/</b></code> <code>/api/vehicle-expenses</code></summary>

##### Body Parameters

> | name       | type     | data type   | description                                |
> |------------|----------|-------------|--------------------------------------------|
> | filters    | optional | object      | Filters to apply to the expenses list      |
> | pagination | optional | object      | Pagination options for the expenses list   |
> | sort       | optional | object      | Sort options for the expenses list         |
>
> ##### Filters
> | name              | type     | data type | description                                            |
> |-------------------|----------|-----------|--------------------------------------------------------|
> | search            | optional | string    | Search for a vehicle name                              |
> | types             | optional | array     | Filter by one or more types (fuel, insurance, service) |
> | min_cost          | optional | integer   | Filter by minimum cost                                 |
> | max_cost          | optional | integer   | Filter by maximum cost                                 |
> | min_creation_date | optional | string    | Filter by minimum creation date                        |
> | max_creation_date | optional | string    | Filter by maximum creation date                        |
>
> ##### Pagination
> | name           | type     | data type   | description                                |
> |----------------|----------|-------------|--------------------------------------------|
> | current_page   | required | integer     | The current page number                    |
> | per_page       | required | integer     | The number of items per page               |
>
> ##### Sort
> | name           | type     | data type   | description                                |
> |----------------|----------|-------------|--------------------------------------------|
> | sort_by        | required | string      | The field to sort by                       |
> | sort_direction | required | string      | The sort direction (asc, desc)             |
>
> ##### Example Body
> ```json
> {
>   "filters": {
>       "search": "Prof. Garland Lang",
>       "types": [
>           "fuel"
>       ],
>       "min_cost": 0,
>       "max_cost": 10,
>       "min_creation_date": "2000-01-01",
>       "max_creation_date": "2023-01-01"
>   },
>   "pagination": {
>       "current_page": 1,
>       "per_page": 1
>   },
>   "sort": {
>       "sort_by": "cost",
>       "sort_direction": "desc"
>   }
> }
> ```


##### Responses

> | http code | content-type       | response                                                                                       |
> |-----------|--------------------|------------------------------------------------------------------------------------------------|
> | `200`     | `application/json` | `{"data":{...},"errors":[],"message":"","status_code":200}`                                    |
> | `429`     | `application/json` | `{"data":null,"errors":["Too many requests"],"message":"Too many requests","status_code":429}` |
>
> ##### Example Success Response
> ```json
> {
>     "data": {
>         "data": [
>             {
>                 "vehicle_id": 1,
>                 "vehicle_name": "Prof. Garland Lang",
>                 "plate_number": "3290804",
>                 "type": "fuel",
>                 "cost": 6,
>                 "created_at": "2019-12-20 11:53:05"
>             }
>         ],
>         "pagination": {
>             "total": 3,
>             "per_page": 1,
>             "current_page": 1,
>             "last_page": 3,
>             "from": 1,
>             "to": 1
>         },
>         "filters_applied": {
>             "search": "Prof. Garland Lang",
>             "min_cost": 0,
>             "max_cost": 10,
>             "min_creation_date": "2000-01-01",
>             "max_creation_date": "2023-01-01",
>             "types": [
>                 "fuel"
>             ]
>         }
>     },
>     "errors": [],
>     "message": "",
>     "status_code": 200
> }
> ```
>
> ##### Example Failure Response
> ```json
> {
>   "data": null,
>   "errors": [
>     "Too many Attempts"
>   ],
>   "message": "Too Many Requests",
>   "status_code": 429
> }
> ```


##### Example cURL

> ```bash
> curl --location 'http://localhost:8000/api/vehicle-expenses' \
> --header 'Content-Type: application/json' \
> --data '{
>   "filters": {
>     "search": "Prof. Garland Lang",
>     "types": [
>        "fuel"
>     ],
>     "min_cost": 0,
>     "max_cost": 10,
>     "min_creation_date": "2000-01-01",
>     "max_creation_date": "2023-01-01"
>   },
>   "pagination": {
>     "current_page": 1,
>     "per_page": 1
>   },
>   "sort": {
>     "sort_by": "cost",
>     "sort_direction": "desc"
>   }
> }
> '
> ```

</details>

## Testing

You can run PHPUnit tests by executing:

```bash
  php artisan test
```
