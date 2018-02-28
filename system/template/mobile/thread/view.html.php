<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');
include TPL_ROOT . 'common/files.html.php';

js::set('quoteTitle', $lang->thread->quoteTitle);
js::set('discussion', $thread->discussion);
?>
<div class='block-region region-top blocks' data-region='thread_view-top'><?php $this->loadModel('block')->printRegion($layouts, 'thread_view', 'top');?></div>
<hr class='space'>
<?php
if($pager->pageID == 1) include $this->loadModel('ui')->getEffectViewFile('mobile', 'thread', 'thread');
include $this->loadModel('ui')->getEffectViewFile('mobile', 'thread', 'reply');
?>
<div class='block-region region-bottom blocks' data-region='thread_view-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'thread_view', 'bottom');?></div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
