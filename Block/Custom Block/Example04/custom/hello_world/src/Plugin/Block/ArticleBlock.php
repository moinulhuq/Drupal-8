<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;


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
    public function build(){

        $build = [];
        $date  = new \DateTime();

        $block = [
            '#theme' => 'article_block',
            '#title' => 'my title ',
            '#description' => 'my custom desc',
            '#attributes' => [
                'class' => ['alticle-block'],
                'id' => 'alticle-block',
            ],
            '#year'  => $date->format('y'),
            '#cache' => [
                'max-age' => 0,
            ],
        ];

        $build['article_block'] = $block ;
        return $build;
    }

    /**
     * {@inheritdoc}
     */
    public function blockAccess(AccountInterface $account){

        if (!$account->isAnonymous()){
            return AccessResult::allowed();
        }
        return AccessResult::forbidden();
    }


}
