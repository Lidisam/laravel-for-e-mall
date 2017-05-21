-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-21 16:16:14
-- 服务器版本： 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `la_mall`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$66x80Mfjhj4dLCRtmvmSHOPDDtoXoSjJ5zo92nfFqmcPPX7Go/yoW', '1yWseehlpOpxmfTNI0eXYLY3tpvKbU2DbeV8mNArAq4kjgjGLfb4J8TTJod8', '2016-05-24 21:56:33', '2017-05-15 08:51:40'),
(2, 'test', 'test@admin.com', '$2y$10$66x80Mfjhj4dLCRtmvmSHOPDDtoXoSjJ5zo92nfFqmcPPX7Go/yoW', '5zYwJbEED3uuKdZh9JXARhEQzl6AISt3BSq2AhdU6ttYHwaqWVuCEQdmL0ZV', '2016-05-24 21:56:33', '2016-05-25 00:34:44');

-- --------------------------------------------------------

--
-- 表的结构 `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(10) unsigned NOT NULL,
  `ad_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '广告名',
  `ad_weight` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '广告权重(数字越大，广告越前)',
  `ad_start_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '开始时间',
  `ad_end_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '结束时间',
  `ad_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '广告链接',
  `ad_logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '广告图片',
  `ad_sm_logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '广告缩略图片',
  `is_open` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启,默认不开启，1为开启',
  `linkman` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '广告联系人',
  `lm_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '联系人邮箱',
  `lm_num` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '联系人电话',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ads`
--

INSERT INTO `ads` (`id`, `ad_name`, `ad_weight`, `ad_start_time`, `ad_end_time`, `ad_url`, `ad_logo`, `ad_sm_logo`, `is_open`, `linkman`, `lm_email`, `lm_num`, `created_at`, `updated_at`) VALUES
(1, '魅族', 1, '2017-03-20 00:00:00', '2017-03-27 00:00:00', 'http://www.meizu.com', 'Uploads/ad/2017-04-09/3f8ee200b43798667185667b89be7723.jpg', 'Uploads/ad/2017-04-09/thumb_3f8ee200b43798667185667b89be7723.jpg', 1, '', '', '', '2017-03-20 10:46:38', '2017-04-09 09:30:59'),
(2, '小米', 1, '2017-03-08 00:00:00', '2017-03-30 00:00:00', 'http://www.mi.com', 'Uploads/ad/2017-04-09/d2ee558c324a948fcf17b4ba85ec05c6.jpg', 'Uploads/ad/2017-04-09/thumb_d2ee558c324a948fcf17b4ba85ec05c6.jpg', 1, '', '', '', '2017-03-20 10:58:02', '2017-04-09 09:31:11');

-- --------------------------------------------------------

--
-- 表的结构 `attributes`
--

CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(10) unsigned NOT NULL,
  `attr_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性名',
  `attr_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性的类型:0唯一，1可选',
  `attr_option_values` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性的可选值，多个可选值用,隔开',
  `type_id` tinyint(3) unsigned NOT NULL COMMENT '所在类型id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `attributes`
--

INSERT INTO `attributes` (`id`, `attr_name`, `attr_type`, `attr_option_values`, `type_id`, `created_at`, `updated_at`) VALUES
(6, '触控', 1, '可触控,非触控', 1, '2017-02-09 03:35:22', '2017-02-09 03:35:22'),
(7, '触控性', 1, '可触控,非触控', 2, '2017-02-14 06:41:33', '2017-02-14 06:41:33');

-- --------------------------------------------------------

--
-- 表的结构 `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL,
  `brand_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `site_url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `site_url`, `logo`, `created_at`, `updated_at`) VALUES
(1, '三星', 'http://www.samsung.com', 'https://ss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/img/logo/logo_white_fe6da1ec.png', '2017-02-11 16:00:00', NULL),
(2, '魅族', 'http://meizu.com/', 'Uploads/brand/2017-05-20/591f977d068da_21o.jpg', '2017-02-11 16:00:00', '2017-05-20 01:10:21'),
(3, '小米', 'http://www.mi.com/', 'http://www.mi.com/index.html', '2017-02-11 16:00:00', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int(10) unsigned NOT NULL,
  `cat_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cat_logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类图的url',
  `cat_pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '查看分类时所看到的图片',
  `order_weight` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权重，0最大，一次递减',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `categorys`
--

INSERT INTO `categorys` (`id`, `cat_name`, `parent_id`, `cat_logo`, `cat_pic`, `order_weight`, `created_at`, `updated_at`) VALUES
(1, '蔬菜水果', 0, 'Uploads/brand/2017-05-20/591fc4641f7e4_56o.png', 'Uploads/brand/2017-05-20/591fc46431569_56o.png', 0, '2017-02-11 16:00:00', '2017-05-20 04:21:56'),
(4, '禽蛋肉类', 0, 'Uploads/brand/2017-05-20/591fcad386c11_23o.png', 'Uploads/brand/2017-05-20/591fc9463d5c2_46o.jpg', 0, '2017-05-20 01:11:36', '2017-05-20 04:49:23'),
(5, '水产火锅', 0, 'Uploads/brand/2017-05-20/591fcb4587377_17o.png', 'Uploads/brand/2017-05-20/591fcb331069f_59o.jpg', 0, '2017-05-20 01:29:40', '2017-05-20 04:51:17'),
(7, '手机电子', 0, 'Uploads/brand/2017-05-20/591fccd762633_59o.png', 'Uploads/brand/2017-05-20/591fcbf644ed1_14o.jpg', 0, '2017-05-20 04:54:14', '2017-05-20 04:57:59');

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(10) unsigned NOT NULL,
  `goods_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名',
  `cat_id` smallint(5) unsigned NOT NULL COMMENT '类型id',
  `brand_id` smallint(5) unsigned NOT NULL COMMENT '品牌id',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `jifen` int(10) unsigned NOT NULL COMMENT '赠送积分',
  `jyz` int(10) unsigned NOT NULL COMMENT '赠送经验值',
  `jifen_price` int(10) unsigned NOT NULL COMMENT '如果要用积分兑换，需要的积分；如果不填则不用',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销，1是0否',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价',
  `promote_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销开始时间',
  `promote_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销结束时间',
  `logo` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'logo原图',
  `sm_logo` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'logo缩略图',
  `goods_desc` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '商品描述',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否热卖',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架：0下架，1上架',
  `sec_keyword` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'seo_关键字',
  `sec_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'seo_描述',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型id',
  `sort_num` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '排序数字',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除(放置回收站),0不删除',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `goods_quantity` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `sale_volume` int(11) NOT NULL DEFAULT '0' COMMENT '商品销量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `goods_name`, `cat_id`, `brand_id`, `market_price`, `shop_price`, `jifen`, `jyz`, `jifen_price`, `is_promote`, `promote_price`, `promote_start_time`, `promote_end_time`, `logo`, `sm_logo`, `goods_desc`, `is_hot`, `is_new`, `is_best`, `is_on_sale`, `sec_keyword`, `sec_description`, `type_id`, `sort_num`, `is_delete`, `addtime`, `goods_quantity`, `sale_volume`, `created_at`, `updated_at`) VALUES
(72, '我不是水果', 1, 1, '10.00', '9.00', 9, 9, 9, 1, '8.00', 0, 0, 'Uploads/good/2017-04-09/58e9f67121ad3_05o.jpg', 'Uploads/good/2017-04-09/thumb_58e9f67121ad3_05o.jpg', '<p>新鲜水果</p>', 1, 1, 1, 1, '', '', 0, 100, 0, 1491727985, 8, 0, '2017-04-09 08:53:05', '2017-05-19 09:27:36');

-- --------------------------------------------------------

--
-- 表的结构 `goods_attrs`
--

CREATE TABLE IF NOT EXISTS `goods_attrs` (
  `id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `attr_id` int(10) unsigned NOT NULL,
  `attr_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品属性的值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性额外价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `goods_cats`
--

CREATE TABLE IF NOT EXISTS `goods_cats` (
  `id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `goods_pics`
--

CREATE TABLE IF NOT EXISTS `goods_pics` (
  `id` int(10) unsigned NOT NULL,
  `pic` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sm_pic` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `goods_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `good_order`
--

CREATE TABLE IF NOT EXISTS `good_order` (
  `id` int(10) unsigned NOT NULL,
  `good_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当前商品的购买数目',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销订单：1是，0否',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '记录当前户货物的购买总价'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品订单关联表';

--
-- 转存表中的数据 `good_order`
--

INSERT INTO `good_order` (`id`, `good_id`, `order_id`, `num`, `is_promote`, `total_price`) VALUES
(1, 72, 2, 2, 0, '0.00'),
(2, 72, 2, 5, 0, '0.00'),
(3, 72, 5, 5, 0, '9.00'),
(4, 72, 5, 1, 0, '45.00'),
(5, 72, 8, 2, 1, '16.00');

-- --------------------------------------------------------

--
-- 表的结构 `member_levels`
--

CREATE TABLE IF NOT EXISTS `member_levels` (
  `id` int(10) unsigned NOT NULL,
  `level_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bottom_num` int(10) unsigned NOT NULL,
  `top_num` int(10) unsigned NOT NULL,
  `rate` tinyint(3) unsigned NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `member_levels`
--

INSERT INTO `member_levels` (`id`, `level_name`, `bottom_num`, `top_num`, `rate`, `created_at`, `updated_at`) VALUES
(1, '普通会员', 0, 1000, 100, '2017-02-03 16:00:00', NULL),
(2, '黄金会员', 1001, 5000, 90, '2017-02-03 16:00:00', '2017-02-04 12:41:16');

-- --------------------------------------------------------

--
-- 表的结构 `member_prices`
--

CREATE TABLE IF NOT EXISTS `member_prices` (
  `id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '会员价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_25_054817_entrust_setup_tables', 1),
('2017_02_04_110925_create_posts_table', 2),
('2017_02_04_131319_create_member_levels_table', 3),
('2017_02_06_162444_create_brands_table', 4),
('2017_02_08_101040_create_categorys_table', 4),
('2017_02_08_190842_create_types_table', 4),
('2017_02_08_193959_create_attributes_table', 5),
('2017_02_11_193232_create_goods_table', 6),
('2017_02_15_140241_create_goods_cats_table', 7),
('2017_02_15_141735_create_member_prices_table', 8),
('2017_02_15_142150_create_goods_attrs_table', 9),
('2017_02_15_142610_create_goods_pics_table', 10),
('2017_03_20_163312_create_ads_table', 11);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT '索引对应的客户的id',
  `order_num` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单号',
  `consigner` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '收货人',
  `total_price` decimal(10,2) NOT NULL COMMENT '订单初始总价',
  `real_price` decimal(10,2) NOT NULL COMMENT '应付金额(扣除打折积分之类)',
  `user_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户描述',
  `order_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单确认完成状态(0:未付款，1已付款)',
  `pay_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单支付状态，0未确认，1确认',
  `deliver_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态0未发货：1已发货：2已收货',
  `pay_way_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '支付方式',
  `pay_way_id` int(10) unsigned NOT NULL COMMENT '支付方式id',
  `user_address_id` int(10) unsigned NOT NULL COMMENT '用户收获地址id',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '取消订单，默认0未取消；1取消',
  `del_msg` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '取消订单的原因描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_num`, `consigner`, `total_price`, `real_price`, `user_desc`, `order_status`, `pay_status`, `deliver_status`, `pay_way_name`, `pay_way_id`, `user_address_id`, `is_del`, `del_msg`, `created_at`, `updated_at`) VALUES
(2, 4, '201704172304444', 'lisam', '36.00', '32.40', '这是一条订单', 0, 0, 0, '', 1, 2, 0, '', '2017-04-17 15:04:44', '2017-05-16 07:42:42'),
(4, 4, '201705140934194', 'lisam', '18.00', '16.20', 'fasffsdfsdfdsaf', 1, 0, 1, '', 1, 6, 0, NULL, '2017-05-14 01:34:19', '2017-05-14 01:34:19'),
(5, 4, '201705151656324', 'lisam', '54.00', '48.60', '我要留言', 0, 1, 1, '', 1, 6, 0, NULL, '2017-05-15 08:56:32', '2017-05-18 09:12:29'),
(8, 4, '201705191727364', 'lisam', '16.00', '14.40', '饭饭饭放放风fads', 0, 0, 0, '', 1, 1, 0, NULL, '2017-05-19 09:27:36', '2017-05-19 09:27:36'),
(9, 4, '201705191728124', 'lisam', '0.00', '0.00', '饭饭饭放放风fads', 0, 0, 0, '', 1, 1, 0, NULL, '2017-05-19 09:28:12', '2017-05-19 09:28:12'),
(10, 4, '201705191728284', 'lisam', '0.00', '0.00', '', 0, 0, 0, '', 1, 1, 0, NULL, '2017-05-19 09:28:28', '2017-05-19 09:28:28'),
(11, 4, '201705191729414', 'lisam', '0.00', '0.00', '乏', 0, 0, 0, '', 2, 1, 0, NULL, '2017-05-19 09:29:41', '2017-05-19 09:29:41');

-- --------------------------------------------------------

--
-- 表的结构 `orders_operations`
--

CREATE TABLE IF NOT EXISTS `orders_operations` (
  `id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL COMMENT '操作员id',
  `order_id` int(10) unsigned NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态0确认，1为确认',
  `pay_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态',
  `deliver_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发货状态：0待发货，1已发货，2已收货',
  `reason` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '操作备注',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单操作记录表';

--
-- 转存表中的数据 `orders_operations`
--

INSERT INTO `orders_operations` (`id`, `admin_id`, `order_id`, `order_status`, `pay_status`, `deliver_status`, `reason`, `created_at`, `updated_at`) VALUES
(32, 1, 5, 1, 1, 1, '啊啊[确认]', '2017-05-18 08:55:50', '2017-05-18 08:55:50'),
(33, 1, 5, 0, 1, 1, '饭饭饭[确认]', '2017-05-18 08:56:29', '2017-05-18 08:56:29'),
(34, 1, 5, 1, 1, 1, '信息[确认]', '2017-05-18 08:56:54', '2017-05-18 08:56:54'),
(35, 1, 5, 0, 1, 1, '短信送达[确认]', '2017-05-18 08:58:47', '2017-05-18 08:58:47'),
(36, 1, 5, 1, 1, 1, '[确认]', '2017-05-18 09:03:11', '2017-05-18 09:03:11'),
(37, 1, 5, 0, 0, 1, '[确认]', '2017-05-18 09:12:29', '2017-05-18 09:12:29');

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) unsigned NOT NULL,
  `pay_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT '支付名',
  `pay_fee` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '支付手续费',
  `pay_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '支付描述',
  `pay_config` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT '支付配置',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启0不开启，1开启',
  `is_cod` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '货到付款?0否，1是',
  `is_online` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '在线支付？0否，1是'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='支付方式表';

--
-- 转存表中的数据 `payments`
--

INSERT INTO `payments` (`id`, `pay_name`, `pay_fee`, `pay_desc`, `pay_config`, `enabled`, `is_cod`, `is_online`) VALUES
(1, '支付宝', '0', '我们是一个年轻、充满活力的团队， 我们是一家追求成长与成功的公司， 我们从事互联网事业，愿意为之奋斗终身。', '{"cfg_name":"425415842255244","cfg_code":"fw&(fsaG^&&T^GBY11HYG5t^7fs","cfg_id":"5421452357555","cfg_type":"0"}', 1, 0, 1),
(2, '微信支付', '0', '今天来聊聊，android中接入微信支付的需求，肯定有人会说，这多简单呀，还在这里扯什么', '{}', 1, 0, 1),
(3, '货到付款', '0', '货到即付款，不再担心手机里没钱', '{}', 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `cid`, `icon`) VALUES
(5, 'admin.user.manage', '管理员管理', '', '2016-05-27 01:14:31', '2017-02-04 05:50:04', 0, 'fa-users'),
(6, 'admin.permission.index', '权限列表', '', '2016-05-27 01:15:01', '2016-05-27 20:35:05', 5, NULL),
(7, 'admin.permission.create', '添加权限', '', '2016-05-27 01:15:22', '2016-05-27 01:15:22', 5, NULL),
(8, 'admin.permission.edit', '修改权限', '', '2016-05-27 01:15:34', '2016-05-27 01:15:34', 5, NULL),
(9, 'admin.permission.destroy ', '删除权限', '', '2016-05-27 01:15:56', '2016-05-27 01:15:56', 5, NULL),
(11, 'admin.user.index', '用户列表', '', '2016-05-27 02:55:55', '2016-05-27 02:55:55', 5, NULL),
(12, 'admin.user.create', '添加用户', '', '2016-05-27 02:56:10', '2016-05-27 02:56:10', 5, NULL),
(13, 'admin.user.edit', '编辑用户', '', '2016-05-27 02:56:26', '2016-05-27 02:56:26', 5, NULL),
(14, 'admin.user.destroy', '删除用户', '', '2016-05-27 02:56:44', '2016-05-27 02:56:44', 5, NULL),
(15, 'admin.role.index', '角色列表', '', '2016-05-27 02:57:35', '2016-05-27 02:57:35', 5, NULL),
(16, 'admin.role.create', '添加角色', '', '2016-05-27 02:57:53', '2016-05-27 02:57:53', 5, NULL),
(17, 'admin.role.edit', '编辑角色', '', '2016-05-27 02:58:13', '2016-05-27 02:58:13', 5, NULL),
(18, 'admin.role.destroy', '删除角色', '', '2016-05-27 02:58:48', '2016-05-27 02:58:48', 5, NULL),
(19, 'admin.memberLevel.manage', '会员管理', '会员管理', '2017-02-04 05:46:50', '2017-02-04 05:47:12', 0, 'fa-user'),
(20, 'admin.memberLevel.index', '会员等级列表', '', '2017-02-04 05:49:09', '2017-02-04 05:49:09', 19, NULL),
(21, 'admin.goods.manage', '商品管理', '', '2017-02-06 08:36:49', '2017-02-06 08:36:49', 0, 'fa-soccer-ball-o'),
(22, 'admin.brand.index', '品牌列表', '', '2017-02-06 08:37:55', '2017-02-08 10:24:35', 21, NULL),
(23, 'admin.category.index', '商品分类列表', '', '2017-02-08 02:22:06', '2017-02-08 02:22:06', 21, NULL),
(24, 'admin.brand.create', '添加品牌', '', '2017-02-08 10:25:34', '2017-02-08 10:25:34', 21, NULL),
(25, 'admin.brand.edit', '修改品牌', '', '2017-02-08 10:26:18', '2017-02-08 10:26:18', 21, NULL),
(26, 'admin.brand.store', '插入品牌', '', '2017-02-08 10:27:04', '2017-02-08 10:27:04', 21, NULL),
(27, 'admin.brand.update', '更新品牌', '', '2017-02-08 10:27:24', '2017-02-08 10:27:24', 21, NULL),
(28, 'admin.category.create', '添加分类', '', '2017-02-08 10:27:55', '2017-02-08 10:27:55', 21, NULL),
(29, 'admin.category.store', '插入分类', '\r\n', '2017-02-08 10:28:18', '2017-02-08 10:28:18', 21, NULL),
(30, 'admin.category.edit', '修改分类', '', '2017-02-08 10:28:38', '2017-02-08 10:28:38', 21, NULL),
(31, 'admin.category.update', '更新分类', '', '2017-02-08 10:28:52', '2017-02-08 10:28:52', 21, NULL),
(32, 'admin.memberLevel.create', '添加会员等级', '', '2017-02-08 10:32:18', '2017-02-08 10:32:18', 19, NULL),
(33, 'admin.memberLevel.edit', '修改会员等级', '', '2017-02-08 10:32:42', '2017-02-08 10:33:32', 19, NULL),
(34, 'admin.memberLevel.store', '插入会员等级', '', '2017-02-08 10:32:55', '2017-02-08 10:33:44', 19, NULL),
(35, 'admin.memberLevel.update', '更新会员等级', '', '2017-02-08 10:33:07', '2017-02-08 10:34:10', 19, NULL),
(36, 'admin.type.index', '类型列表', '', '2017-02-08 11:16:22', '2017-02-08 11:16:22', 21, NULL),
(37, 'admin.type.create', '添加类型', '', '2017-02-08 11:16:41', '2017-02-08 11:16:41', 21, NULL),
(38, 'admin.type.edit', '修改类型', '', '2017-02-08 11:16:56', '2017-02-08 11:16:56', 21, NULL),
(39, 'admin.type.store', '插入类型', '', '2017-02-08 11:17:09', '2017-02-08 11:17:09', 21, NULL),
(40, 'admin.type.update', '更新类型', '', '2017-02-08 11:17:21', '2017-02-08 11:17:21', 21, NULL),
(41, 'admin.good.index', '商品列表', '', '2017-02-12 02:08:14', '2017-02-12 02:08:14', 21, NULL),
(42, 'admin.good.create', '添加商品', '', '2017-02-12 02:08:37', '2017-02-12 02:08:37', 21, NULL),
(43, 'admin.good.store', '插入商品', '', '2017-02-12 02:08:51', '2017-02-12 02:08:51', 21, NULL),
(44, 'admin.good.edit', '编辑商品', '', '2017-02-12 02:09:05', '2017-02-12 02:09:05', 21, NULL),
(45, 'admin.good.update', '修改商品', '', '2017-02-12 02:09:17', '2017-02-12 02:09:17', 21, NULL),
(46, 'admin.ad.manage', '广告管理', '', '2017-03-20 09:02:00', '2017-03-20 09:02:00', 0, 'fa-bullhorn'),
(47, 'admin.ad.index', '广告列表', '', '2017-03-20 09:03:19', '2017-03-20 09:03:19', 46, NULL),
(48, 'admin.ad.create', '添加广告', '', '2017-03-20 09:03:55', '2017-03-20 09:03:55', 46, NULL),
(49, 'admin.ad.edit', '修改广告', '', '2017-03-20 09:04:26', '2017-03-20 09:04:26', 46, NULL),
(50, 'admin.ad.store', '插入广告', '', '2017-03-20 09:04:52', '2017-03-20 09:04:52', 46, NULL),
(51, 'admin.ad.update', '更新广告', '', '2017-03-20 09:05:17', '2017-03-20 09:05:17', 46, NULL),
(54, 'admin.customer.index', '会员列表', '', '2017-04-16 09:38:31', '2017-04-16 09:38:31', 19, NULL),
(55, 'admin.customer.create', '添加会员', '', '2017-04-16 09:38:55', '2017-04-16 09:38:55', 19, NULL),
(56, 'admin.customer.store', '插入会员', '', '2017-04-16 09:39:14', '2017-04-16 09:39:14', 19, NULL),
(57, 'admin.customer.edit', '修改会员', '', '2017-04-16 09:39:29', '2017-04-16 09:39:29', 19, NULL),
(58, 'admin.customer.update', '更新会员', '', '2017-04-16 09:39:42', '2017-04-16 09:39:42', 19, NULL),
(59, 'admin.order.manage', '订单管理', '', '2017-05-16 08:01:38', '2017-05-16 08:01:38', 0, 'fa-shopping-cart'),
(60, 'admin.order.index', '订单列表', '', '2017-05-16 08:02:11', '2017-05-16 08:02:11', 59, NULL),
(61, 'admin.order.create', '添加订单', '', '2017-05-16 08:07:46', '2017-05-16 08:07:46', 59, NULL),
(62, 'admin.order.store', '插入订单', '', '2017-05-16 08:08:16', '2017-05-16 08:08:16', 59, NULL),
(63, 'admin.order.edit', '编辑订单', '', '2017-05-16 08:08:33', '2017-05-16 08:08:33', 59, NULL),
(64, 'admin.order.update', '修改订单', '', '2017-05-16 08:08:54', '2017-05-16 08:08:54', 59, NULL),
(65, 'admin.order.destroy', '删除订单', '', '2017-05-16 08:09:36', '2017-05-16 08:09:36', 59, NULL),
(66, 'admin.set.manage', '系统设置', '系统设置', '2017-05-17 02:01:33', '2017-05-17 02:01:33', 0, 'fa-gears'),
(67, 'admin.set.payment.index', '支付方式', '', '2017-05-17 02:02:49', '2017-05-17 02:02:49', 66, NULL),
(68, 'admin.set.payment.edit', '支付方式编辑', '', '2017-05-21 04:32:52', '2017-05-21 04:32:52', 66, NULL),
(69, 'admin.set.payment.store', '支付方式更新', '', '2017-05-21 04:33:14', '2017-05-21 04:33:14', 66, NULL),
(70, 'admin.order.operate.update', '订单修改操作', '', '2017-05-21 04:34:09', '2017-05-21 04:34:09', 59, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` tinyint(3) unsigned NOT NULL,
  `type_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `types`
--

INSERT INTO `types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, '电视机', '2017-02-09 01:01:01', '2017-02-09 01:01:01'),
(2, '手机', '2017-02-14 03:28:12', '2017-02-14 03:28:12');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level_id` int(10) unsigned DEFAULT '0' COMMENT '用户对应的会员id',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `password`, `level_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'lisam', '15089271488', '$2y$10$cTgtEGXiLTwaBXYTVjrDuOUGwWpxRe4mafUOSVzj7qFXMSPUIHkqa', 2, 'ZcfOU6dEj2PuDOJVnqpWmqtlgf09YU81gufFUltHOhuAaWVhvypbxs3vofpv', '2017-04-11 09:10:45', '2017-05-21 02:05:54'),
(7, 'wyb', '15142102455', '$2y$10$ta1AzSFOQoUjS5u/oNzmbuPtCShjd0RRet8SOGtR/MRxd9UG0aupO', 0, NULL, '2017-04-16 09:20:12', '2017-04-16 09:20:12');

-- --------------------------------------------------------

--
-- 表的结构 `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户',
  `user_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '省',
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '市',
  `county` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '县',
  `other` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '其他要求',
  `is_selected` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用于判断当前的选中收货地址'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='客户收获地址';

--
-- 转存表中的数据 `user_address`
--

INSERT INTO `user_address` (`id`, `name`, `user_id`, `address`, `mobile`, `province`, `city`, `county`, `other`, `is_selected`) VALUES
(1, '李山', 4, '五邑大学玫瑰园461312', '15089271487', '广东省', '江门市', '台山市', '很强势！！', 1),
(2, '李善', 4, '五邑大学玫瑰园隔壁的461316', '15089271488', '广东省', '惠州市', '惠阳区', '快点就好', 0),
(6, '彬总', 4, '哈哈哈哈哈哈五邑大学', '15089271488', '北京市', '北京市市辖区', '东城区', '在在在在在在在在在在在在在在在在在在在', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_type_id_foreign` (`type_id`),
  ADD KEY `attr_name` (`attr_name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_shop_price_index` (`shop_price`),
  ADD KEY `goods_cat_id_index` (`cat_id`),
  ADD KEY `goods_brand_id_index` (`brand_id`),
  ADD KEY `goods_is_on_sale_index` (`is_on_sale`),
  ADD KEY `goods_is_hot_index` (`is_hot`),
  ADD KEY `goods_is_new_index` (`is_new`),
  ADD KEY `goods_is_best_index` (`is_best`),
  ADD KEY `goods_is_delete_index` (`is_delete`),
  ADD KEY `goods_sort_num_index` (`sort_num`),
  ADD KEY `goods_promote_start_time_index` (`promote_start_time`),
  ADD KEY `goods_promote_end_time_index` (`promote_end_time`),
  ADD KEY `goods_addtime_index` (`addtime`);

--
-- Indexes for table `goods_attrs`
--
ALTER TABLE `goods_attrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_attrs_goods_id_foreign` (`goods_id`),
  ADD KEY `goods_attrs_attr_id_foreign` (`attr_id`);

--
-- Indexes for table `goods_cats`
--
ALTER TABLE `goods_cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_cats_goods_id_foreign` (`goods_id`),
  ADD KEY `goods_cats_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `goods_pics`
--
ALTER TABLE `goods_pics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_pics_goods_id_foreign` (`goods_id`);

--
-- Indexes for table `good_order`
--
ALTER TABLE `good_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_levels`
--
ALTER TABLE `member_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_prices`
--
ALTER TABLE `member_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_prices_goods_id_foreign` (`goods_id`),
  ADD KEY `member_prices_level_id_foreign` (`level_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_num` (`order_num`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_address_id` (`user_address_id`),
  ADD KEY `is_del` (`is_del`);

--
-- Indexes for table `orders_operations`
--
ALTER TABLE `orders_operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`admin_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`mobile`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `goods_attrs`
--
ALTER TABLE `goods_attrs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_cats`
--
ALTER TABLE `goods_cats`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_pics`
--
ALTER TABLE `goods_pics`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `good_order`
--
ALTER TABLE `good_order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `member_levels`
--
ALTER TABLE `member_levels`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member_prices`
--
ALTER TABLE `member_prices`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orders_operations`
--
ALTER TABLE `orders_operations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 限制导出的表
--

--
-- 限制表 `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- 限制表 `goods_attrs`
--
ALTER TABLE `goods_attrs`
  ADD CONSTRAINT `goods_attrs_attr_id_foreign` FOREIGN KEY (`attr_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_attrs_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `goods_cats`
--
ALTER TABLE `goods_cats`
  ADD CONSTRAINT `goods_cats_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_cats_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `goods_pics`
--
ALTER TABLE `goods_pics`
  ADD CONSTRAINT `goods_pics_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `member_prices`
--
ALTER TABLE `member_prices`
  ADD CONSTRAINT `member_prices_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_prices_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `member_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
