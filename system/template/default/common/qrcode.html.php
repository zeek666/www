<?php if(!defined("RUN_MODE")) die();?>
<?php if(isset($this->config->wechatPublic->hasPublic) and $this->config->wechatPublic->hasPublic) $publicList = $this->loadModel('wechat')->getList();?>
<div id='rightDocker' class='hidden-xs'>
  <?php if(!empty($publicList) or extension_loaded('gd')):?>
  <button id='rightDockerBtn' class='btn' data-toggle="popover" data-placement="left" data-target='$next'><i class='icon-qrcode'></i></button>
  <?php endif;?>
  <div class='popover fade'>
    <div class='arrow'></div>
    <div class='popover-content docker-right'>
      <table class='table table-borderless'>
        <tr>
          <?php if(isset($publicList)):?>
          <?php foreach($publicList as $public):?>
          <?php if(!$public->qrcode) continue;?>
          <td>
            <div class='heading'><i class='icon-weixin'>&nbsp;</i> <?php echo $public->name;?></div>
            <?php echo html::image('javascript:;', "data-src='{$public->qrcode}' width='200' height='200'");?>
          </td>
          <?php endforeach;?>
          <?php endif;?>
          <?php if(extension_loaded('gd')):?>
          <td>
            <div class='heading'><i class='icon-mobile-phone'></i> <?php echo $lang->qrcodeTip;?></div>
            <?php echo html::image('data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', "width='200' height='200' data-src='" . $this->createLink('misc', 'qrcode') . "'");?>
          </td>
          <?php endif;?>
        </tr>
      </table>
    </div>
  </div>
</div>
