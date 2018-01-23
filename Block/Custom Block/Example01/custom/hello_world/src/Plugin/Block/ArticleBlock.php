<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ArticleBlock' block.
 *
 * @Block(
 *  id = "article_block",
 *  admin_label = @Translation("Article Block"),
 *  category = @Translation("Custom")
 * )
 */
class ArticleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $date = new \DateTime();

/*
    $block = [
        '#markup' => t('Implement ArticleBlock.')
    ];
*/

/*
    $block = [
        '#markup' => t('Implement ArticleBlock on @year.', [ '@year' => $date->format('Y') ])
    ];
*/

/*
    $block = [
      'inside' => [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#value' => t('Implement ArticleBlock.'),
          '#attributes' => [
              'class' => ['some-class'],
              'style' => ['color:red']
          ]
      ]
    ];
*/

/*
    $block = [
      '#markup' => t('Cancel'),
      '#prefix' => '<div class="article-block" id="article-block">',
      '#suffix' => '</div>',
    ];
 */

     $block = [
        '#markup' => $this->configuration["article_block_content"],
     ];

    $build['article_block'] = $block ;
    return $build;
  }

  /**
  * {@inheritdoc}
  */
  public function defaultConfiguration() {
      return array(
          'article_block_content' => t('Implement ArticleBlock.'),
      );
  }

}
