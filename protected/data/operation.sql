-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 08 月 16 日 02:21
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `operation`
--

-- --------------------------------------------------------

--
-- 表的结构 `woc_data`
--

CREATE TABLE IF NOT EXISTS `woc_data` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_domain`
--

CREATE TABLE IF NOT EXISTS `woc_domain` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) default NULL,
  `username` varchar(64) default NULL,
  `password` varchar(64) default NULL,
  `provider` varchar(64) default NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_domain`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_email`
--

CREATE TABLE IF NOT EXISTS `woc_email` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) default NULL,
  `username` varchar(64) default NULL,
  `password` varchar(64) default NULL,
  `provider` varchar(64) default NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_email`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_function`
--

CREATE TABLE IF NOT EXISTS `woc_function` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `controller` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `woc_function`
--

INSERT INTO `woc_function` (`id`, `name`, `controller`) VALUES
(1, '网站管理', 'site'),
(2, '域名管理', 'domain'),
(3, '主机管理', 'host'),
(4, '数据管理', 'data'),
(5, '邮箱管理', 'email'),
(6, 'SEO管理', 'seo'),
(7, '用户管理', 'user'),
(8, '角色管理', 'role'),
(9, '分类管理', 'type'),
(10, '功能管理', 'function'),
(11, '缓存管理', 'caches');

-- --------------------------------------------------------

--
-- 表的结构 `woc_host`
--

CREATE TABLE IF NOT EXISTS `woc_host` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_host`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_permission`
--

CREATE TABLE IF NOT EXISTS `woc_permission` (
  `pid` int(10) unsigned NOT NULL auto_increment,
  `rid` int(11) NOT NULL,
  `perm` longtext,
  PRIMARY KEY  (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `woc_permission`
--

INSERT INTO `woc_permission` (`pid`, `rid`, `perm`) VALUES
(16, 363064, '0'),
(17, 158608, 'site,domain,host,data,email,seo');

-- --------------------------------------------------------

--
-- 表的结构 `woc_rnum`
--

CREATE TABLE IF NOT EXISTS `woc_rnum` (
  `id` int(11) NOT NULL auto_increment,
  `sname` varchar(64) NOT NULL,
  `onum` int(11) default NULL,
  `cnum` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_rnum`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_role`
--

CREATE TABLE IF NOT EXISTS `woc_role` (
  `id` int(11) NOT NULL auto_increment,
  `rid` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `woc_role`
--

INSERT INTO `woc_role` (`id`, `rid`, `name`) VALUES
(1, 363064, '管理员'),
(2, 158608, '普通用户');

-- --------------------------------------------------------

--
-- 表的结构 `woc_seo`
--

CREATE TABLE IF NOT EXISTS `woc_seo` (
  `id` int(11) NOT NULL auto_increment,
  `sid` int(11) NOT NULL,
  `alexa` int(11) default NULL,
  `baidu` int(11) default NULL,
  `google` int(11) default NULL,
  `pr` int(2) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_seo`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_site`
--

CREATE TABLE IF NOT EXISTS `woc_site` (
  `sid` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `method` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `tid` int(11) default '0',
  `dmid` int(11) default '0',
  `hid` int(11) default '0',
  `dbid` int(11) default '0',
  `eid` int(11) default '0',
  PRIMARY KEY  (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_site`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_type`
--

CREATE TABLE IF NOT EXISTS `woc_type` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `woc_type`
--


-- --------------------------------------------------------

--
-- 表的结构 `woc_users`
--

CREATE TABLE IF NOT EXISTS `woc_users` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(64) default NULL,
  `telphone` varchar(20) default NULL,
  `status` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `rid` int(11) NOT NULL,
  `rname` varchar(64) NOT NULL,
  `ptid` int(11) NOT NULL,
  `pname` varchar(64) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `woc_users`
--

INSERT INTO `woc_users` (`uid`, `name`, `pass`, `email`, `telphone`, `status`, `created`, `access`, `login`, `ip`, `rid`, `rname`, `ptid`, `pname`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'test@163.com', '123456', 1, 1344911011, 1344911011, 1344911011, '127.0.0.1', 363064, '管理员', 0, 'All Product'),
(2, 'demo', 'e10adc3949ba59abbe56e057f20f883e', 'test@163.com', '123456', 1, 1345017983, 1345017983, 1345017983, '127.0.0.1', 158608, '普通用户', 0, 'All Product');
