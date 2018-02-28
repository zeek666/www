<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module en file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->visual->common      = "Visual Editor";
$lang->visual->editLogo    = "Edit Logo";
$lang->visual->editSlogan  = "Edit slogan";
$lang->visual->appendBlock = "Insert Widget";
$lang->visual->removeBlock = "Remov eWidget";
$lang->visual->sortBlocks  = "Sort Widgets";

$lang->visual->info            = "Edit Mode";
$lang->visual->preview         = "Preview";
$lang->visual->exit            = "Exit";
$lang->visual->exitVisualEdit  = "Exit Visual Editor";
$lang->visual->customTheme     = "Custom Theme";
$lang->visual->admin           = "Admin";
$lang->visual->reload          = 'Refresh';
$lang->visual->createBlock     = 'Add Widget';
$lang->visual->manageBlock     = 'Manage Widget';
$lang->visual->searchBlock     = 'Search Widget';
$lang->visual->allBlock        = 'All Widgets';
$lang->visual->openInNewWindow = 'Open in a new window';
$lang->visual->editPowerBy     = "<p>You can use Changer for free, if you have read and acknowledged <a href='http://changercms.com/book/changermanual/changerlicense-5.html' target='_blank'> Z PUBLIC LICENSE 1.2 </a>, and you have to keep Changer logos which is of great importance to Changer. If you would like to remove Changer logos, please purchase <a href='http://www.chanzhi.org/license-search.html' target='_blank'> Changer business license</a>.</p>";
$lang->visual->pageLayout      = 'Page layout is applied.';
$lang->visual->pageLayoutInfo  = 'Only applies to current layout.<span class="page-name"></span> will not affect global layout.';
$lang->visual->globalLayout    = 'Gloabl Layout';
$lang->visual->globalLayoutInfo= 'Layout applies to all<span class="page-name"></span>';

$lang->visual->js = new stdclass();
$lang->visual->js->saved             = $lang->saveSuccess;
$lang->visual->js->deleted           = $lang->deleteSuccess;
$lang->visual->js->preview           = 'Preview';
$lang->visual->js->exitPreview       = 'Exit Preview';
$lang->visual->js->removeBlock       = 'Remove Widget';
$lang->visual->js->invisible         = 'Hidden';
$lang->visual->js->carousel          = 'Slide';
$lang->visual->js->operateFail       = 'Action failed！';
$lang->visual->js->addContent        = 'Add';
$lang->visual->js->addContentTo      = 'Add Widget to 【{0}】';
$lang->visual->js->createBlock       = 'Add Widget';
$lang->visual->js->addSubRegion      = 'Add Child';
$lang->visual->js->addBlock          = 'Add an existing Widget';
$lang->visual->js->subRegion         = 'Child Widget';
$lang->visual->js->subRegionDesc     = 'Child Details';
$lang->visual->js->alreadyLastSlide  = 'Last Silde';
$lang->visual->js->alreadyFirstSlide = 'First Silde';
$lang->visual->js->slideOrder        = 'Play Order';
$lang->visual->js->gridWidth         = 'Grid Width';
$lang->visual->js->pageLayoutPrefix  = 'Current Only';
$lang->visual->js->actions           = array('edit' => 'Edit', 'delete' => 'Delete', 'move' => 'Move', 'add' => 'Add');

/* Language for config */
$lang->visual->setting = new stdclass();
$lang->visual->setting->logo                               = array('name' => "Logo/name");
$lang->visual->setting->slogan                             = array('name' => "Slogan");
$lang->visual->setting->powerby                            = array('name' => "Changer logo", 'actions' => array());
$lang->visual->setting->powerby['actions']['edit']         = array('title' => 'Remove Changer logo', 'text' => 'Remove Changer logo', 'alert' => $lang->visual->editPowerBy);
$lang->visual->setting->company                            = array('name' => "Company Intro", 'actions' => array());
$lang->visual->setting->company['actions']['edit']         = array('text' => 'Edit Company Intro');
$lang->visual->setting->companyName                        = array('name' => "Company Name");
$lang->visual->setting->companyDesc                        = array('name' => "Company Intro");
$lang->visual->setting->companyContact                     = array('name' => "Contact");
$lang->visual->setting->links                              = array('name' => "Links");
$lang->visual->setting->navbar                             = array('name' => "Menu");
$lang->visual->setting->carousel                           = array();
$lang->visual->setting->carousel['groupActions']           = array();
$lang->visual->setting->carousel['groupActions']['add']    = array('text' => 'Add a slide');
$lang->visual->setting->carousel['itemActions']            = array();
$lang->visual->setting->carousel['itemActions']['edit']    = array('text' => 'Edit', 'title' => 'Edit a slide');
$lang->visual->setting->carousel['itemActions']['delete']  = array('text' => 'Delete this one', 'confirm' => 'Do you want to delete this slide?');
$lang->visual->setting->carousel['itemActions']['up']      = array('text' => 'Play order has moved forward to {0}');
$lang->visual->setting->carousel['itemActions']['down']    = array('text' => 'Play order has moved backward to {0}');
$lang->visual->setting->block                              = array('name' => "Widget", 'actions' => array());
$lang->visual->setting->block['actions']['delete']         = array('confirm' => 'Do you want to remove {title}?', 'success' => '{title} has been removed.'); 
$lang->visual->setting->block['actions']['layout']         = array('text' => 'Change Layout', 'success' => 'Layout has been saved.');
$lang->visual->setting->block['actions']['add']            = array('title' => 'Add Widget to 【{title}】');
$lang->visual->setting->block['actions']['create']         = array('title' => 'Add Widget');
$lang->visual->setting->columns                            = array('name' => "Column Settings", 'actions' => array());
$lang->visual->setting->columns['actions']['edit']         = array('title' => "Sidebar Settings", 'text' => "Sidebar Settings");
$lang->visual->setting->article                            = array('name' => 'Article');
$lang->visual->setting->articles                           = array('name' => 'Article list', 'actions' => array());
$lang->visual->setting->articles['actions']['add']         = array('text' => 'Post an article');
$lang->visual->setting->page                               = array('name' => 'Page');
$lang->visual->setting->pageList                           = array('name' => 'Page list', 'actions' => array());
$lang->visual->setting->pageList['actions']['add']         = array('text' => 'Post a page');
$lang->visual->setting->blog                               = array('name' => 'Blog');
$lang->visual->setting->blogList                           = array('name' => 'Blog list', 'actions' => array());
$lang->visual->setting->blogList['actions']['add']         = array('text' => 'Post a blog');
$lang->visual->setting->product                            = array('name' => 'Product');
$lang->visual->setting->products                           = array('name' => 'Product list', 'actions' => array());
$lang->visual->setting->products['actions']['add']         = array('text' => 'Post a product');
$lang->visual->setting->books                              = array('name' => 'Book List', 'actions' => array());
$lang->visual->setting->books['actions']['add']            = array('text' => 'Add a Book');
$lang->visual->setting->bookCatalog                        = array('name' => "Book Content");
$lang->visual->setting->book                               = array('name' => "Book");
$lang->visual->setting->boards                             = array('name' => 'Board', 'actions' => array());
$lang->visual->setting->boards['actions']['add']           = array('text' => 'Board Admin');
$lang->visual->setting->thread                             = array('name' => 'Thread', 'actions' => array());
$lang->visual->setting->thread['actions']['edit']          = array('text' => 'Transfer');
