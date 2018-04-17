To create a route using "HTTP Basic Authentication" with custom access service for multiple controllers.

hello_world.routing.yml
------------------------
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
    _custom_access_check: 'TRUE'
```

hello_world.services.yml
-------------------------
```
services:
  hello_world.custom_access_check:
    class: Drupal\hello_world\CustomAccessCheck
    arguments: ['@current_user']
    tags:
          - { name: access_check, applies_to: _custom_access_check }
```

CustomAccessCheck.php
---------------------
```php
class CustomAccessCheck implements AccessInterface {

  protected $current_user;

  /**
   * Constructs a new CustomAccessCheck object.
   *
   * @param \Drupal\Core\Session\AccountProxy $current_user
   *  To get current user.
   */
  public function __construct(AccountProxy $current_user) {
    $this->current_user = $current_user;
  }

  /**
   * A custom access check.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access() {

    //replace of _role: 'administrator' && _user_is_logged_in: 'TRUE' or _permission: 'access content'

    if(in_array('administrator', $this->current_user->getAccount()->getRoles()) && $this->current_user->getAccount()->hasPermission('access content') && !$this->current_user->getAccount()->isAnonymous()) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }


}

```