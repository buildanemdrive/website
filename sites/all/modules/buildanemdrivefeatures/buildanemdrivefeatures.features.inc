<?php
/**
 * @file
 * buildanemdrivefeatures.features.inc
 */

/**
 * Implements hook_views_api().
 */
function buildanemdrivefeatures_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_default_mailchimp_signup().
 */
function buildanemdrivefeatures_default_mailchimp_signup() {
  $items = array();
  $items['sign_up_for_our_newsletter'] = entity_import('mailchimp_signup', '{
    "name" : "sign_up_for_our_newsletter",
    "mc_lists" : { "4e587c881b" : "4e587c881b" },
    "mode" : "3",
    "title" : "Sign up for our newsletter",
    "settings" : {
      "path" : "signup",
      "submit_button" : "Sign up for our newsletter",
      "confirmation_message" : "You have been successfully subscribed.",
      "destination" : "newsletter\\/thank-you",
      "mergefields" : {
        "EMAIL" : {
          "name" : "Email Address",
          "req" : true,
          "field_type" : "email",
          "public" : true,
          "show" : true,
          "order" : "1",
          "default" : null,
          "helptext" : null,
          "size" : "25",
          "tag" : "EMAIL",
          "id" : 0
        },
        "FNAME" : {
          "name" : "First Name",
          "req" : false,
          "field_type" : "text",
          "public" : true,
          "show" : true,
          "order" : "2",
          "default" : "",
          "helptext" : "",
          "size" : "25",
          "tag" : "FNAME",
          "id" : 1
        },
        "LNAME" : {
          "name" : "Last Name",
          "req" : false,
          "field_type" : "text",
          "public" : true,
          "show" : true,
          "order" : "3",
          "default" : "",
          "helptext" : "",
          "size" : "25",
          "tag" : "LNAME",
          "id" : 2
        }
      },
      "description" : "",
      "doublein" : 0,
      "send_welcome" : 1,
      "include_interest_groups" : 0
    },
    "rdf_mapping" : []
  }');
  return $items;
}

/**
 * Implements hook_node_info().
 */
function buildanemdrivefeatures_node_info() {
  $items = array(
    'biography' => array(
      'name' => t('Biography'),
      'base' => 'node_content',
      'description' => t('Use for the biographies of principals.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'facebook_landing_page' => array(
      'name' => t('Facebook Landing Page'),
      'base' => 'node_content',
      'description' => t('Use this content type to design landing pages for Facebook campaigns.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'front_page' => array(
      'name' => t('Front Page'),
      'base' => 'node_content',
      'description' => t('Use this to contain the content for the front page. There should only be one of these published at a time.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'front_page_item' => array(
      'name' => t('Front Page Item'),
      'base' => 'node_content',
      'description' => t('Use this to create items for the front page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
