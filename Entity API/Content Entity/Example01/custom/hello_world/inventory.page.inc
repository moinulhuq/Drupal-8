<?php

/**
 * @file
 * Contains inventory.page.inc.
 *
 * Page callback for Inventory entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Inventory templates.
 *
 * Default template: inventory.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_inventory(array &$variables) {
  // Fetch Inventory Entity Object.
  $inventory = $variables['elements']['#inventory'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
