Drupal custom block access permission

Visible only if logged in otherwise hidden

```php
/**
 * {@inheritdoc}
 */
public function blockAccess(AccountInterface $account){

    if (!$account->isAnonymous()){
        return AccessResult::allowed();
    }
    return AccessResult::forbidden();
}
```