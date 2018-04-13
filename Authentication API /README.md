Drupal 8 core includes two auhtentication

```
1. Cookie
	- Returns authenticated or anonymous user depending on the presence of a cookie.
2. HTTP Basic Authentication ('basic_auth')
	- Checks if user & password are in the request headers and finds a matching user in the DB.
```