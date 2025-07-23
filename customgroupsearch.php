<?php

require_once 'customgroupsearch.civix.php';
// phpcs:disable
use CRM_Customgroupsearch_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function customgroupsearch_civicrm_config(&$config) {
  _customgroupsearch_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function customgroupsearch_civicrm_install() {
  _customgroupsearch_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function customgroupsearch_civicrm_enable() {
  _customgroupsearch_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function customgroupsearch_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function customgroupsearch_civicrm_navigationMenu(&$menu) {
//  _customgroupsearch_civix_insert_navigation_menu($menu, 'Mailings', [
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ]);
//  _customgroupsearch_civix_navigationMenu($menu);
//}

/**
 * Implementation of hook_civicrm_buildForm
 */
function customgroupsearch_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Custom_Form_Group') {
    if (CIVICRM_UF == 'Drupal8') {
      $user_role_names = user_role_names(TRUE);
      unset($user_role_names['authenticated']);
    }
    elseif (CIVICRM_UF == 'Drupal' || CIVICRM_UF == 'Backdrop') {
      $user_role_names = user_roles(TRUE);
      if (defined('DRUPAL_AUTHENTICATED_RID')) {
        unset($user_role_names[DRUPAL_AUTHENTICATED_RID]);
      }
    }

    $form->add('select', 'user_roles', ts('Show Custom Group in Search for only these roles'),
      $user_role_names, FALSE, ['class' => 'crm-select2 huge', 'multiple' => 1]);
    if ($form->_action & CRM_Core_Action::UPDATE) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $form->setDefaults(['user_roles' => $settings->get('user_roles_' . $form->getVar('_id'))]);
    }
  }
}

/**
 * Implementation of hook_civicrm_postProcess
 */
function customgroupsearch_civicrm_postProcess($formName, &$form) {
  if ($formName == 'CRM_Custom_Form_Group') {
    if ($form->getVar('_id')) {
      $id = $form->getVar('_id');
    }
    else {
      $id = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_CustomGroup',
        $form->_submitValues['title'], 'id', 'title');
    }
    if ($id) {
      $user_roles_id = $form->_submitValues['user_roles'] ?? NULL;
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $settings->set('user_roles_' . $id, $user_roles_id);
    }
  }
}

/**
 * @param $groupDetails
 */
function customgroupsearch_civicrm_customGroupSearchRole(&$groupDetails) {
  $userId = CRM_Utils_System::getLoggedInUfID();
  foreach ($groupDetails as $id => $detail) {
    $roles = CRM_Customgroupsearch_Utils::getValue($id);
    if (!empty($roles)) {
      $isPresent = CRM_Customgroupsearch_Utils::isRolePresentToUser($userId,
        $roles);
      if (!$isPresent) {
        unset($groupDetails[$id]);
      }
    }
  }
}
