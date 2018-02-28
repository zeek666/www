<?php if(!defined("RUN_MODE")) die();?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<div class='row'>
  <?php foreach($books as $book):?>
  <div class='col-xs-6 col-sm-4 col-md-3'>
    <div class='card'>
      <div class='card-heading text-center'>
        <?php echo html::a($this->createLink('book', 'browse', "nodeID=$book->id", "book=$book->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $book->title);?>
      </div>
      <div class='card-content text-muted'><?php echo $book->summary;?></div>
      <div class='card-actions'>
        <span class='text-muted'><i class='icon-user'></i> <?php echo $book->author;?></span>
        <span class='text-muted'><i class='icon-time'></i> <?php echo $book->addedDate;?></span>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <?php if($pager->pageTotal > 1):?>
  <div class='col-xs-12 col-sm-12 col-md-12 pull-left'><?php $pager->show('right', 'short');?></div>
  <?php endif;?>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
