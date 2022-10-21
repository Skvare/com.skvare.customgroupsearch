<?php

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Customgroupsearch_Utils {

  public static function getValue($id) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);

    return $settings->get('user_roles_' . $id);
  }

  /**
   * Function to get user details.
   * @param $userId
   * @return \Drupal\Core\Entity\EntityBase|\Drupal\Core\Entity\EntityInterface|\Drupal\user\Entity\User|WP_User|null
   */
  public static function loadUser($userId) {
    if (CIVICRM_UF == 'Drupal8') {
      $account = \Drupal\user\Entity\User::load($userId);
    }
    elseif (CIVICRM_UF == 'Drupal' || CIVICRM_UF == 'Backdrop') {
      $account = user_load((int)$userId, TRUE);
    }
    elseif (CIVICRM_UF == 'WordPress') {
      $account = new WP_User($userId);
    }
    elseif (CIVICRM_UF == 'Joomla') {
      $account = JUser::getInstance((int)$userId);
    }

    return $account;
  }

  /**
   * Function to check user have mentioned role
   *
   * @param $cmsUserID
   * @param $roles
   */
  public static function isRolePresentToUser($userId, $roles) {
    $account = self::loadUser($userId);
    $hasRole = FALSE;
    if (CIVICRM_UF == 'Drupal8') {
      $userRoles = $account->getRoles();
      foreach ($roles as $role) {
        if (in_array($role, $userRoles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Drupal') {
      foreach ($roles as $role) {
        if ($account !== FALSE && isset($account->roles[$role])) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Backdrop') {
      foreach ($roles as $role) {
        if ($account !== FALSE && in_array($role, $account->roles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'WordPress') {
      foreach ($roles as $role) {
        if (in_array($role, (array)$account->roles)) {
          $hasRole = TRUE;
          break;
        }
      }
    }
    elseif (CIVICRM_UF == 'Joomla') {
      foreach ($roles as $role) {
        if ($account !== FALSE && isset($account->groups[$role])) {
          $hasRole = TRUE;
          break;
        }
      }
    }

    return $hasRole;
  }
}
