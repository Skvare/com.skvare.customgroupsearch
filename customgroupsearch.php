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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function customgroupsearch_civicrm_xmlMenu(&$files) {
  _customgroupsearch_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function customgroupsearch_civicrm_postInstall() {
  _customgroupsearch_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function customgroupsearch_civicrm_uninstall() {
  _customgroupsearch_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function customgroupsearch_civicrm_enable() {
  _customgroupsearch_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function customgroupsearch_civicrm_disable() {
  _customgroupsearch_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function customgroupsearch_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _customgroupsearch_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function customgroupsearch_civicrm_managed(&$entities) {
  _customgroupsearch_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Add CiviCase types provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function customgroupsearch_civicrm_caseTypes(&$caseTypes) {
  _customgroupsearch_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Add Angular modules provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function customgroupsearch_civicrm_angularModules(&$angularModules) {
  // Auto-add module files from ./ang/*.ang.php
  _customgroupsearch_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function customgroupsearch_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _customgroupsearch_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function customgroupsearch_civicrm_entityTypes(&$entityTypes) {
  _customgroupsearch_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function customgroupsearch_civicrm_themes(&$themes) {
  _customgroupsearch_civix_civicrm_themes($themes);
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

    $form->add('select', 'user_roles', ts('Show Custom Group in Search for only these rolesfn'),
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
