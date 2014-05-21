<?php
/**
 * @version		$Id: itemform.php 1959 2013-04-07 19:06:19Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScriptDeclaration("
	Joomla.submitbutton = function(pressbutton){
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (\$K2.trim(\$K2('#title').val()) == '') {
			alert( '" . JText::_('K2_ITEM_MUST_HAVE_A_TITLE', true) . "' );
		}
		else if (\$K2.trim(\$K2('#catid').val()) == '0') {
			alert( '" . JText::_('K2_PLEASE_SELECT_A_CATEGORY', true) . "' );
		}
		else {
			syncExtraFieldsEditor();
			var validation = validateExtraFields();
			if(validation === true) {
				\$K2('#selectedTags option').attr('selected', 'selected');
				submitform( pressbutton );
			}
		}
	}
");
?>

<div style="width:100%; height:100%">
    <form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" target="_parent">
        <?php if ($this->mainframe->isSite()): ?>
            <div id="k2FrontendContainer">
                <div id="k2Frontend">
                    <table class="k2FrontendToolbar" cellpadding="2" cellspacing="4">
                        <tr>
                            <td id="toolbar-save" class="button">
                                <a class="toolbar" href="#" onclick="Joomla.submitbutton('saveDraft'); return false;"> <span title="<?php echo JText::_('K2_SAVE_DRAFT'); ?>" class="icon-32-save icon-save"></span> <?php echo JText::_('K2_SAVE_DRAFT'); ?> </a>
                            </td>
                            <td id="toolbar-save" class="button">
                                <a class="toolbar" href="#" onclick="Joomla.submitbutton('save');
                                            return false;"> <span title="<?php echo JText::_('K2_SAVE'); ?>" class="icon-32-save icon-save"></span> <?php echo JText::_('K2_SAVE'); ?> </a>
                            </td>                         
                            <td class="button">
                                <a class="toolbar" target="_parent" href="<?php echo JRoute::_(JURI::base().'community/profile#articles')?>"> <?php echo JText::_('K2_CLOSE'); ?> </a>
                            </td>
                        </tr>
                    </table>
                    <div id="k2FrontendEditToolbar">
                        <h2 class="header icon-48-k2">
                            <?php echo (JRequest::getInt('cid')) ? JText::_('K2_EDIT_ITEM') : JText::_('K2_ADD_ITEM'); ?>
                        </h2>
                    </div>
                    <div class="clr"></div>
                    <hr class="sep" />
                    <?php if (false and !$this->permissions->get('publish')): ?>
                        <div id="k2FrontendPermissionsNotice">
                            <p><?php echo JText::_('K2_FRONTEND_PERMISSIONS_NOTICE'); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <!--<div id="k2ToggleSidebarContainer aaa"> <a href="#" id="k2ToggleSidebar"><?php // echo JText::_('K2_TOGGLE_SIDEBAR'); ?></a> </div>-->
                <table cellspacing="0" cellpadding="0" border="0" class="adminFormK2Container table">
                    <tbody>
                        <tr>
                            <td>
                                <table class="adminFormK2">
                                    <tr>
                                        <td class="adminK2LeftCol">
                                            <label for="title"><?php echo JText::_('K2_TITLE'); ?></label>
                                        </td>
                                        <td class="adminK2RightCol">
                                            <input class="text_area k2TitleBox" type="text" name="title" id="title" maxlength="250" value="<?php echo $this->row->title; ?>" />
                                        </td>
                                    </tr>
                                    <tr style="display:none">
                                        <td class="adminK2LeftCol">
                                            <label for="alias"><?php echo JText::_('K2_TITLE_ALIAS'); ?></label>
                                        </td>
                                        <td class="adminK2RightCol">
                                            <input class="text_area k2TitleAliasBox" type="text" name="alias" id="alias" maxlength="250" value="<?php echo $this->row->alias; ?>" />
                                        </td>
                                    </tr>
                                    <tr style="display:none">
                                        <td class="adminK2LeftCol">
                                            <label><?php echo JText::_('K2_CATEGORY'); ?></label>
                                        </td>
                                        <td class="adminK2RightCol">
                                            <?php echo $this->lists['categories']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="adminK2LeftCol">
                                            <label><?php echo JText::_('K2_TAGS'); ?></label>
                                        </td>
                                        <td class="adminK2RightCol">
                                            <?php if ($this->params->get('taggingSystem')): ?>
                                                <!-- Free tagging -->
                                                <ul class="tags">
                                                    <?php if (isset($this->row->tags) && count($this->row->tags)): ?>
                                                        <?php foreach ($this->row->tags as $tag): ?>
                                                            <li class="tagAdded">
                                                                <?php echo $tag->name; ?>
                                                                <span title="<?php echo JText::_('K2_CLICK_TO_REMOVE_TAG'); ?>" class="tagRemove">x</span>
                                                                <input type="hidden" name="tags[]" value="<?php echo $tag->name; ?>" />
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <li class="tagAdd">
                                                        <input type="text" id="search-field" />
                                                    </li>
                                                    <li class="clr"></li>
                                                </ul>
                                                <span class="k2Note"> <?php echo JText::_('K2_WRITE_A_TAG_AND_PRESS_RETURN_OR_COMMA_TO_ADD_IT'); ?> </span>
                                            <?php else: ?>
                                                <!-- Selection based tagging -->
                                                <?php if (!$this->params->get('lockTags') || $this->user->gid > 23): ?>
                                                    <div style="float:left;">
                                                        <input type="text" name="tag" id="tag" />
                                                        <input type="button" id="newTagButton" value="<?php echo JText::_('K2_ADD'); ?>" />
                                                    </div>
                                                    <div id="tagsLog"></div>
                                                    <div class="clr"></div>
                                                    <span class="k2Note"> <?php echo JText::_('K2_WRITE_A_TAG_AND_PRESS_ADD_TO_INSERT_IT_TO_THE_AVAILABLE_TAGS_LISTNEW_TAGS_ARE_APPENDED_AT_THE_BOTTOM_OF_THE_AVAILABLE_TAGS_LIST_LEFT'); ?> </span>
                                                <?php endif; ?>
                                                <table cellspacing="0" cellpadding="0" border="0" id="tagLists">
                                                    <tr>
                                                        <td id="tagListsLeft">
                                                            <span><?php echo JText::_('K2_AVAILABLE_TAGS'); ?></span> <?php echo $this->lists['tags']; ?>
                                                        </td>
                                                        <td id="tagListsButtons">
                                                            <input type="button" id="addTagButton" value="<?php echo JText::_('K2_ADD'); ?> &raquo;" />
                                                            <br />
                                                            <br />
                                                            <input type="button" id="removeTagButton" value="&laquo; <?php echo JText::_('K2_REMOVE'); ?>" />
                                                        </td>
                                                        <td id="tagListsRight">
                                                            <span><?php echo JText::_('K2_SELECTED_TAGS'); ?></span> <?php echo $this->lists['selectedTags']; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if ($this->mainframe->isAdmin() || ($this->mainframe->isSite() && $this->permissions->get('publish'))): ?>
                                        <tr>
                                            <td class="adminK2LeftCol">
                                                <label for="featured"><?php echo JText::_('K2_IS_IT_FEATURED'); ?></label>
                                            </td>
                                            <td class="adminK2RightCol">
                                                <?php echo $this->lists['featured']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adminK2LeftCol">
                                                <label><?php echo JText::_('K2_PUBLISHED'); ?></label>
                                            </td>
                                            <td class="adminK2RightCol">
                                                <?php echo $this->lists['published']; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                                <ul id="k2ExtraFieldsValidationResults"></ul>
                                <!-- Tabs start here -->
                                <div class="simpleTabs" id="k2Tabs">
                                    <ul class="simpleTabsNavigation">
                                        <li id="tabContent"><a href="#k2Tab1"><?php echo JText::_('K2_CONTENT'); ?></a></li>
                                        <?php if ($this->params->get('showImageTab')): ?>
                                            <li id="tabImage"><a href="#k2Tab2"><?php echo JText::_('K2_IMAGE'); ?></a></li>
                                        <?php endif; ?>
                                        <?php // if ($this->params->get('showImageGalleryTab')): ?>
                                            <!--<li id="tabImageGallery"><a href="#k2Tab3"><?php // echo JText::_('K2_IMAGE_GALLERY'); ?></a></li>-->
                                        <?php // endif; ?>
                                        <?php // if ($this->params->get('showVideoTab')): ?>
                                            <!--<li id="tabVideo"><a href="#k2Tab4"><?php // echo JText::_('K2_MEDIA'); ?></a></li>-->
                                        <?php // endif; ?>                           
                                    </ul>

                                    <!-- Tab content -->
                                    <div class="simpleTabsContent" id="k2Tab1">
                                        <?php if ($this->params->get('mergeEditors')): ?>
                                            <div class="k2ItemFormEditor"> <?php echo $this->text; ?>
                                                <div class="dummyHeight"></div>
                                                <div class="clr"></div>
                                            </div>
                                        <?php else: ?>
                                            <div class="k2ItemFormEditor"> <span class="k2ItemFormEditorTitle"> <?php echo JText::_('K2_INTROTEXT_TEASER_CONTENTEXCERPT'); ?> </span> <?php echo $this->introtext; ?>
                                                <div class="dummyHeight"></div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="k2ItemFormEditor"> <span class="k2ItemFormEditorTitle"> <?php echo JText::_('K2_FULLTEXT_MAIN_CONTENT'); ?> </span> <?php echo $this->fulltext; ?>
                                                <div class="dummyHeight"></div>
                                                <div class="clr"></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (count($this->K2PluginsItemContent)): ?>
                                            <div class="itemPlugins">
                                                <?php foreach ($this->K2PluginsItemContent as $K2Plugin): ?>
                                                    <?php if (!is_null($K2Plugin)): ?>
                                                        <fieldset>
                                                            <legend><?php echo $K2Plugin->name; ?></legend>
                                                            <?php echo $K2Plugin->fields; ?>
                                                        </fieldset>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clr"></div>
                                    </div>
                                    <?php if ($this->params->get('showImageTab')): ?>
                                        <!-- Tab image -->
                                        <div class="simpleTabsContent" id="k2Tab2">
                                            <table class="admintable">
                                                <tr>
                                                    <td align="right" class="key">
                                                        <?php echo JText::_('K2_ITEM_IMAGE'); ?>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="image" class="fileUpload" />
                                                        <i>(<?php echo JText::_('K2_MAX_UPLOAD_SIZE'); ?>: <?php echo ini_get('upload_max_filesize'); ?>)</i>
                                                        <br />
                                                        <br />
                                                        <input type="text" name="existingImage" id="existingImageValue" class="text_area" readonly />
                                                        <input type="button" value="<?php echo JText::_('K2_BROWSE_SERVER'); ?>" id="k2ImageBrowseServer"  />
                                                        <br />
                                                        <br />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" class="key">
                                                        <?php echo JText::_('K2_ITEM_IMAGE_CAPTION'); ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="image_caption" size="30" class="text_area" value="<?php echo $this->row->image_caption; ?>" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" class="key">
                                                        <?php echo JText::_('K2_ITEM_IMAGE_CREDITS'); ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="image_credits" size="30" class="text_area" value="<?php echo $this->row->image_credits; ?>" />
                                                    </td>
                                                </tr>
                                                <?php if (!empty($this->row->image)): ?>
                                                    <tr>
                                                        <td align="right" class="key">
                                                            <?php echo JText::_('K2_ITEM_IMAGE_PREVIEW'); ?>
                                                        </td>
                                                        <td>
                                                            <a class="modal" rel="{handler: 'image'}" href="<?php echo $this->row->image; ?>" title="<?php echo JText::_('K2_CLICK_ON_IMAGE_TO_PREVIEW_IN_ORIGINAL_SIZE'); ?>">
                                                                <img alt="<?php echo $this->row->title; ?>" src="<?php echo $this->row->thumb; ?>" class="k2AdminImage" />
                                                            </a>
                                                            <input type="checkbox" name="del_image" id="del_image" />
                                                            <label for="del_image"><?php echo JText::_('K2_CHECK_THIS_BOX_TO_DELETE_CURRENT_IMAGE_OR_JUST_UPLOAD_A_NEW_IMAGE_TO_REPLACE_THE_EXISTING_ONE'); ?></label>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </table>
                                 
                                        </div>
                                    <?php endif; ?>                                                                 
           
                  
                                </div>
                                <!-- Tabs end here -->

                                <input type="hidden" name="isSite" value="<?php echo (int) $this->mainframe->isSite(); ?>" />
                                <?php if ($this->mainframe->isSite()): ?>
                                    <input type="hidden" name="lang" value="<?php echo JRequest::getCmd('lang'); ?>" />
                                <?php endif; ?>
                                <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
                                <input type="hidden" name="option" value="com_k2" />
                                <input type="hidden" name="view" value="item" />
                                <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
                                <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
                                <?php echo JHTML::_('form.token'); ?>
                            </td>
                            <td id="adminFormK2Sidebar"<?php if ($this->mainframe->isSite() && !$this->params->get('sideBarDisplayFrontend')): ?> style="display:none;"<?php endif; ?> class="xmlParamsFields">
                                <?php if ($this->row->id): ?>
                                    <table class="sidebarDetails">
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_ITEM_ID'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->row->id; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_PUBLISHED'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo ($this->row->published > 0) ? JText::_('K2_YES') : JText::_('K2_NO'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_FEATURED'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo ($this->row->featured > 0) ? JText::_('K2_YES') : JText::_('K2_NO'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_CREATED_DATE'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->lists['created']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_CREATED_BY'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->row->author; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_MODIFIED_DATE'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->lists['modified']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_MODIFIED_BY'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->row->moderator; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_HITS'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->row->hits; ?>
                                                <?php if ($this->row->hits): ?>
                                                    <input id="resetHitsButton" type="button" value="<?php echo JText::_('K2_RESET'); ?>" class="button" name="resetHits" />
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($this->row->id): ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo JText::_('K2_RATING'); ?></strong>
                                            </td>
                                            <td>
                                                <?php echo $this->row->ratingCount; ?> <?php echo JText::_('K2_VOTES'); ?>
                                                <?php if ($this->row->ratingCount): ?>
                                                    <br />
                                                    (<?php echo JText::_('K2_AVERAGE_RATING'); ?>: <?php echo number_format(($this->row->ratingSum / $this->row->ratingCount), 2); ?>/5.00)
                                                <?php endif; ?>
                                                <input id="resetRatingButton" type="button" value="<?php echo JText::_('K2_RESET'); ?>" class="button" name="resetRating" />
                                            </td>
                                        </tr>
                                    </table>
                                <?php endif; ?>
                                <div id="k2Accordion">
                                    <h3><a href="#"><?php echo JText::_('K2_AUTHOR_PUBLISHING_STATUS'); ?></a></h3>
                                    <div>
                                        <table class="admintable">
                                            <?php if (isset($this->lists['language'])): ?>
                                                <tr>
                                                    <td align="right" class="key">
                                                        <?php echo JText::_('K2_LANGUAGE'); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->lists['language']; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_AUTHOR'); ?>
                                                </td>
                                                <td id="k2AuthorOptions">
                                                    <span id="k2Author"><?php echo $this->row->author; ?></span>
                                                    <?php if ($this->mainframe->isAdmin() || ($this->mainframe->isSite() && $this->permissions->get('editAll'))): ?>
                                                        <a class="modal" rel="{handler:'iframe', size: {x: 800, y: 460}}" href="index.php?option=com_k2&amp;view=users&amp;task=element&amp;tmpl=component"><?php echo JText::_('K2_CHANGE'); ?></a>
                                                        <input type="hidden" name="created_by" value="<?php echo $this->row->created_by; ?>" />
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_AUTHOR_ALIAS'); ?>
                                                </td>
                                                <td>
                                                    <input class="text_area" type="text" name="created_by_alias" maxlength="250" value="<?php echo $this->row->created_by_alias; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_ACCESS_LEVEL'); ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->lists['access']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_CREATION_DATE'); ?>
                                                </td>
                                                <td class="k2ItemFormDateField">
                                                    <?php echo $this->lists['createdCalendar']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_START_PUBLISHING'); ?>
                                                </td>
                                                <td class="k2ItemFormDateField">
                                                    <?php echo $this->lists['publish_up']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_FINISH_PUBLISHING'); ?>
                                                </td>
                                                <td class="k2ItemFormDateField">
                                                    <?php echo $this->lists['publish_down']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <h3><a href="#"><?php echo JText::_('K2_METADATA_INFORMATION'); ?></a></h3>
                                    <div>
                                        <table class="admintable">
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_DESCRIPTION'); ?>
                                                </td>
                                                <td>
                                                    <textarea name="metadesc" rows="5" cols="20"><?php echo $this->row->metadesc; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_KEYWORDS'); ?>
                                                </td>
                                                <td>
                                                    <textarea name="metakey" rows="5" cols="20"><?php echo $this->row->metakey; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_ROBOTS'); ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="meta[robots]" value="<?php echo $this->lists['metadata']->get('robots'); ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" class="key">
                                                    <?php echo JText::_('K2_AUTHOR'); ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="meta[author]" value="<?php echo $this->lists['metadata']->get('author'); ?>" />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php if ($this->mainframe->isAdmin()): ?>
                                        <h3><a href="#"><?php echo JText::_('K2_ITEM_VIEW_OPTIONS_IN_CATEGORY_LISTINGS'); ?></a></h3>
                                        <div>
                                            <?php if (version_compare(JVERSION, '1.6.0', 'ge')): ?>
                                                <fieldset class="panelform">
                                                    <ul class="adminformlist">
                                                        <?php foreach ($this->form->getFieldset('item-view-options-listings') as $field): ?>
                                                            <li>
                                                                <?php if ($field->type == 'header'): ?>
                                                                    <div class="paramValueHeader"><?php echo $field->input; ?></div>
                                                                <?php elseif ($field->type == 'Spacer'): ?>
                                                                    <div class="paramValueSpacer">&nbsp;</div>
                                                                    <div class="clr"></div>
                                                                <?php else: ?>
                                                                    <div class="paramLabel"><?php echo $field->label; ?></div>
                                                                    <div class="paramValue"><?php echo $field->input; ?></div>
                                                                    <div class="clr"></div>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </fieldset>
                                            <?php else: ?>
                                                <?php echo $this->form->render('params', 'item-view-options-listings'); ?>
                                            <?php endif; ?>
                                        </div>
                                        <h3><a href="#"><?php echo JText::_('K2_ITEM_VIEW_OPTIONS'); ?></a></h3>
                                        <div>
                                            <?php if (version_compare(JVERSION, '1.6.0', 'ge')): ?>
                                                <fieldset class="panelform">
                                                    <ul class="adminformlist">
                                                        <?php foreach ($this->form->getFieldset('item-view-options') as $field): ?>
                                                            <li>
                                                                <?php if ($field->type == 'header'): ?>
                                                                    <div class="paramValueHeader"><?php echo $field->input; ?></div>
                                                                <?php elseif ($field->type == 'Spacer'): ?>
                                                                    <div class="paramValueSpacer">&nbsp;</div>
                                                                    <div class="clr"></div>
                                                                <?php else: ?>
                                                                    <div class="paramLabel"><?php echo $field->label; ?></div>
                                                                    <div class="paramValue"><?php echo $field->input; ?></div>
                                                                    <div class="clr"></div>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </fieldset>
                                            <?php else: ?>
                                                <?php echo $this->form->render('params', 'item-view-options'); ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->aceAclFlag): ?>
                                        <h3><a href="#"><?php echo JText::_('AceACL') . ' ' . JText::_('COM_ACEACL_COMMON_PERMISSIONS'); ?></a></h3>
                                        <div><?php AceaclApi::getWidget('com_k2.item.' . $this->row->id, true); ?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clr"></div>
                <?php if ($this->mainframe->isSite()): ?>
                </div>
            </div>
        <?php endif; ?>
    </form>
</div>
