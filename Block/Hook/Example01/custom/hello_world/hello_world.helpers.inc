<?php

/**
 * @file
 * Contains hello_world helpers function goes here.
 */

/**
 * Creating article block.
 */
function hello_callback(array $build) {

    /*---To replace the block title and content---*/

/*
    $build['content'] = [
        '#title' => t('Hello Article'),
        '#markup' => t('Article markup'),
    ];
*/
    /*---To concat with the block content---*/

    $build['content'][] = [
        '#markup' => t('Article markup'),
    ];

    return $build;
}

/**
 * Creating form block.
 */
function form_callback(array $build) {

    /*------Replacing existing form-------*/

/*    $build['content'] = [
        [
        '#type' => 'textfield',
        '#title' => t('Name'),
        '#required' => TRUE,
        ],
        [
            '#type' => 'textarea',
            '#title' => t('Contact'),
        ],
        [
            '#type' => 'submit',
            '#value' => t('Send'),
            '#button_type' => 'primary',
        ],

    ];
*/
    /*------Concating existing form-------*/

    $build['content'][] = [
        [
            '#type' => 'textfield',
            '#title' => t('Name'),
            '#required' => TRUE,
        ],
        [
            '#type' => 'textarea',
            '#title' => t('Contact'),
            '#value' => t(''),
        ]
    ];

    return $build;
}