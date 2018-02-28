<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $ID$
 * @link        http://www.chanzhi.org
 */
class blockModel extends model
{
    public $counter;

    /**
     * Get block by id.
     *
     * @param string $blockID
     * @access public
     * @return object   the block.
     */
    public function getByID($blockID)
    {
        $block = $this->dao->findByID($blockID)->from(TABLE_BLOCK)->fetch();
        if(strpos($block->type, 'code') === false) $block->content = json_decode($block->content);
        if(strpos($block->type, 'code') !== false) $block->content = is_null(json_decode($block->content)) ? $block->content : json_decode($block->content);
        if(empty($block->content)) $block->content = new stdclass();

        $block->content = $this->loadModel('file')->replaceImgURL($block->content, 'content');
        return $block;
    }

    /**
     * Get block list of one site.
     *
     * @param  string    $template
     * @access public
     * @return array
     */
    public function getList($template)
    {
        return $this->dao->select('*')->from(TABLE_BLOCK)->where('template')->eq($template)->orderBy('id_desc')->fetchAll('id');
    }

    /**
     * Get block list of one region.
     *
     * @param  string    $module
     * @param  string    $method
     * @access public
     * @return array
     */
    public function getPageBlocks($module, $method, $object = '')
    {
        $device   = $this->app->clientDevice;
        $template = $this->config->template->{$device}->name;
        $theme    = $this->config->template->{$device}->theme;
        $plan     = 'all,' . zget($this->config->layout, "{$template}_{$theme}");
        $pages    = "all,{$module}_{$method}";

        $layoutsInCurrent = array();
        if($object)
        {
            $layoutsInCurrent = $this->dao->select('*')->from(TABLE_LAYOUT)
                ->where('page')->eq("{$module}_{$method}")
                ->andWhere('template')->eq(!empty($this->config->template->{$device}->name) ? $this->config->template->{$device}->name : 'default')
                ->andWhere('plan')->in($plan)
                ->andWhere('object')->eq($object)
                ->fetchAll('region');
        }

        $rawLayouts = $this->dao->select('*')->from(TABLE_LAYOUT)
            ->where('page')->in($pages)
            ->andWhere('template')->eq(!empty($this->config->template->{$device}->name) ? $this->config->template->{$device}->name : 'default')
            ->andWhere('plan')->in($plan)
            ->andWhere('object')->eq('')
            ->fetchGroup('page', 'region');

        if(!empty($layoutsInCurrent))
        {
            foreach($layoutsInCurrent as $region => $layouts)
            {
                $rawLayouts["{$module}_{$method}"][$region] = $layouts;
            }
        }

        $blockIdList = array();
        foreach($rawLayouts as $page => $pageBlocks)
        {
            foreach($pageBlocks as $region => $regionBlock)
            {
                $regionBlocks = json_decode($regionBlock->blocks);
                foreach((array)$regionBlocks as $block)
                {
                    $blockIdList[] = $block->id;
                    if(isset($block->children)) foreach($block->children as $child) $blockIdList[] = $child->id;
                }
            }
        }

        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->where('id')->in($blockIdList)->fetchAll('id');
        foreach($blocks as $id => $block)
        {
            if($block->type == 'html') $blocks[$id]->content = json_encode($this->loadModel('file')->replaceImgURL(json_decode($block->content), 'content'));
        }

        $layouts = array();
        foreach($rawLayouts as $page => $pageBlocks)
        {
            $layouts[$page] = array();
            foreach($pageBlocks as $region => $regionBlock)
            {
                $layouts[$page][$region] = array();

                $regionBlocks = json_decode($regionBlock->blocks);

                foreach((array)$regionBlocks as $block)
                {
                    if(!empty($blocks[$block->id]))
                    {
                        $block->title    = $blocks[$block->id]->title;
                        $block->type     = $blocks[$block->id]->type;
                        $block->content  = $blocks[$block->id]->content;
                        $block->template = $blocks[$block->id]->template;
                    }
                    else
                    {
                        $block->title    = '';
                        $block->type     = '';
                        $block->content  = '';
                        $block->template = '';
                    }

                    $mergedBlock = new stdclass();

                    if(!empty($block->children))
                    {
                        $mergedBlock->id = $block->id;
                        $children = array();
                        foreach($block->children as $child)
                        {
                            if(!empty($blocks[$child->id]))
                            {
                                $child->title    = $blocks[$child->id]->title;
                                $child->type     = $blocks[$child->id]->type;
                                $child->content  = $blocks[$child->id]->content;
                                $child->template = $blocks[$child->id]->template;
                            }
                            else
                            {
                                $child->title    = '';
                                $child->type     = '';
                                $child->content  = '';
                                $child->template = '';
                            }

                            $mergedChild = new stdclass();
                            $mergedChild->id          = $child->id;
                            $mergedChild->title       = $child->title;
                            $mergedChild->type        = $child->type;
                            $mergedChild->content     = $child->content;
                            $mergedChild->template    = $child->template;
                            $mergedChild->grid        = $child->grid;
                            $mergedChild->probability = $child->probability;
                            $mergedChild->isRandom    = $child->isRandom;
                            $mergedChild->titleless   = $child->titleless;
                            $mergedChild->borderless  = $child->borderless;
                            $children[] = $mergedChild;
                        }
                        $mergedBlock->children = $children;
                    }
                    else
                    {
                        $mergedBlock->id       = $block->id;
                        $mergedBlock->title    = $block->title;
                        $mergedBlock->type     = $block->type;
                        $mergedBlock->content  = $block->content;
                        $mergedBlock->template = $block->template;
                    }

                    if(isset($block->grid))        $mergedBlock->grid        = $block->grid;
                    if(isset($block->probability)) $mergedBlock->probability = $block->probability;
                    if(isset($block->isRandom))    $mergedBlock->isRandom    = $block->isRandom;
                    if(isset($block->titleless))   $mergedBlock->titleless   = $block->titleless;
                    if(isset($block->borderless))  $mergedBlock->borderless  = $block->borderless;
                    $layouts[$page][$region][] = $mergedBlock;
                }
            }
        }
        return $layouts;
    }

    /**
     * Get block list of one region.
     *
     * @param  string    $page
     * @param  string    $region
     * @param  string    $template
     * @access public
     * @return array
     */
    public function getRegionBlocks($page, $region, $object, $template, $theme)
    {
        $plan = 'all,' . zget($this->config->layout, "{$template}_{$theme}");

        $regionBlocks = $this->dao->select('*')->from(TABLE_LAYOUT)->where('page')->eq($page)->andWhere('region')->eq($region)->andWhere('object')->eq($object)->andWhere('template')->eq($template)->andWhere('plan')->in($plan)->fetch('blocks');
        if($object and empty($regionBlocks)) $regionBlocks = $this->dao->select('*')->from(TABLE_LAYOUT)->where('page')->eq($page)->andWhere('region')->eq($region)->andWhere('object')->eq('')->andWhere('template')->eq($template)->andWhere('plan')->in($plan)->fetch('blocks');

        $regionBlocks = json_decode($regionBlocks);
        if(empty($regionBlocks)) return array();

        $blocks = $this->dao->select('*')->from(TABLE_BLOCK)->fetchAll('id');
        foreach($blocks as $id => $block)
        {
            if($block->type == 'html') $blocks[$id]->content = json_encode($this->loadModel('file')->replaceImgURL(json_decode($block->content), 'content'));
        }

        $sortedBlocks = array();
        foreach($regionBlocks as $block)
        {
            if(!empty($blocks[$block->id]))
            {
                $block->title    = $blocks[$block->id]->title;
                $block->type     = $blocks[$block->id]->type;
                $block->template = $blocks[$block->id]->template;
                $block->content  = $blocks[$block->id]->content;
            }
            else
            {
                $block->title    = '';
                $block->type     = '';
                $block->template = '';
                $block->content  = '';

            }

            $rawBlock = new stdclass();
            if(!empty($block->children))
            {
                $rawBlock->id = $block->id;
                $children = array();
                foreach($block->children as $child)
                {
                    if(!empty($blocks[$child->id]))
                    {
                        $child->title    = $blocks[$child->id]->title;
                        $child->type     = $blocks[$child->id]->type;
                        $child->content  = $blocks[$child->id]->content;
                        $child->template = $blocks[$child->id]->template;
                    }
                    else
                    {
                        $child->title    = '';
                        $child->type     = '';
                        $child->content  = '';
                        $child->template = '';
                    }

                    $rawChild = new stdclass();
                    $rawChild->grid        = $child->grid;
                    $rawChild->probability = $child->probability;
                    $rawChild->titleless   = $child->titleless;
                    $rawChild->borderless  = $child->borderless;
                    $rawChild->id          = $child->id;
                    $rawChild->title       = $child->title;
                    $rawChild->type        = $child->type;
                    $rawChild->content     = $child->content;
                    $rawChild->template    = $child->template;
                    $children[] = $rawChild;
                }
                $rawBlock->children = $children;
            }
            else
            {
                $rawBlock->id       = $block->id;
                $rawBlock->title    = $block->title;
                $rawBlock->type     = $block->type;
                $rawBlock->content  = $block->content;
                $rawBlock->template = $block->template;
            }

            $rawBlock->grid        = $block->grid;
            $rawBlock->probability = $block->probability;
            $rawBlock->isRandom    = $block->isRandom;
            $rawBlock->titleless   = $block->titleless;
            $rawBlock->borderless  = $block->borderless;

            $sortedBlocks[] = $rawBlock;
        }
        return $sortedBlocks;
    }

    /**
     * Get block id => title pairs.
     *
     * @access public
     * @return array
     */
    public function getPairs($template)
    {
        return $this->dao->select('id, title')->from(TABLE_BLOCK)->where('template')->eq($template)->andWhere('type')->ne('region')->fetchPairs();
    }

    /**
     * Create block type dropdown menu.
     *
     * @param  string    $template
     * @param  string    $type
     * @param  int       $blockID
     * @param  string    $method
     * @param  string    $class
     * @access public
     * @return string
     */
    public function createTypeMenu($template, $type = '', $blockID = 0, $method = '', $class = '')
    {
        if(empty($method)) $method = $this->app->getMethodName();
        $select = "<ul class='dropdown-menu $class block-types-menu' role='menu'><li><dl>";
        foreach($this->config->block->categoryList as $category => $groups)
        {
            $select .= "<dt>{$this->lang->block->categoryList[$category]}</dt>";
            $groups = explode(',', $groups);
            foreach($groups as $group)
            {
                if($group == '') continue;
                if(!isset($this->lang->block->$template->typeList[$group])) continue;
                $class = ($group == $type) ? "class='active'" : '';
                if($blockID)
                {
                    $select .= "<dd {$class}>" . html::a(helper::createLink('block', $method, "blockID={$blockID}&type={$group}"), $this->lang->block->$template->typeList[$group], "class='loadInModal'") . "</dd>";
                }
                else
                {
                    $select .= "<dd {$class}>" . html::a(helper::createLink('block', $method, "type={$group}"), $this->lang->block->$template->typeList[$group]) . "</dd>";
                }
            }
            $select .= "</dl></li>";
            if($category != 'system') $select .= "<li><dl>";
        }

        $select .= "</ul>";
        return $select;
    }

    /**
     * Create type  select area.
     *
     * @param  string    $template
     * @param  string    $type
     * @param  int       $blockID
     * @access public
     * @return string
     */
    public function createTypeSelector($template, $type, $blockID = 0)
    {
        $select = "<div class='btn-group'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>";
        $select .= $this->lang->block->$template->typeList[$type] . " <span class='caret'></span></button>";
        $select .= $this->createTypeMenu($template, $type, $blockID);
        $select .= "</div>" .  html::hidden('type', $type);
        return $select;
    }

    /**
     * Create form entry of one block backend.
     *
     * @param  string  $template
     * @param  object  $block
     * @param  mix     $key
     * @param  int     $grade 1,2
     * @access public
     * @return void
     */
    public function createEntry($template, $region, $block = null, $key, $grade = 1, $random = false)
    {
        $blockOptions[''] = $this->lang->block->select;
        $blockOptions += $this->getPairs($template);

        $blockID     = isset($block->id) ? $block->id : '';
        $type        = isset($block->type) ? $block->type : '';
        $grid        = isset($block->grid) ? $block->grid : '';
        $probability = isset($block->probability) ? $block->probability : '';
        $isRandom    = isset($block->isRandom) ? $block->isRandom : 0;

        $entry    = "<div class='block-item row' data-block='{$key}' data-id='{$blockID}'>";
        $readonly = !empty($block->children) ? "readonly='readonly'" : '';
        if(!empty($block->children)) 
        {
            $entry .= "<div class='col col-type text-center'>" . html::hidden("blocks[{$key}]", $blockID) . html::input('', $this->lang->block->subRegion, "class='form-control text-center' readonly") . "</div>";
            $entry .= html::hidden('isRegion', 1);
            $entry .= html::hidden("isRandom[$key]", $isRandom ? 1 : 0);
        }
        else
        {
            $entry .= "<div class='col col-type'>" . html::select("blocks[{$key}]", $blockOptions, $blockID, "class='form-control block' id='block_{$key}' $readonly") . "</div>";
            $entry .= html::hidden('isRegion', 0);
            $entry .= html::hidden("isRandom[$key]", 0);
        }
        
        if($template != 'mobile' and !$random and !$probability and $region != 'side') $entry .= "<div class='col col-grid'><div class='input-group'><span class='input-group-addon'>{$this->lang->block->grid}</span>" . html::select("grid[{$key}]", $this->lang->block->gridOptions, $grid, "class='form-control'") . '</div></div>';
        if($random or $probability) $entry .= "<div class='col col-probability'><div class='input-group'><span class='input-group-addon'>{$this->lang->block->probability}</span>" . html::select("probability[{$key}]", $this->lang->block->probabilityOptions, $probability, "class='form-control'") . '</div></div>';

        $titlelessChecked  = isset($block->titleless) && $block->titleless ? 'checked' : '';
        $borderlessChecked = isset($block->borderless) && $block->borderless ? 'checked' : '';
        $containerChecked  = isset($block->container) && $block->container ? 'checked' : '';
        $entry .= "
            <div class='text-center col col-style'>
               <label>
                 <input type='checkbox' {$titlelessChecked} value='1'><input type='hidden' name='titleless[{$key}]' /><span>{$this->lang->block->titleless}</span>
               </label>
              <label>
                <input type='checkbox' {$borderlessChecked} value='1'><input type='hidden' name='borderless[{$key}]' /><span>{$this->lang->block->borderless}</span>
              </label>
            </div>";

        $entry .= '<div class="col col-actions actions">';
        if($grade == 1) $entry .= html::a('javascript:;', $this->lang->block->add, "class='plus'");
        if($grade == 2) $entry .= html::a('javascript:;', $this->lang->block->add, "class='plus-child'");
        $entry .= html::a('javascript:;', $this->lang->delete, "class='delete'");
        $entry .= html::a(inlink('edit', "blockID={$blockID}&type={$type}"), $this->lang->edit, "class='edit loadInModal'");
        if($grade == 1) $entry .= html::a('javascript:;', $this->lang->block->addChild, "class='btn-add-child'");
        if($grade == 1) $entry .= html::a('javascript:;', $this->lang->block->addRandom, "class='btn-add-random'");
        $entry .= '</div>';
        $entry .= "<div class='col col-move'><span class='sort-handle sort-handle-{$grade}'><i class='icon-move'></i> {$this->lang->block->sort}</span></div>";
        if($grade == 1)
        {
            $entry .= "<div class='children'>";
            if(!empty($block->children))
            {
                foreach($block->children as $child)
                {
                    $key ++;
                    $entry .= $this->createEntry($template, $region, $child, $key, 2);
                }
            }
            $entry .= '</div>';
        }
        if($grade == 2) $entry .= html::hidden("parent[{$key}]", '');
        $entry .= "</div>";
        if($grade == 1) $this->counter = $key;
        return $entry;
    }

    /**
     * Create a block.
     *
     * @param  string  $template
     * @access public
     * @return bool
     */
    public function create($template, $theme)
    {
        $block = fixer::input('post')->add('template', $template)->stripTags('content', $this->config->block->allowedTags)->get();
        $block = $this->loadModel('file')->processImgURL($block, $this->config->block->editor->create['id'], $this->post->uid);

        $block->content = helper::decodeXSS($block->content);
        $block->css     = helper::decodeXSS($block->css);
        $block->js      = helper::decodeXSS($block->js);
        if($block->params['top']['left'] != 'custom') $block->params['topLeftContent'] = '';
        if($this->post->type == 'phpcode') $block = fixer::input('post')->add('template', $template)->get();

        $gpcOn = (version_compare(phpversion(), '5.4', '<') and function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc());

        if(!isset($block->params)) $block->params = array();
        $block->params['custom'][$theme]['css'] = $gpcOn ? stripslashes($block->css) : $block->css;
        $block->params['custom'][$theme]['js']  = $gpcOn ? stripslashes($block->js) : $block->js;
        foreach($block->params as $field => $value)
        {
            if($field == 'category' and is_array($value)) $block->params[$field] = join($value, ',');
        }
        if($this->post->content) $block->params['content'] = $gpcOn ? stripslashes($block->content) : $block->content;

        if($this->post->nav)
        {
            $navs = $this->post->nav;

            foreach($navs as $key => $nav) $navs[$key] = $this->loadModel('nav')->organizeNav($nav);

            if(isset($navs[2])) $navs[2] = $this->nav->group($navs[2]);

            foreach($navs[1] as &$nav)
            {
                $nav['children'] = isset($navs[2][$nav['key']]) ?  $navs[2][$nav['key']] : array();
            }

            $block->params['nav'] = $navs[1];
        }

        $block->content = helper::jsonEncode($block->params);

        $this->dao->insert(TABLE_BLOCK)->data($block, 'params,uid,css,js,nav')->batchCheck($this->config->block->require->create, 'notempty')->autoCheck()->exec();

        $blockID = $this->dao->lastInsertID();
        $this->loadModel('file')->updateObjectID($this->post->uid, $blockID, 'block');

        if($block->type == 'followUs' and $block->params['imageType'] == 'custom' and !empty($_FILES['params']))
        {
            $fileTitles = $this->loadModel('file')->saveUpload('followUs', $blockID, '', 'params');
            if(!empty($fileTitles))
            {
                $file = $this->dao->select('*')->from(TABLE_FILE)->where('objectType')->eq('followUs')->andWhere('objectID')->eq($blockID)->fetch();
                $block->params['customImage'] = $this->app->getWebRoot() . 'data/upload/' . $file->pathname;

                $this->dao->update(TABLE_BLOCK)->set('content')->eq(helper::jsonEncode($block->params))->where('id')->eq($blockID)->exec();
            }
        }

        return $blockID;
    }

    /**
     * Update  block.
     *
     * @param  string  $template
     * @access public
     * @return bool
     */
    public function update($template, $theme)
    {
        $block = $this->getByID($this->post->blockID);

        $data = fixer::input('post')->add('template', $template)->stripTags('content', $this->config->block->allowedTags)->get();
        $data = $this->loadModel('file')->processImgURL($data, $this->config->block->editor->edit['id'], $this->post->uid);
        $data->params['customImage'] = $block->content->customImage;

        if($data->type == 'followUs' && $data->params['imageType'] == 'custom' && !empty($_FILES))
        {
            $oldFiles = $this->dao->select('id')->from(TABLE_FILE)->where('objectType')->eq('followUs')->andWhere('objectID')->eq($block->id)->fetchAll('id');
            foreach($oldFiles as $file) $this->loadModel('file')->delete($file->id);

            $fileTitles = $this->loadModel('file')->saveUpload('followUs', $block->id, '', 'params');
            if(!empty($fileTitles))
            {
                $file = $this->dao->select('*')->from(TABLE_FILE)->where('objectType')->eq('followUs')->andWhere('objectID')->eq($block->id)->fetch();
                $data->params['customImage'] = $this->app->getWebRoot() . 'data/upload/' . $file->pathname;
            }
        }

        $data->content = helper::decodeXSS($data->content);
        $data->css     = helper::decodeXSS($data->css);
        $data->js      = helper::decodeXSS($data->js);

        if($data->params['top']['left'] != 'custom') $data->params['topLeftContent'] = '';
        if($data->params['top']['right'] != 'custom') $data->params['topRightContent'] = '';
        
        if($this->post->type == 'phpcode') $data = fixer::input('post')->add('template', $template)->get();

        $gpcOn = (version_compare(phpversion(), '5.4', '<') and function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc());

        if(!isset($data->params)) $data->params = array();
        $data->params['custom'][$theme]['css'] = $gpcOn ? stripslashes($data->css) : $data->css;
        $data->params['custom'][$theme]['js']  = $gpcOn ? stripslashes($data->js) : $data->js;
        foreach($data->params as $field => $value)
        {
            if($field == 'category' and is_array($value)) $data->params[$field] = join($value, ',');
        }

        if(isset($block->content->custom))
        {
            foreach($block->content->custom as $field => $value)
            {
                if(!isset($data->params['custom'][$field])) $data->params['custom'][$field] = $value;
            }
        }

        if($this->post->content) $data->params['content'] = $gpcOn ? stripslashes($data->content) : $data->content;
        if($this->post->nav)
        {
            $navs = $this->post->nav;

            foreach($navs as $key => $nav)
            {
                $navs[$key] = $this->loadModel('nav')->organizeNav($nav);
            }

            if(isset($navs[2])) $navs[2] = $this->nav->group($navs[2]);

            foreach($navs[1] as &$nav)
            {
                $nav['children'] = isset($navs[2][$nav['key']]) ?  $navs[2][$nav['key']] : array();
            }

            $data->params['nav'] = $navs[1];
        }

        $data->content = helper::jsonEncode($data->params);

        $this->dao->update(TABLE_BLOCK)->data($data, 'params,uid,blockID,css,js,nav')
            ->batchCheck($this->config->block->require->edit, 'notempty')
            ->autoCheck()
            ->where('id')->eq($this->post->blockID)
            ->exec();

        $this->loadModel('file')->updateObjectID($this->post->uid, $this->post->blockID, 'block');
        return true;
    }

    /**
     * Delete one block.
     *
     * @param  int    $blockID
     * @param  null    $table
     * @access public
     * @return bool
     */
    public function delete($blockID, $table = null)
    {
        $this->dao->delete()->from(TABLE_BLOCK)->where('id')->eq($blockID)->exec();
        return !dao::isError();
    }

    /**
     * Set block of one region.
     *
     * @param string $page
     * @param string $region
     * @param string $template
     * @param string $theme
     * @access public
     * @return bool
     */
    public function setRegion($page, $region, $object = '', $template, $theme)
    {
        $layout = new stdclass();
        $layout->page     = $page;
        $layout->region   = $region;
        $layout->template = $template;
        $layout->object   = $object;
        $layout->plan     = $object ? 'all' : zget($this->config->layout, $template . '_' . $theme);

        if(!$this->post->blocks and !$object)
        {
            $this->dao->delete()->from(TABLE_LAYOUT)
                ->where('page')->eq($page)
                ->andWhere('region')->eq($region)
                ->andWhere('object')->eq($object)
                ->andWhere('template')->eq($template)
                ->andWhere('plan')->eq($layout->plan)
                ->exec();

            if(!dao::isError()) return true;
        }

        $blocks = array();
        foreach($this->post->blocks as $key => $block)
        {
            if($block == 0) $block = $this->createRegion($template, $page, $region);
            $blocks[$key]['id']          = $block;
            $blocks[$key]['grid']        = isset($this->post->grid[$key]) ? $this->post->grid[$key] : '';
            $blocks[$key]['probability'] = isset($this->post->probability[$key]) ? $this->post->probability[$key] : '';
            $blocks[$key]['titleless']   = $this->post->titleless[$key];
            $blocks[$key]['borderless']  = $this->post->borderless[$key];
            $blocks[$key]['isRandom']    = isset($this->post->isRandom[$key]) ? $this->post->isRandom[$key] : 0;
        }

        /* Compute children blocks. */
        if($this->post->parent)
        {
            $parents = (array) $this->post->parent;
            foreach($parents as $key => $parent) $children[$parent][] = $key;
            foreach($blocks as $key => $block)
            {
                if(empty($children[$key])) continue;
                foreach($children[$key] as $child)
                {
                    $blocks[$key]['children'][] = $blocks[$child];
                    unset($blocks[$child]);
                }
            }
        }

        /* Clear blocks keys. */
        $sortedBlocks = array();
        foreach($blocks as $key => $block) $sortedBlocks[] = $block;
        $layout->blocks = helper::jsonEncode($sortedBlocks);

        $this->dao->replace(TABLE_LAYOUT)->data($layout)->exec();

        return !dao::isError();
    }

    /**
     * Print blocks of one region.
     *
     * @param  array    $blocks
     * @param  string   $method
     * @param  string   $region
     * @param  bool     $withGrid
     * @param  string   $containerHeader
     * @param  string   $containerFooter
     * @access public
     * @return string
     */
    public function printRegion($blocks, $method = '', $region = '', $withGrid = false, $containerHeader = '', $containerFooter = '')
    {
        if(!isset($blocks[$method][$region])) return '';
        $blocks = $blocks[$method][$region];

        foreach($blocks as $block) 
        {
            if($this->config->cache->type != 'close')
            {
                $type = zget($block, 'type', '');
                $key  = strtolower("block/{$type}_{$block->id}");
                if($withGrid and $block->grid) $key = "block/{$type}_{$block->id}_{$block->grid}";
                if(strpos($key, 'tree') !== false)
                {
                    if($this->session->articleCategory) $key .= "_{$this->session->articleCategory}";
                    if($this->session->productCategory) $key .= "_{$this->session->productCategory}";
                }

                if(isset($this->app->cache) and is_object($this->app->cache))
                {
                    $cache = $this->app->cache->get($key);

                    if($cache)
                    {
                        echo $cache;
                    }
                    else
                    {
                        ob_start();
                        $this->parseBlockContent($block, $withGrid, $containerHeader, $containerFooter);
                        $content = ob_get_flush();

                        $this->app->cache->set($key, $content);
                    }
                }
            }
            else
            {
               $this->parseBlockContent($block, $withGrid, $containerHeader, $containerFooter);
            }
        }
    }

    /**
     * Parse the content of one block.
     *
     * @param  object    $block
     * @param  bool      $withGrid
     * @param  string    $containerHeader
     * @param  string    $containerFooter
     * @access private
     * @return string
     */
    public function parseBlockContent($block, $withGrid = false, $containerHeader, $containerFooter)
    {
        $withGrid = ($withGrid and isset($block->grid));
        $isRegion = isset($block->type) && $block->type === 'region';
        if($isRegion || !empty($block->children))
        {
            $randomClass = !empty($block->isRandom) ? 'random-block-list' : '';
            if(!empty($block->isRandom) && $this->app->clientDevice == 'mobile') echo "<div class='$randomClass' data-id='{$block->id}'>";

            if($withGrid)
            {
                if($block->grid == 0) echo "<div class='col col-row'><div class='row $randomClass' data-id='{$block->id}'>";
                else echo "<div class='col col-row' data-grid='{$block->grid}'><div class='row $randomClass' data-id='{$block->id}'>";
            }

            if(!empty($block->children))
            {
                foreach($block->children as $child) $this->parseBlockContent($child, $withGrid, $containerHeader, $containerFooter);
            }

            if(!empty($block->isRandom) && $this->app->clientDevice == 'mobile') echo "</div>";
            
            if($withGrid) echo '</div></div>';
        }
        else
        {
            $probability = !empty($block->probability) ? "data-probability={$block->probability}" : '';
            if($withGrid)
            {
                if(!isset($block->grid)) $block->grid = 12;
                if($block->grid == 0)
                {
                    echo "<div class='col' $probability>";
                }
                else
                {
                    echo "<div class='col' data-grid='{$block->grid}'>";
                }
            }

            if($probability && $this->app->clientDevice == 'mobile') echo "<div class='random-block' $probability>";

            $device   = $this->app->clientDevice;
            $template = $this->config->template->{$device}->name;
            $theme    = $this->config->template->{$device}->theme;
            $tplPath  = $this->app->getTplRoot() . $template . DS . 'block' . DS;

            /* First try block/ext/sitecode/block/ */
            $extBlockRoot = $tplPath . "/ext/_{$this->app->siteCode}/";
            $blockFile    = $extBlockRoot . strtolower($block->type) . '.html.php';

            /* Then try block/ext//block/ */
            if(!file_exists($blockFile))
            {
                $extBlockRoot = $tplPath . 'ext' . DS;
                $blockFile    = $extBlockRoot . strtolower($block->type) . '.html.php';

                /* No ext file, use the block/block/. */
                if(!file_exists($blockFile))
                {
                    $blockFile = $this->loadModel('ui')->getEffectViewFile($template, 'block', strtolower($block->type));
                    if(!file_exists($blockFile))
                    {
                        if($withGrid) echo '</div>';
                        return '';
                    }
                }
            }

            foreach($this->config->block->categoryList as $category => $typeList)
            {
                if(is_numeric(strpos($typeList, ",{$block->type},"))) $blockCategory = $category;
            }

            $blockClass = "block-{$blockCategory}-{$block->type}";
            if(isset($block->borderless) and $block->borderless) $blockClass .= ' panel-borderless';
            if(isset($block->titleless) and $block->titleless) $blockClass  .= ' panel-titleless';

            $content = is_object($block->content) ? $block->content : json_decode($block->content);
            if(isset($content->class)) $blockClass .= ' ' . $content->class;

            if(isset($this->config->block->defaultIcons[$block->type]))
            {
                $defaultIcon = $this->config->block->defaultIcons[$block->type];
                $iconClass   = isset($content->icon) ? $content->icon : $defaultIcon;
                $icon        = $iconClass ? "<i class='icon panel-icon {$iconClass}'></i> " : "" ;
            }

            $style  = '<style>';
            if(isset($content->custom->$theme))
            {
                $style .= '#block' . $block->id . '{';
                $style .= !empty($content->custom->$theme->backgroundColor) ? 'background-color:' . $content->custom->$theme->backgroundColor . ' !important;' : '';
                $style .= !empty($content->custom->$theme->textColor) ? 'color:' . $content->custom->$theme->textColor . ' !important;;' : '';
                $style .= !empty($content->custom->$theme->borderColor) ? 'border-color:' . $content->custom->$theme->borderColor . ' !important;' : '';
                $style .= '}';
                $style .= '#block' . $block->id . ' .panel-heading{';
                $style .= !empty($content->custom->$theme->titleColor) ? 'color:' .$content->custom->$theme->titleColor . ';' : '';
                $style .= !empty($content->custom->$theme->titleBackground) ? 'background:' .$content->custom->$theme->titleBackground . ' !important;;' : '';
                $style .= '}';
                $style .= !empty($content->custom->$theme->iconColor) ? '#block' . $block->id . ' .panel-icon {color:' .$content->custom->$theme->iconColor . ' !important;}' : '';
                $style .= !empty($content->custom->$theme->linkColor) ? '#block' . $block->id . ' a{color:' .$content->custom->$theme->linkColor . ' !important;}' : '';
                $style .= isset($content->custom->$theme->paddingTop) ? '#block' . $block->id . ' .panel-body' . '{padding-top:' . $content->custom->$theme->paddingTop . 'px !important;}' : '';
                $style .= isset($content->custom->$theme->paddingRight) ? '#block' . $block->id . ' .panel-body' . '{padding-right:' . $content->custom->$theme->paddingRight . 'px !important;}' : '';
                $style .= isset($content->custom->$theme->paddingBottom) ? '#block' . $block->id . ' .panel-body' . '{padding-bottom:' . $content->custom->$theme->paddingBottom . 'px !important;}' : '';
                $style .= isset($content->custom->$theme->paddingLeft) ? '#block' . $block->id . ' .panel-body' . '{padding-left:' . $content->custom->$theme->paddingLeft . 'px !important;}' : '';
                if(!empty($content->custom->$theme->css))
                {
                    $customStyle     = str_ireplace('#blockID', "#block{$block->id}", htmlspecialchars_decode($content->custom->$theme->css, ENT_QUOTES));
                    $customStyleBack = $customStyle;
                    $lessc           = $this->app->loadClass('lessc');
                    $lessc->setFormatter("compressed");
                    
                    $customStyle = htmlspecialchars_decode($customStyle, ENT_QUOTES);
                    try
                    {
                        $customStyle = $lessc->compile($customStyle);
                    }
                    catch(Exception $e)
                    {
                        $lessc->errors[] = $e->getMessage();
                    }
                    if(isset($lessc->errors) and !empty($lessc->errors)) $customStyle = $customStyleBack;

                    $style .= $customStyle;
                }
            }
            $style .= '</style>';
            $script = !empty($content->custom->$theme->js) ? '<script>' . str_ireplace('#blockID', "#block{$block->id}", htmlspecialchars_decode($content->custom->$theme->js, ENT_QUOTES)) . "</script>" : '';

            echo $containerHeader;
            if(file_exists($blockFile)) include $blockFile;
            echo $style;
            echo $script;
            echo $containerFooter;

            if($withGrid) echo "</div>";
            if($probability && $this->app->clientDevice == 'mobile') echo "</div>";
        }
    }

    /**
     * Load language from a template.
     *
     * @param  string $template
     * @access public
     * @return void
     */
    public function loadTemplateLang($template)
    {
        $this->app->loadLang('block');
    }

    /**
     * Get layout of one region.
     * 
     * @param  string   $template 
     * @param  string   $theme 
     * @param  string   $page 
     * @param  string   $region 
     * @param  int      $object 
     * @access public
     * @return object
     */
    public function getLayout($template, $theme, $page, $region, $object = 0)
    {
        if($object)
        {
            $layout = $this->dao->select('*')->from(TABLE_LAYOUT)
                ->where('template')->eq($template)
                ->andWhere('plan')->eq('all')
                ->andWhere('page')->eq($page)
                ->andWhere('object')->eq($object)
                ->andWhere('region')->eq($region)
                ->fetch();
            if(!empty($layout)) return $layout;
        }

        $plan = zget($this->config->layout, $template . '_' . $theme);
        return $this->dao->select('*')->from(TABLE_LAYOUT)
            ->where('template')->eq($template)
            ->andWhere('plan')->eq($plan)
            ->andWhere('page')->eq($page)
            ->andWhere('region')->eq($region)
            ->fetch();
    }

    /**
     * Remove a block from on region or from one subRegion.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $page 
     * @param  string    $region 
     * @param  int       $blockID 
     * @param  int       $object 
     * @access public
     * @return void
     */
    public function removeBlock($template, $theme, $page, $region, $object, $blockID)
    {
        $layout = $this->getLayout($template, $theme, $page, $region, $object);

        if(empty($layout)) return array('result' => 'fail', 'message' => $this->lang->fail);
        $blocks = json_decode($layout->blocks);

        $newBlocks = array();
        foreach($blocks as $block) 
        {
            if(isset($block->children))
            {
                $children = array();
                foreach($block->children as $child)
                {
                    if($child->id != $blockID) $children[] = $child;
                }
                $block->children = $children;
            }
            if($block->id != $blockID) $newBlocks[] = $block;
        }

        $plan           = zget($this->config->layout, $template . '_' . $theme);
        $layout->plan   = $object ? 'all' : $plan;
        $layout->object = $object ? $object : '';

        $layout->blocks = helper::jsonEncode($newBlocks);
        $this->dao->replace(TABLE_LAYOUT)->data($layout)->exec();

        if(!dao::isError()) return array('result' => 'success');
        return array('result' => 'fail', 'message' => dao::getError());
    }

    /**
     * Append a block to region.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $page 
     * @param  string    $region 
     * @param  string    $parent 
     * @param  int       $block 
     * @param  int       $object 
     * @access public
     * @return array     result for send
     */
    public function appendBlock($template, $theme, $page, $region, $object, $parent, $block)
    {
        if(!$this->checkRegion($template, $theme, $page, $region)) return array('result' => 'fail', 'message' => 'region not exisits.');
        $layout  = $this->getLayout($template, $theme, $page, $region, $object);
        if(empty($layout))
        {
            $layout = new stdclass();
            $layout->template = $template;
            $layout->plan     = zget($this->config->layout, "{$template}_{$theme}");
            $layout->page     = $page;
            $layout->region   = $region;
            $layout->blocks   = json_encode(array());
        }
        $blocks  = json_decode($layout->blocks);

        $newBlock = new stdclass();
        $newBlock->grid       = 4;
        $newBlock->borderless = 0;
        $newBlock->titleless  = 0;

        if($block == 'region')
        {
            $newBlock->id       = $this->createRegion($template, $page, $region);
            $newBlock->children = array();
        }
        else
        {
            $newBlock->id = $block;
        }

        if($parent)
        {
            foreach($blocks as $block)
            {
                if($block->id == $parent)
                {
                    if(!isset($block->children)) $block->children = array();
                    $block->children[] = $newBlock; 
                } 
            }
        }
        else
        {
            $blocks[] = $newBlock;
        }

        $layout->blocks = helper::jsonEncode($blocks);

        $plan           = zget($this->config->layout, $template . '_' . $theme);
        $layout->plan   = $object ? 'all' : $plan;
        $layout->object = $object ? $object : '';

        $this->dao->replace(TABLE_LAYOUT)->data($layout)->exec();
        if(!dao::isError()) return array('result' => 'success');
        return array('result' => 'fail', 'message' => dao::getError());
    }

    /**
     * Fix block attribute in one layout.
     * 
     * @param  obvject    $layout 
     * @param  object     $setting 
     * @access public
     * @return array
     */
    public function fixBlock($layout, $setting)
    {
        $blocks = json_decode($layout->blocks);
        foreach($blocks as $block)
        {
            if($block->id == $setting->id)
            {
                $block->grid       = $setting->grid;
                $block->titleless  = $setting->titleless;
                $block->borderless = $setting->borderless;
            }
            if(isset($block->children))
            {
                foreach($block->children as $child)
                {
                    if($child->id == $setting->id)
                    {
                        $child->grid       = $setting->grid;
                        $child->titleless  = $setting->titleless;
                        $child->borderless = $setting->borderless;
                    }
                }
            }
        }
        $layout->blocks = helper::jsonEncode($blocks);
        $this->dao->replace(TABLE_LAYOUT)->data($layout)->exec();
        if(!dao::isError()) return array('result' => 'success');
        return array('result' => 'fail', 'message' => dao::getError());
    }

    /**
     * Sort blocks.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $page 
     * @param  string    $region 
     * @param  int       $parent 
     * @param  string    $orders 
     * @access public
     * @return bool
     */
    public function sortBlocks($template, $theme, $page, $region, $object = 0, $parent = 0, $orders = '')
    {
        $layout  = $this->getLayout($template, $theme, $page, $region, $object);
        $blocks = json_decode($layout->blocks);
        $orders = explode(',', $orders);
        if($parent)
        {
            foreach($blocks as $block)
            {
                if($block->id == $parent)
                {
                    $sortedBlocks = array();
                    foreach($orders as $order)
                    {
                        foreach($block->children as $child) if($child->id == $order) $sortedBlocks[] = $child;
                    }

                    $block->children = $sortedBlocks;
                }
            }
        }
        else
        {
            $sortedBlocks = array();
            foreach($orders as $order)
            {
                foreach($blocks as $block) if($block->id == $order) $sortedBlocks[] = $block;
            }
            $blocks = $sortedBlocks;
        }

        $layout->blocks = helper::jsonEncode($blocks);

        $plan           = zget($this->config->layout, $template . '_' . $theme);
        $layout->plan   = $object ? 'all' : $plan;
        $layout->object = $object ? $object : '';

        $this->dao->replace(TABLE_LAYOUT)->data($layout)->exec();

        return !dao::isError();
    }

    /**
     * Create a region block for one region.
     * 
     * @param  string $template 
     * @param  string $page 
     * @param  string $region 
     * @access public
     * @return int $blockID
     */
    public function createRegion($template = '', $page, $region)
    {
        if($template == '') $template = $this->config->template->{$this->app->clientDevice}->name;

        $block = new stdclass();

        $block->type     = 'region';
        $block->template = $template;
        $block->title    = $this->lang->block->subRegion;
        $this->dao->insert(TABLE_BLOCK)->data($block)->exec();
        return $this->dao->lastInsertID();
    }

    /**
     * Check a region is exisits.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $page 
     * @param  string    $region 
     * @access public
     * @return bool
     */
    public function checkRegion($template, $theme, $page, $region)
    {
        $this->loadTemplateLang($template);
        if(!isset($this->lang->block->{$template}->pages[$page])) return false;
        if(!isset($this->lang->block->{$template}->regions->{$page}[$region])) return false;
        return true;
    }
    
    /**
     * Get layout plans.
     * 
     * @param  string template
     * @access public
     * @return array
     */
    public function getPlans($template)
    {
        $plans = $this->loadModel('tree')->getPairs(0, 'layout_' . $template);
        $plans = array(0 => $this->lang->block->defaultPlan) + (array)$plans;   
        return $plans;
    }

    /**
     * Set layout plan for a theme.
     * 
     * @param  int    $plan 
     * @param  string $template 
     * @param  string $theme 
     * @access public
     * @return void
     */
    public function setPlan($plan, $template = '' , $theme = '')
    {
        $setting["{$template}_{$theme}"] = $plan;
        return $this->loadModel('setting')->setItems('system.common.layout', $setting);
    }
    
    /**
     * Clone an layout plan.
     * 
     * @param  object    $plan 
     * @access public
     * @return int|bool
     */
    public function cloneLayout($plan)
    {
        $this->app->loadLang('tree');
        $this->lang->category->name = $this->lang->block->planName;

        $clonedPlanID = isset($plan->id) ? $plan->id : '0';
        if(isset($plan->id)) unset($plan->id);
        if(isset($plan->pathNames))unset($plan->pathNames);

        $plan->name = $this->post->name;  

        $this->dao->insert(TABLE_CATEGORY)
            ->data($plan)
            ->check('name', 'notempty')
            ->check('name', 'unique', "type='{$plan->type}'")
            ->exec();

        $newPlanID = $this->dao->lastInsertID();
        $this->dao->query("REPLACE INTO " . TABLE_LAYOUT . " (template, plan, page,region, object, blocks, import, lang) SELECT template,$newPlanID,page,region,object,blocks,import,lang FROM " . TABLE_LAYOUT . " WHERE plan = $clonedPlanID;");
        if(dao::isError()) return false;
        return $newPlanID;
    }

    /**
     * Rename a layout.
     * 
     * @param  object    $plan 
     * @access public
     * @return bool
     */
    public function renameLayout($plan)
    {
        $this->app->loadLang('tree');
        $this->lang->category->name = $this->lang->block->planName;
        $type   = $plan->type;
        $planID = $plan->id;

        $this->dao->update(TABLE_CATEGORY)
            ->data(array('name' => $this->post->name))
            ->check('name', 'notempty')
            ->check('name', 'unique', "type='{$type}'")
            ->where('id')->eq($planID)
            ->exec();

        return !dao::isError();
    }

    /**
     * Get layout setting's scope.
     * 
     * @param  string   $page 
     * @param  int      $object 
     * @access public
     * @return void
     */
    public function getLayoutScope($page, $object)
    {
        $template = $this->loadModel('common')->getCurrentTemplate();
        $layout   = $this->dao->select('count(*) as count')->from(TABLE_LAYOUT)
            ->where('template')->eq($template)
            ->andWhere('plan')->eq('all')
            ->andWhere('page')->eq($page)
            ->andWhere('object')->eq($object)
            ->fetch('count');
        return $layout ? 'object' : 'global';
    }
}
