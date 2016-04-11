DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE IF NOT EXISTS `tp_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(15) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级分类id',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类表';