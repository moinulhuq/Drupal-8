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

        $block = [
            '#markup' => t('Implement ArticleBlock.')
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
