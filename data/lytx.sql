DROP TABLE IF EXISTS lytx_cache;
CREATE TABLE lytx_cache (
  id int(10) unsigned NOT NULL key auto_increment,
  name varchar(50) not null unique,
  kvalue varchar(255) null
) ENGINE=InnoDb;  

DROP TABLE IF EXISTS lytx_article;

CREATE TABLE lytx_article (
  id int(10) unsigned NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content mediumtext NOT NULL,
  imagepath varchar(100) NOT NULL,
  description varchar(150) NOT NULL default '',
  comments mediumint(8) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  clicks int unsigned not null default 0,
  dateline int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_calendar;

CREATE TABLE lytx_calendar (
  yearmonth mediumint(6) unsigned NOT NULL default '0',
  `day` tinyint(2) unsigned NOT NULL default '1',
  aid int(10) unsigned NOT NULL default '0',
  KEY aid (aid),
  KEY yearmonth (yearmonth)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_category;

CREATE TABLE lytx_category (
  id smallint(5) unsigned NOT NULL auto_increment,
  catename varchar(50) NOT NULL,
  keywords varchar(255) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  urlname varchar(50) NOT NULL default '',
  redirect varchar(200) NOT NULL default '',
  ishide tinyint(1) NOT NULL default '0',
  orderid smallint(5) unsigned NOT NULL default '0',
  count mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_comment;

CREATE TABLE lytx_comment (
  id int(10) unsigned NOT NULL auto_increment,
  aid int(10) unsigned NOT NULL default '0',
  rid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username varchar(20) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  homepage varchar(100) NOT NULL default '',
  content text NOT NULL,
  dateline int(10) unsigned NOT NULL default '0',
  ip varchar(15) NOT NULL default '',
  ischeck tinyint(1) NOT NULL default '0',
  ishide tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY aid (aid)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_config;

CREATE TABLE lytx_config (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(20) NOT NULL default '',
  `desc` varchar(50) NOT NULL default '',
  PRIMARY KEY (name)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_link;

CREATE TABLE lytx_link (
  id mediumint(8) unsigned NOT NULL auto_increment,
  groupid smallint(5) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL,
  url varchar(100) NOT NULL default '',
  logo varchar(100) NOT NULL default '',
  description varchar(200) NOT NULL default '',
  visible tinyint(1) unsigned NOT NULL default '1',
  orderid smallint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_linkgroup;

CREATE TABLE lytx_linkgroup (
  id smallint(5) unsigned NOT NULL auto_increment,
  groupname varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  orderid smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_page;

CREATE TABLE lytx_page (
  id mediumint(8) unsigned NOT NULL auto_increment,
  uid int(10) unsigned NOT NULL default '0',
  username varchar(20) NOT NULL,
  title varchar(100) NOT NULL,
  pagename varchar(50) NOT NULL default '',
  urlname varchar(100) NOT NULL default '',
  filepath varchar(255) NOT NULL default '',
  keywords varchar(200) NOT NULL default '',
  description varchar(200) NOT NULL default '',
  content mediumtext NOT NULL,
  orderid smallint(5) unsigned NOT NULL default '0',
  ishide tinyint(1) unsigned NOT NULL default '0',
  dateline int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_plugin;

CREATE TABLE lytx_plugin (
  id mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  identifier varchar(50) NOT NULL,
  `directory` varchar(100) NOT NULL default '',
  enabled tinyint(1) unsigned NOT NULL default '0',
  runmode tinyint(1) unsigned NOT NULL default '0',
  author varchar(20) NOT NULL default '',
  version varchar(20) NOT NULL default '',
  homepage varchar(50) NOT NULL default '',
  `data` text NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY identifier (identifier)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_session;

CREATE TABLE lytx_session (
  uid mediumint(8) unsigned NOT NULL default '0',
  username varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL default '',
  groupid smallint(5) unsigned NOT NULL default '3',
  ip int(11) NOT NULL default '0',
  PRIMARY KEY  (uid)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_tag;

CREATE TABLE lytx_tag (
  id mediumint(8) unsigned NOT NULL auto_increment,
  tagname varchar(20) NOT NULL default '',
  count mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_upload;

CREATE TABLE lytx_upload (
  id int(10) unsigned NOT NULL auto_increment,
  aid int(10) unsigned NOT NULL default '0',
  uid mediumint(8) unsigned NOT NULL default '0',
  username varchar(20) NOT NULL default '',
  originalname varchar(100) NOT NULL default '',
  filepath varchar(255) NOT NULL default '',
  thumb varchar(255) NOT NULL default '',
  filesize int(10) unsigned NOT NULL default '0',
  filetype varchar(50) NOT NULL default '',
  fileext char(10) NOT NULL default '',
  dateline int(10) unsigned NOT NULL default '0',
  downloads mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY aid (aid)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_user;

CREATE TABLE lytx_user (
  id mediumint(8) unsigned NOT NULL auto_increment,
  username varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  email varchar(50) NOT NULL default '',
  groupid smallint(5) unsigned NOT NULL default '0',
  lastlogin int(10) unsigned NOT NULL default '0',
  regtime int(10) unsigned NOT NULL default '0',
  logincount int(10) unsigned NOT NULL default '0',
  ip varchar(15) NOT NULL default '0',
  PRIMARY KEY  (id),
  UNIQUE KEY username (username)
) ENGINE=InnoDb;

DROP TABLE IF EXISTS lytx_usergroup;

CREATE TABLE lytx_usergroup (
  id smallint(5) unsigned NOT NULL auto_increment,
  groupname varchar(10) NOT NULL,
  purview text NOT NULL,
  `type` enum('system','user') NOT NULL default 'user',
  PRIMARY KEY  (id)
) ENGINE=InnoDb;