# Blog - api

This is REST API for managing blog posts. 

# Api endpoints

- GET /api/posts - Fetch all blog posts
- GET /api/post/{id} - Fetch a blog post by id
- PUT /api/post - Update a blog post
- POST /api/posts - Create a new blog post
- DELETE /api/post/{id} - Delete a blog post

Authentication endpoints

- POST /api/login
- POST /api/register

# Setup

1. Download / clone project. Navigate to project folder.</br>
2. Install composer dependencies using following command:</br>
    <pre>composer install</pre>
3. Create .env file (copy from .env.example).</br>
4. Generate jwt-auth key:</br>
    <pre>php artisan jwt:secret</pre>
5. Create empty DB and set up .env file with database information.</br>
6. Run migrations</br>
    <pre>php artisan migrate</pre>
7. Seed database to insert 5 users and 3 blog post for each user (for testing if needed)</br>
    <pre>php artisan db:seed</pre>

# Usage

To register make POST request to /api/register route</br>
with provided name, email, password. All keys are required.</br>

To login, make POST request to /api/login route</br>
with valid email and password. Response will return</br>
authorization token for other requests.</Br>

# Authorization

Authorization bearer token recieved in login request must be added to all</br>
requests listed below:

Making requests: (response json included as example)</br>
For fetching all blog posts we need to make GET request to route</br>
`/api/posts`</br>

For fetching single blog posts we need to make GET request to route</br>
`/api/post/{id}` </br>with valid post ID (/api/posts/6).</br>
<pre>
    {
        "code": 202,
        "message": "success",
        "post": {
            "id": 6,
            "user_id": 2,
            "title": "Earum ipsum repellendus",
            "body": "Quam sed dolore in repellat optio voluptatem. Ratione minima sed occaecati incidunt tempore quos.",
            "created_at": "2020-11-13T08:24:58.000000Z",
            "updated_at": "2020-11-13T08:24:58.000000Z"
        }
    }
</pre>

For updating a blog post we need to make PUT request to route</br>
`/api/post` </br>with valid post id, title and body.</br>
<pre>
    {
        "code": 202,
        "message": "success",
        "post": {
            "id": 6,
            "user_id": 2,
            "title": "Updated title",
            "body": "New or old body text",
            "created_at": "2020-11-13T08:24:58.000000Z",
            "updated_at": "2020-11-13T09:28:59.000000Z"
        }
    }
</pre>

For deletind a blog posts we need to make DELETE request to route</br>
`/api/post/{id}` </br>with valid post ID (/api/posts/1).</br>
<pre>
    {
        "code": 202,
        "message": "success"
    }
</pre>