INSERT INTO jblog_config VALUES ('name', '欢迎使用JBLOG', 'blog', '');
INSERT INTO jblog_config VALUES ('subtitle', 'JBLOG，基于PHP+MySQL的博客程序。', 'blog', '');
INSERT INTO jblog_config VALUES ('url', 'http://localhost/jblog', 'blog', '');
INSERT INTO jblog_config VALUES ('keywords', 'JBLOG,PHP博客,PHP,开源,博客程序', 'blog', '');
INSERT INTO jblog_config VALUES ('description', 'JBLOG是一个基于PHP+MySQL的开源博客程序。', 'blog', '');
INSERT INTO jblog_config VALUES ('theme', 'default', 'blog', '');
INSERT INTO jblog_config VALUES ('open', '1', 'blog', '');
INSERT INTO jblog_config VALUES ('close_reason', '', 'blog', '');
INSERT INTO jblog_config VALUES ('debug', '0', 'blog', '');
INSERT INTO jblog_config VALUES ('obstart', '0', 'blog', '');
INSERT INTO jblog_config VALUES ('cachepage', '0', 'blog', '');
INSERT INTO jblog_config VALUES ('cachemod' ,'' ,'blog', '');
INSERT INTO jblog_config VALUES ('cachetime', '36000', 'blog', '');
INSERT INTO jblog_config VALUES ('timezone' ,'8' ,'blog', '');
INSERT INTO jblog_config VALUES ('rewrite', '0', 'seo', '');
INSERT INTO jblog_config VALUES ('htmldir' ,'{y}-{m}' ,'seo', '');
INSERT INTO jblog_config VALUES ('pagesize', '10', 'display', '');
INSERT INTO jblog_config VALUES ('comment_limit', '50', 'display', '');
INSERT INTO jblog_config VALUES ('archive_num', '10', 'display', '');
INSERT INTO jblog_config VALUES ('sidebar_num', '10', 'display', '');
INSERT INTO jblog_config VALUES ('sidebar_charnum', '25', 'display', '');
INSERT INTO jblog_config VALUES ('image_resize_width', '580', 'display', '');
INSERT INTO jblog_config VALUES ('reverse_order', '0', 'display', '');
INSERT INTO jblog_config VALUES ('dir_rule', '{y}{m}', 'upload', '');
INSERT INTO jblog_config VALUES ('allow_type', 'jpg|png|jpeg|gif|bmp|rar', 'upload', '');
INSERT INTO jblog_config VALUES ('file_size', '1024', 'upload', '');
INSERT INTO jblog_config VALUES ('auto_resize', '0', 'upload', '');
INSERT INTO jblog_config VALUES ('resize_width', '500', 'upload', '');
INSERT INTO jblog_config VALUES ('resize_height', '500', 'upload', '');
INSERT INTO jblog_config VALUES ('create_thumb', '0', 'upload', '');
INSERT INTO jblog_config VALUES ('thumb_width', '200', 'upload', '');
INSERT INTO jblog_config VALUES ('thumb_height', '200', 'upload', '');
INSERT INTO jblog_config VALUES ('watermark', '0', 'upload', '');
INSERT INTO jblog_config VALUES ('watermark_pos', '0', 'upload', '');
INSERT INTO jblog_config VALUES ('watermark_trans', '', 'upload', '');
INSERT INTO jblog_config VALUES ('remote_open', '1', 'upload', '');
INSERT INTO jblog_config VALUES ('allow_domain', '', 'upload', '');
INSERT INTO jblog_config VALUES ('allow_reg', '1', 'user', '');
INSERT INTO jblog_config VALUES ('reg_vdcode', '1', 'user', '');
INSERT INTO jblog_config VALUES ('login_vdcode', '0', 'user', '');
INSERT INTO jblog_config VALUES ('reg_need_check', '0', 'user', '');
INSERT INTO jblog_config VALUES ('banname', '', 'user', '');


INSERT INTO jblog_usergroup VALUES (1, '管理员', 'a:20:{s:10:"visit_blog";s:1:"1";s:20:"view_hidden_category";s:1:"1";s:19:"view_hidden_article";s:1:"1";s:19:"view_hidden_comment";s:1:"1";s:12:"post_comment";s:1:"1";s:13:"reply_comment";s:1:"1";s:18:"comment_need_check";s:1:"0";s:19:"comment_need_vdcode";s:1:"0";s:17:"comment_max_chars";s:3:"255";s:18:"comment_time_limit";s:2:"10";s:12:"manage_login";s:1:"1";s:12:"post_article";s:1:"1";s:18:"article_need_check";s:1:"0";s:12:"edit_article";s:1:"1";s:16:"edit_all_article";s:1:"1";s:14:"manage_article";s:1:"1";s:15:"manage_category";s:1:"1";s:14:"manage_comment";s:1:"1";s:10:"manage_tag";s:1:"1";s:11:"manage_link";s:1:"1";}', 'system');
INSERT INTO jblog_usergroup VALUES (2, '会员', 'a:20:{s:10:"visit_blog";s:1:"1";s:20:"view_hidden_category";s:1:"0";s:19:"view_hidden_article";s:1:"0";s:19:"view_hidden_comment";s:1:"0";s:12:"post_comment";s:1:"1";s:13:"reply_comment";s:1:"1";s:18:"comment_need_check";s:1:"0";s:19:"comment_need_vdcode";s:1:"0";s:17:"comment_max_chars";s:3:"255";s:18:"comment_time_limit";s:2:"10";s:12:"manage_login";s:1:"0";s:12:"post_article";s:1:"0";s:18:"article_need_check";s:1:"0";s:12:"edit_article";s:1:"0";s:16:"edit_all_article";s:1:"0";s:14:"manage_article";s:1:"0";s:15:"manage_category";s:1:"0";s:14:"manage_comment";s:1:"0";s:10:"manage_tag";s:1:"0";s:11:"manage_link";s:1:"0";}', 'system');
INSERT INTO jblog_usergroup VALUES (3, '游客', 'a:20:{s:10:"visit_blog";s:1:"1";s:20:"view_hidden_category";s:1:"0";s:19:"view_hidden_article";s:1:"0";s:19:"view_hidden_comment";s:1:"0";s:12:"post_comment";s:1:"1";s:13:"reply_comment";s:1:"0";s:18:"comment_need_check";s:1:"0";s:19:"comment_need_vdcode";s:1:"1";s:17:"comment_max_chars";s:3:"255";s:18:"comment_time_limit";s:2:"10";s:12:"manage_login";s:1:"0";s:12:"post_article";s:1:"0";s:18:"article_need_check";s:1:"0";s:12:"edit_article";s:1:"0";s:16:"edit_all_article";s:1:"0";s:14:"manage_article";s:1:"0";s:15:"manage_category";s:1:"0";s:14:"manage_comment";s:1:"0";s:10:"manage_tag";s:1:"0";s:11:"manage_link";s:1:"0";}', 'system');

INSERT INTO jblog_category VALUES (1, '默认分类', '', '', '', '', 0, 1, 0);

INSERT INTO jblog_article VALUES (1, 1, 1, 'admin', 'Hello world!', '', 1, '', '本站原创', '', '', '<p>欢迎使用Jblog，这是一篇系统自动创建的日志，你可以修改或删除，然后开始你的Jblog之旅吧。别忘了常来Jblog官方看看！</p>\r\n<p>Jblog官方网站：<a href="http://www.lisijie.org">http://www.lisijie.org</a></p>\r\n<p>Jblog官方论坛：<a href="http://www.lisijie.org/bbs">http://www.lisijie.org/bbs</a></p>', '<p>欢迎使用Jblog，这是一篇系统自动创建的日志，你可以修改或删除，然后开始你的Jblog之旅吧。别忘了常来Jblog官方看看！</p>\r\n<p>Jblog官方网站：<a href="http://www.lisijie.org">http://www.lisijie.org</a></p>\r\n<p>Jblog官方论坛：<a href="http://www.lisijie.org/bbs">http://www.lisijie.org/bbs</a></p>', 0, 0, 1226977392, 0, 0, 1, '');

INSERT INTO jblog_linkgroup VALUES (1, '默认链接', 1, 0);

INSERT INTO jblog_link VALUES (1, 1, 'JBLOG官方网站', 'http://www.lisijie.org', '', 'JBLOG官方网站', 1, 1);
INSERT INTO jblog_link VALUES (2, 1, '飞酷IT资讯', 'http://www.feedcool.cn', '', '最精彩的中文IT资讯站', 1, 2);
INSERT INTO jblog_link VALUES (3, 1, '作者博客', 'http://www.lisijie.org/', '', 'JBLOG作者博客', 1, 3);
INSERT INTO jblog_link VALUES (4, 1, 'Web开发网', 'http://www.cncms.com.cn/', '', 'Web开发网', 1, 4);