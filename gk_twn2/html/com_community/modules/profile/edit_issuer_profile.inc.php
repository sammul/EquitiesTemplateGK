<?php

function editIssuerProfile($data) {

	$mainframe = JFactory::getApplication();

	// access check
	CFactory::setActiveProfile();

	$my = CFactory::getUser();
	$config = CFactory::getConfig();
	$userParams = $my->getParams();

	$pathway = $mainframe->getPathway();
	$pathway->addItem(JText::_($my->getDisplayName()), CRoute::_('index.php?option=com_community&view=profile&userid=' . $my->id));
	$pathway->addItem(JText::_('COM_COMMUNITY_PROFILE_EDIT'), '');

	$document = JFactory::getDocument();
	$document->setTitle(JText::_("COM_COMMUNITY_PROFILE_DASHBOARD"));

	$js = 'assets/validate-1.5.min.js';
	CAssets::attach($js, 'js');
	
//	$obj = new CommunityView;
//	$obj->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=uploadAvatar', JText::_('COM_COMMUNITY_PROFILE_AVATAR_EDIT') );
//	$obj->addSubmenuItem ( 'index.php?option=com_community&view=profile&task=notifications', JText::_('COM_COMMUNITY_PROFILE_NOTIFICATIONS') );
//	$obj->showSubmenu ();

	$jConfig = JFactory::getConfig();
	$app = CAppPlugins::getInstance();

	$appFields = $app->triggerEvent('onFormDisplay', array('jsform-profile-edit'));
	$beforeFormDisplay = CFormElement::renderElements($appFields, 'before');
	$afterFormDisplay = CFormElement::renderElements($appFields, 'after');

	$multiprofile = JTable::getInstance('MultiProfile', 'CTable');
	$multiprofile->load($my->getProfileType());

	$model = CFactory::getModel('Profile');
	$profileTypes = $model->getProfileTypes();

	// @rule: decide to show multiprofile or not.
	$showProfileType = ( $config->get('profile_multiprofile') && $profileTypes && count($profileTypes) >= 1 && !$multiprofile->profile_lock);

	$isAdmin = COwnerHelper::isCommunityAdmin();
	$profileField = $data->profile ['fields'];

	if (!is_null($profileField)) {
		foreach ($profileField as $key => $val) {
			foreach ($val as $pkey => $field) {
				if (!$isAdmin && $field['visible'] == 2) {
					unset($profileField[$key][$pkey]);
				}
			}
		}
	}

	$fbHtml = '';
	$connectModel = CFactory::getModel('Connect');
	$associated = $connectModel->isAssociated($my->id);

	if ($config->get('fbconnectkey') && $config->get('fbconnectsecret')) {

		$facebook = new CFacebook();
		$fbHtml = $facebook->getLoginHTML();
	}

	$isUseFirstLastName = CUserHelper::isUseFirstLastName();

	$data->profile ['fields'] = $profileField;
	$tmpl = new CTemplate();
	echo $tmpl->set('showProfileType', $showProfileType)
			->set('multiprofile', $multiprofile)
			->set('beforeFormDisplay', $beforeFormDisplay)
			->set('afterFormDisplay', $afterFormDisplay)
			->set('fields', $data->profile ['fields'])
			->set('user', $my)
			->set('fbHtml', $fbHtml)
			->set('fbPostStatus', $userParams->get('postFacebookStatus'))
			->set('jConfig', $jConfig)
			->set('params', $data->params)
			->set('config', $config)
			->set('associated', $associated)
			->set('isAdmin', COwnerHelper::isCommunityAdmin())
			->set('offsetList', $data->offsetList)
			->set('isUseFirstLastName', $isUseFirstLastName)
			->fetch('profile.edit');
}

CFactory::setActiveProfile();

$user = CFactory::getUser();
$mainframe = JFactory::getApplication();
$jinput = $mainframe->input;

if ($user->id == 0) {
	return $this->blockUnregister();
}
// Get/Create the model

$model = CFactory::getModel('profile');
$model->setProfile('hello me');

$data = new stdClass();
$data->profile = $model->getEditableProfile($user->id, $user->getProfileType());

if ($jinput->post->get('action', '') != '') {
	if ($this->_saveProfile()) {
		$this->save();
	} else {
		$postData = $_POST;
		foreach ($data->profile['fields'] as $key => $fields) {
			foreach ($fields as $key2 => $field) {
				if (is_array($postData['field' . $field['id']])) {
					$glue = ($field['type'] == 'birthdate') ? '-' : '';
					$postData['field' . $field['id']] = implode($glue, $postData['field' . $field['id']]);
				}
				$data->profile['fields'][$key][$key2]['value'] = $postData['field' . $field['id']];
			}
		}
	}
}

$document = JFactory::getDocument();

$lang = JFactory::getLanguage();
$lang->load(COM_USER_NAME);

// Check if user is really allowed to edit.
//$params = $mainframe->getParams();
$params = null;
// check to see if Frontend User Params have been enabled
$usersConfig = JComponentHelper::getParams('com_users');
$check = $usersConfig->get('frontend_userparams');

if ($check == '1' || $check == 1 || $check == NULL) {
	if ($user->authorise(COM_USER_NAME, 'edit')) {
		$params = $user->getParameters(true);

		//In Joomla 1.6, $params will be a JRegistry class, whereas it was JParameter in 1.5
		//render() does not exist in JRegistry. Will need to translate the JForm XML in 1.6 to those acceptable for JParameter in 1.5.
		if (get_class($params) != 'JParameter') {

			$vals = $params->toArray();
			$params = CJForm::getInstance('editDetails', JPATH_ADMINISTRATOR . '/components/com_users/models/forms/user.xml');

			//set data for the form
			foreach ($vals as $k => $v) {
				$params->setValue($k, 'params', $v);
			}
		}
	} else {
		//user can only edit front end value [ > 1.5, user can only edit timezone and language ]
		$params = $user->getParameters(true);

		if ((get_class($params) != 'JParameter' || get_class($params) != 'CParameter')) {
			$vals = $params->toArray();
			$params = CJForm::getInstance('editDetails', JPATH_ADMINISTRATOR . '/components/com_users/models/forms/user.xml');

			//set data for the form
			foreach ($vals as $k => $v) {
				//@since 2.6, accept timezone and language only
				if ($k == 'timezone' || $k == 'language') {
					$params->setValue($k, 'params', $v);
				} else {
					$stat = $params->removeField($k, 'params');
				}
			}
		}
	}
}


$my = CFactory::getUser();
$config = CFactory::getConfig();

$myParams = $my->getParams();
$myDTS = $myParams->get('daylightsavingoffset');
$cOffset = ( $myDTS != '' ) ? $myDTS : $config->get('daylightsavingoffset');

$dstOffset = array();
$counter = -4;
for ($i = 0; $i <= 8; $i++) {
	$dstOffset[] = JHTML::_('select.option', $counter, $counter);
	$counter++;
}

$offSetLists = JHTML::_('select.genericlist', $dstOffset, 'daylightsavingoffset', 'class="inputbox" size="1"', 'value', 'text', $cOffset);

$data->params = $params;
$data->offsetList = $offSetLists;

$this->_icon = 'edit';

if (!$data->profile) {
	//echo $view->get('error', JText::_('COM_COMMUNITY_USER_NOT_FOUND'));
	echo "error";
} else {
	editIssuerProfile($data);
	//echo $view->get(__FUNCTION__, $data);
}
