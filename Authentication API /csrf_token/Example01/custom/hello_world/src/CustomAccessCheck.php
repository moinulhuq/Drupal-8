<?php

namespace Drupal\hello_world;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Access\CsrfTokenGenerator;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Url;

/**
 * Class CustomAccessCheck.
 * Typically, if you tag a service, your service class must also implement a corresponding interface.
 */
class CustomAccessCheck implements AccessInterface {

  protected $csrf_token;

  /**
   * Constructs a new CustomAccessCheck object.
   *
   * @param \Drupal\Core\Access\CsrfTokenGenerator $csrf_token
   *  To get current token.
   */
  public function __construct(CsrfTokenGenerator $csrf_token) {
    $this->csrf_token = $csrf_token;
  }

  /**
   * A custom access check.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(Request $request) {
    
//    $url = Url::fromRoute('hello_world.general_controller_hello', [], ['absolute' => TRUE, 'query' => ['token' => \Drupal::csrfToken()->get()]])->toString();
//
//    $url2 = \Drupal::service('url_generator')->generateFromRoute('hello_world.general_controller_hello', [], ['absolute' => TRUE]);
//
//    $url3 = Url::fromRoute('hello_world.general_controller_hello')->toString();

    $token = $this->csrf_token->get();

    if($this->csrf_token->validate($token)){
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();

  }


}
