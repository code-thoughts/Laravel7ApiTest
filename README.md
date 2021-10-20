# Laravel7ApiTest
<u><b>Test Question </b></u>

This challenge will test your knowledge of API’s, API Authentication and verification when
getting data.

Requirements
  PHP
  Laravel or Lumen

Challenge
 Create a small API key system
 <ul>
  <li> API keys must be unique</li>
  <li>They should have scope/permissions to minimize security risks(optional)</li>
  </ul>
 Create a cart system
 <ul>
  <li>Create cart</li>
    <li>Get Cart</li>
    <li>Update Cart</li>
  <li> Delete Cart</li>
</ul>  
1. Use the API key system to generate API keys and use them in the cart system actions<br>
2. Make sure to verify and validate every request<br>
3. It can have a front-end but it is not required, API endpoints will be fine.<br>
4.You are basically creating a third-party cart application & to your clients will need an
API key to use your application<br><br>


<u><b>Test answer,installation and testing using project contents</b></u>

The Laravel API Key and Authentication Cart testing System

This is a simple system to demonstrate API authentication and verification when getting data or sending through data using: 
<ul>
  <li>Laravel 7</li>
  <li>Passport </li>
  <li>Composer</li> 
  <li>Laravel Helper</li>
  <li>LAMP</li>
  <li>Postman</li>
  <li>Visual Studio Code</li>
  <li>Linux Ubuntu Os</li>
</ul>
Laravel Passport 
Laravel uses the Passport library to implement a full OAuth2 server we can use for authentication in our API.(<i style="color:red;">OAuth 2.0 provides consented access and restricts actions of what the client app can perform on resources on behalf of the user, without ever sharing the user's credentials.</i>)<br><br>

<b>Installation of this project</b><br>

1.Install Lamp on your pc.<br> 
2.Composer<br> 
3.Laravel 7(Create your project at this step with laravel 7)<br> 
4.Laravel Passport(Add this to your project)<br> 
5.Laravel Helpers after (after step 3 and 4)<br> 
6.Copy project contents to your files<br> 

Edit your env file details , with details that correspond with your mysql database.
You may need to create a database called Carts_db before you do this and before migration.<br> 

DB_CONNECTION=mysql<br> 
DB_HOST=127.0.0.1<br> 
DB_PORT=3306<br> 
DB_DATABASE=Carts_db<br> 
DB_USERNAME=root<br> 
DB_PASSWORD=' '<br> 

Open the application in visual studio code, if you navigate tothe database tab-then click  migrations tab, you will see all the tables that you need to help run the test, but before that you need to migrate these tables so that, they are created in the database.<br> 


<b>How to test using this project</b><br> 

In visual studio code, in your app , if you navigate to routes and click on api.php all of our routes are in there divided into ,public and protected.

Now open your postman<br> 
<b>1.Add api url – [POST]   localhost:8000/api/register </b>,this registers a new user.
Parameters to enter are name, email, password, password_confirmation
you will then get a token back which will be used in further authentication.

<br>  
<b>2.Add api url – [POST]   localhost:8000/api/login </b>, here registered user logs in.
Parameters to enter are  email, password, password_confirmation
you will then get a token back which will be used in accessing a protected route as below.If you try accessing a protected routed with out logging in then your get.<br> 

{
"message": "Unauthenticated."
}

<br> 

<b>3.Add api url – [POST]   localhost:8000/api/cartCreate</b>, here registered user  and logged in user creates a cart with contents.
Parameters to enter are  product, country and token that was received after successful login.To use this token navigate to the Authorization tab,select bearer token,place token and click send.The contents where successfully saved you will see.<br> 

{
"message": "Your product has bee saved to your cart"
}


<br> 
<b>4.Add api url – [POST]   localhost:8000/api/cartShow</b>, here registered user  and logged in user gets to view all their carts and their contents.
No parameters to enter,the system uses the credentials of the user that is logged in,so its their view and token that was received after successful login.To use this token navigate to the Authorization tab,select bearer token,place token and click send.On success you will see.<br> 

{
"Cart": [
{
"id": 2,
"created_at": "2021-09-30T05:35:33.000000Z",
"updated_at": "2021-09-30T05:35:33.000000Z",
"product": "GreenSocks",
"country": "Greenland",
"user_id": 8
},<br> 
{
"id": 3,
"created_at": "2021-09-30T06:07:19.000000Z",
"updated_at": "2021-09-30T06:07:19.000000Z",
"product": "Green Glasses",
"country": "China",
"user_id": 8
}
]
}

<br> 

<b>5.Add api url – [PUT]   localhost:8000/api/cartUpdate/1</b>, here registered user  and logged in user can edit/update  cart and contents.
Parameters to enter are  product, country,the id of the cart whose contents you are editing and updating and token that was received after successful login.To use this token navigate to the Authorization tab,select bearer token, place token and click send. How ever if user tries to update contents other than  thiers, this message comes through.

<br> 

{
"message": "This cart is not yours to update"
}

<br> 

else if they are editing their own and the update is successful.<br> 

{
"message": "Cart updated successfully"
}

<br> 

<b>6.Add api url – [DELETE]   localhost:8000/api/cartDelete/3</b>, here registered user  and logged in user can delete cart and contents.
Parameters to enter are just the id of the cart with the contents you want to delete and token that was received after successful login.To use this token navigate to the Authorization tab,select bearer token,place token and click send.How ever if user tries to delete contents other than  thiers, this message comes through.

<br> 

{
"message": "This cart is not yours to delete"
}

<br> 

else if they are deleting  their own and the deletion is successful.<br> 

{
"message": "Cart deleted successfully"
}

<br> 

<b>3.Add api url – [POST]   localhost:8000/api/logout</b>, here registered user  and logged in user is logout of the system and the token is also removed.
Parameters to enter are the token that was received after successful login. To use this token navigate to the Authorization tab,select bearer token,place token and click send.After successful login this should appear.

<br> 

{
"message": "You have been successfully logged out!"
}



