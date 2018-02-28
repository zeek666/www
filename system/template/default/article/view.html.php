<?php if(!defined("RUN_MODE")) die();?>
<?php
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');

/* set categoryPath for topNav highlight. */
js::set('path', $article->path);
js::set('objectType', 'article');
js::set('objectID', $article->id);
js::set('categoryID', $category->id);
js::set('categoryPath', explode(',', trim($category->path, ',')));
if(isset($article->css)) css::internal($article->css);
if(isset($article->js)) js::execute($article->js);
js::set('pageLayout', $this->block->getLayoutScope('article_view', $article->id));
?>
<?php $common->printPositionBar($category, $article);?>
<div class='row blocks' data-region='article_view-topBanner'><?php $this->block->printRegion($layouts, 'article_view', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='article_view'>
  <?php if(!empty($layouts['article_view']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='row blocks' data-region='article_view-top'><?php $this->block->printRegion($layouts, 'article_view', 'top', true);?></div>
    <div class='article' id='article' data-id='<?php echo $article->id;?>'>
      <header>
        <h1><?php echo $article->title;?></h1>
        <dl class='dl-inline'>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAddedDate, formatTime($article->addedDate));?>'><i class='icon-time icon-large'></i> <?php echo formatTime($article->addedDate); ?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
          <?php if($article->source != 'original' and $article->copyURL != ''):?>
          <dt><?php echo $lang->article->sourceList[$article->source] . $lang->colon;?></dt>
          <?php if($article->source == 'article') $article->copyURL = commomModel::getSysURL() . $this->article->createPreviewLink($article->copyURL);?>
          <dd><?php $article->copyURL ? print(html::a($article->copyURL, $article->copySite, "target='_blank'")) : print($article->copySite); ?></dd>
          <?php else: ?>
          <span class='label label-success'><?php echo $lang->article->sourceList[$article->source]; ?></span>
          <?php endif;?>
          <dd class='pull-right'>
            <?php
            if(!empty($this->config->oauth->sina))
            {
                $sina = json_decode($this->config->oauth->sina);
                if(isset($sina->widget)) echo "<div class='sina-widget'>" . $sina->widget . '</div>';
            }
            ?>
            <span class='label label-warning' data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblViews, $config->viewsPlaceholder);?>'><i class='icon-eye-open'></i> <?php echo $config->viewsPlaceholder; ?></span>
          </dd>
        </dl>
        <?php if($article->summary):?>
        <section class='abstract'><strong><?php echo $lang->article->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
        <?php endif; ?>
      </header>
      <section class='article-content'>
        <?php echo $article->content;?>
      </section>
      <?php if(!empty($article->files)):?>
      <section class="article-files">
        <?php $this->loadModel('file')->printFiles($article->files);?>
      </section>
      <?php endif;?>
      <footer>
        <div class='article-moreinfo clearfix'>
          <?php if($article->editor):?>
          <?php $editor = $this->loadModel('user')->getByAccount($article->editor);?>
          <?php if(!empty($editor)): ?>
          <p class='text-right pull-right'><?php printf($lang->article->lblEditor, $editor->realname, formatTime($article->editedDate));?></p>
          <?php endif;?>
          <?php endif;?>
          <?php if($article->keywords):?>
          <p class='small'><strong class="text-muted"><?php echo $lang->article->keywords;?></strong><span class="article-keywords"><?php echo $lang->colon . $article->keywords;?></span></p>
          <?php endif; ?>
        </div>
        <?php extract($prevAndNext);?>
        <ul class='pager pager-justify'>
          <?php if($prev): ?>
          <li class='previous' title='<?php echo $prev->title;?>'><?php echo html::a(inlink('view', "id=$prev->id", "category={$category->alias}&name={$prev->alias}"), '<i class="icon-arrow-left"></i> <span>' . $prev->title . '</span>'); ?></li>
          <?php else: ?>
          <li class='preious disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->article->none); ?></a></li>
          <?php endif; ?>
          <?php if($next):?>
          <li class='next' title='<?php echo $next->title;?>'><?php echo html::a(inlink('view', "id=$next->id", "category={$category->alias}&name={$next->alias}"), '<span>' . $next->title . '</span> <i class="icon-arrow-right"></i>'); ?></li>
          <?php else:?>
          <li class='next disabled'><a href='###'> <?php print($lang->article->none); ?><i class='icon-arrow-right'></i></a></li>
          <?php endif; ?>
        </ul>
      </footer>
    </div>
    <div class='row blocks' data-region='article_view-bottom'><?php $this->block->printRegion($layouts, 'article_view', 'bottom', true);?></div>
    <?php if(commonModel::isAvailable('message')):?>
    <div id='commentBox'>
      <?php echo $this->fetch('message', 'comment', "objectType=article&objectID={$article->id}");?>
    </div>
    <?php endif;?>
  </div>
  <?php if(!empty($layouts['article_view']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'><side class='page-side blocks' data-region='article_view-side'><?php $this->block->printRegion($layouts, 'article_view', 'side');?></side></div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='article_view-bottomBanner'><?php $this->block->printRegion($layouts, 'article_view', 'bottomBanner', true);?></div>
<?php if(strpos($article->content, '<embed ') !== false) include TPL_ROOT . 'common/video.html.php'; ?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
