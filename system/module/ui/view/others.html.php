<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('rebuildThumbs', $lang->ui->rebuildThumbs);?>
<?php js::set('thumbs', $this->config->file->thumbs);?>
<?php js::set('rebuildWatermark', $lang->file->rebuildWatermark);?>
<?php
$colorPlates = '';
foreach (explode('|', $lang->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<form method='post' id='ajaxForm' enctype='multipart/form-data'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->ui->settingList as $key => $name):?>
        <li><?php echo html::a('#' . $key . 'Tab', $name, "data-toggle='tab' class='setting-control-tab'");?></li>
        <?php endforeach;?>
      </ul>
    </div>
    <div class='panel-body'>
      <div class='tab-content'>
        <div class='tab-pane setting-control-tab-pane' id='displayTab'>
          <table class='table table-form w-p60 table-fixed'>
            <tr>
              <th class='w-120px'><?php echo $lang->ui->QRCode;?></th>
              <td class='w-p30'><?php echo html::radio('QRCode', $lang->ui->QRCodeList, isset($this->config->ui->QRCode) ? $this->config->ui->QRCode : '1');?></td><td></td>
            </tr>
            <tr>
              <th><?php echo $lang->ui->execInfo;?></th>
              <td class='w-p30'><?php echo html::radio('execInfo', $lang->ui->execInfoOptions, isset($this->config->site->execInfo) ? $this->config->site->execInfo : 'show');?></td><td></td>
            </tr>
            <?php if($this->config->framework->detectDevice[$this->app->clientLang]):?>
            <tr>
              <th><?php echo $lang->ui->mobileBottomNav;?></th>
              <td class='w-p30'><?php echo html::radio('mobileBottomNav', $lang->ui->execInfoOptions, isset($this->config->site->mobileBottomNav) ? $this->config->site->mobileBottomNav : 'show');?></td><td></td>
            </tr>
            <?php endif;?>
          </table>
        </div>

        <div class='tab-pane setting-control-tab-pane' id='browseTab'>
          <table class='table table-form w-p60 table-fixed'>
            <?php if(strpos($this->config->site->modules, 'article') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->article;?></th> 
              <td class='w-p30'><?php echo html::input('articleRec', !empty($this->config->site->articleRec) ? $this->config->site->articleRec : $this->config->article->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'product') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->product;?></th> 
              <td class='w-p30'><?php echo html::input('productRec', !empty($this->config->site->productRec) ? $this->config->site->productRec : $this->config->product->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->blog;?></th> 
              <td class='w-p30'><?php echo html::input('blogRec', !empty($this->config->site->blogRec) ? $this->config->site->blogRec : $this->config->blog->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'book') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->book;?></th> 
              <td class='w-p30'><?php echo html::input('bookRec', !empty($this->config->site->bookRec) ? $this->config->site->bookRec : $this->config->book->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'message') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->message;?></th> 
              <td class='w-p30'><?php echo html::input('messageRec', !empty($this->config->site->messageRec) ? $this->config->site->messageRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <tr>
              <th><?php echo $lang->site->customizableList->comment;?></th> 
              <td><?php echo html::input('commentRec', !empty($this->config->site->commentRec) ? $this->config->site->commentRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'forum') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->site->customizableList->forum;?></th> 
              <td class='w-p30'><?php echo html::input('forumRec', !empty($this->config->site->forumRec) ? $this->config->site->forumRec : $this->config->forum->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <tr>
              <th><?php echo $lang->site->customizableList->reply;?></th> 
              <td><?php echo html::input('replyRec', !empty($this->config->site->replyRec) ? $this->config->site->replyRec : $this->config->reply->recPerPage, "class='form-control'");?></td><td></td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
            <tr>
              <th><?php echo $lang->article->blog->category;?></th>
              <td><?php echo html::radio('blog[showCategory]', $lang->article->blog->categoryOptions, isset($this->config->blog->showCategory) ? $this->config->blog->showCategory : '0');?></td>
              <td></td>
            </tr>
            <tr class='blog-setting <?php echo (!isset($this->config->blog->showCategory) || !$this->config->blog->showCategory) ? "hide" : "";?>'>
              <th><?php echo $lang->article->blog->category;?></th>
              <td>
                <div class='input-group'>
                  <?php echo html::select('blog[categoryName]', $lang->article->blog->categoryNameList, isset($this->config->blog->categoryName) ? $this->config->blog->categoryName : '', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->article->blog->categoryLevel;?></span>
                  <?php echo html::select('blog[categoryLevel]', $lang->article->blog->categoryLevelList, isset($this->config->blog->categoryLevel) ? $this->config->blog->categoryLevel : '', "class='form-control'");?>
                </div>
              </td>
              <td></td>
            </tr>
            <tr>
              <th class='w-120px'><?php echo $lang->blog->common . $lang->article->browseImage->common;?></th>
              <td colspan='2'>
                <div class='input-group'>
                  <?php echo html::select('blog[imagePosition]', $lang->article->browseImage->positionList, isset($this->config->blog->imagePosition) ? $this->config->blog->imagePosition : 'right', "class='form-control'");?>
                  <span class='input-group-addon'></span>
                  <?php echo html::select('blog[imageSize]', $lang->article->browseImage->sizeList, isset($this->config->blog->imageSize) ? $this->config->blog->imageSize : 'small', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->article->browseImage->maxWidth;?></span>
                  <?php echo html::input('blog[imageWidth]', isset($this->config->blog->imageWidth) ? $this->config->blog->imageWidth : '100', "class='form-control'");?>
                  <span class='input-group-addon'>px</span>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'article') !== false):?>
            <tr>
              <th class='w-120px'><?php echo $lang->article->common . $lang->article->browseImage->common;?></th>
              <td colspan='2'>
                <div class='input-group'>
                  <?php echo html::select('article[imagePosition]', $lang->article->browseImage->positionList, isset($this->config->article->imagePosition) ? $this->config->article->imagePosition : 'right', "class='form-control'");?>
                  <span class='input-group-addon'></span>
                  <?php echo html::select('article[imageSize]', $lang->article->browseImage->sizeList, isset($this->config->article->imageSize) ? $this->config->article->imageSize : 'small', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->article->browseImage->maxWidth;?></span>
                  <?php echo html::input('article[imageWidth]', isset($this->config->article->imageWidth) ? $this->config->article->imageWidth : '100', "class='form-control'");?>
                  <span class='input-group-addon'>px</span>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <?php if(strpos($this->config->site->modules, 'product') !== false):?>
            <tr>
              <th><?php echo $lang->product->list;?></th>
              <td colspan='2'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->ui->productView;?></span>
                  <?php echo html::select('product[showViews]', $lang->product->viewsOptions, isset($this->config->product->showViews) ? $this->config->product->showViews : '1', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->product->price;?></span>
                  <?php echo html::select('product[showPrice]', $lang->product->priceOptions, isset($this->config->product->showPrice) ? $this->config->product->showPrice : '1', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->product->name;?></span>
                  <?php echo html::select('product[namePosition]', $lang->product->namePositionOptions, isset($this->config->product->namePosition) ? $this->config->product->namePosition : 'left', "class='form-control'");?>
                </div>
              </td>
            </tr>
            <?php endif;?>
          </table>
        </div>

        <div class='tab-pane setting-control-tab-pane' id='thumbTab'>
          <table class='table table-form w-p60 table-fixed'>
            <tr>
              <th class='w-120px'><?php echo $lang->site->setImageSize;?></th>
              <td colspan='2'>
                <?php foreach($this->config->file->thumbs as $key => $thumb):?> 
                <div class='input-group' style='margin-bottom: 10px'>
                  <span class='input-group-addon'><?php echo $lang->site->imageSize[$key];?></span>
                  <span class='input-group-addon'><?php echo $lang->site->image['width'];?></span>
                  <?php echo html::input("thumbs[$key][width]", $thumb['width'], "class='form-control fix-border' placeholder='{$thumb['width']}'");?>
                  <span class="input-group-addon">px</span>
                  <span class='input-group-addon fix-border'><?php echo $lang->site->image['height'];?></span>
                  <?php echo html::input("thumbs[$key][height]", $thumb['height'], "class='form-control' placeholder='{$thumb['height']}'");?>
                  <span class="input-group-addon">px</span>
                </div>
                <?php endforeach;?>
              </td>
            </tr>
          </table>
        </div>

        <div class='tab-pane setting-control-tab-pane' id='watermarkTab'>
          <table class='table table-form w-p65'>
            <!--watermark open or close -->
            <tr>
              <th class='w-120px'><?php echo $lang->file->watermark;?></th>
              <td><?php echo html::radio('files[watermark]', $lang->file->watermarkList, isset($this->config->file->watermark) ? $this->config->file->watermark : 'close');?></td>
            </tr>

            <?php $waterHide = (!isset($this->config->file->watermark) || $this->config->file->watermark == 'close') ? "hide" : "";?>

            <!--watermark content -->
            <tr class='watermark-info <?php echo $waterHide;?>'>
              <th class='w-120px'><?php echo $lang->file->watermarkContent;?></th> 
              <td class='w-p30'><?php echo html::input('files[watermarkContent]', !empty($this->config->file->watermarkContent) ? $this->config->file->watermarkContent : $this->config->site->name, "class='form-control'");?></td><td></td>
            </tr>

            <!--watermark color -->
            <tr class='watermark-info <?php echo $waterHide;?>'>
              <th class='w-120px'><?php echo $lang->color;?></th> 
              <td class='w-p30'>
                <div class="input-group">
                  <?php echo html::input('files[watermarkColor]', isset($this->config->file->watermarkColor) ? $this->config->file->watermarkColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  <div class='input-group-btn'>
                    <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                      <span class='caret'></span>
                    </button>
                    <div class='dropdown-menu colors'>
                      <?php echo $colorPlates; ?>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <!--watermark opacity -->
            <tr class='watermark-info <?php echo $waterHide;?>'>
              <th class='w-120px'><?php echo $lang->file->watermarkOpacity;?></th> 
              <td class='w-p30'>
                <div class='input-group'>
                  <?php echo html::input('files[watermarkOpacity]', !empty($this->config->file->watermarkOpacity) ? $this->config->file->watermarkOpacity : '50', "class='form-control'");?>
                  <span class='input-group-addon'><?php echo $lang->percent;?></span>
                </div>
              </td>
            </tr>

            <!--watermark size -->
            <tr class='watermark-info <?php echo $waterHide;?>'>
              <th class='w-120px'><?php echo $lang->file->watermarkSize;?></th> 
              <td class='w-p30'>
                <div class='input-group'>
                <?php echo html::input('files[watermarkSize]', isset($this->config->file->watermarkSize) ? $this->config->file->watermarkSize : '14', "class='form-control'");?>
                <span class='input-group-addon'>px</span>
                </div>
              </td>
            </tr>

            <!--watermark position -->
            <tr class='watermark-info <?php echo $waterHide;?>'>
              <th><?php echo $lang->file->watermarkPosition;?></th> 
              <td>
                <?php echo html::select('files[watermarkPosition]', $lang->file->watermarkPositionList, isset($this->config->file->watermarkPosition) ? $this->config->file->watermarkPosition : 'middleMiddle', "class='form-control'");?>
              </td>
            </tr>

            <tr>
              <th></th>
              <td colspan='3'>
                <div class='alert alert-info' style='margin: 1px;'><?php printf($lang->file->fontPosition, $fontsPath);?></div>
              </td>
            </tr>

          </table>
        </div>
      </div>

      <div class='form-footer'>
        <?php echo html::submitButton();?>
        <div class='thumb-footer hidden'>
          <?php echo html::a(helper::createLink('file', 'rebuildthumbs'), $lang->ui->rebuildThumbs, "class='btn btn-primary' id='thumbExecButton'");?>
          <span class='alert alert-success total hide'></span>
        </div>
        <div class='watermark-footer hidden'>
          <?php if(isset($this->config->file->watermark) and $this->config->file->watermark == 'open') echo html::a(helper::createLink('file', 'rebuildWatermark'), $lang->file->rebuildWatermark, "class='btn btn-primary' id='watermarkExecButton'");?>
          <span class='alert alert-success total hide'></span>
        </div>
      </div>
    </div>
  </div>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
