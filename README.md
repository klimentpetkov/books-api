# books-api
Simple CRUD API access for managing books, works with user roles and 
restricts books access for every single request.

## If you enjoy this API example, please give a star to this repo 

> Two type of user roles can work with the API - admin and user

## Authentication - works for both user and admin
##### Login
##### Logout
##### Me
##### Payload
##### Refresh

## Books - restricts access for every request to the data
#### List all (both user and admin)
#### Create new (admin only)
#### Show (both user and admin)
#### Update (admin only)
#### Delete (admin only)

If a regular user try to CREATE, UPDATE or DELETE a book record, then he/she will inevitably get this json response: 
<code>
{
    "message": "ACCESS DENIED"
}
</code>

> Let's start setting up the application

1) Create an .env file with database settings
2) Set jwt secret with <b>php artisan jwt:secret</b> 
    You shall see something similar to this in your .env file
   JWT_SECRET=XlKoKfLy8svUydXnsqD6Q24mGjVHOeGxafHyNEB4FloWyUGBJuEcS35oVLEj4bnh
If those below are missing you can generate and add them separately   
   JWT_PUBLIC_KEY=CyMuEZX5RDOTv500MHlifUE92nsNmwSLw2E4EJ568fc7GBhHLd
   JWT_PRIVATE_KEY=qLnT5quTr8yNmfz3A6sGCMENPKU2ENvfgJWB9mNCFmUMuJ2PGP
   JWT_PASSPHRASE=g9wDD5nN7nfQnzPD64sj
   JWT_TTL=10
   JWT_REFRESH_TTL=300
3) Create a database - for MySQL I suggest you to set up the encoding as <b>UTF8MB4_UNICODE_CI</b>
4) Run <b>composer install</b> to install all project dependencies 
5) Create and seed the database <b>php artisan migrate:fresh --seed</b>

Here are the routes that navigate the API - run: <b>php artisan routes:list</b>

Start the server <b>php artisan serve</b>

Then run postman and inside try the routes:
<p> &nbsp;</p>

> LOGIN  http://127.0.0.1:8000/api/auth/login

###### Method: 
<b>POST</b>

###### Params: 
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>email</td><td>_seeded_admin_or_user_email_</td></tr>
    <tr><td>password</td><td>_seeded_password_</td></tr>
</table>

###### Headers:

<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/json</td></tr>
</table>

###### The response shall be similar to this
<code>
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU3NDMzNDQ5NCwiZXhwIjoxNTc0MzM1MDk0LCJuYmYiOjE1NzQzMzQ0OTQsImp0aSI6IjZZVU5Xb3lYRXF5TkxQTXYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJuYW0iOiJTb21ldGhpbmcifQ.y3WDmfSoM00H2Zmoh-2jJCBkbjO_GGY8f5lqxZ-vnGw",
    "token_type": "bearer",
    "expires_in": 600
}
</code>

<p> &nbsp;</p>

> PAYLOAD  http://127.0.0.1:8000/api/auth/payload

###### Method: 
<b>POST</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization-type</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU3NDMzNDQ5NCwiZXhwIjoxNTc0MzM1MDk0LCJuYmYiOjE1NzQzMzQ0OTQsImp0aSI6IjZZVU5Xb3lYRXF5TkxQTXYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJuYW0iOiJTb21ldGhpbmcifQ.y3WDmfSoM00H2Zmoh-2jJCBkbjO_GGY8f5lqxZ-vnGw </td></tr>
</table>

###### The response shall be similar to this
<code>
{
    "iss": "http://127.0.0.1:8000/api/auth/login",
    "iat": 1574335755,
    "exp": 1574336355,
    "nbf": 1574335755,
    "jti": "Uf0GqGH6wyLWdSni",
    "sub": 1,
    "prv": "87e0af1ef9fd15812fdec97153a14e0b047546aa",
    "nam": "Something"
}
</code>

As you can see from the jwt authentication <a href="https://jwt-auth.readthedocs.io/en/develop/auth-guard/">documentation</a> there is a method claims() that cna be used to add additional payload parameters, as in our case the parameter nam 

<p> &nbsp;</p>

> ME  http://127.0.0.1:8000/api/auth/me

###### Method: 
<b>POST</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization-type</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU3NDMzNDQ5NCwiZXhwIjoxNTc0MzM1MDk0LCJuYmYiOjE1NzQzMzQ0OTQsImp0aSI6IjZZVU5Xb3lYRXF5TkxQTXYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJuYW0iOiJTb21ldGhpbmcifQ.y3WDmfSoM00H2Zmoh-2jJCBkbjO_GGY8f5lqxZ-vnGw</td></tr>
</table>

###### The response shall be similar to this
<code>
{
    "id": 1,
    "name": "Jeffrey Daugherty",
    "email": "noemi18@example.com",
    "role": "admin"
}
</code>

<p>&nbsp;</p>

> LOGOUT  http://127.0.0.1:8000/api/auth/logout

###### Method: 
<b>POST</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
</table>

###### For Body check <u>x-www-form-urlencoded</u> and provide the token
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>token</td><td>eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU3NDMzNDQ5NCwiZXhwIjoxNTc0MzM1MDk0LCJuYmYiOjE1NzQzMzQ0OTQsImp0aSI6IjZZVU5Xb3lYRXF5TkxQTXYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJuYW0iOiJTb21ldGhpbmcifQ.y3WDmfSoM00H2Zmoh-2jJCBkbjO_GGY8f5lqxZ-vnGw</td></tr>
</table>

###### You shall see this
<code>
{
    "message": "User logged out"
}
</code>

<p> &nbsp;</p>

> REFRESH  http://127.0.0.1:8000/api/auth/refresh

###### Method: 
<b>POST</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
</table>

###### For Body check <u>x-www-form-urlencoded</u> and provide the active token
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>token</td><td>eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU3NDMzNDQ5NCwiZXhwIjoxNTc0MzM1MDk0LCJuYmYiOjE1NzQzMzQ0OTQsImp0aSI6IjZZVU5Xb3lYRXF5TkxQTXYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJuYW0iOiJTb21ldGhpbmcifQ.y3WDmfSoM00H2Zmoh-2jJCBkbjO_GGY8f5lqxZ-vnGw</td></tr>
</table>

###### The response with a new token shall be similar to this
<code>
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc",
    "token_type": "bearer",
    "expires_in": 600
}
</code>

<p> &nbsp;</p>

> BOOKS index http://127.0.0.1:8000/api/books

###### Method: 
<b>GET</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

###### The response will be a paginated list by 10 books similar to this
<code>
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "title": "Voluptas odit illo consequatur.",
            "description": "White Rabbit read:-- 'They told me he was gone, and, by the whole she thought to herself, 'in my going out altogether, like a writing-desk?' 'Come, we shall have somebody to talk about wasting IT.",
            "author": {
                "last_name": "Keebler",
                "first_name": "Yadira"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 2,
            "title": "Eaque eum dolor.",
            "description": "Queen, but she did not at all for any of them. 'I'm sure those are not the smallest idea how confusing it is almost certain to disagree with you, sooner or later. However, this bottle does. I do it.",
            "author": {
                "last_name": "Mante",
                "first_name": "Waylon"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 3,
            "title": "Facilis itaque.",
            "description": "Hatter. Alice felt so desperate that she might as well say,' added the Gryphon; and then said, 'It was the same thing as \"I sleep when I learn music.' 'Ah! that accounts for it,' said the Duchess.",
            "author": {
                "last_name": "Reichert",
                "first_name": "Percival"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 4,
            "title": "Hic amet enim.",
            "description": "Alice rather unwillingly took the watch and looked at it uneasily, shaking it every now and then; such as, 'Sure, I don't know,' he went on, half to Alice. 'Nothing,' said Alice. 'It must be.",
            "author": {
                "last_name": "Mann",
                "first_name": "Nikki"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 5,
            "title": "Ab sed tempora.",
            "description": "Alice cautiously replied: 'but I haven't been invited yet.' 'You'll see me there,' said the Mock Turtle, and said 'That's very important,' the King hastily said, and went back to my right size to do.",
            "author": {
                "last_name": "Keebler",
                "first_name": "Paolo"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 6,
            "title": "Et iste et at.",
            "description": "Rabbit came near her, about four feet high. 'Whoever lives there,' thought Alice, 'shall I NEVER get any older than you, and listen to her, And mentioned me to him: She gave me a pair of white kid.",
            "author": {
                "last_name": "Mertz",
                "first_name": "Elinor"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 7,
            "title": "Laboriosam doloremque laborum suscipit.",
            "description": "Luckily for Alice, the little golden key, and when she went on, 'and most things twinkled after that--only the March Hare. 'Sixteenth,' added the Queen. 'I never was so much about a foot high: then.",
            "author": {
                "last_name": "Halvorson",
                "first_name": "Everette"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 8,
            "title": "Voluptatibus perferendis.",
            "description": "I'm doubtful about the crumbs,' said the King, who had got so much frightened that she began shrinking directly. As soon as she listened, or seemed to be ashamed of yourself for asking such a.",
            "author": {
                "last_name": "Bradtke",
                "first_name": "Alfred"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 9,
            "title": "Enim dolores.",
            "description": "I'll get into that beautiful garden--how IS that to be true): If she should meet the real Mary Ann, what ARE you doing out here? Run home this moment, and fetch me a pair of white kid gloves in one.",
            "author": {
                "last_name": "Lynch",
                "first_name": "Gisselle"
            },
            "created_at": "2019-11-21 10:11:42"
        },
        {
            "id": 10,
            "title": "Sunt occaecati error.",
            "description": "Rabbit's--'Pat! Pat! Where are you?' said the Duchess. 'I make you grow taller, and the Mock Turtle, 'but if you've seen them at dinn--' she checked herself hastily. 'I don't even know what \"it\".",
            "author": {
                "last_name": "Becker",
                "first_name": "Lorena"
            },
            "created_at": "2019-11-21 10:11:42"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/books?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/books?page=3",
    "next_page_url": "http://127.0.0.1:8000/api/books?page=2",
    "path": "http://127.0.0.1:8000/api/books",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 30
}
</code>

And if we decide to pass the page parameter like <b>http://127.0.0.1:8000/api/books?page=2</b>
then if the pagi is one of the valid pages then corresponding information will show
otherwise you can see this
<code>
{
    "current_page": 4,
    "data": [],
    "first_page_url": "http://127.0.0.1:8000/api/books?page=1",
    "from": null,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/books?page=3",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/books",
    "per_page": 10,
    "prev_page_url": "http://127.0.0.1:8000/api/books?page=3",
    "to": null,
    "total": 30
}
</code>

<p> &nbsp;</p>

> BOOKS create http://127.0.0.1:8000/api/books/create

###### Method: 
<b>GET</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

###### Params:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>title</td><td>test</td></tr>
    <tr><td>description</td><td>test2</td></tr>
    <tr><td>author[first_name]</td><td>Some name</td></tr>
    <tr><td>author[last_name]</td><td>Last name</td></tr>
</table>

###### When data are correct the result is
<code>
{
    "message": "Resource saved"
}
</code>

###### Else if validation is not passed the result is
<code>
{
    "message": "Validation error",
    "data": {
        "title": [
            "The title field is required."
        ],
        "description": [
            "The description field is required."
        ],
        "author.first_name": [
            "The author.first name field is required."
        ],
        "author.last_name": [
            "The author.last name field is required."
        ]
    }
}
</code>

<p> &nbsp;</p>

> BOOKS show http://127.0.0.1:8000/api/books/{id}

###### Method: 
<b>GET</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

###### Params:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>title</td><td>test</td></tr>
    <tr><td>description</td><td>test2</td></tr>
    <tr><td>author[first_name]</td><td>Some name</td></tr>
    <tr><td>author[last_name]</td><td>Last name</td></tr>
</table>

###### When id exists the result is similar to
<code>
{
    "data": {
        "id": 27,
        "title": "Quis provident molestiae qui blanditiis.",
        "description": "MARMALADE', but to get out at the proposal. 'Then the words did not notice this last word with such a capital one for catching mice you can't swim, can you?' he added, turning to the puppy.",
        "author": {
            "last_name": "Auer",
            "first_name": "Sherman"
        },
        "created_at": "2019-11-21 10:11:43"
    }
}
</code>

###### For non existent resources the result is
<code>
{
    "message": "The resource does not exist"
}
</code>

<p> &nbsp;</p>

> BOOKS update http://127.0.0.1:8000/api/books/{id}

###### Method: 
<b>PATCH</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

###### Params: (all that need to be changed)
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>author[first_name]</td><td>Some name</td></tr>
</table>

###### When id exists the result is
<code>
{
    "message": "Resource saved"
}
</code>

###### For non existent resources the result is
<code>
{
    "message": "The resource does not exist"
}
</code>

<p> &nbsp;</p>

> BOOKS delete http://127.0.0.1:8000/api/books/{id}

###### Method: 
<b>DELETE</b>

###### Headers:
<table>
    <tr><td>key</td><td>value</td></tr>
    <tr><td>Accept</td><td>application/json</td></tr>
    <tr><td>Content-type</td><td>application/x-www-form-urlencoded</td></tr>
    <tr><td>Authorization</td><td>Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9yZWZyZXNoIiwiaWF0IjoxNTc0MzM5NTUxLCJleHAiOjE1NzQzNDAxNzIsIm5iZiI6MTU3NDMzOTU3MiwianRpIjoiYkQ1d25VSnhJbGd1c3hzdSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsIm5hbSI6IlNvbWV0aGluZyJ9.Mi6Uea92c29VsKlT8r_KTuZulGquSRNFgrGl2-1P9dc</td></tr>
</table>

###### When id exists the result is
<code>
{
    "message": "Resource deleted successfully"
}
</code>

###### For non existent resources the result is
<code>
{
    "message": "The resource does not exist"
}
</code>

