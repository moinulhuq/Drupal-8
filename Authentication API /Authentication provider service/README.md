In Drupal 8, "basic_auth" and "cookie" are default authentication provider services comes up with drupal core. But what if those don't fit with your needs then you need to create your own authentication provider service. To do so write command using "drupalconsole"

```
drupal gap
```

which will generate two files "hello_world.services.yml" and "src/Authentication/Provider/CustomAuthenticationProvider.php"

hello_world.services.yml
------------------------

```yml
services:
  authentication.hello_world:
    class: Drupal\hello_world\Authentication\Provider\CustomAuthenticationProvider
    arguments: ['@config.factory', '@entity_type.manager']
    tags:
      - { name: authentication_provider, provider_id: custom_authentication_provider, priority: 100 }
```

Here

```yml
name: (required) name tag for the service, it must be authentication_provider otherwise the service data manager will not find it.

provider_id: (required) machine name of the service and the authentication provider.

priority: (0) Provider weight. At standard cookie= 0, and the module basic_auth= 100.

global: ( FALSE) If TRUE this provider will be applied globally throughout the site. If left by default, then it will be applied only on the routers where it is explicitly indicated. Must return either an object of type AccountInterface, either NULL.
```

CustomAuthenticationProvider.php
--------------------------------

```php
class CustomAuthenticationProvider implements AuthenticationProviderInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a HTTP basic authentication provider object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EntityTypeManagerInterface $entity_type_manager) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Checks whether suitable authentication credentials are on the request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   *
   * @return bool
   *   TRUE if authentication credentials suitable for this provider are on the
   *   request, FALSE otherwise.
   */
  public function applies(Request $request) {
    // If you return TRUE and the method Authentication logic fails,
    // you will get out from Drupal navigation if you are logged in.
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function authenticate(Request $request) {
    $consumer_ip = $request->getClientIp();
    $ips = [];
    if (in_array($consumer_ip, $ips)) {
      // Return Anonymous user.
      return $this->entityTypeManager->getStorage('user')->load(0);
    }
    else {
      throw new AccessDeniedHttpException();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function cleanup(Request $request) {}

  /**
   * {@inheritdoc}
   */
  public function handleException(GetResponseForExceptionEvent $event) {
    $exception = $event->getException();
    if ($exception instanceof AccessDeniedHttpException) {
      $event->setException(
        new UnauthorizedHttpException('Invalid consumer origin.', $exception)
      );
      return TRUE;
    }
    return FALSE;
  }

}
```

Here

```yml
applies(Request $request): (required) This method returns either TRUE, or FALSE. This determines whether the current provider should work with the current request or not.

authenticate(Request $request): (required) The method responsible for all other authorization logic if this provider was called.
```

Check: https://niklan.net/blog/166