<?php

/**
 * @file
 * Contains contact_person.page.inc.
 *
 * Page callback for Contact person entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Contact person templates.
 *
 * Default template: contact_person.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_contact_person(array &$variables) {
  // Fetch ContactPerson Entity Object.
  $contact_person = $variables['elements']['#contact_person'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
