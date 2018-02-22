<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HelloBlock' block.
 *
 * @Block(
 *  id = "hello_block",
 *  admin_label = @Translation("Hello block"),
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
      $form = \Drupal::formBuilder()->getForm('Drupal\hello_world\Form\GeneralForm');
      return $form;
  }

}
