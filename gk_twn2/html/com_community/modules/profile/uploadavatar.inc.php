<?php
$my = CFactory::getUser();
$firstLogin = false;

$config = CFactory::getConfig();
$uploadLimit = (double) $config->get('maxuploadsize');
$uploadLimit .= 'MB';

$tmpl = new CTemplate();
$skipLink = CRoute::_('index.php?option=com_community&view=frontpage&doSkipAvatar=Y&userid=' . $my->id);

echo $tmpl->set('user', $my)
		->set('profileType', $my->getProfileType())
		->set('uploadLimit', $uploadLimit)
		->set('firstLogin', $firstLogin)
		->set('skipLink', $skipLink)
		->fetch('profile.uploadavatar.settings');