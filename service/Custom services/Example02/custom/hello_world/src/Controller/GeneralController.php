<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class GeneralController.
 */
class GeneralController extends ControllerBase {

    /**
    * hello().
    *
    * @return array
    *   Return Hello string.
    */
    public function listbooks() {

        $book_list  = \Drupal::service('hello_world.book');

        $render = '';
        foreach($book_list->getBooklist() as $book) {
            $render .= '<div><span><b>Title:</b> ' . $book['title'] . '</span></div>';
            $render .= '<div><span><b>Author:</b> ' . $book['author'] . '</span></div>';
        }
        $render .= '<div><span>&nbsp;</span></div>';
        $render .= '<div><span><b>Location:</b> ' . $book_list->getOther()['location'] . '</span></div>';
        $render .= '<div><span><b>year:</b> ' . $book_list->getOther()['year'] . '</span></div>';

        return [
          '#type' => 'markup',
          '#markup' => $render,
        ];
    }
}
