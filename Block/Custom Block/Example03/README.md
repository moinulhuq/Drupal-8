Drupal custom block cache disable

```
$block = [
    '#markup' => t('Implement ArticleBlock.'),
    '#prefix' => '<div class="article-block" id="article-block">',
    '#suffix' => '</div>',
    '#cache' => [
                'max-age' => 0
            ],
];
```