<?php
 die();
?>
20171010 18:34:32: /chanzhi/install.php

20171010 18:34:35: /chanzhi/install.php?m=install&f=step0

20171010 18:35:32: /chanzhi/install.php?m=install&f=step1

20171010 18:35:34: /chanzhi/install.php?m=install&f=step2

20171010 18:35:44: /chanzhi/install.php?m=install&f=step3

20171010 18:35:46: /chanzhi/install.php?m=install&f=step2

20171010 18:36:32: /chanzhi/install.php?m=install&f=step3

20171010 18:36:41: /chanzhi/install.php?m=install&f=step2

20171010 18:36:55: /chanzhi/install.php?m=install&f=step3

20171010 18:36:55: /chanzhi/install.php?m=install&f=step4

20171010 18:37:03: /chanzhi/install.php?m=install&f=step4
  INSERT INTO eps_user SET `account` = 'admin',`realname` = 'admin',`password` = '86f3059b228c8acf99e69734b6bb32cc',`admin` = 'super',`join` = '2017-10-10 18:37:03',`lang` = 'zh-cn'
  REPLACE eps_config SET `owner` = 'system',`module` = 'common',`section` = 'global',`key` = 'version',`value` = '6.6',`lang` = 'all'

20171010 18:37:03: /chanzhi/install.php?m=install&f=step5
  REPLACE eps_config SET `owner` = 'system',`module` = 'common',`section` = 'site',`key` = 'lang',`value` = '',`lang` = 'all'

20171010 18:37:13: /chanzhi/admin.php?m=user&f=login&t=html
  SELECT * FROM eps_config WHERE owner IN ('system','guest')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT u.*, o.provider as provider, openID as openID FROM eps_user AS u  LEFT JOIN eps_oauth AS o  ON u.account = o.account  WHERE u.account  = 'admin'
  SELECT * FROM eps_user WHERE account  = 'admin'
  INSERT INTO eps_log SET `account` = 'admin',`date` = '2017-10-10 18:37:13',`ip` = '::1',`location` = 'N/A',`browser` = 'chrome 55',`type` = 'adminlogin',`desc` = 'success',`lang` = 'all',`ext` = '{\"userAgent\":\"Mozilla\\/5.0 (Windows NT 6.1; WOW64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/55.0.2883.87 Safari\\/537.36\"}'
  UPDATE eps_user SET `id` = '1',`account` = 'admin',`password` = '86f3059b228c8acf99e69734b6bb32cc',`realname` = 'admin',`realnames` = '',`nickname` = '',`admin` = 'super',`avatar` = '',`birthday` = '0000-00-00',`gender` = 'u',`email` = '',`skype` = '',`qq` = '',`yahoo` = '',`gtalk` = '',`wangwang` = '',`site` = '',`mobile` = '',`phone` = '',`company` = '',`address` = '',`zipcode` = '',`visits` = '1',`ip` = '::1',`last` = '2017-10-10 18:37:11',`score` = '0',`rank` = '0',`maxLogin` = '10',`fails` = '0',`referer` = '',`join` = '2017-10-10 18:37:03',`reset` = '',`locked` = '0000-00-00 00:00:00',`public` = '0',`emailCertified` = '0',`security` = '',`notification` = '',`os` = '',`browser` = '',`lang` = 'zh-cn' WHERE account  = 'admin'
  UPDATE eps_user SET  `browser` = 'chrome 55', `os` = 'Windows 7' WHERE id  = '1' AND  eps_user.lang in('zh-cn', 'all') 
  SELECT module, method FROM eps_usergroup AS t1  LEFT JOIN eps_grouppriv AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin' AND  t1.lang in('zh-cn', 'all') 

20171010 18:37:13: /chanzhi/admin.php?m=user&f=login&t=html
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 

20171010 18:37:13: /chanzhi/admin.php?m=user&f=login&t=html
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 

20171010 18:37:13: /chanzhi/admin.php?m=widget&f=printWidget&widget=5
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '5' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE type  = 'article'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` desc,`order` 

20171010 18:37:14: /chanzhi/admin.php?m=widget&f=printWidget&widget=1
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '1' AND  eps_widget.lang in('zh-cn', 'all') 
  UPDATE eps_order SET  `deliveryStatus` = 'confirmed', `last` = '2017-10-10 18:37:14' WHERE deliveryStatus  = 'send' AND  deliveriedDate  <= '2017-10-03 18:37:14' AND  status  != 'finished' AND  eps_order.lang in('zh-cn', 'all') 
  UPDATE eps_order SET  `status` = 'expired', `last` = '2017-10-10 18:37:14' WHERE payStatus  = 'not_paid' AND  status  != 'deleted' AND  status  != 'expired' AND  createdDate  <= '2017-09-10 18:37:14' AND  eps_order.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  
  SELECT * FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  ORDER BY `id` desc 
  SELECT * FROM eps_order_product WHERE orderID IN ('2','1') AND  eps_order_product.lang in('zh-cn', 'all') 

20171010 18:37:14: /chanzhi/admin.php?m=widget&f=printWidget&widget=3
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '3' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT account FROM eps_user WHERE admin  != 'no' AND  eps_user.lang in('zh-cn', 'all') 
  SELECT * FROM eps_message WHERE status  = '0' AND  type IN ('comment','message','reply') AND  account  NOT IN ('admin','demo')  AND  eps_message.lang in('zh-cn', 'all')  ORDER BY `date` desc  LIMIT 10 
  SELECT id, title FROM eps_article WHERE id IN ('') AND  eps_article.lang in('zh-cn', 'all') 
  SELECT id, name FROM eps_product WHERE id IN ('') AND  eps_product.lang in('zh-cn', 'all') 
  SELECT id, title FROM eps_book WHERE id IN ('') AND  eps_book.lang in('zh-cn', 'all') 
  SELECT id, `from` FROM eps_message WHERE id IN ('') AND  eps_message.lang in('zh-cn', 'all') 
  SELECT id, `from` FROM eps_message WHERE id IN ('') AND  eps_message.lang in('zh-cn', 'all') 

20171010 18:37:14: /chanzhi/admin.php?m=widget&f=printWidget&widget=2
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '2' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT * FROM eps_thread WHERE 1   AND  eps_thread.lang in('zh-cn', 'all')  ORDER BY `id` desc  LIMIT 10 
  SELECT account, realnames, realname FROM eps_user WHERE account IN ('demo','','')
  SELECT account, realname, realnames FROM eps_user ORDER BY `id` asc 

20171010 18:37:29: /chanzhi/admin.php?m=order&f=view&orderID=2&btnLink=false
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order WHERE id  = '2' AND  eps_order.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order_product WHERE orderID  = '2' AND  eps_order_product.lang in('zh-cn', 'all') 
  SELECT account, realname, realnames FROM eps_user ORDER BY `id` asc 
  SELECT * FROM eps_action WHERE objectType  = 'order' AND  objectID  = '2'  AND  eps_action.lang in('zh-cn', 'all')  ORDER BY `id` asc 
  SELECT * FROM eps_history WHERE action IN ('')  AND  eps_history.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT account, realname, realnames FROM eps_user ORDER BY `id` asc 

20171010 18:37:33: /chanzhi/admin.php?m=order&f=edit&orderID=2
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order WHERE id  = '2' AND  eps_order.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE type  = 'express'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` desc,`order` 
  SELECT * FROM eps_order_product WHERE orderID  = '2' AND  eps_order_product.lang in('zh-cn', 'all') 

20171010 18:37:35: /chanzhi/admin.php?m=order&f=delivery&orderID=2
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order WHERE id  = '2' AND  eps_order.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE type  = 'express'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` desc,`order` 

20171010 18:38:03: /chanzhi/admin.php?m=user&f=forbid&userID=2&date=1
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  UPDATE eps_user SET  `locked` = '2017-10-11 18:38:03' WHERE id  = '2'

20171010 18:38:07: /chanzhi/admin.php?m=user&f=activate&id=2
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  UPDATE eps_user SET  `locked` = '' WHERE id  = '2'

20171010 18:39:14: /chanzhi/admin.php?m=widget&f=printWidget&widget=1
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '1' AND  eps_widget.lang in('zh-cn', 'all') 
  UPDATE eps_order SET  `deliveryStatus` = 'confirmed', `last` = '2017-10-10 18:39:14' WHERE deliveryStatus  = 'send' AND  deliveriedDate  <= '2017-10-03 18:39:14' AND  status  != 'finished' AND  eps_order.lang in('zh-cn', 'all') 
  UPDATE eps_order SET  `status` = 'expired', `last` = '2017-10-10 18:39:14' WHERE payStatus  = 'not_paid' AND  status  != 'deleted' AND  status  != 'expired' AND  createdDate  <= '2017-09-10 18:39:14' AND  eps_order.lang in('zh-cn', 'all') 
  SELECT * FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  
  SELECT * FROM eps_order WHERE 1  AND  status  != 'deleted'  AND  eps_order.lang in('zh-cn', 'all')  ORDER BY `id` desc 
  SELECT * FROM eps_order_product WHERE orderID IN ('2','1') AND  eps_order_product.lang in('zh-cn', 'all') 

20171010 18:39:15: /chanzhi/admin.php?m=widget&f=printWidget&widget=3
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '3' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT account FROM eps_user WHERE admin  != 'no' AND  eps_user.lang in('zh-cn', 'all') 
  SELECT * FROM eps_message WHERE status  = '0' AND  type IN ('comment','message','reply') AND  account  NOT IN ('admin','demo')  AND  eps_message.lang in('zh-cn', 'all')  ORDER BY `date` desc  LIMIT 10 
  SELECT id, title FROM eps_article WHERE id IN ('') AND  eps_article.lang in('zh-cn', 'all') 
  SELECT id, name FROM eps_product WHERE id IN ('') AND  eps_product.lang in('zh-cn', 'all') 
  SELECT id, title FROM eps_book WHERE id IN ('') AND  eps_book.lang in('zh-cn', 'all') 
  SELECT id, `from` FROM eps_message WHERE id IN ('') AND  eps_message.lang in('zh-cn', 'all') 
  SELECT id, `from` FROM eps_message WHERE id IN ('') AND  eps_message.lang in('zh-cn', 'all') 

20171010 18:39:15: /chanzhi/admin.php?m=widget&f=printWidget&widget=2
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '2' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT * FROM eps_thread WHERE 1   AND  eps_thread.lang in('zh-cn', 'all')  ORDER BY `id` desc  LIMIT 10 
  SELECT account, realnames, realname FROM eps_user WHERE account IN ('demo','','')
  SELECT account, realname, realnames FROM eps_user ORDER BY `id` asc 

20171010 18:39:15: /chanzhi/admin.php?m=widget&f=printWidget&widget=5
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_widget WHERE id  = '5' AND  eps_widget.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE type  = 'article'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` desc,`order` 

20171010 18:39:42: /chanzhi/admin.php?m=user&f=create
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT id, name FROM eps_group WHERE  eps_group.lang in('zh-cn', 'all') 
  SELECT security FROM eps_user WHERE account  = 'admin' AND  eps_user.lang in('zh-cn', 'all') 

20171010 18:39:50: /chanzhi/admin.php?m=user&f=forbid&userID=2&date=3000
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  UPDATE eps_user SET  `locked` = '2025-12-27 18:39:50' WHERE id  = '2'

20171010 18:45:19: /chanzhi/admin.php?m=tree&f=children&type=forum&root=0&t=html
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT count(*) as count FROM eps_category WHERE grade  = '2' AND  type  = 'forum' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE parent  = '0' AND  type  = 'forum'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `order` 

20171010 18:45:21: /chanzhi/admin.php?m=tree&f=edit&category=5&type=forum
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE alias  = '5' AND  type  = 'article' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE `id` = '5'  AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE id  = '4' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT id, name FROM eps_category WHERE id IN ('','4','5','')  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` 
  SELECT * FROM eps_category WHERE type  = 'forum'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` desc,`order` 
  SELECT * FROM eps_category WHERE alias  = '5' AND  type  = '' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE `id` = '5'  AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE id  = '4' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT id, name FROM eps_category WHERE id IN ('','4','5','')  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `grade` 
  SELECT id FROM eps_category WHERE path  LIKE ',4,5,%' AND  eps_category.lang in('zh-cn', 'all') 

20171010 18:45:26: /chanzhi/admin.php?m=tree&f=children&type=forum&root=0&t=html
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT count(*) as count FROM eps_category WHERE grade  = '2' AND  type  = 'forum' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE parent  = '0' AND  type  = 'forum'  AND  eps_category.lang in('zh-cn', 'all')  ORDER BY `order` 

20171010 18:45:35: /chanzhi/admin.php?m=forum&f=setting
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  REPLACE eps_config SET `owner` = 'system',`module` = 'common',`section` = 'forum',`key` = 'postReview',`value` = 'open',`lang` = 'zh-cn'

20171010 18:45:37: /chanzhi/admin.php?m=forum&f=setting
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  REPLACE eps_config SET `owner` = 'system',`module` = 'common',`section` = 'forum',`key` = 'postReview',`value` = 'open',`lang` = 'zh-cn'

20171010 18:45:38: /chanzhi/admin.php?m=forum&f=setting
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  REPLACE eps_config SET `owner` = 'system',`module` = 'common',`section` = 'forum',`key` = 'postReview',`value` = 'open',`lang` = 'zh-cn'

20171010 18:45:41: /chanzhi/admin.php?m=forum&f=update
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT id FROM eps_category WHERE grade  = '2' AND  type  = 'forum' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT COUNT(id) as threads, SUM(replies) as replies FROM eps_thread WHERE board  = '5' AND  status  != 'wait' AND  addedDate  <= '2017-10-10 18:45:41' AND  hidden  = '0' AND  eps_thread.lang in('zh-cn', 'all') 
  SELECT id as postID, replyID, repliedDate as postedDate, repliedBy, author FROM eps_thread WHERE board  = '5' AND  addedDate  <= '2017-10-10 18:45:41' AND  hidden  = '0'  AND  eps_thread.lang in('zh-cn', 'all')  ORDER BY `repliedDate` desc  LIMIT 1 
  UPDATE eps_category SET `threads` = '1',`posts` = '1',`postID` = '1',`replyID` = '0',`postedDate` = '2014-09-02 18:27:35',`postedBy` = 'demo' WHERE id  = '5'
  SELECT COUNT(id) as threads, SUM(replies) as replies FROM eps_thread WHERE board  = '6' AND  status  != 'wait' AND  addedDate  <= '2017-10-10 18:45:41' AND  hidden  = '0' AND  eps_thread.lang in('zh-cn', 'all') 
  SELECT id as postID, replyID, repliedDate as postedDate, repliedBy, author FROM eps_thread WHERE board  = '6' AND  addedDate  <= '2017-10-10 18:45:41' AND  hidden  = '0'  AND  eps_thread.lang in('zh-cn', 'all')  ORDER BY `repliedDate` desc  LIMIT 1 
  UPDATE eps_category SET `threads` = '0',`posts` = '0',`postID` = '0',`replyID` = '0',`postedBy` = '' WHERE id  = '6'

20171010 18:45:45: /chanzhi/admin.php?m=tag&f=source&tag=%E4%BC%81%E4%B8%9A%E5%BB%BA%E7%AB%99%E7%B3%BB%E7%BB%9F
  SELECT * FROM eps_config WHERE owner IN ('system','admin')  AND  eps_config.lang in('zh-cn', 'all')  ORDER BY `id` 
  SELECT *, id as category FROM eps_category WHERE type IN ('article','video','product','blog','forum','usercase') AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_article WHERE concat(',', keywords, ',')  LIKE '%,企业建站系统,%'  AND  eps_article.lang in('zh-cn', 'all')  ORDER BY `type`,`id` desc 
  SELECT * FROM eps_product WHERE concat(',', keywords, ',')  LIKE '%,企业建站系统,%' AND  eps_product.lang in('zh-cn', 'all') 
  SELECT * FROM eps_book WHERE concat(',', keywords, ',')  LIKE '%,企业建站系统,%' AND  eps_book.lang in('zh-cn', 'all') 
  SELECT * FROM eps_book WHERE  eps_book.lang in('zh-cn', 'all') 
  SELECT * FROM eps_category WHERE concat(',', keywords, ',')  LIKE '%,企业建站系统,%' AND  eps_category.lang in('zh-cn', 'all') 
  SELECT * FROM eps_article WHERE id  = '10' AND  eps_article.lang in('zh-cn', 'all') 
  SELECT *, length(tag) as length FROM eps_tag WHERE link  != ''  AND  eps_tag.lang in('zh-cn', 'all')  ORDER BY `length` desc 
  SELECT t2.name,t2.id,t2.alias,t2.path FROM eps_relation AS t1  LEFT JOIN eps_category AS t2  ON t1.category = t2.id  WHERE t1.type  = 'article' AND  t1.id  = '10' AND  t1.lang in('zh-cn', 'all') 
  SELECT * FROM eps_file WHERE objectType  = 'article' AND  objectID IN ('10') ORDER BY `order`,`editor` desc 
  SELECT * FROM eps_article WHERE id  = '8' AND  eps_article.lang in('zh-cn', 'all') 
  SELECT *, length(tag) as length FROM eps_tag WHERE link  != ''  AND  eps_tag.lang in('zh-cn', 'all')  ORDER BY `length` desc 
  SELECT t2.name,t2.id,t2.alias,t2.path FROM eps_relation AS t1  LEFT JOIN eps_category AS t2  ON t1.category = t2.id  WHERE t1.type  = 'article' AND  t1.id  = '8' AND  t1.lang in('zh-cn', 'all') 
  SELECT * FROM eps_file WHERE objectType  = 'article' AND  objectID IN ('8') ORDER BY `order`,`editor` desc 
  SELECT * FROM eps_article WHERE id  = '7' AND  eps_article.lang in('zh-cn', 'all') 
  SELECT *, length(tag) as length FROM eps_tag WHERE link  != ''  AND  eps_tag.lang in('zh-cn', 'all')  ORDER BY `length` desc 
  SELECT t2.name,t2.id,t2.alias,t2.path FROM eps_relation AS t1  LEFT JOIN eps_category AS t2  ON t1.category = t2.id  WHERE t1.type  = 'article' AND  t1.id  = '7' AND  t1.lang in('zh-cn', 'all') 
  SELECT * FROM eps_file WHERE objectType  = 'article' AND  objectID IN ('7') ORDER BY `order`,`editor` desc 
  SELECT * FROM eps_article WHERE id  = '6' AND  eps_article.lang in('zh-cn', 'all') 
  SELECT *, length(tag) as length FROM eps_tag WHERE link  != ''  AND  eps_tag.lang in('zh-cn', 'all')  ORDER BY `length` desc 
  SELECT t2.name,t2.id,t2.alias,t2.path FROM eps_relation AS t1  LEFT JOIN eps_category AS t2  ON t1.category = t2.id  WHERE t1.type  = 'article' AND  t1.id  = '6' AND  t1.lang in('zh-cn', 'all') 
  SELECT * FROM eps_file WHERE objectType  = 'article' AND  objectID IN ('6') ORDER BY `order`,`editor` desc 
  SELECT * FROM eps_article WHERE id  = '1' AND  eps_article.lang in('zh-cn', 'all') 
  SELECT *, length(tag) as length FROM eps_tag WHERE link  != ''  AND  eps_tag.lang in('zh-cn', 'all')  ORDER BY `length` desc 
  SELECT t2.name,t2.id,t2.alias,t2.path FROM eps_relation AS t1  LEFT JOIN eps_category AS t2  ON t1.category = t2.id  WHERE t1.type  = 'article' AND  t1.id  = '1' AND  t1.lang in('zh-cn', 'all') 
  SELECT * FROM eps_file WHERE objectType  = 'article' AND  objectID IN ('1') ORDER BY `order`,`editor` desc 

