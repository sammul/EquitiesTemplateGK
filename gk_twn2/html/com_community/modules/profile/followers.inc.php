<?php
$mainframe = JFactory::getApplication();
$jinput = $mainframe->input;
$my = CFactory::getUser();
$id = JRequest::getInt('userid', 0);

if ($id == 0) {
	$id = $my->id;
}

$user = CFactory::getUser($id);
$friends = CFactory::getModel('followers');
$sorted = $jinput->get->get('sort', 'latest', 'STRING'); //JRequest::getVar( 'sort' , 'latest' , 'GET' );
$filter = JRequest::getWord('filter', 'followers', 'GET');
$rows = $friends->getFriends($id, $sorted, true, $filter);
$isMine = ( ($id == $my->id) && ($my->id != 0) );

$sortItems = array(
	'latest' => JText::_('COM_COMMUNITY_SORT_RECENT_FRIENDS'),
	'online' => JText::_('COM_COMMUNITY_ONLINE'),
	'name' => JText::_('COM_COMMUNITY_SORT_ALPHABETICAL')
);

$config = CFactory::getConfig();
$filterItems = array();

if ($config->get('alphabetfiltering')) {
	$filterItems = array(
		//'all' 	=> JText::_('COM_COMMUNITY_JUMP_ALL') ,
		'followers' => JText::_('COM_COMMUNITY_JUMP_ALL'),
		'abc' => JText::_('COM_COMMUNITY_JUMP_ABC'),
		'def' => JText::_('COM_COMMUNITY_JUMP_DEF'),
		'ghi' => JText::_('COM_COMMUNITY_JUMP_GHI'),
		'jkl' => JText::_('COM_COMMUNITY_JUMP_JKL'),
		'mno' => JText::_('COM_COMMUNITY_JUMP_MNO'),
		'pqr' => JText::_('COM_COMMUNITY_JUMP_PQR'),
		'stu' => JText::_('COM_COMMUNITY_JUMP_STU'),
		'vwx' => JText::_('COM_COMMUNITY_JUMP_VWX'),
		'yz' => JText::_('COM_COMMUNITY_JUMP_YZ'),
		'others' => JText::_('COM_COMMUNITY_JUMP_OTHERS')
	);
}

// Check if friend is banned
$blockModel = CFactory::getModel('block');
$resultRows = array();

// @todo: preload all friends
foreach ($rows as $row) {
	$user = CFactory::getUser($row->id);

	$obj = clone($row);
	$obj->friendsCount = $user->getFriendCount();

	//update
	$followingModel = CFactory::getModel('following');
	$obj->followersCount = $followingModel->getFollowersCount($row->id);
	//end update

	$obj->profileLink = CUrlHelper::userLink($row->id);
	$obj->isFriend = true;
	$obj->isBlocked = $blockModel->getBlockStatus($user->id, $my->id);
	$resultRows[] = $obj;
}
unset($rows);

// Should not show recently added filter to otehr people
$sortingHTML = '';

if ($isMine) {
	$sortingHTML = CFilterBar::getHTML(CRoute::getURI(), $sortItems, 'latest', $filterItems, 'all');
}

$tmpl = new CTemplate();
$html = $tmpl->set('isMine', $isMine)
		->setRef('my', $my)
		->setRef('friends', $resultRows)
		//->set('sortings', $sortingHTML)
		->set('config', CFactory::getConfig())
		->set('friendRel', "followers")
		->fetch('friends.list');

$html .= '<div class="cPagination">';
$pagination = $friends->getPagination();
$html .= $pagination->getPagesLinks("#followers");
$html .= '</div>';
echo $html;