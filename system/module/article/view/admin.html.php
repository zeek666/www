<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of article of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('categoryID', $categoryID);?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-th-large"></i> <?php echo $lang->$type->list;?></strong>
  <?php if($type != 'submission'):?>
  <div class='panel-actions'>
    <form method='get' class='form-inline form-search'>
      <?php echo html::hidden('m', 'article');?>
      <?php echo html::hidden('f', 'admin');?>
      <?php echo html::hidden('type', $type);?>
      <?php echo html::hidden('categoryID', $categoryID);?>
      <?php echo html::hidden('orderBy', $orderBy);?>
      <?php echo html::hidden('recTotal', isset($this->get->recTotal) ? $this->get->recTotal : 0);?>
      <?php echo html::hidden('recPerPage', isset($this->get->recPerPage) ? $this->get->recPerPage : 10);?>
      <?php echo html::hidden('pageID', isset($this->get->pageID) ? $this->get->pageID :  1);?>
      <div class="input-group">
        <?php echo html::input('searchWord', $this->get->searchWord, "class='form-control search-query'");?>
        <span class="input-group-btn"><?php echo html::submitButton($lang->search->common, "btn btn-primary"); ?></span>
      </div>
    </form>
     <?php if($type == 'page') commonModel::printLink('article', 'create', "type={$type}", '<i class="icon-plus"></i> ' . $lang->page->create, 'class="btn btn-primary"');?>
     <?php if($type != 'page') commonModel::printLink('article', 'create', "type={$type}&category={$categoryID}", '<i class="icon-plus"></i> ' . $lang->$type->create, 'class="btn btn-primary"');?>
   </div>
  <?php endif;?>
  </div>
  <table class='table table-hover table-striped tablesorter table-fixed'>
    <thead>
      <tr>
        <?php $vars = "type=$type&categoryID=$categoryID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->article->id);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('title', $orderBy, $vars, $lang->article->title);?></th>
        <?php if($type == 'submission'):?>
        <th class='text-center w-80px'><?php echo $lang->article->type;?></th>
        <?php endif;?>
        <?php if($type != 'page' and $type != 'submission'):?>
        <th class='text-center w-160px'><?php echo $lang->article->category;?></th>
        <?php endif;?>
        <?php if($type != 'page'):?>
        <th class='text-center w-80px'><?php commonModel::printOrderLink('author', $orderBy, $vars, $lang->article->author);?></th>
        <?php endif;?>
        <th class='text-center w-150px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->article->addedDate);?></th>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('views', $orderBy, $vars, $lang->article->views);?></th>
        <?php if($type != 'page' and commonModel::isAvailable('submission')):?>
        <th class='text-center w-60px'> <?php commonModel::printOrderLink('submission', $orderBy, $vars, $lang->article->status);?></th>
        <?php endif;?>
        <?php $actionClass = $type == 'page' ? 'w-250px' : 'w-300px';?>
        <?php 
          if($type == 'page')
          {
            $actionClass = 'w-250px';
          }
          else if($type == 'submission')
          {
            $actionClass = 'w-150px';
          }
          else
          {
            $actionClass = 'w-300px';
          }
        ?>
        <th class="text-center <?php echo $actionClass;?>"><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php $maxOrder = 0; foreach($articles as $article):?>
      <tr>
        <td class='text-center'><?php echo $article->id;?></td>
        <td title="<?php echo $article->title;?>" style="color:<?php echo $article->titleColor;?>">
          <?php if($article->sticky):?><span class='red'><i class="icon icon-pushpin"></i></span><?php endif;?>
          <?php if($article->status == 'draft') echo '<span class="label label-xsm label-warning">' . $lang->article->statusList[$article->status] .'</span>';?>
          <?php echo $article->title;?>
        </td>
        <?php if($type == 'submission'):?>
        <td class='text-center'><?php echo zget($lang->submission->typeList, $article->type, $lang->article->submission);?></td>
        <?php endif;?>
        <?php if($type != 'page' and $type != 'submission'):?>
        <td class='text-center'><?php foreach($article->categories as $category) echo $category->name . ' ';?></td>
        <?php endif;?>
        <?php if($type != 'page'):?>
        <td class='text-center'><?php echo $article->author;?></td>
        <?php endif;?>
        <td class='text-center'><?php echo $article->addedDate;?></td>
        <td class='text-center'><?php echo $article->views;?></td>
        <?php
        if($type != 'page' and commonModel::isAvailable('submission'))
        {
            echo "<td class='text-center'>" . $lang->submission->status[$article->submission] . '</td>';
        }
        ?>
        <td class='text-center nofixed'>
          <?php if($type == 'submission'):?>
          <?php
          if($article->submission != 2) commonmodel::printlink('article', 'check', "articleid=$article->id", $lang->submission->check); 
          else commonModel::printLink('article', 'edit', "articleID=$article->id&type=$article->type", $lang->edit);
          commonModel::printLink('article', 'delete', "articleID=$article->id", $lang->delete, 'class="deleter"');
          ?>
          <?php else:?>
          <?php
          commonModel::printLink('article', 'edit', "articleID=$article->id&type=$article->type", $lang->edit);
          echo html::a($this->article->createPreviewLink($article->id), $lang->preview, "target='_blank'");
          commonModel::printLink('file', 'browse', "objectType=$article->type&objectID=$article->id&isImage=1", $lang->article->images, "data-toggle='modal'");
          commonModel::printLink('file', 'browse', "objectType=$article->type&objectID=$article->id&isImage=0", $lang->article->files, "data-toggle='modal'");
          ?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='javascript:;'><?php echo $lang->article->layout;?><span class='caret'></span></a>
            <ul class='dropdown-menu pull-right'>    
              <?php $page = $type . '_view';?>
              <?php foreach($lang->block->$template->regions->$page as $region => $regionName):?>
              <li><?php commonModel::printLink('block', 'setregion', "page=$page&region=$region&object=$article->id", $regionName, "data-toggle='modal'");?></li>
              <?php endforeach;?>
              <li><?php commonModel::printLink('block', 'resetRegion', "page=$page&object=$article->id", $lang->block->resetRegion, "class='deleter' data-message='{$lang->block->placeholder->reset}'");?></li>
            </ul>
          </span>
          <?php if($type != 'page'):?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='###'><?php echo $lang->article->stick; ?><span class='caret'></span></a>
            <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
            <?php
              foreach($lang->article->sticks as $stick => $label)
              {
                  if($article->sticky != $stick)
                  {
                      echo '<li>';
                      commonModel::printLink('article', 'stick', "article=$article->id&stick=$stick", $label, "class='jsoner'");
                      echo '</li>';
                  }
                  else
                  {
                      echo '<li class="active"><a href="###">' . $label . '</a></li>';
                  }
              }
              ?>
            </ul>
          </span>
          <?php endif;?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='javascript:;'><?php echo $this->lang->more;?><span class='caret'></span></a>
            <ul class='dropdown-menu pull-right'>    
              <li><?php commonModel::printLink('article', 'delete', "articleID=$article->id", $lang->delete, 'class="deleter"');?></li>
              <li><?php commonModel::printLink('article', 'setcss', "articleID=$article->id", $lang->article->css, "data-toggle='modal'");?></li>
              <li><?php commonModel::printLink('article', 'setjs',  "articleID=$article->id", $lang->article->js, "data-toggle='modal'");?></li>
              <?php if($type == 'article'):?>
              <li><?php commonmodel::printlink('article', 'forward2blog', "articleid=$article->id", $lang->article->forward2Blog, "data-toggle='modal'");?></li>
              <li><?php commonmodel::printlink('article', 'forward2forum', "articleid=$article->id", $lang->article->forward2Forum, "data-toggle='modal'");?></li>
              <?php endif;?>
            </ul>
          </span>
        </td>
      </tr>
      <?php endif;?>
      <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr>
        <?php $col = commonModel::isAvailable('submission') ? 8 : 7;?>
        <?php if($type == 'page') $col = 5;?>
        <?php if($type == 'submission') $col = 8;?>
        <td colspan="<?php echo $col;?>"><?php $pager->show();?></td>
      </tr>
    </tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
