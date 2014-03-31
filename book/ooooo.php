-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2014 年 1 月 06 日 13:38
-- サーバのバージョン: 5.5.29
-- PHP のバージョン: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `bbb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `BOOK`
--

CREATE TABLE `BOOK` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `BOOK_NAME` varchar(256) NOT NULL COMMENT 'book_name',
  `LINK` varchar(256) DEFAULT NULL COMMENT 'アマゾンへのリンク',
  `PUBLISHER` varchar(256) NOT NULL COMMENT '出版社',
  `AUTHOR_NAME` varchar(256) NOT NULL COMMENT '著者名',
  `BOOK_COUNTER` int(11) DEFAULT '0' COMMENT '貸し出し回数',
  `BOOK_NUMBER` int(11) NOT NULL COMMENT '本の数',
  `RENT_NUM` int(11) DEFAULT '0' COMMENT 'rent_num',
  `ISBN` varchar(256) DEFAULT NULL COMMENT 'ISBN',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='本' AUTO_INCREMENT=6 ;

--
-- テーブルのデータのダンプ `BOOK`
--

INSERT INTO `BOOK` (`ID`, `BOOK_NAME`, `LINK`, `PUBLISHER`, `AUTHOR_NAME`, `BOOK_COUNTER`, `BOOK_NUMBER`, `RENT_NUM`, `ISBN`) VALUES
(1, 'AR入門', 'http://www.amazon.co.jp/dp/4777515613', '工学社', '佐野 彰', 4, 3, 2, '1111'),
(2, 'ThinkStats-プログラマのための統計入門', 'http://books.google.co.jp/books?id=PHiwMQEACAAJ&dq=9784873115726&hl=ja&sa=X&ei=myaoUpTjK4bPlAWJr4CYAw&redir_esc=y', 'オライリー・ジャパン', 'Allen B. Downey', 4, 2, 2, '9784873115726'),
(3, 'jQuery＋CSSフレームワークでサクサクつくる「動き」と「仕掛け」 実践Webデザイン', 'http://store.shopping.yahoo.co.jp/guruguru/9784844363576.html', 'エムディエヌコーポレーション', '共著 アルディート', 1, 1, 1, '9784844363576'),
(4, '「タッチパネル」のゲームデザイン――アプリやゲームをおもしろくするテクニック', 'http://www.oreilly.co.jp/books/9784873116204/', 'オライリー・ジャパン', 'Scott Rogers', 1, 1, 1, '9784873116204'),
(5, 'HTML5とJavaScriptによるiPhone／Android両対応アプリ開', 'http://books.rakuten.co.jp/rb/12241103/', '翔泳社', '大友聡之/坂手寛', 0, 1, 0, '9784798129686');
