# DCookies

API SPEcs

1. Login Admin

Request
Method : Post
End Point :/login
Header:
    Content-Type:application/json
    Body:
{
    ‘email’ : “string”
    ‘password’:”string”
    }
Response
{
    ‘message’: “Login berhasil”
}

2. Get all
Request
Method : Get
End Point : /categories
Header:
	Content-Type:application/json
Body:
{
	‘id’ : “string”
	‘category’:”string”
}
Response
{
	‘message’: “get all berhasil”
}


3. Rsgistrasi User
Request
Method : Post
End Point :/users
Header:
	Content-Type:application/json
Body:
{
	‘name’:”string”
	‘email’ : “string”
	‘password’:”string”
}
Response
{
	‘message’: “Registrasi berhasil”
}

4. Login Users
Request
Method : Post
End Point :/login
Header:
	Content-Type:application/json
Body:
{
	‘email’ : “string”
	‘password’:”string”
}
Response
{
	‘message’: “Login berhasil”
}

5. Add
Request
Method : Post
End Point :/categoies
Header:
	Content-Type:application/json
Body:
{
	‘namecategory’: “string”
}
Response
{
	‘message’: "Successfull store"
}
