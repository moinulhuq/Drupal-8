To implement "HTTP Basic Authentication" go to Extend->WEB SERVICES->HTTP Basic Authentication and enable.

Then create a route using "HTTP Basic Authentication".

```yml
hello_world.general_controller_hello:
  path: 'hello_world/hello'
  options:
    _auth: [ 'basic_auth' ]
    no_cache: 'TRUE'
  defaults:
    _controller: '\Drupal\hello_world\Controller\GeneralController::hello'
    _title: 'Your are Authenticate'
  requirements:
    _user_is_logged_in: 'TRUE'
    _role: 'administrator'
    _permission: 'access content'
```

This 'basic_auth' will check whether the userid and password is authentic or not.

Note: Basic Auth is NOT a means of logging into a Drupal site in order to make service GET requests that depend on the identity of the logged-in user.

To check logout from drupal site and go to "http://localhost:8888/uniservice/hello_world/hello" and you will be prompt with a screen of login popup. Please note that it will show 'access denied' even if you request that page when you are logged-in.

Basic problem of basic auth is it has no cookie and session which is why it kept information in the browser history for that you could not see every time promt popup once you submit worng userid and pass.