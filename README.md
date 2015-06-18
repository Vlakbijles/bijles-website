# Vlakbijles

/user?
GET
```
{
	"api_user": "<api user>",
    "data": {
                "loggedin_data": {
                                    "user_id":    "<user id>",
                                    "token_hash": "<user token hash>"
                                 }
            },
	"timestamp": "<timestamp>",
	"hash": "<hash>"
}
```

POST
```
{
	"api_user": "<api user>",
    "data": {
		        "user_data":     {
                                   "email":   "<user email>"
                                 },
                "usermeta_data": {
                                   "zipcode": "<user zipcode>",
                                   "fb_id":   "<user facebook token>",
                                 }
            },
	"timestamp": "<timestamp>",
	"hash": "<hash>"
}
```

PUT
```
{
	"api_user": "<api user>",
    "data": {
		        "user_data":     {
                                   "email":   "<user email>"
                                 },
                "usermeta_data": {
                                   "phone":       "<user phone>",
                                   "zipcode":     "<user zipcode>",
                                   "description": "<user description>"
                                 }
            },
	"timestamp": "<timestamp>",
	"hash": "<hash>"
}
```

/user/<user_id>?

GET

