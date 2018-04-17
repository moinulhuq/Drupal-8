To create a route using "HTTP Basic Authentication" with custom_access_check function for a signle controller.

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
    _custom_access: '\Drupal\hello_world\Controller\GeneralController::custom_access_check'
```

_custom_access will replace of (_role: 'administrator' && _user_is_logged_in: 'TRUE' or _permission: 'access content').