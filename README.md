<h1>Rest Api Service Example</h1>

<h3>A very basic demo for creating a restful webservice with php and javascript.</h3>

To test the application we will use a simple set of curl commands to send requests and check the corresonding responses. The Curl library itself enables to send data to or form a server and supports a large set of protocols including HTTP POST and HTTP PUT and even user/password authentication. For more information on curl, including installation and supported options vist the curl website http://curl.haxx.se/

We will start with a very simple Request on our application.

<b>curl -i  http://rest.localhost/users</b>

This should return a json content-type, as we defined application/json as default content type previously.

```
HTTP/1.1 200 OK
Date: Sun, 24 Feb 2013 01:16:16 GMT
Content-Length: 33
Content-Type: application/json; charset=utf-8

{"message":"retrieved all data."} 
```

We can use the -d option to add data, the -X option to define the request methid  and the -H option to add a header to the  request. This means, we can test a PUT request on a specific resource:


<b>curl -i -H "Accept: application/json" -X PUT -d '{"name":"test"}' http://rest.localhost/users/11</b>

```
HTTP/1.1 200 OK
Content-Length: 67
Content-Type: application/json; charset=utf-8

{"message":"... successfully updated ID : 11 with the name = test"}
```

One final test to test the application with a POST request and and accepted content type html:

<b>curl -i -H "Accept: text/html" -X POST -d name=test  http://rest.localhost/users/</b>

```
HTTP/1.1 201 CREATED
Content-Length: 71
Content-Type: text/html; charset=utf-8


...successfully added a new user with the name = test

```

The status code is 201 which means a new resource was created, the returned type and the content type is html. By using Curl we can add more tests, like sending a request with an accepted xml content and a DELETE method or a PUT request on a collection.
