Drupal custom form with live validation

Get alert if change 

```
$response = new AjaxResponse();
$response->addCommand(new AlertCommand($form_state->getTriggeringElement()['#value']));
return $response;
```