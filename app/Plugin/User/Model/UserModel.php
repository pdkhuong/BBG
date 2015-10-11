<?php
App::uses('UtilLib', 'Lib');
App::uses('AppModel', 'Model');
App::uses('PasswordHash', 'Lib');
App::uses('UserRoleAccess', 'User.Model');
App::uses('UserLoginHistory', 'User.Model');
App::uses('SFEmail', 'EmailTemplate.Model');

class UserModel extends AppModel {

  var $useTable = 'wp_users';
  var $multiLanguage = null;
  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array(
    'user_login' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
        'allowEmpty' => false,
      ),
      'unique_user_login' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'user_login',
          ),
        ),
        'message' => 'Username already exists',
      ),
    ),
    'user_email' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 100,
        ),
        'message' => 'Please enter a text no larger than 100 characters long',
        'allowEmpty' => false,
      ),
      'user_email' => array(
        'rule' => array(
          0 => 'email',
        ),
        'message' => 'Please enter a valid email address',
      ),
      'unique_user_email' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'user_email',
          ),
        ),
        'message' => 'Email already exists',
      ),
    ),
    'firstname' =>array(
      'size' => array(
          'rule' => array(
            0 => 'maxLength',
            1 => 100,
          ),
          'message' => 'Please enter a text no larger than 100 characters long',
          'allowEmpty' => false,
      ),
    ),
    'lastname' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 100,
        ),
        'message' => 'Please enter a text no larger than 100 characters long',
        'allowEmpty' => false,
      ),
    ),
    'password' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
        'allowEmpty' => false,
      ),
      'notNull' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'Password field cannot be left blank',
      ),
      'minLength' => array(
        'rule'    => array('minLength', 6),
        'message' => 'Minimum 6 characters long'
      ),
    ),
    'password_confirmation' => array(
      'notNull' => array(
        'rule'     => 'notEmpty',
        'required' => true,
        'message'  => 'Password Confirmation field cannot be left blank',
      ),
      'match_password' => array(
        'rule'    => array('isMatchedValidate', 'password'),
        'message' => 'Password does not match the confirmation password',
      ),
    ),

  );

  public function verifyLogin($email, $password) {
    $message = '';
    $loggedUser = new stdClass();
    $user = $this->findByEmail($email);
    if (empty($user) || empty($user['UserModel']) || empty($user['UserAccount']) || $user['UserAccount']['password'] != sha1($password)) {
      $message =  __('The email or password you entered is incorrect');
      if(isset($user['UserAccount']) && $user['UserAccount']['id'] > 0) {
        $user['UserAccount']['number_attempt'] += 1;
        $account = new UserAccount();
        $account->save($user['UserAccount'], array('validate' => false, 'callbacks' => false));
      }
    } elseif ($user['UserModel']['status'] == USER_DISABLE) {
      $message = __('Your account has been disabled');
    } elseif ($user['UserModel']['status'] == USER_INACTIVE) {
      $message = __('Your account was not activated. Please check your email then active the account to continue');
    } else {
      $account = new UserAccount();
      $user['UserAccount']['number_attempt'] = 0;
      $user['UserAccount']['last_login'] = date('Y-m-d H:i:s');
      $account->save($user['UserAccount'], array('validate' => false, 'callbacks' => false));

      $history = new UserLoginHistory();
      $history->save(array('user_id' => $user['UserModel']['id'], 'ip' => $_SERVER['REMOTE_ADDR']), array('validate' => false));

      unset($user['UserAccount']['password']);
      $loggedUser->Admin = new stdClass();
      $loggedUser->Admin->id = 0;
      $loggedUser->User = arrayToObject($user['UserModel']);

      $roles = new UserRoleAccess();
      $loggedUser->Role = Hash::combine($roles->findByUserId($user['UserAccount']['user_id']), 'UserRoleAccess.role_id', 'UserRoleAccess.role_id');
    }

    return array(
      'status' => empty($message) ? true : false,
      'message' => $message,
      'user' => $loggedUser
    );
  }

  public function addRegisteredRole($id) {
    $userRoleAccess = new UserRoleAccess();
    $userAccess = $userRoleAccess->find('first', array('conditions' => array('UserRoleAccess.role_id' => USER_ROLE_REGISTER_DEFAUT, 'UserRoleAccess.user_id' => $id)));

    if(empty($userAccess)) {
      $userRoleAccess->save(array('role_id' => USER_ROLE_REGISTER_DEFAUT, 'user_id' => $id));
    }
  }

  public function onlyOneRole($id, $roleId) {
    $this->query('UPDATE user_role_access SET deleted_time = "'.date('Y-m-d H:i:s').'" WHERE user_id = "'.$id.'"');
    $this->query('UPDATE user_role_access SET deleted_time = NULL WHERE user_id = "'.$id. '" AND role_id = "'.$roleId.'"');

    $userRoleAccess = new UserRoleAccess();
    $userAccess = $userRoleAccess->find('first', array('conditions' => array('UserRoleAccess.role_id' => $roleId, 'UserRoleAccess.user_id' => $id)));

    if(empty($userAccess)) {
      $userRoleAccess->save(array('role_id' => $roleId, 'user_id' => $id));
    }
  }

  public function updateProfile($data) {
    if(!empty($data['UserAccount']['password'])) {
      $data['UserAccount']['password'] = sha1($data['UserAccount']['password']);
      $data['UserAccount']['password_confirmation'] = sha1($data['UserAccount']['password_confirmation']);
    } else {
      unset($data['UserAccount']['password']);
    }

    #unset($data['UserModel']['email']);

    $account = new UserAccount();
    $dataAccount = $account->findByUserId($data['UserModel']['id']);
    $data['UserAccount']['id'] = $dataAccount['UserAccount']['id'];

    if($this->saveAll($data, array('validate' => true, 'callbacks' => false))) {
      return true;
    }

    return false;
  }

  public function register($data){
    $wp_hasher = new PasswordHash(8, true);
    $inputPassword = trim($data['UserModel']['password']);
    if(!empty($inputPassword)) {
      $data['UserModel']['user_pass'] = $wp_hasher->HashPassword($inputPassword);
    }
    $data['UserModel']['display_name'] = $data['UserModel']['firstname'].' '.$data['UserModel']['lastname'];
    $data['UserModel']['user_registered'] = date('Y-m-d H:i:s', time());
    if (USER_AUTO_ACTIVE == 1) {
      $data['UserModel']['user_status'] = USER_ACTIVE;
    }
    else {
      $data['UserModel']['user_status'] = USER_INACTIVE;
      $data['UserModel']['user_activation_key'] = UtilLib::generateToken();
    }
    if (!$this->save($data)) {
      return false;
    }

    if (USER_AUTO_ACTIVE == 0) {
      App::uses('CakeEmail', 'Network/Email');

      $Email = new CakeEmail('noreply');
      $noreplyConf = $Email->config();

      $Email->emailFormat('html');
      $Email->template('User.activate_account');

      $Email->viewVars(array(
                         'token' => $data['UserModel']['user_activation_key'],
                         'name' => $data['UserModel']['display_name']
                       ));

      $Email->from($noreplyConf['from']);
      $Email->to($data['UserModel']['user_email']);
      $Email->subject(__('Please activate your account'));
      $Email->send();
    }

    $this->addRegisteredRole($this->getId());
    return true;
  }
  public function activeAccount($user_account_record){
    $this->save(array(
      'id' => $user_account_record['UserModel']['id'],
      'status' => USER_ACTIVE
    ), array('validate' => FALSE));

    $this->UserAccount->save(array(
      'id' => $user_account_record['UserAccount']['id'],
      'active_token' => NULL,
    ), array('validate' => FALSE));

    $result = array();

    //send welcome email
    if (USER_AUTO_SEND_WELCOME_EMAIL == 1){
      $sf_email = new SFEmail();
      $result = $sf_email->sendEmail('user_registration_welcome', $user_account_record['UserModel']['email'], $user_account_record['UserModel']['name'], array(
        'values' => array(
          '[:account_name]' => $user_account_record['UserModel']['name'],
          '[:login_url]' => Router::url('/user/account/login', TRUE),
        )
      ));
    }

    return $result;
  }

  public function requestChangePassword($user_model_record){
    //reset token and send email
    $new_token = UtilLib::generateToken();
    $this->UserAccount->save(array(
      'id' => $user_model_record['UserAccount'][0]['id'],
      'reset_token_password' => $new_token,
      'reset_token_time' => UtilLib::getCurrentDateTime(),
    ), array('validate' => FALSE));

    $sf_email = new SFEmail();
    $result = $sf_email->sendEmail('user_forgot_password', $user_model_record['UserModel']['email'], $user_model_record['UserModel']['name'], array(
      'values' => array(
        '[:account_name]' => $user_model_record['UserModel']['name'],
        '[:reset_url]' => Router::url('/user/account/resetPassword', TRUE) . '?token=' . $new_token,
      )
    ));

    return $result;
  }
}
