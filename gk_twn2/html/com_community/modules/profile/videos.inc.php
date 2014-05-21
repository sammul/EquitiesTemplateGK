<?php
//$cpath='cache/community/'.$profile->id;
//$cfile=$cpath.'/videos.html';
//$generateCache=0;
//if(!file_exists($cpath))mkdir($cpath, 0777, true);
//if(!file_exists($cfile))$generateCache=1;
//else if(time()-filemtime($cfile)>=43200){$generateCache=1;unlink($cfile);}
//else{echo file_get_contents($cfile);return;}
//ob_start();

function _getVideosHTML($videos,$pagination=NULL){
	$mainframe=JFactory::getApplication();
	$jinput=$mainframe->input;
	$videoEntries=array();
	if($videos){
		foreach($videos as $videoEntry){
			$video=JTable::getInstance('Video','CTable');
			$video->bind($videoEntry);
			$videoEntries[]=$video;
		}
	}
	$my=CFactory::getUser();
	$user=CFactory::getUser(JRequest::getInt('userid',$my->id));
	$featured=new CFeatured(FEATURED_VIDEOS);
	$featuredVideos=$featured->getItemIds();
	$featuredList=array();
	foreach($featuredVideos as $videoId) {
		$featuredList[]=$videoId;
	}
	$allowManageVideos=true;
	$groupVideo=false;
	$groupId=$jinput->get->get('groupid','','INT');
	$task=$jinput->get->get('task', '', 'WORD');
	$redirectUrl = CRoute::getURI(false);
	if(!empty($groupId)){
		$allowManageVideos=CGroupHelper::allowManageVideo($groupId);
		$groupVideo=true;
	}
	$config = CFactory::getConfig();
	$tmpl = new CTemplate();
	return $tmpl->set('sort', $jinput->get('sort', 'latest', 'STRING'))
		->set('currentTask', JRequest::getCmd('task', ''))
		->set('videos', $videoEntries)
		->set('videoThumbWidth', CVideoLibrary::thumbSize('width'))
		->set('videoThumbHeight', CVideoLibrary::thumbSize('height'))
		->set('redirectUrl', $redirectUrl)
		->set('my', $my)
		->set('user', $user)
		->set('featuredList', $featuredList)
		->set('isCommunityAdmin', COwnerHelper::isCommunityAdmin())
		->set('allowManageVideos', $allowManageVideos)
		->set('groupVideo', $groupVideo)
		->set('pagination', $pagination)
		->set('showFeatured', $config->get('show_featured'))
		->set('arevalo', "toto")
		->fetch('videos.list');
}

$my=CFactory::getUser();
$userid=JRequest::getInt('userid','');
$user=CFactory::getUser($userid);
$mainframe=JFactory::getApplication();
$jinput=$mainframe->input;
$blocked=$user->isBlocked();
if($blocked&&!COwnerHelper::isCommunityAdmin()) {
	$tmpl=new CTemplate();
	echo $tmpl->fetch('profile.blocked');
	return;
}
$model=CFactory::getModel('videos');
$filters=array(
	'creator'=>$user->id,
	'status'=>'ready',
	'groupid'=>0,
	'sorting'=>$jinput->get('sort', 'latest', 'STRING')
);
$videos=$model->getVideos($filters);
$sortItems=array(
	'latest'=>JText::_('COM_COMMUNITY_VIDEOS_SORT_LATEST'),
	'mostwalls'=>JText::_('COM_COMMUNITY_VIDEOS_SORT_MOST_WALL_POST'),
	'mostviews'=>JText::_('COM_COMMUNITY_VIDEOS_SORT_POPULAR'),
	'title'=>JText::_('COM_COMMUNITY_VIDEOS_SORT_TITLE')
);
$pagination=$model->getPagination();
$videosHTML=_getVideosHTML($videos);
$tmpl=new CTemplate();
$tmpl->set('user',$user);
$tmpl->set('sort',$jinput->get('sort','latest','STRING'));
$tmpl->set('currentTask',JRequest::getCmd('task', ''));
$tmpl->set('videosHTML',$videosHTML);
$tmpl->set('sortings','');
$tmpl->set('pagination',$pagination);
echo $tmpl->fetch('videos.myvideos');

//file_put_contents($cfile,preg_replace('(\r|\n|\t|<\!--.*-->)','',ob_get_contents()));
//ob_end_clean();
//echo file_get_contents($cfile);