<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot        = $config->webRoot;
$jsRoot         = $webRoot . "js/";
$themeRoot      = $webRoot . "theme/default/";
$sysURL         = $common->getSysURL();
$thisModuleName = $this->app->getModuleName();
$thisMethodName = $this->app->getMethodName();
$template       = $this->config->template->{$this->app->clientDevice}->name ? $this->config->template->{$this->app->clientDevice}->name : 'default';
$theme          = $this->config->template->{$this->app->clientDevice}->theme ? $this->config->template->{$this->app->clientDevice}->theme : 'default';
$cdnRoot        = ($this->config->cdn->open == 'open') ? (!empty($this->config->cdn->site) ? rtrim($this->config->cdn->site, '/') : $this->config->cdn->host . $this->config->version) : '';
?>
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang='<?php echo $app->getClientLang();?>' class='m-<?php echo $thisModuleName?> m-<?php echo $thisModuleName?>-<?php echo $thisMethodName?>'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <meta name="Generator" content="<?php echo 'chanzhi' . $this->config->version . ' www.chanzhi.org'; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if(isset($mobileURL)):?>
  <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo rtrim($sysURL, '/') . '/' . ltrim($mobileURL, '/');?>">
  <?php endif;?>
  <?php if(isset($sourceURL)):?>
  <link rel="canonical" href="<?php echo rtrim($sysURL, '/') . '/' . ltrim($sourceURL, '/');?>" >
  <?php elseif(isset($canonicalURL)):?>
  <link rel="canonical" href="<?php echo $sysURL . $canonicalURL;?>" >
  <?php endif;?>
  <?php if($this->app->getModuleName() == 'user' and $this->app->getMethodName() == 'deny'):?>
  <meta http-equiv='refresh' content="5;url='<?php echo helper::createLink('index');?>'">
  <?php endif;?>
  <?php
  if(!isset($title))   $title    = '';
  if(!empty($title))   $title   .= $lang->minus;
  if(empty($keywords)) $keywords = $config->site->keywords;
  if(empty($desc))     $desc     = $config->site->desc;

  echo html::title($title . $config->site->name);
  echo html::meta('keywords',    strip_tags($keywords));
  echo html::meta('description', strip_tags($desc));
  if(isset($this->config->site->meta)) echo $this->config->site->meta;

  js::exportConfigVars();
  js::set('theme', array('template' => $template, 'theme' => $theme, 'device' => $this->app->clientDevice));
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/min.js');
      js::import($jsRoot . 'zui/min.js');
      js::import($jsRoot . 'chanzhi.js');
      js::import($jsRoot . 'my.js');

      css::import($webRoot . 'zui/css/min.css');
      css::import($themeRoot . 'common/style.css');
  }
  else
  {
      if($cdnRoot)
      {
          css::import($cdnRoot . '/theme/default/default/chanzhi.all.css', '', $version = false);
          js::import($cdnRoot  . '/js/chanzhi.all.js', $version = false);
      }
      else
      {
          css::import($themeRoot . 'default/chanzhi.all.css');
          js::import($jsRoot     . 'chanzhi.all.js');
      }
  }

  /* Import customed css file if it exists. */
  $customCssFile = $this->loadModel('ui')->getCustomCssFile($config->template->{$this->app->clientDevice}->name, $config->template->{$this->app->clientDevice}->theme);
  if(!file_exists($customCssFile) or !is_readable($customCssFile))
  {
      $resultCustomCss = $this->loadModel('ui')->createCustomerCss($config->template->{$this->app->clientDevice}->name, $config->template->{$this->app->clientDevice}->theme);
  }
  if(file_exists($customCssFile)) css::import($this->ui->getThemeCssUrl($template, $theme), "id='themeStyle'");
 
  if(isset($pageCSS)) css::internal($pageCSS);

  echo isset($this->config->site->favicon) ? html::icon(json_decode($this->config->site->favicon)->webPath) : (file_exists($this->app->getWwwRoot() . 'favicon.ico') ? html::icon($webRoot . 'favicon.ico') : '');
  echo html::rss($this->createLink('rss', 'index', '', '', 'xml'), $config->site->name);
  ?>
  <?php $browser = helper::getBrowser(); ?>
  <?php if($browser['name'] == 'ie' and $browser['version'] <= 9):?>
  <?php
  if($config->debug)
  {
      js::import($jsRoot . 'html5shiv/min.js');
      js::import($jsRoot . 'respond/min.js');
  }
  else
  {
      if($cdnRoot)
      {
          echo '<link href="' . $cdnRoot . '/js/respond/cross-domain/respond-proxy.html" id="respond-proxy" rel="respond-proxy" />'; 
          echo '<link href="/js/respond/cross-domain/respond.proxy.gif" id="respond-redirect" rel="respond-redirect" />';
          js::import($jsRoot . 'html5shiv/min.js');
          js::import($jsRoot . 'respond/min.js');
          js::import($jsRoot . 'respond/cross-domain/respond.proxy.js');
      }
      else
      {
          js::import($jsRoot . 'chanzhi.all.ie8.js');
      }
  }
  ?>
  <?php endif;?>
  <?php
  if($browser['name'] == 'ie' and $browser['version'] <= 10)
  {
      if($config->debug)  js::import($jsRoot . 'jquery/placeholder/min.js');
      if(!$config->debug) js::import($jsRoot . 'chanzhi.all.ie9.js');
  }    
  ?>
  <?php
  js::set('lang', $lang->js);

  $baseCustom = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();
  if(!empty($baseCustom[$template][$theme]['js'])) js::execute($baseCustom[$template][$theme]['js']);

  if(!empty($config->oauth->sina) and !is_object($config->oauth->sina)) $sina = json_decode($config->oauth->sina);
  if(!empty($config->oauth->qq)   and !is_object($config->oauth->qq))   $qq   = json_decode($config->oauth->qq);
  if(!empty($sina->verification)) echo $sina->verification;
  if(!empty($qq->verification))   echo $qq->verification;
  if(!empty($sina->widget)) js::import('http://tjs.sjs.sinajs.cn/open/api/js/wb.js');

  $this->block->printRegion($layouts, 'all', 'header');
  ?>
</head>
<body>
<?php if(isset($resultCustomCss) and $resultCustomCss['result'] != 'success'):?>
<?php if(!empty($resultCustomCss['message'])):?>
<div class='alert alert-danger'>
  <?php echo $lang->customCssError;?>
</div>
<?php endif;?>
<?php endif;?>
