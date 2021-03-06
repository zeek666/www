/* books */
.books {position: relative;}
.books dl{margin: 0 0 0 10px; line-height: 20px;}
.books > dl {margin-left: 0;}
.books .article { padding: 0; border: none; box-shadow: none; margin: 0}
.book,.chapter,.books .article { line-height: 30px; padding: 3px 0; transition: all 0.3s; border-radius: 4px}
.book:before { content: '\e62a'; font-family: ZenIcon; display: inline-block; margin-right: 10px; font-weight: normal; font-size: 14px; width: 30px; height: 30px; color: #999; text-align: center; border: 1px solid #e1e1e1; border-radius: 15px; }
.book > strong,.chapter > strong,.books .article > strong { font-size: 16px; display: inline-block; }
.chapter > strong,.books .article > strong { font-size: 14px; }
.books .article > strong { font-weight: normal; }
.books .actions { display: inline-block; margin-left: 20px;}
.books .actions a { color: #999; font-weight: normal; }
.book:hover,.chapter:hover,.books .article:hover {background-color: #f6f6f6; }
.book:hover .actions a,.chapter:hover .actions a,.books .article:hover .actions a { color: #506EAF; }
.chapter, .books .article { line-height: 20px; }
.chapter .order,.books .article .order { display: inline-block; margin-right: 0; height: 20px; line-height: 20px; padding: 0 6px; text-align: center; border-radius: 5px; transition: all 0.3s;  }
.books dd:hover .order,.book:hover:before{border-color: #999}
.books dd.active{font-weight:bold}

.catalog.chapter.dragging, .catalog.article.dragging {opacity: 0.25; background-color: #FFF4E5; border: 1px solid #fff}
.catalog.chapter.drag-shadow, .catalog.article.drag-shadow {background: #fff; border: 1px solid #ddd; box-shadow:0 1px 8px rgba(0,0,0,.15);}
.sort {cursor: move;}
.catalog {position: relative;}
.catalog.drop-to {background: none;}
.catalog.drop-to:before {display: block; background-color: #E48600; content: ' '; height: 1px; width: 100%; position: absolute; top: -1px}
.catalog.dragging .catalog.drop-to:before, .catalog.drop-to.dragging:before {display: none}
.catalog-empty {display: none; padding: 0; height: 10px; line-height: 5px!important}
dl.drop-area {background-color: #f1f1f1}
.show-empty-catalog .catalog-empty {display: block;}
.books > .catalog > .actions > .sort-handle {display: none}

.fullScreen-book{display: block; width: 100%; height: 100%; position: relative;}
.fullScreen-book > .panel{border: none; box-shadow: none;}
.fullScreen-book .fullScreen-catalog{position: absolute; top: 0; left: 0; z-index: 1; width: 300px; overflow-y:auto; height: 100%; border-right: 1px solid #ddd;}
.fullScreen-book .fullScreen-content{position: absolute; top: 0; left: 320px; height: 100%; overflow-y: auto; right: 0;}
.fullScreen-book .fullScreen-inner{max-width: 960px; margin: 0 auto;}
.fullScreen-book .fullScreen-content footer ul{background: #fafafa; display: block; position: fixed; bottom: 0; right: 20px; left: 320px; margin: 0; z-index: 1000;}
.fullScreen-book .home{margin: 0;}
.fullScreen-book .powerby{position: fixed; background: #fafafa; bottom: 0; height: 30px; line-height: 30px; left: 0; width: 282px; overflow: hidden;}
.fullScreen-book .powerby .icon-chanzhi{left: 0; position: absolute; top: 8px;}
.fullScreen-book .powerby a {display: block; margin: 0; padding-left: 36px; color: #777; position: relative;}
.fullScreen-book .powerby a > .name{display: block; overflow: hidden; position: absolute; width: 0;}
.article > .article-content { padding-top: 0; }
.article-content > .content { max-width: 900px; }
.nav-content { float: right; max-width: 360px; background-color: #fafafa; border: 1px solid #e5e5e5; margin: 0 0 20px 20px; border-radius: 4px; padding: 10px 0; }
.nav-content > li > a { padding:5px 20px; text-shadow: #FFF 0px 1px 0px; }
#bookInfoLink{margin-left:20px;}
.activeBookInfo{font-weight:bold;}

.previous > a, .next > a{overflow: hidden;}
.previous > a > span, .next > a > span{display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; vertical-align: middle;}
.icon-arrow-left, .icon-arrow-right{vertical-align: middle;}

#header {padding: 0; margin-bottom: 14px;}
#headNav {min-height: 30px; line-height: 30px; padding: 0; margin-bottom: 8px;}
#headNav, #headTitle {position: static; display: block;}
#headNav > .row {margin: 0}
#headTitle > .row, #headNav > .row {display: table; width: 100%; margin: 0}
#headNav > .row > #siteNav,
#headNav > .row > #siteSlogan,
#headNav > .row > #searchbar,
#headTitle > .row > #siteTitle,
#headTitle > .row > #searchbar {display: table-cell; vertical-align: middle;}

#headTitle {padding: 0;}
#siteNav {text-align: right; float: right; display: inline-block !important;}
@media (max-width: 767px){#siteNav {padding-left: 8px; padding-right: 8px;}}

#searchbar {max-width: initial;}
#searchbar > form {max-width: 200px; float: right;}
#navbar .navbar-nav {width: 100%}
#navbarCollapse {padding: 0;}
#navbar .navbar-nav {margin: 0;}
#navbar li.nav-item-searchbar {float: right;}
#navbar li.nav-item-searchbar #searchbar > form {margin: 4px;}






