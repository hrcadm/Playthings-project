<?php
/**
  * Copyright © 2005 - 2018 CoreDial, LLC.
  * All Rights Reserved.
  *
  * This software is the confidential and proprietary information
  * of CoreDial, LLC and constitutes trade secrets owned by
  * CoreDial, LLC ("Confidential Information"). You shall not
  * disclose such Confidential Information and shall use it only
  * in accordance with the terms of the license agreement you
  * entered into with CoreDial, LLC.
  *
  */

use \Portal\ServiceIntegration\Services\ServiceBroadworksService;
use Portal\ServicePBX\Services\ServicePBXService;
use Service\FeatureToggle\Contexts\SessionContext;
use Service\FeatureToggle\FeatureToggleService;
use Service\Legacy\Model\VoipPlatform\VoipPlatform;

if (CHAT_ENABLED)
{
    include_once(BASE_DIR . "/application/include/chat.inc.php");
}

include_once(BASE_DIR . "/application/models/UserImporter.inc.php");

class User
{
    public $userId;
    public $userType;
    public $customerId;
    public $resellerId;
    public $branchId;
    private $agentId;
    private $services_account_user_id;
    public $username;
    public $alias;
    private $servicesAccountUserId;
    public $password;
    public $confirmPassword;
    private $encryptedPassword;
    public $firstName;
    public $lastName;
    public $email;
    public $contact_type;
    public $enabled;
    private $isSalesRep;    // indicates if this user should appear in the list of Sales Reps, NOT that this user is a TYPE_SALES_REP
    private $failedLogins;
    private $lockedOut;
    private $lockouts;
    private $lnpRecipient;
    private $timezone;
    private $address_id;
    private $role_id;
    private $organization_id;
    private $extension_ids;
    private $group_names;
    private $profile_ids;
    private $seatId;
    private $primary_extension_id;
    private $softphone_extension_id;
    private $xref_address;
    private $api_application_ids;
    private $call_center_importing_agent_id;
    private $external_identifier_for_import_value;
    public $dbLink;
    public $original = NULL;
    protected $customer = null;
    protected $servicesCustomer = null;

    const OPERATION_ADD = 1;
    const OPERATION_UPDATE = 2;
    const OPERATION_DELETE = 3;
    const OPERATION_UPDATE_FORM = 4;
    const OPERATION_UNLOCK = 5;
    const OPERATION_PERMISSION= 6;
    const OPERATION_DELETE_AVATAR = 7;
    const OPERATION_CREATE_EXTENSION = 8;

    const TYPE_ALL = -1;          // All users fit this type definition. Used when a module allows access to everyone
    const TYPE_SUPER_USER = 1;    // An employee of the service provider who maintains the entire enterprise
    const TYPE_ADMIN = 2;         // An end-user customer who has admin privileges over a given PBX
    const TYPE_EMPLOYEE = 3;      // An end-user customer who has privilege only over their given extension
    const TYPE_RESELLER = 4;      // A reseller user who has privilege over all of their own customers
    const TYPE_SALES_REP = 5;     // An reseller employee of a reseller who has privilege over sales functions
    const TYPE_ACD_AGENT = 6;     // An employee of a reseller who has privilege over individual sales functions
    const TYPE_SALES_MANAGER = 7; // An employee of a reseller who has privilege over the entire sales functions, of all team members

    const CLASS_NOT_LOGGED_IN = 0;
    const CLASS_SERVICE_PROVIDER = 1;
    const CLASS_RESELLER = 2;
    const CLASS_CUSTOMER = 3;

    const PASSWORD_REGEX_PATTERN = "^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).+$";

    const PASSWORD_ERROR_NO_PASSWORD = 1;
    const PASSWORD_ERROR_NO_CONFIRM_PASSWORD = 2;
    const PASSWORD_ERROR_TOO_SMALL = 3;
    const PASSWORD_ERROR_PATTERN_MATCH_FAILURE = 4;
    const PASSWORD_ERROR_MATCHES_USERNAME = 5;
    const PASSWORD_ERROR_PASSWORDS_DONT_MATCH = 6;

    /**
     * Constructor - if given a valid $userId, populates a new
     * user object with data from the database. If supplied -1,
     * then a new user object is created with default values.
     */
    function User($userId = -1, $resellerId = -1, $dbLink = null)
    {
      if ($dbLink === null) {
        global $portalLink;
        $dbLink = $portalLink;
      }
      $this->dbLink = $dbLink;

      if (-1 == $resellerId)
      {
          // TODO Must remove calls to Auth::instance() from all models
          if (Auth::instance()->is_drilled_down())
          {
              $resellerId = Auth::instance()->get_drilled_organization()->resellerId;
          }
          else 
          {
              $resellerId = Auth::instance()->get_user_organization()->resellerId;
          }
      }

      $this->userId = $userId;
      $this->resellerId = $resellerId;

      $this->extension_ids = array();
      $this->group_names = array();
      $this->profile_ids = array();
      $this->xref_address = new Address(-1);
      $this->api_application_ids = array();
      $this->external_identifier_for_import_value = "";

      if ($this->isNewUser()) {
        // create a new, empty user object
        $this->setDefaultValues();
      } else {
        // get the user data from the database
        $sql = sprintf(" SELECT u.customerId, u.resellerId, u.branchId,
                                u.agentId, u.username, u.password,
                                u.firstName, u.lastName, u.email, u.enabled,
                                u.isSalesRep, u.failedLogins, u.lockedOut, u.lockouts,
                                u.timezone, u.contactType, u.addressId, u.role_id,
                                u.organization_id, u.alias, u.servicesAccountUserId,
                                e1.extensionId as primary_extension_id,
                                e2.extensionId as softphone_extension_id,
                                bs.id as seatId
                         FROM user as u
                            LEFT JOIN user_extension AS ue1 ON (u.userId = ue1.userId AND ue1.primary_extension = 1)
                            LEFT JOIN extension AS e1 ON (e1.extensionId=ue1.extensionId)
                            LEFT JOIN user_extension AS ue2 ON (u.userId = ue2.userId AND ue2.softphone_extension = 1)
                            LEFT JOIN extension AS e2 ON (e2.extensionId=ue2.extensionId)
                            LEFT JOIN broadworks_seat bs ON (bs.userId=u.userId)
                         WHERE u.userId=%d",
                        dbEscape($userId,$this->dbLink)
                );
        $result = dbQuery($sql, $this->dbLink);
        if (dbCheckQuery($result)) {
          $row = dbFetchHash($result);
          $this->setUserId($userId);
          $this->setCustomerId($row["customerId"]);
          $this->setResellerId($row["resellerId"]);
          $this->setBranchId($row["branchId"]);
          $this->agentId = $row["agentId"];
          $this->setUsername($row["username"]);
          $this->setAlias($row["alias"]);
          $this->setServicesAccountUserId($row["servicesAccountUserId"]);
          $this->encryptedPassword = $row['password'];
          $this->setFirstName($row["firstName"]);
          $this->setLastName($row["lastName"]);
          $this->setEmail($row["email"]);
          $this->set_contact_type($row["contactType"]);
          $this->setEnabled($row["enabled"]);
          $this->setIsSalesRep($row["isSalesRep"]);
          $this->setFailedLogins($row["failedLogins"]);
          $this->setLockedOut($row["lockedOut"]);
          $this->setLockouts($row["lockouts"]);
          $this->set_timezone($row["timezone"]);
          $this->set_address_id($row["addressId"]);
          $this->set_role_id($row["role_id"]);
          $this->set_organization_id($row["organization_id"]);
          $this->set_primary_extension_id($row["primary_extension_id"]);
          $this->set_softphone_extension_id($row["softphone_extension_id"]);
          $this->setSeatId($row["seatId"]);

          $this->original = clone $this;
        } else {
          // something went wrong, or we weren't given a valid userId
            throw new Exception('Failure retrieving User from database.');
        }
      }
    }   // end constructor

    function setDefaultValues()
    {
      $this->setUserId(-1);
      $this->setCustomerId(-1);
      $this->setBranchId(-1);
      $this->agentId = -1;
      $this->setUsername("");
      $this->setAlias("");
      $this->setPassword("");
      $this->setFirstName("");
      $this->setLastName("");
      $this->setEmail("");
      $this->set_contact_type(0);
      $this->setEnabled(true);
      $this->isSalesRep = 0;    // TODO: When to set this if we keep it
      $this->set_timezone(null);
      $this->set_address_id(-1);
      $this->set_role_id(-1);
      // TODO Must remove calls to Auth::instance() from all models
      $this->set_organization_id(Auth::instance()->get_organization()->pk());
    }   // end setDefaultValues()


    /**
     * Populates this object with the values from the HTTP Request, not the database.
     */
    function populateFromRequest()
    {
      setFieldFromRequest($this->customerId, "customerId");
      setFieldFromRequest($this->resellerId, "resellerId");
      setFieldFromRequest($this->branchId, "branchId");
      setFieldFromRequest($this->agentId, "agentId");
      if($this->agentId < 1) { $this->agentId = -1 ;}
      setFieldFromRequest($this->username, "username");
      setFieldFromRequest($this->alias, "alias");
      setFieldFromRequest($this->servicesAccountUserId, "servicesAccountUserId");
      setFieldFromRequest($this->firstName, "firstName");
      setFieldFromRequest($this->lastName, "lastName");
      setFieldFromRequest($this->email, "email");
      setFieldFromRequest($this->enabled, "enabled");
      setFieldFromRequest($this->timezone, "timezone");
      setFieldFromRequest($this->role_id, "role_id");
      $this->setIsSalesRep((request("isSalesRep") == "1") ? 1 : 0);

        if (is_array($_POST['filter']['contact_type']))
        {
            $this->set_contact_type(
                array_reduce($_POST['filter']['contact_type'], function($a, $b){ return $a | $b;})
            );
        }
        else
        {
            $this->set_contact_type(0);
        }

      $password = request('password');
      if ($password) {
        /* Only update the password property if one was provided, otherwise
         * we'll end up setting it empty, which will trigger a password change
         * email every time the user is updated.
         */
        $this->setPassword($password);
        setFieldFromRequest($this->confirmPassword, "confirmPassword");
      }
    }   // end populateFromRequest()

    static public function get_from_username($username, $db_link)
    {
        $user_id = -1;

        // TODO Must remove calls to Auth::instance() from all models
        $reseller_id = Auth::instance()->get_site_organization()->get_reseller_id();
        $sql = sprintf("SELECT userId, resellerId FROM user WHERE username like '%s'",
                        dbEscape($username, $db_link));
        $result = dbQuery($sql, $db_link);
        if ($result)
        {
            if ($row = dbFetchHash($result))
            {
                $user_id = $row['userId'];
                $reseller_id = $row['resellerId'];
            }
        }
        else
        {
            writeToLog(sprintf("Error looking up a user by username: %s", dbError($db_link)));
        }
        return new User($user_id, $reseller_id, $db_link);
    }

    static public function get_username_from_id($user_id, $db_link)
    {
        $sql = sprintf("SELECT username FROM user WHERE userId = '%s'",
                       dbEscape($user_id));

        $result = dbQuery($sql, $db_link);
        if ($result)
        {
            if ($row = dbFetchHash($result))
            {
                return $row['username'];
            }
        }
        else
        {
            writeToLog(sprintf("Error looking up a username: %s", dbError($db_link)));
        }
        return null;
    }

    static public function getFromPrimaryExtensionId($extension_id, $db_link)
    {
        $sql = sprintf("SELECT ue.userId
                        FROM user_extension ue
                        WHERE ue.extensionId = %d and ue.primary_extension = 1",
                            dbEscape($extension_id, $db_link));
        $result = dbQuery($sql, $db_link);
        if (dbCheckQuery($result)) {
            $row = dbFetchHash($result);
            $user_id = $row['userId'];
            return new User($user_id);
        }
        return null;
    }

    /**
     * Validates data prior to operating on it
     *
     * @param ErrorList $errorList
     * @param int       $operation
     * @param array     $options
     *
     * @return boolean
     */
    function validate(&$errorList, $operation = self::OPERATION_ADD, $options = array())
    {
        $do_confirm_password = Common::getOption($options, "do_confirm_password", TRUE);
        $extensions_in_use = Common::getOption($options, "extensions_in_use", array());
        $seats_in_use = Common::getOption($options, "seats_in_use", array());

        //*** Username ***
        if (strlen($this->getUsername()) < USERNAME_MIN_LENGTH)
        {
            $errorList->add("Username must be at least " . USERNAME_MIN_LENGTH . " characters.");
        }
        if (trim($this->getUsername()) != $this->getUsername())
        {
            $errorList->add("Username must not begin or end with whitespace characters.");
        }

        if ($this->customerId > 0) {
            switch ($this->getCustomer()->get_platform_id()) {
                case VoipPlatform::PLATFORM_BROADWORKS:
                    $options = array("seats_in_use" => $seats_in_use);
                    $this->validateSeatsInUse($errorList, $options);
                    break;
                case VoipPlatform::PLATFORM_ASTERISK:
                    if ($this->enabled) {
                        $options = array("extensions_in_use" => $extensions_in_use);
                        $this->validateExtensionsInUse($errorList, $options);
                    }
                    break;
            }
        }

        if ($operation == self::OPERATION_ADD || $operation == self::OPERATION_UPDATE)
        {
            $this->checkForUsernameTaken($errorList);
            if ($operation == self::OPERATION_ADD)
            {
                if (strlen($this->getPassword()) <= 0)
                {
                    $errorList->add(
                        self::get_password_error_messages(
                            self::PASSWORD_ERROR_NO_PASSWORD
                        )
                    );
                }
                if ($do_confirm_password)
                {
                    if (strlen($this->getConfirmPassword()) <= 0)
                    {
                        $errorList->add(
                            self::get_password_error_messages(
                                self::PASSWORD_ERROR_NO_CONFIRM_PASSWORD
                            )
                        );
                    }
                }
            }
        }

        //*** Password ***
        if (strlen($this->getPassword()) > 0)
        {
            // Password is being updated or saved, validate it
            self::check_password($this->getPassword(), $errorList);

            if (strtolower($this->getPassword()) == strtolower($this->getUsername()))
            {
                $errorList->add(self::get_password_error_messages(self::PASSWORD_ERROR_MATCHES_USERNAME));
            }
            if ($do_confirm_password)
            {
                if ($this->getPassword() != $this->getConfirmPassword())
                {
                    $errorList->add(self::get_password_error_messages(self::PASSWORD_ERROR_PASSWORDS_DONT_MATCH));
                }
            }
        }

        //*** First Name ***
        if (strlen($this->getFirstName()) <= 0)
        {
            $errorList->add("You must enter a first name.");
        }

        //*** Last Name ***
        if (strlen($this->getLastName()) <= 0)
        {
            $errorList->add("You must enter a last name.");
        }

        //*** Email ***
        if (! isValidEmail($this->getEmail()))
        {
            $errorList->add("Please enter a valid email address.");
        }

        //*** Contact Type ***
        if ((0 > $this->contact_type) or ($this->contact_type > Model_User::CONTACT_TYPE_ALL))
        {
            $errorList->add("Please enter a valid contact type.");
        }

        //*** Time Zone ***
        if (!TimeZone::is_valid($this->timezone))
        {
            $errorList->add("Please enter a valid timezone.");
        }

        //*** Role ***
        if ((Model_Role::ROLE_MIN > $this->role_id) or ($this->role_id > Model_Role::ROLE_MAX))
        {
            $errorList->add("Please enter a valid role");
        }

        if ($this->customerId < 1) {
            //*** Assignable UC Service User ***
            $this->validateServicesAccountUser($errorList, $options);
        }

        return $errorList->isEmpty();
    }   // end validate()


    /**
     * Updates a new user record to the database
     */
    function update($errorList)
    {
        if (strlen($this->getPassword()) > 0) {
            $sqlPassword = ", password = '{$this->encryptedPassword}' ";
        } else {
            $sqlPassword = "";
        }

        $customer_id = ((int) $this->getCustomerId()  > 0) ? dbEscape($this->getCustomerId(),  $this->dbLink) : 'NULL';
        $branch_id   = ((int) $this->getBranchId()    > 0) ? dbEscape($this->getBranchId(),    $this->dbLink) : 'NULL';
        $agent_id    = ((int) $this->getAgentId()     > 0) ? dbEscape($this->getAgentId(),     $this->dbLink) : 'NULL';
        $address_id  = ((int) $this->get_address_id() > 0) ? dbEscape($this->get_address_id(), $this->dbLink) : 'NULL';
        $role_id     = ((int) $this->get_role_id()    > 0) ? dbEscape($this->get_role_id(),    $this->dbLink) : 'NULL';
        // must burn UserBlankInput with fire
        $services_account_user_id = UserBlankInput::stripUserBlankInput($this->getServicesAccountUserId());
        $services_account_user_id = ((int) $services_account_user_id > 0) ? dbEscape($services_account_user_id, $this->dbLink) : 'NULL';
        // resellerId cannot be changed, so we do not update it

        $sql = sprintf("UPDATE user SET firstName='%s', enabled=%d,
                        lastName='%s', username='%s', alias=%s, email='%s', isSalesRep=%d, agentId=%s $sqlPassword ,
                        customerId=%s, branchId=%s, timezone='%s', contactType=%d,
                        addressId=%s, role_id=%s, organization_id=%s,
                        servicesAccountUserId=%s
                        WHERE userId = %d",
              dbEscape($this->getFirstName(),$this->dbLink),
              dbEscape($this->getEnabled(),$this->dbLink),
              dbEscape($this->getLastName(),$this->dbLink),
              dbEscape($this->getUsername(),$this->dbLink),
              $this->getAliasForDb(),
              dbEscape($this->getEmail(),$this->dbLink),
              dbEscape($this->getIsSalesRep(),$this->dbLink),
              $agent_id,
              $customer_id,
              $branch_id,
              dbEscape($this->get_timezone(),$this->dbLink),
              dbEscape($this->get_contact_type(),$this->dbLink),
              $address_id,
              $role_id,
              dbEscape($this->get_organization_id(), $this->dbLink),
              $services_account_user_id,
              dbEscape($this->getUserId(), $this->dbLink));

        $result = dbQuery($sql, $this->dbLink);
        if (! dbCheckQuery($result)) {
            $errorList->add("Could not update User record.", dbError());
            writeToLog("Could not UPDATE 'user' table in User->update():", LOG_ERROR);
            writeToLog(dbError(), LOG_ERROR);
            return false;
        }

        if (!$this->enabled) {
            if (!$this->unlinkFromEndUserParent()) {
                $errorList->add("Could not update User record.");
                return false;
            }
        }

        $this->updateAssociatedSeat();

        if (CHAT_ENABLED && ($this->original->getFullName() != $this->getFullName()))
        {
            $this->load_api_application_ids_xref();
            foreach ($this->api_application_ids as $aid)
            {
                if (ApiApplication::APP_USER_DASHBOARD_ID == $aid)
                {
                    update_chat_nick($this->getUsername(), $this->getFullName());
                    break;
                }
            }
        }
        PortalQueue::send_event(PortalQueue::ACTION_UPDATE, get_class(), $this->userId,
            array('username' => $this->getUsername())
        );
        History::log(History::MODIFY, History::RECORD_TYPE_USER, $this->userId, $this->dbLink);
        return true;
    }


    /**
     * Adds a new user record to the database
     */
    function add($errorList,$allowedRights=null)
    {
      $customer_id = ((int) $this->getCustomerId() > 0)  ? dbEscape($this->getCustomerId(), $this->dbLink)  : 'NULL';
      $branch_id   = ((int) $this->getBranchId() > 0)    ? dbEscape($this->getBranchId(), $this->dbLink)    : 'NULL';
      $agent_id    = ((int) $this->getAgentId() > 0)     ? dbEscape($this->getAgentId(), $this->dbLink)     : 'NULL';
      $address_id  = ((int) $this->get_address_id() > 0) ? dbEscape($this->get_address_id(), $this->dbLink) : 'NULL';
      $role_id     = ((int) $this->get_role_id() > 0)    ? dbEscape($this->get_role_id(), $this->dbLink)    : 'NULL';
      // must burn UserBlankInput with fire
      $services_account_user_id = UserBlankInput::stripUserBlankInput($this->getServicesAccountUserId());
      $services_account_user_id = ((int) $services_account_user_id > 0) ? dbEscape($services_account_user_id, $this->dbLink) : 'NULL';

      $sql = sprintf("INSERT INTO user (customerId, branchId, username, alias,
                        password, firstName, lastName, email, resellerId,
                        isSalesRep, agentId, timezone, contactType, addressId,
                        role_id, organization_id, enabled, servicesAccountUserId)
                    VALUES (%s, %s, '%s', %s,
                        '%s', '%s', '%s', '%s', %d,
                        %d, %s, '%s', %d, %s,
                        %s, %d, %d, %s)",
                    $customer_id,
                    $branch_id,
                    dbEscape($this->getUserName(), $this->dbLink),
                    $this->getAliasForDb(),
                    dbEscape($this->encryptedPassword, $this->dbLink),
                    dbEscape($this->getFirstName(), $this->dbLink),
                    dbEscape($this->getLastName(), $this->dbLink),
                    dbEscape($this->getEmail(), $this->dbLink),
                    dbEscape($this->getResellerId(), $this->dbLink),
                    dbEscape($this->isSalesRep, $this->dbLink),
                    $agent_id,
                    dbEscape($this->timezone, $this->dbLink),
                    dbEscape($this->contact_type, $this->dbLink),
                    $address_id,
                    $role_id,
                    dbEscape($this->get_organization_id(), $this->dbLink),
                    dbEscape($this->getEnabled(),$this->dbLink),
                    $services_account_user_id
            );
      $result = dbQuery($sql, $this->dbLink);

      if (dbCheckQuery($result)) {
          $this->setUserId(dbLastInsert($this->dbLink));
          $this->updateAssociatedSeat();

          $all_user_group = ORM::factory('UserGroup')
              ->where('organization_id', '=', $this->get_organization_id())
              ->where('system', '=', 1)
              ->find();
          if ($all_user_group->loaded())
          {
              $pivot_map = array(
                  'created_by' => $all_user_group->modified_by,
                  'modified_by' => $all_user_group->modified_by,
              );
              $all_user_group->add(
                  'users',
                  array($this->getUserId()),
                  $pivot_map
              );

              // TODO: Eventually we will move this to UserGroup model logic
              if ($all_user_group->visibility_type == 1)
              {
                  $all_user_group->add(
                      'group_visible',
                      array($this->getUserId()),
                      $pivot_map
                  );
              }
              $all_user_group->save();
          }
      } else {
        $errorList->add("Could not create user.", dbError());
        writeToLog("Could not INSERT into 'user' table in User->add():");
        writeToLog("$sql");
        writeToLog(dbError());
        return false;
      }

      // TODO: Powered By Control with new UI and permissions
      PortalQueue::send_event(PortalQueue::ACTION_CREATE, get_class(), $this->userId,
        array('username' => $this->getUsername())
      );

      History::log(History::ADD, History::RECORD_TYPE_USER, $this->userId, $this->dbLink);

      return true;
    }   // end add()

    static function lockoutUser($userId,$dbLink=null){
      if ($dbLink === null) {
        global $portalLink;
        $dbLink = $portalLink;
      }
      if ($userId > 0) {
        // TODO Must remove calls to Auth::instance() from all models
        $reseller_id = Auth::instance()->get_organization()->get_reseller_id();

        $sql = sprintf("update user set lockedOut = now() + interval ".LOCKOUTTIME." MINUTE where userId = %d and resellerId = $reseller_id",
                        dbEscape($userId, $dbLink)
                );
        $result = dbQuery($sql, $dbLink);
        if (! dbCheckQuery($result)) {
          return false;
        }
      } else {
        return false;
      }
      PortalQueue::send_event(PortalQueue::ACTION_UPDATE, get_class(), $userId,
        array('username' => self::get_username_from_id($userId, $dbLink))
      );

      return true;
    }

    static function resetFailedLogins($userId,$dbLink=null)
    {
      if ($dbLink === null) {
        global $portalLink;
        $dbLink = $portalLink;
      }
      if ($userId > 0) {
        // TODO Must remove calls to Auth::instance() from all models
        $reseller_id = Auth::instance()->get_site_organization()->get_reseller_id();

        $sql = sprintf("UPDATE user set failedLogins = 0 WHERE userId = %d and resellerId = $reseller_id",
                        dbEscape($userId,$dbLink)
                );
        $result = dbQuery($sql, $dbLink);
        if (! dbCheckQuery($result)) {
          return false;
        }
      } else {
        return false;
      }
      PortalQueue::send_event(PortalQueue::ACTION_UPDATE, get_class(), $userId,
        array('username' => self::get_username_from_id($userId, $dbLink))
      );

      return true;
    }

    static function incrementFailedLogins($userId,$dbLink=null)
    {
      if ($dbLink === null) {
        global $portalLink;
        $dbLink = $portalLink;
      }
      if ($userId > 0) {
        $sql = sprintf("UPDATE user set failedLogins = failedLogins + 1 WHERE userId = %d",
                        dbEscape($userId,$dbLink)
                );
        $result = dbQuery($sql, $dbLink);
        if (! dbCheckQuery($result)) {
          return false;
        }
      } else {
        return false;
      }
      PortalQueue::send_event(PortalQueue::ACTION_UPDATE, get_class(), $userId,
        array('username' => self::get_username_from_id($userId, $dbLink))
      );

      return true;
    }

    static function incrementLockouts($userId,$dbLink=null)
    {
      if ($dbLink === null) {
        global $portalLink;
        $dbLink = $portalLink;
      }
      if ($userId > 0) {
        $sql = sprintf("UPDATE user set lockouts = lockouts + 1 WHERE userId = %d",
                        dbEscape($userId,$dbLink)
                );
        $result = dbQuery($sql, $dbLink);
        if (! dbCheckQuery($result)) {
          return false;
        }
      } else {
        return false;
      }
      PortalQueue::send_event(PortalQueue::ACTION_UPDATE, get_class(), $userId,
        array('username' => self::get_username_from_id($userId, $dbLink))
      );

      return true;
    }

    static function setUserData($user_id, $name, $value=null, $dbLink=null)
    {
        if(gettype($value) === 'resource')
        {
            $dbLink = $value;
            $value = null;
        }

        if ($dbLink === null)
        {
            global $portalLink;
            $dbLink = $portalLink;
        }

        //multiple values
        if($value === null && is_array($name))
        {
            $success = true;

            foreach ($name as $key => $value)
            {
                $success = ($success) ? user::setUserData($user_id, $key, $value) : false;
            }

            return $success;
        }

        $query = DB::insert('userData', array('userId', 'name', 'json', 'phpSerialized'))
            ->values(array(
                $user_id,
                $name,
                json_encode(array($name => $value)),
                serialize($value)
            ));

        $query .= ' ON DUPLICATE KEY UPDATE json=VALUES(json), phpSerialized=VALUES(phpSerialized)';

        return dbCheckQuery(dbQuery($query, $dbLink));
    }

    static function getUserData($user_id, $name=null, $dbLink=null)
    {
        if(gettype($name) === 'resource')
        {
            $dbLink = $name;
            $name = null;
        }

        if ($dbLink === null)
        {
            global $portalLink;
            $dbLink = $portalLink;
        }

        if($name === null)
        {
            $query = DB::select('name', 'phpSerialized', 'ts')
                ->from('userData')
                ->where('userId', '=', $user_id);

            $result = dbQuery($query, $dbLink);

            $return_val = array();

            if (dbCheckQuery($result))
            {
                while($row = dbFetchHash($result))
                {
                    $return_val[$row['name']] = unserialize($row['phpSerialized']);
                }
            }

            return $return_val;
        }

        $query = DB::select('phpSerialized')
            ->from('userData')
            ->where('userId', '=', $user_id)
            ->where('name',   '=', $name);

        $result = dbQuery($query, $dbLink);

        return dbCheckQuery($result) ? unserialize(dbFetchOne($result)) : null;
    }

    static function deleteUserData($user_id, $name, $dbLink=null)
    {
        if ($dbLink === null)
        {
            global $portalLink;
            $dbLink = $portalLink;
        }

        $query = DB::delete('userData')
            ->where('userId', '=', $user_id)
            ->where('name',    '=', $name);

        dbQuery($query, $dbLink);

        return dbAffectedRows($dbLink) === 1;
    }

    /**
     * Checks to see if there is already a record with the same username
     * as $this->getUsername(). Returns false if username is taken, true
     * otherwise. Adds error message to $errorList if username is taken.
     */
    function checkForUsernameTaken($errorList)
    {
      $sql = "SELECT userId FROM user WHERE username='{$this->getUsername()}'";
      $result = dbQuery($sql, $this->dbLink);
      $row = dbFetchHash($result);
      if (dbCheckQuery($result) && $this->userId != $row['userId']) {
        $errorList->add("Username '{$this->getUsername()}' is already in use. Please select another username.");
        return false;
      }
      return true;
    }   // end checkForUsernameTaken

    static public function check_password($password, ErrorList $error_list)
    {
        if (strlen($password) < PASSWORD_MINIMUM_LENGTH) {
            $error_list->add(self::get_password_error_messages(self::PASSWORD_ERROR_TOO_SMALL));
        }
        if (!preg_match('/' . self::PASSWORD_REGEX_PATTERN . '/', $password))
        {
            $error_list->add(self::get_password_error_messages(self::PASSWORD_ERROR_PATTERN_MATCH_FAILURE));
        }
        return $error_list->isEmpty();
    }

    // TODO: Remove me when the user list screen is edited
    static public function getUserTypeOptions()
    {
      return array(self::TYPE_SUPER_USER => "Super User",
                   self::TYPE_RESELLER => "Reseller",
                   self::TYPE_ADMIN => "Administrator",
                   self::TYPE_EMPLOYEE => "Employee",
                   self::TYPE_SALES_MANAGER => "Sales Manager",
                   self::TYPE_SALES_REP => "Sales Rep",
                   self::TYPE_ACD_AGENT => "Call Center Agent");
    }   // end getUserTypeOptions()

    static function getClassTypeOptions()
    {
      return array( self::CLASS_NOT_LOGGED_IN => "Login Screen",
                    self::CLASS_SERVICE_PROVIDER => "Service Provider",
                    self::CLASS_RESELLER => "Reseller",
                    self::CLASS_CUSTOMER  => "Customer");
    }

    static function getClassFromType($typeId)
    {
      $types = array(self::TYPE_SUPER_USER => self::CLASS_SERVICE_PROVIDER,
                     self::TYPE_RESELLER => self::CLASS_RESELLER,
                     self::TYPE_ADMIN => self::CLASS_CUSTOMER,
                     self::TYPE_EMPLOYEE => self::CLASS_CUSTOMER,
                     self::TYPE_SALES_MANAGER => self::CLASS_RESELLER,
                     self::TYPE_SALES_REP => self::CLASS_RESELLER,
                     self::TYPE_ACD_AGENT => self::CLASS_CUSTOMER);
      if(isset($types[$typeId])) {
        return $types[$typeId];
      } else {
        return self::CLASS_NOT_LOGGED_IN;
      }
    }

    // TODO: Organization way of doing this
    static function updateLNPRecipient($resellerId, $userId, $value)
    {
        global $portalLink;
        $query = sprintf("UPDATE user SET lnpRecipient=%d WHERE resellerId=%d AND userId=%d",
                         dbEscape($value, $portalLink),
                         dbEscape($resellerId, $portalLink),
                         dbEscape($userId, $portalLink));
        $result = dbQuery($query, $portalLink);
        if (dbCheckQuery($result))
        {
            return true;
        }
        return false;
    }

    /**
     * Get a UserCollection of Assigned LNP Recipients for a reseller, sorted by firstName
     * @param $resellerId
     * @return null
     */
    static function get_lnp_recipients($resellerId)
    {
        $user_collection = self::get_lnp_recipient_users($resellerId, UserCollection::LNP_ASSIGNED_RECIPIENTS);
        $user_collection->sort('getFullName');
        $recipients = $user_collection->get_collection();

        return($recipients);
    }

    /**
     * An interface that generates a UserCollection based on the type of LNP recipients list passed in.
     * @param $reseller_id
     * @param $type
     * @return UserCollection
     */
    static public function get_lnp_recipient_users($reseller_id, $type)
    {
        global $portalLink;
        $recipient_ids = array();

        switch ($type) {
            case UserCollection::LNP_ASSIGNED_RECIPIENTS:
                $recipient_ids = array_unique(self::get_assigned_lnp_recipient_ids($reseller_id));
                break;
            case UserCollection::LNP_POTENTIAL_RECIPIENTS:
                $recipient_ids = array_unique(self::get_potential_lnp_recipient_ids($reseller_id));
                break;
            case UserCollection::LNP_AVAILABLE_RECIPIENTS:
                $potential_recipients = self::get_potential_lnp_recipient_ids($reseller_id);
                $assigned_recipients = self::get_assigned_lnp_recipient_ids($reseller_id);
                $recipient_ids = array_unique(array_diff($potential_recipients, $assigned_recipients));
                break;
        }

        return new UserCollection($recipient_ids, $reseller_id, $portalLink);
    }

    /**
     * Returns an array of User IDs by selecting a Reseller's enabled Account Owners and
     * enabled users with permission to view Notifications
     * @param $reseller_id
     * @return array
     */
    static private function get_potential_lnp_recipient_ids($reseller_id)
    {
        global $portalLink;

        $case_permission = Auth::PERMISSION_SETTINGS_CASE_NOTIFICATIONS;
        $view_access = Auth::ACCESS_VIEW;
        $reseller_id = dbEscape($reseller_id, $portalLink);
        $account_owner = Model_Role::ACCOUNT_OWNER;
        $query = "
            SELECT DISTINCT u.userId
            FROM user u
            JOIN user_profile upr ON (upr.userId = u.userId)
            JOIN profile_permission pp ON (upr.profile_id = pp.profile_id)
            JOIN permission p
                ON (pp.permission_id = p.permission_id)
            WHERE u.resellerId = {$reseller_id} AND u.enabled = 1
                AND (p.object_id = {$case_permission} AND p.type_id = {$view_access})
            UNION
            SELECT u.userId
            FROM user u
            WHERE u.resellerId = {$reseller_id}
                AND u.enabled = 1
                AND u.role_id = {$account_owner} ;";

        $recipient_ids = array();
        $result = dbQuery($query, $portalLink);
        if (dbCheckQuery($result)) {
            while ($row = dbFetchHash($result)) {
                $recipient_ids[] = $row['userId'];
            }
        }

        return array_unique($recipient_ids);
    }

    /**
     * Selects and array of User IDs belonging to a Reseller's assigned LNP recipients.
     * @param $reseller_id
     * @return array
     */
    static private function get_assigned_lnp_recipient_ids($reseller_id)
    {
        global $portalLink;

        $query = sprintf("SELECT u.userId
            FROM user u
            WHERE u.resellerId = %d
                AND u.enabled = 1
                AND u.lnpRecipient=1;",
            dbEscape($reseller_id, $portalLink)
        );

        $recipient_ids = array();
        $result = dbQuery($query, $portalLink);
        if (dbCheckQuery($result))
        {
            while ($row = dbFetchHash($result))
            {
                $recipient_ids[] = $row['userId'];
            }
        }

        return $recipient_ids;
    }


    // TODO: Permissions and organizations way of doing this
    static public function resetCaseNotifications($resellerId, $dbLink)
    {
        $sql = sprintf("UPDATE user SET lnpRecipient=%d WHERE resellerId=%d AND userType IN (%d, %d)",
                       dbEscape(false, $dbLink),
                       dbEscape($resellerId, $dbLink),
                       dbEscape(self::TYPE_SUPER_USER, $dbLink),
                       dbEscape(self::TYPE_RESELLER, $dbLink));
        $result = dbQuery($sql, $dbLink);
        if (dbCheckQuery($result)) {
            return true;
        }
        return false;
    }

    public function loaded()
    {
        return $this instanceof User && $this->getUserId() > 0;
    }

    public function has_contact_type($flag)
    {
        return ($this->contact_type & $flag) == $flag;
    }

    // Getters and Setters here down
    function getUserId() {
      return $this->userId;
    }

    function setUserId($userId) {
      $this->userId = $userId;
    }

    function getUserType() {
      return $this->userType;
    }

    function setUserType($userType) {
      $this->userType = $userType;
    }

    function getCustomerId() {
      return $this->customerId;
    }

    function setCustomerId($customerId) {
      $this->customerId = $customerId;
    }

    function getResellerId() {
      return $this->resellerId;
    }

    function setResellerId($resellerId) {
      $this->resellerId = $resellerId;
    }

    function getBranchId() {
      return $this->branchId;
    }

    function setBranchId($branchId) {
      $this->branchId = $branchId;
    }

    public function getAgentId() {
      return $this->agentId;
    }

    public function setAgentId($agentId) {
      $this->agentId = $agentId;
    }

    function getUsername() {
      return $this->username;
    }

    function setUsername($username) {
      $this->username = $username;
    }

    /**
     * @return Customer|null
     */
    function getCustomer() {
        if ($this->customer == null && $this->customerId > 0) {
            $this->customer = new Customer($this->customerId);
        }
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    function setCustomer(Customer $customer) {
        $this->customer = $customer;
        $this->customerId = $this->customer->customerId;
    }

    /**
     * @param resource|null $dbLink
     * @param int           $maxLength
     *
     * @return string
     */
    public function generateDefaultAlias($dbLink = null, $maxLength = 50) {
        $defaultMaxLength = 50;

        $disallowedChars = "/[^[:alnum:]]/";
        $first = preg_replace($disallowedChars, "", $this->getFirstName());
        $last = preg_replace($disallowedChars,  "", $this->getLastName());

        $root = $first . $last;
        if (strlen($root) > $defaultMaxLength) {
            $root = substr($first, 0, 1) . $last;
        }
        $limitedRoot = substr($root, 0, $maxLength);

        list($existing, $encoded) = $this->getAliasesLike($dbLink, $limitedRoot);

        $suffix = $maxLength == $defaultMaxLength ? null : pow(10 , ($defaultMaxLength - $maxLength - 1));
        $defaultAlias = $limitedRoot . $suffix;
        while (in_array(urlencode($defaultAlias), $encoded) || in_array($defaultAlias, $existing)) {
            $suffix = empty($suffix) ? 1 : $suffix + 1;
            $defaultAlias = $limitedRoot . $suffix;
            $aliasTooLong = strlen($defaultAlias) > $defaultMaxLength;
            if ($aliasTooLong) {
                return $this->generateDefaultAlias($dbLink, ($maxLength - 1));
            }
        }

        return $defaultAlias;
    }

    /**
     * @param resource|null $dbLink
     * @param string        $limitedRoot
     *
     * @return array
     */
    public function getAliasesLike($dbLink, $limitedRoot)
    {
        $sql = sprintf(
            "SELECT `alias` from `user` WHERE `alias` LIKE '%s%%' AND resellerId = %d;",
            dbEscape($limitedRoot, $dbLink),
            $this->getResellerId()
        );
        $result = dbQuery($sql, $dbLink);
        $existing = array();
        $encoded = array();
        /** @noinspection PhpAssignmentInConditionInspection */
        while ($row = dbFetchHash($result)) {
            // has to be tested against db values for uniqueness
            $existing[] = $row['alias'];
            // The alias is for use in URLs, so we need to test its encoded form as well
            $encoded[] = urlencode($row['alias']);
        }
        return array($existing, $encoded);
    }

    /**
     * @param resource|null $dbLink
     * @throws Exception -- unexpected db errors passed from saveAlias
     */
    public function updateAliasToDefault($dbLink = null) {
        do {
            // loop to deal with race conditions of similar aliases
            $alias = $this->generateDefaultAlias($dbLink);
            $this->setAlias($alias);
        } while (! $this->saveAlias($dbLink));
    }

    /**
     * @param resource|null $dbLink
     * @return bool -- false if the alias already exists
     * @throws Exception -- any unexpected db error
     */
    private function saveAlias($dbLink = null) {
        $sql = sprintf(
            "UPDATE `user` SET `alias` = %s WHERE userId = %d;",
            $this->getAliasForDb(),
            $this->getUserId()
        );

        if (dbQuery($sql, $dbLink)) {
            return true;
        }

        $error = dbError($dbLink);
        if (strstr($error, 'Duplicate entry')) {
            return false;
        } else {
            $message = "Unable to save alias: $error";
            writeToLog($message);
            throw new Exception($message);
        }
    }

    function getAlias() {
      return $this->alias;
    }

    /**
     * @return string
     */
    function getAliasForDb() {
        $alias = $this->getAlias();
        return empty($alias)
            ? "NULL"
            : "'" . dbEscape($alias, $this->dbLink) . "'";
    }

    function setAlias($alias) {
      $this->alias = $alias;
    }

    function setServicesAccountUserId($servicesAccountUserId) {
      $this->servicesAccountUserId = $servicesAccountUserId;
    }

    function getServicesAccountUserId() {
      return $this->servicesAccountUserId;
    }

    function getPassword() {
      return $this->password;
    }

    function setPassword($password) {
      $this->password = $password;
      if ($password) {
        $this->encryptedPassword = sha1($password);
      }
    }

    public function get_encrypted_password()
    {
      return $this->encryptedPassword;
    }

    function getConfirmPassword() {
      return $this->confirmPassword;
    }

    function setConfirmPassword($confirmPassword) {
      $this->confirmPassword = $confirmPassword;
    }

    function getFirstName() {
      return $this->firstName;
    }

    function setFirstName($firstName) {
      $this->firstName = $firstName;
    }

    function getLastName() {
      return $this->lastName;
    }

    function setLastName($lastName) {
      $this->lastName = $lastName;
    }

    function getFullName() {
      return $this->firstName." ".$this->lastName;
    }

    function getEmail() {
      return $this->email;
    }

    function setEmail($email) {
      $this->email = $email;
    }

    function get_contact_type() {
      return $this->contact_type;
    }

    function set_contact_type($contact_type) {
      $this->contact_type = intval($contact_type);
    }

    function getEnabled() {
      return $this->enabled;
    }

    function setEnabled($enabled) {
      $this->enabled = $enabled;
    }

    public function getIsSalesRep() {
      return $this->isSalesRep;
    }

    public function setIsSalesRep($isSalesRep) {
      $this->isSalesRep = $isSalesRep;
    }

    public function isSuperUser() {
      return $this->userType == self::TYPE_SUPER_USER;
    }

    public function isReseller() {
      return $this->userType == self::TYPE_RESELLER;
    }

    public function isAdministrator() {
      return $this->userType == self::TYPE_ADMIN;
    }

    public function isEmployee() {
      return $this->userType == self::TYPE_EMPLOYEE;
    }

    public function isSalesManager() {
      return $this->userType == self::TYPE_SALES_MANAGER;
    }

    public function isSalesRep() {
      return $this->userType == self::TYPE_SALES_REP;
    }

    public function isAcdAgent() {
      return $this->userType == self::TYPE_ACD_AGENT;
    }

    function getFailedLogins() {
      return $this->failedLogins;
    }

    function setFailedLogins($failedLogins) {
      $this->failedLogins = $failedLogins;
    }

    function getLockedOut() {
      return $this->lockedOut;
    }

    function setLockedOut($lockedOut) {
      $this->lockedOut = $lockedOut;
    }

    function getLockouts() {
      return $this->lockouts;
    }

    function setLockouts($lockouts) {
      $this->lockouts = $lockouts;
    }

    function get_timezone() {
      return $this->timezone;
    }

    function set_timezone($timezone) {
      $this->timezone = $timezone;
    }

    function get_address_id()
    {
        return $this->address_id;
    }

    function set_address_id($address_id)
    {
        $this->address_id = $address_id;
    }

    function get_role_id()
    {
        return $this->role_id;
    }

    function set_role_id($role_id)
    {
        $this->role_id = $role_id;
    }

    function get_organization_id()
    {
        return $this->organization_id;
    }

    function set_organization_id($organization_id)
    {
        $this->organization_id = $organization_id;
    }

    function add_group_name_xref($group_name)
    {
        $group_names = $this->group_names;
        if (in_array($group_name, $group_names))
        {
            return false;
        }
        else
        {
            $this->group_names[] = $group_name;
            return true;
        }
    }

    function load_goup_names_xref()
    {
        $group_name_array = DB::select('user_group.name')->from('user_group')
                                                         ->join('user_group_xref')->on('user_group.user_group_id', '=', 'user_group_xref.user_group_id')
                                                         ->where('userId', '=', $this->userId)->execute()->as_array();
        $this->group_names = array();
        foreach ($group_name_array as $row)
        {
            $this->group_names[] = $row['name'];
        }

        return $this->group_names;
    }

    function get_loaded_group_names_xref()
    {
        return $this->group_names;
    }

    function remove_group_name_xref($group_name)
    {
        $key = array_search($group_name, $this->group_names);
        if ($key !== false)
        {
            unset($this->group_names[$key]);
            $this->group_names = array_filter($this->group_names);
            return true;
        }
        else
        {
            return false;
        }
    }

    function save_group_ids_xref($organization_id ,$user_id_of_one_who_initiated = 1)
    {
        //we save groups that already exist into the group table, or create new groups.
        $group_name_and_id_existing_rows = array();
        if (count($this->group_names)  > 0)
        {
            $group_name_and_id_existing_rows = DB::select('name', 'user_group_id')->from('user_group')
                                                               ->where('name', 'in', $this->group_names)
                                                               ->and_where('organization_id', '=', $organization_id)
                                                               ->execute()->as_array();
        }
        $existing_group_names = array();
        $existing_group_ids = array();
        foreach ($group_name_and_id_existing_rows as $group_names_row)
        {
            $existing_group_names[] = $group_names_row['name'];
            $existing_group_ids[] = $group_names_row['user_group_id'];
        }

        $upper_existing_group_names = array_map('strtoupper', $existing_group_names);
        $names_of_groups_to_create = array();
        foreach ($this->group_names as $group_name)
        {
            if (!in_array(strtoupper($group_name), $upper_existing_group_names))
            {
                $names_of_groups_to_create[] = $group_name;
            }
        }
        $groups_values_string = array();

        //Create the new ones before putting them in the xref
        foreach ($names_of_groups_to_create as $name_of_group_to_create)
        {
            $groups_values_string[] = '(\'' . $name_of_group_to_create . '\', \'\', ' . $this->get_organization_id() . ", 1, 0, CURDATE(), {$user_id_of_one_who_initiated}, CURDATE(), {$user_id_of_one_who_initiated})";
        }
        $insert_ids = array();
        if ($groups_values_string !== "")
        {
            try
            {
                foreach ($groups_values_string as $group_value_string)
                {
                    $insert_id_results = DB::query(Database::INSERT, 
                        'INSERT INTO user_group (name, description, organization_id, visibility_type, system, created_at, created_by, modified_at, modified_by) VALUES ' . $group_value_string
                    )->execute();

                    $insert_ids[] = $insert_id_results[0];
                }
            }
            catch(Exception $e)
            {
                writeToLog("Error writing Group ID xrefs: " . $e->getMessage());
                return false;
            }
        }
        //Xref.

        //Get the ones we won't insert because the association is already there.
        $xref_values_string = '';
        //Now prepare insert the rest.
        $total_group_ids_to_apply_to_user = array_merge($insert_ids, $existing_group_ids);
        foreach ($total_group_ids_to_apply_to_user as $group_id)
        {
            $xref_values_string .= '(' . $group_id . ',' . $this->getUserId() . ", CURDATE(),
                    {$user_id_of_one_who_initiated}, CURDATE(), {$user_id_of_one_who_initiated}),";
        }
        $xref_values_string = rtrim($xref_values_string, ',');

        //Actual Xfref Insertion
        try
        {
            DB::delete('user_group_xref')->where('userId', '=', $this->getUserId())->execute();
            if ($xref_values_string !== "")
            {
                DB::query(Database::INSERT, 
                    "INSERT INTO user_group_xref (user_group_id, userId, created_at, created_by, modified_at, modified_by) VALUES {$xref_values_string}"
                )->execute();
            }
        }
        catch(Exception $e)
        {
            writeToLog("Error writing Group ID xrefs: " . $e->getMessage());
            return false;
        }
        return $this->group_names;

    }

    function add_extension_id_xref($extension_id)
    {
        $extension_ids = $this->extension_ids;
        if (in_array($extension_id, $extension_ids))
        {
            return false;
        }
        else
        {
            $this->extension_ids[] = $extension_id;
            return true;
        }
    }

    function load_extension_ids_xref()
    {
        $extension_id_array = DB::select('extensionId')->from('user_extension')->where('userId', '=', $this->userId)->execute()->as_array();
        $this->extension_ids = array();
        foreach ($extension_id_array as $row)
        {
            $this->extension_ids[] = $row['extensionId'];
        }

        return $this->extension_ids;
    }

    function get_loaded_extension_ids_xref()
    {
        return $this->extension_ids;
    }

    function remove_extension_id_xref($extension_id)
    {
        $key = array_search($extension_id, $this->extension_ids);
        if ($key !== false)
        {
            unset($this->extension_ids[$key]);
            $this->extension_ids = array_filter($this->extension_ids);
            return true;
        }
        else
        {
            return false;
        }
    }

    function save_extension_ids_xref($user_id_of_one_who_initiated = 1)
    {
        //we will only save extensions that already exist into the extension table.
        $extension_id_existing_rows = array();
        if (count($this->extension_ids) > 0)
        {
            $extension_id_existing_rows = DB::select('extensionId')->from('extension')
                                                               ->where('extensionId', 'in', $this->extension_ids)
                                                               ->execute()->as_array();
        }
        $existing_extension_ids = array();
        foreach ($extension_id_existing_rows as $extension_id_row)
        {
            $existing_extension_ids[] = $extension_id_row['extensionId'];
        }
        if ((count($this->extension_ids) > count($existing_extension_ids)) && count($existing_extension_ids) > 0)
        {
            writeToLog("Validation error counting extension_ids.");
            return false;
        }
        else
        {
            $values_string = "";
            foreach ($this->extension_ids as $extension_id)
            {

                $values_string .= '(' . $this->getUserId() . ',' . $extension_id . ", CURTIME(),
                        {$user_id_of_one_who_initiated}, CURTIME(), {$user_id_of_one_who_initiated}, " .
                        ($extension_id == $this->get_primary_extension_id() ? '1' : '0') . ", " .
                        ($extension_id == $this->get_softphone_extension_id() ? '1' : '0') . "),";
            }
            $values_string = rtrim($values_string, ',');

            try
            {
                DB::delete('user_extension')->where('userId', '=', $this->getUserId())->execute();
                if ($values_string !== "")
                {
                    DB::query(Database::INSERT, 
                        "INSERT INTO user_extension (userId, extensionId, created_at, created_by, modified_at, modified_by, primary_extension, softphone_extension) VALUES {$values_string}"
                    )->execute();
                }

            }
            catch(Exception $e)
            {
                writeToLog("Error writing Extension ID xrefs: " . $e->getMessage());
                writeToLog($values_string);
                return false;
            }
            return $this->extension_ids;
        }

    }


    /**
     * Remove this user's ID from all user.servicesAccountUserId
     * @return bool
     */
    private function unlinkFromEndUserParent()
    {
        $sql = sprintf("UPDATE user
                        SET servicesAccountUserId = NULL
                        WHERE servicesAccountUserId = %d",
            $this->userId);

        if (dbQuery($sql, $this->dbLink)) {
            return true;
        }

        $error = dbError($this->dbLink);
        $message = "Unable to remove from end users: $error";
        writeToLog($message);
        return false;
    }


    /**
     * Checks if primary extension has been changed since load or is being initially set.
     * @return bool
     */
    public function primaryExtensionChanged()
    {
        if (!is_object($this->original)) {
            if ($this->get_primary_extension_id() > 0) {
                return true;
            }
            return false;
        }
        $is_updated_primary = $this->original->get_primary_extension_id() != $this->get_primary_extension_id();
        if ($is_updated_primary) {
            return true;
        }
        return false;
    }

    function add_profile_id_xref($profile_id)
    {
        $profile_ids = $this->profile_ids;
        if (in_array($profile_id, $profile_ids))
        {
            return false;
        }
        else
        {
            $this->profile_ids[] = $profile_id;
            return true;
        }
    }

    function load_profile_ids_xref()
    {
        $profile_id_array = DB::select('profileId')->from('user_profile')->where('userId', '=', $this->userId)->execute()->as_array();
        $this->profile_ids = array();
        foreach ($profile_id_array as $row)
        {
            $this->profile_ids[] = $row['profileId'];
        }

        return $this->profile_ids;
    }

    function get_loaded_profile_ids_xref()
    {
        return $this->profile_ids;
    }

    function remove_profile_id_xref($profile_id)
    {
        $key = array_search($profile_id, $this->profile_ids);
        if ($key !== false)
        {
            unset($this->profile_ids[$key]);
            $this->profile_ids = array_filter($this->profile_ids);
            return true;
        }
        else
        {
            return false;
        }
    }

    function save_profile_ids_xref($user_id_of_one_who_initiated = 1)
    {
        //we will only save profiles that already exist into the profile table.
        $profile_id_existing_rows = array();
        if (count($this->profile_ids))
        {
            $profile_id_existing_rows = DB::select('profile_id')->from('profile')
                                                               ->where('profile_id', 'in', $this->profile_ids)
                                                               ->execute()->as_array();
        }
        $existing_profile_ids = array();
        foreach ($profile_id_existing_rows as $profile_id_row)
        {
            $existing_profile_ids[] = $profile_id_row['profile_id'];
        }
        if (count($this->profile_ids) > count($existing_profile_ids))
        {
            writeToLog($this->getUserId() . "Error validating profile ID count.");
            return false;
        }
        else
        {
            //Let's get a list of those profile IDs that are already associated with this user, if any.
            $values_string = "";
            //Now lets insert the profile IDs that are associated with this user, per the importer, that are not already there...
            foreach ($this->profile_ids as $profile_id)
            {
                    $values_string .= '(' . $profile_id . ',' . $this->getUserId() . ", CURTIME(),
                            {$user_id_of_one_who_initiated}, CURTIME(), {$user_id_of_one_who_initiated}),";
            }
            $values_string = rtrim($values_string, ',');

            try
            {
                DB::delete('user_profile')->where('userId', '=', $this->getUserId())->execute();
                if ($values_string !== "")
                {
                    DB::query(Database::INSERT, 
                        "INSERT INTO user_profile (profile_id, userId, created_at, created_by, modified_at, modified_by) VALUES {$values_string}"
                    )->execute();
                }

            }
            catch(Exception $e)
            {
                writeToLog("Error writing Profile ID xrefs: " . $e->getMessage());
                return false;
            }
            writeToLog("Profile IDs returned.");
            return $this->profile_ids;
        }

    }

    function add_api_application_id_xref($api_application_id)
    {
        $api_application_ids = $this->api_application_ids;
        if (in_array($api_application_id, $api_application_ids))
        {
            return false;
        }
        else
        {
            $this->api_application_ids[] = $api_application_id;
            return true;
        }
    }

    function load_api_application_ids_xref()
    {
        $api_application_id_array = DB::select('apiApplicationId')->from('apiApplicationUser')->where('userId', '=', $this->userId)->execute()->as_array();
        $this->api_application_ids = array();
        foreach ($api_application_id_array as $row)
        {
            $this->api_application_ids[] = $row['apiApplicationId'];
        }

        return $this->api_application_ids;
    }

    function get_loaded_api_application_ids_xref()
    {
        return $this->api_application_ids;
    }

    function remove_api_application_id_xref($api_application_id)
    {
        $key = array_search($api_application_id, $this->api_application_ids);
        if ($key !== false)
        {
            unset($this->api_application_ids[$key]);
            $this->api_application_ids = array_filter($this->api_application_ids);
            return true;
        }
        else
        {
            return false;
        }
    }

    function save_api_application_ids_xref()
    {
        //we will only save api_applications that already exist into the api_application table.
        $api_application_id_existing_rows = array();
        if (count($this->api_application_ids) > 0)
        {
            $api_application_id_existing_rows = DB::select('id')->from('apiApplication')
                                                               ->where('id', 'in', $this->api_application_ids)
                                                               ->execute()->as_array();
        }
        $user_organization_id = $this->get_organization_id();
        $organization = ORM::factory('organization', $user_organization_id);
        $available_customer_api_applications = ApiApplication::get_permissions_by_customer($organization->customerId);
        $existing_api_application_ids = array();
        foreach ($api_application_id_existing_rows as $api_application_id_row)
        {
            $existing_api_application_ids[] = $api_application_id_row['id'];
        }
        if (count($this->api_application_ids) > count($existing_api_application_ids))
        {
            return false;
        }
        else
        {
            try
            {
                DB::delete('apiApplicationUser')->where('userId', '=', $this->getUserId())->execute();
                $application_permissions = array();
                foreach ($available_customer_api_applications as $api_application_id => $api_application_data)
                {
                    if ($api_application_data['status'] == ApiApplication::STATUS_ENABLED)
                    {
                        if (in_array($api_application_id, $this->api_application_ids))
                        {
                            $application_permissions[$api_application_id] = array('status' => ApiApplication::STATUS_ENABLED);
                        }
                        else
                        {
                            $application_permissions[$api_application_id] = array('status' => ApiApplication::STATUS_DISABLED);
                        }
                    }
                }

                ApiApplication::update_permissions_for_user($this->getUserId(), $application_permissions);
            }
            catch(Exception $e)
            {
                writeToLog("Error writing API App ID xrefs: " . $e->getMessage());
                return false;
            }
            return $this->api_application_ids;
        }

    }

    /**
     * @param string $seatId
     */
    function setSeatId($seatId)
    {
        $this->seatId = $seatId;
    }

    /**
     * @return string|null
     */
    function getSeatId()
    {
        return $this->seatId;
    }

    function set_primary_extension_id($id)
    {
        $this->primary_extension_id = $id;
    }

    function get_primary_extension_id()
    {
        return $this->primary_extension_id;
    }

    function set_softphone_extension_id($id)
    {
        $this->softphone_extension_id = $id;
    }

    function get_softphone_extension_id()
    {
        return $this->softphone_extension_id;
    }

    function get_xref_address()
    {
        return $this->xref_address;
    }

    /**
     * This function is NOT to be used by anything except for tracking of current and new values of the
     * association between users and agents for User Import. This is not used to get the actual association.
     */
    public function get_call_center_agent_id()
    {
        return $this->importing_call_center_agent_id;
    }

    /**
     * This function is NOT to be used by anything except for setting of current and new values of the
     * association between users and agents for User Import. This is not used to store the actual association.
     */
    public function set_call_center_agent_id($call_center_agent_id)
    {
        $this->importing_call_center_agent_id = $call_center_agent_id;
    }

    static function get_password_error_messages($message_key = null) {
        $error_messages = array(
            self::PASSWORD_ERROR_NO_PASSWORD => 'You must enter a password.',
            self::PASSWORD_ERROR_NO_CONFIRM_PASSWORD => 'You must enter a confirm password.',
            self::PASSWORD_ERROR_TOO_SMALL => 'Passwords must be at least ' . PASSWORD_MINIMUM_LENGTH . ' characters long.',
            self::PASSWORD_ERROR_PATTERN_MATCH_FAILURE => 'Passwords must contain at least one uppercase character, lowercase character and number.',
            self::PASSWORD_ERROR_MATCHES_USERNAME => 'Your password cannot be the same as your username.',
            self::PASSWORD_ERROR_PASSWORDS_DONT_MATCH => 'Passwords do not match. Please re-enter your password.',
        );
        if (!is_null($message_key))
        {
            return $error_messages[$message_key];
        }
        else
        {
            return $error_messages;
        }
    }

    public function get_loaded_external_identifier_xref()
    {
        return $this->external_identifier_for_import_value;
    }

    public function set_external_identifier_xref($external_identifier_value)
    {
        $this->external_identifier_for_import_value = $external_identifier_value;
        return true;
    }

    public function load_external_identifier_xref()
    {
        $external_id = \DAO\UserExternalIdentifier::getByUserId($this->getUserId());
        if (isset($external_id['userExternalIdentifierValue']))
        {
            $this->external_identifier_for_import_value = $external_id['userExternalIdentifierValue'];
        }
    }

    public function save_external_identifier_xref()
    {
        \DAO\UserExternalIdentifier::save($this->getUserId(), $this->external_identifier_for_import_value);
    }


    /**
     * @param ErrorList $error_list
     * @param array     $options
     *
     * @return bool
     */
    public function validateSeatsInUse(ErrorList $error_list, $options = array())
    {
        // Not using getOption so we only call getSeatsInUse when we have to.
        // This might be a good place to use a lambda in the future.
        $seats_in_use = isset($options["seats_in_use"])
            ? $options["seats_in_use"]
            : User::getSeatsInUse($this->organization_id);

        $valid = true;

        if (! $this->isAccountOwner()) {
            if ($this->getSeatId() == "") {
                $error_list->add("Seat is Required");
                $valid = false;
            }
        }

        if (isset($seats_in_use[$this->getSeatId()])) {
            if ($this->seatInUseByOther($seats_in_use[$this->getSeatId()])) {
                $error_list->add("Seat is in use by another user.");
                $valid = false;
            }
        }

        return $valid;
    }


    /**
     * @param ErrorList $error_list
     * @param array     $options
     *
     * @return mixed
     */
    public function validateExtensionsInUse(ErrorList $error_list, $options = array())
    {
        $extension_types = array("primary", "softphone");

        $extension_text = array(
            "primary" => "Primary",
            "softphone" => "ComClient",
        );

        $user_extensions = array(
            "primary"   => $this->get_primary_extension_id(),
            "softphone" => $this->get_softphone_extension_id(),
        );

        $extensions_in_use = Common::getOption($options, "extensions_in_use", array());
        if (! $extensions_in_use) {
            $extensions = array();
            foreach ($extension_types as $extension_type) {
                if ($user_extensions[$extension_type] > 0) {
                    $extensions[] = $user_extensions[$extension_type];
                }
            }
            $extensions_in_use = Model_UserExtension::getExtensionsInUse(
                $this->branchId,
                array("extensions" => $extensions)
            );
        }
        if ($this->requiresPrimaryExtension()) {
            if ($this->get_primary_extension_id() < 1
                || $this->get_primary_extension_id() instanceof \UserBlankInput
            ) {
                $error_list->add("Primary Extension is Required");
            }
        }

        foreach ($extension_types as $user_extension_type) {

            // Force coercion to string because of UserBlankInput object
            $user_extension_id = (string) $user_extensions[$user_extension_type];

            if ($user_extension_id > 0) {

                foreach ($extension_types as $in_use_extension_type) {

                    if (isset($extensions_in_use[$in_use_extension_type][$user_extension_id])) {

                        $extension_users = $extensions_in_use[$in_use_extension_type][$user_extension_id];

                        if ($this->extensionInUseByOther($extension_users)) {

                            $user_text   = $extension_text[$user_extension_type];
                            $in_use_text = $extension_text[$in_use_extension_type];
                            $user_list = implode(", ", $extension_users);

                            $error_list->add(
                                "{$user_text} extension in use as {$in_use_text}"
                                . " extension of user ({$user_list})"
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * Validates that the service user (L4) is not assigned to another user
     * and it belongs to the same customer as this user's reseller's customer
     *
     * @param ErrorList $errorList
     * @param array $options
     * @return bool
     */
    private function validateServicesAccountUser(ErrorList $errorList, $options = array())
    {
        if (is_object($this->servicesAccountUserId)
            && get_class($this->servicesAccountUserId) == "UserBlankInput"
            && trim($this->servicesAccountUserId) != "") {

            $errorList->add("Username is unassignable. Please choose another.");
            return false;
        }

        $serviceUsers = Common::getOption($options, "service_users_in_use", array());

        $reseller = new Reseller($this->resellerId);
        if ($this->servicesCustomer == null) {
            $this->servicesCustomer = new Customer($reseller->getCustomerId(), $this->dbLink);
        }

        if (count($serviceUsers) == 0) {
            if ($this->servicesCustomer != null) {
                $userList = User::getServicesAccountUsers($this->servicesCustomer->get_organization_id());
                foreach ($userList as $user) {
                    $serviceUsers[$user["userId"]] = $user["inUseBy"];
                }
            }
        }

        if ($servicesUserId > 0) {

            $userId = $this->userId;

            $spUsers = $serviceUsers[$servicesUserId];
            $spCount = count($spUsers);
            if ( 0 == $spCount || (( 1 == $spCount) && isSet($spUsers[$userId]))) {
                // all is fine
            } else {
                $errorList->add("User already assigned. Please choose another user to associate with this account.");
                return false;
            }
        }

        return true;
    }


    /**
     * @param array $seat_users
     * @return bool
     */
    private function seatInUseByOther($seat_users)
    {
        return (
            count($seat_users) > 1)
            || (count($seat_users) == 1 && ! isset($seat_users[$this->userId]));
    }

    /**
     * @param array $extension_users
     * @return bool
     */
    private function extensionInUseByOther($extension_users)
    {
        return (
            count($extension_users) > 1)
            || (count($extension_users) == 1 && ! isset($extension_users[$this->userId]));
    }


    /**
     * @param $organizationId
     * @return array
     */
    static public function getSeatsInUse($organizationId)
    {
        global $portalLink;
        $seatsInUse = array();
        $sql = sprintf("SELECT bs.id, bs.userId, bs.firstName, bs.lastName
                        FROM broadworks_seat bs
                        WHERE bs.customerOrgId = %d AND bs.userId IS NOT NULL",
            dbEscape($organizationId, $portalLink));
        $result = dbQuery($sql, $portalLink);
        if (dbCheckQuery($result)) {
            /** @noinspection PhpAssignmentInConditionInspection */
            while($row = dbFetchHash($result)) {
                $seatsInUse[$row["id"]][$row["userId"]] = "{$row['firstName']} {$row['lastName']}";
            }
        }
        return $seatsInUse;
    }

    public static function getInUseUser($row)
    {
        return array(
                    "userId" => $row["serviceUserId"],
                    "firstName" => $row["serviceFirstName"],
                    "lastName" => $row["serviceLastName"],
                    "username" => $row["serviceUsername"],
                     ) ;
    }

    /**
     * Get a list of all users that are assignable for a particular organization L2 -> L4
     *
     * @param $organizationId
     * @var USER $user
     * @return array
     */
    public static function getServicesAccountUsers($customerOrganizationId)
    {
        global $portalLink;
        $serviceUsers = array();

        //filter out users that are assigned and are NOT assigned to the current user
        $sql = sprintf("SELECT cu.userId, cu.firstName, cu.lastName, cu.username,
                               spu.userId as serviceUserId,
                               spu.firstName as serviceFirstName,
                               spu.lastName as serviceLastNamne,
                               spu.username as serviceUsername
                        FROM user cu
                            LEFT JOIN user spu ON (spu.servicesAccountUserId = cu.userId and spu.enabled = 1)
                        WHERE cu.enabled = 1 AND cu.organization_id = %d",
                       dbEscape($customerOrganizationId, $portalLink));
        $result = dbQuery($sql, $portalLink);
        if (dbCheckQuery($result)) {
            while ($row = dbFetchHash($result)) {
                $userId = $row["userId"];
                $spUserId = $row["serviceUserId"];
                if (isset($serviceUsers[$userId])) {
                    if ($spUserId > 0) {
                        $serviceUsers[$userId]["inUseBy"][$spUserId] = User::getInUseUser($row);
                    }
                } else {
                    $serviceUsers[$userId] =
                        array(
                            "userId" => $userId,
                            "firstName" => $row["firstName"],
                            "lastName" => $row["lastName"],
                            "username" => $row["username"],
                            "inUseBy" => array()
                            );
                        if ($spUserId > 0) {
                            $serviceUsers[$userId]["inUseBy"][$spUserId] = User::getInUseUser($row);
                        }
                }
            }
        }
        return $serviceUsers;
    }

    private function updateAssociatedSeat()
    {
        $pbx = new ServicePBXService();

        if ($this->original->seatId){
            $pbx->releaseSeat($this->original->seatId);
        }

        if ($this->enabled && $this->seatId) {
            $pbx->assignSeat($this->seatId, $this->userId);
        }
    }


    function pancake()
    {
        $pancake = get_object_vars($this);
        if ($this->encryptedPassword != '')
        {
            $pancake['password_placeholder'] = '********';
        }
        $contact_types = Model_User::get_contact_types();
        foreach ($contact_types as $key => $contact_type)
        {
            $pancake['has_contact_type'][$key] = $this->has_contact_type($key);
        }
        // Yes, dumb name, but we have lockedOut too which may be different?
        $pancake['lockouts_locked_out'] = (($this->getLockouts() != 0) && ($this->getLockouts() % LOCKOUTSALLOWED) == 0);
        unset($pancake["dbLink"]);
        return $pancake;
    }


    /**
     * @return bool
     */
    public function isAccountOwner()
    {
        return Model_Role::ACCOUNT_OWNER == $this->get_role_id();
    }


    /**
     * @return bool
     */
    public function isExistingUser()
    {
        return $this->userId > 0;
    }


    /**
     * @return bool
     */
    public function isNewUser()
    {
        return $this->userId < 1;
    }


    /**
     * @return bool
     */
    public function hadPrimaryExtension()
    {
        return $this->original->primary_extension_id > 0;
    }


    /**
     * @return bool
     */
    public function requiresPrimaryExtension()
    {
        if (!$this->enabled) {
            return false;
        }
        if ($this->isAccountOwner()) {
            return false;
        }
        if ($this->isExistingUser() && !$this->hadPrimaryExtension()) {
            return false;
        }
        if (! $this->getCustomer() || ! $this->getCustomer()->isAsterisk()) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isUCReady()
    {
        $services_user = $this;
        if ($this->getServicesAccountUserId()) {
            $services_user = new User($this->getServicesAccountUserId());
        }

        if (!$services_user->getEnabled()) {
            return false;
        }

        $primary_extension = $services_user->get_primary_extension_id();
        $broadworks_seat = $services_user->getSeatId();
        if (!$broadworks_seat && !$primary_extension) {
            return false;
        }

        if ($broadworks_seat) {
            $service_integrations = new ServiceBroadworksService();
            $api_response = $service_integrations->getDeviceProfile(
                                $services_user->getUserId(),
                                ServiceBroadworksService::UC_DEVICE_PROFILE_TYPE
                            );
            if ($api_response->isSuccess()) {
                $response_data = $api_response->getData();
                if (empty($response_data)) {
                    return false;
                }
            } else {
                return false;
            }
        }

        $featureToggleService = FeatureToggleService::instance();
        $featureName = "Unified Communications Client";
        $context = new SessionContext();
        $context->setOrganizationId($services_user->get_organization_id());
        if (!$featureToggleService->isFeatureActive($featureName, $context)) {
            return false;
        }

        if ($primary_extension) {
            $branch = new Branch($services_user->getBranchId());
            $codegen_id = $branch->get_codegen_id();
            $is_asterisk_18 = ($codegen_id == Codegen::CODEGEN_ASTERISK_1_8)
                || ($codegen_id == Codegen::CODEGEN_ASTERISK_1_8_SLOW_ROLL);
            if (!$is_asterisk_18) {
                return false;
            }

            $extensionSipUser = new ExtensionSipUser($primary_extension, SipUser::TYPE_UC);
            if (!$extensionSipUser->getSipUsername()) {
                return false;
            }
        }

        return true;
    }
}   // end class User
