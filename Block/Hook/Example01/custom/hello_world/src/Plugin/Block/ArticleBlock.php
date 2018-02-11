<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

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
    public function defaultConfiguration() {
        return array(
            'article_block_content' => 'Hello world',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $config = $this->getConfiguration();
        $form['article_block_content'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Hello message'),
            '#description' => $this->t('Who do you want to say hello to?'),
            '#default_value' => isset($config['article_block_content']) ? $config['article_block_content'] : '',
            '#maxlength' => 64,
            '#size' => 64,
            '#weight' => '1',
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['article_block_content'] = $form_state->getValue('article_block_content');
    }

    /**
     * {@inheritdoc}
     */
    public function blockValidate($form, FormStateInterface $form_state)
    {
        if (empty($form_state->getValue('article_block_content'))) {
            drupal_set_message('needs to be an integer', 'warning');
            $form_state->setErrorByName('article_block_content', t('Can not be empty'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $config = $this->getConfiguration();
        return array(
            '#markup' => $this->t($config['article_block_content']),
        );
    }

}
