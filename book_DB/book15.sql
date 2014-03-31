SET SESSION FOREIGN_KEY_CHECKS=0;


/* Create Tables */

CREATE TABLE USER
(
	-- ユーザーid
	ID INT(11) NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'id : ユーザーid',
	NAME VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ユーザー名',
	PASS VARCHAR(256) NOT NULL COMMENT 'pass',
	CREATED DATE NOT NULL COMMENT '登録された日',
	PRIMARY KEY (ID)
) COMMENT = 'ユーザー情報';


CREATE TABLE REQUEST
(
	ID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
	USER_ID VARCHAR(256) COMMENT 'user_id',
	REQUEST_TIME DATETIME NOT NULL COMMENT 'request_time',
	ADD_TIME DATETIME NOT NULL COMMENT 'add_time',
	BOOK_ID INT(11) NOT NULL COMMENT 'book_id',
	STATUS INT(11) COMMENT 'STATUS',
	PRIMARY KEY (ID)
) COMMENT = 'リクエスト';


CREATE TABLE INFO
(
	ID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
	USER_ID VARCHAR(256) COMMENT 'user_id',
	WRITE_TIME DATETIME NOT NULL COMMENT '時間',
	COMMENT VARCHAR(256) COMMENT 'comment',
	BOOK_ID INT(11) COMMENT 'book_id',
	STATUS INT(11) COMMENT 'status',
	DEVICE_ID INT(11) COMMENT 'device_id',
	PRIMARY KEY (ID)
) COMMENT = '更新状況';


CREATE TABLE BOARD
(
	ID INT(11) NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'id',
	COMMENT VARCHAR(256) NOT NULL COMMENT 'comment',
	WRITE_TIME DATETIME NOT NULL COMMENT 'write_time',
	COMMENT_TYPE VARCHAR(256) NOT NULL COMMENT 'comment_type',
	USER_ID VARCHAR(256) NOT NULL COMMENT 'user_id',
	PRIMARY KEY (ID)
) COMMENT = '掲示板';


CREATE TABLE BOOK
(
	ID INT(11) NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'id',
	BOOK_NAME VARCHAR(256) NOT NULL COMMENT 'book_name',
	LINK VARCHAR(256) COMMENT 'アマゾンへのリンク',
	PUBLISHER VARCHAR(256) NOT NULL COMMENT '出版社',
	AUTHOR_NAME VARCHAR(256) NOT NULL COMMENT '著者名',
	BOOK_COUNTER INT(11) DEFAULT 0 COMMENT '貸し出し回数',
	BOOK_NUMBER INT(11) NOT NULL COMMENT '本の数',
	RENT_NUM INT(11) DEFAULT 0 COMMENT 'rent_num',
	ISBN VARCHAR(256) COMMENT 'ISBN',
	BOOK_CONT VARCHAR(255) COMMENT '内容説明',
	BOOK_PURCHASE VARCHAR(256) COMMENT 'book_purchase',
	PRIMARY KEY (ID)
) COMMENT = '本';


CREATE TABLE KASIDASI
(
	ID INT(11) NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'id',
	-- ユーザーid
	USER_ID INT(11) NOT NULL COMMENT 'user_id : ユーザーid',
	BOOK_ID INT(11) COMMENT 'book_id',
	DEVICE_ID INT(11) COMMENT 'device_id',
	BORROW_TIME DATE NOT NULL COMMENT 'borrow_time',
	STATUS INT(11) DEFAULT 0 COMMENT 'ユーザーの貸し出し履歴',
	RETURN_TIME DATE NOT NULL COMMENT 'return_time',
	PRIMARY KEY (ID)
) COMMENT = '貸し出し';


CREATE TABLE DEVICE
(
	ID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
	ASSET VARCHAR(256) COMMENT 'asset',
	MANUFACTURE VARCHAR(256) COMMENT 'manufacture',
	SERIAL VARCHAR(256) COMMENT 'serial',
	OS_VERSION VARCHAR(256) COMMENT 'os_version',
	CPU VARCHAR(256) COMMENT 'cpu',
	MEMORY VARCHAR(256) COMMENT 'memory',
	STRAGE VARCHAR(256) COMMENT 'strage',
	WIFI VARCHAR(256) COMMENT 'wifi',
	VM_WARE VARCHAR(256) COMMENT 'vm_ware',
	VM_LISENCE VARCHAR(256) COMMENT 'vm_lisence',
	MS_OFFICE VARCHAR(256) COMMENT 'ms_office',
	NOTE VARCHAR(256) COMMENT 'note',
	DEVICE_PURCHASE VARCHAR(256) COMMENT 'device_purchase',
	PRIMARY KEY (ID)
) COMMENT = 'デバイス';


CREATE TABLE DEVICE_CATEGORY
(
	ID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
	NAME VARCHAR(256) COMMENT 'name',
	DEVICE_ID INT(11) COMMENT 'device_id',
	PRIMARY KEY (ID)
) COMMENT = '新規テーブル';


CREATE TABLE CATEGORY
(
	ID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'カテゴリid',
	NAME VARCHAR(256) COMMENT 'name',
	BOOK_ID INT(11) COMMENT 'book_id',
	PRIMARY KEY (ID)
) COMMENT = 'カテゴリ';



/* Create Foreign Keys */

ALTER TABLE KASIDASI
	ADD FOREIGN KEY (USER_ID)
	REFERENCES USER (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE INFO
	ADD FOREIGN KEY (BOOK_ID)
	REFERENCES BOOK (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE CATEGORY
	ADD FOREIGN KEY (BOOK_ID)
	REFERENCES BOOK (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE REQUEST
	ADD FOREIGN KEY (BOOK_ID)
	REFERENCES BOOK (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE KASIDASI
	ADD FOREIGN KEY (BOOK_ID)
	REFERENCES BOOK (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE DEVICE_CATEGORY
	ADD FOREIGN KEY (DEVICE_ID)
	REFERENCES DEVICE (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE INFO
	ADD FOREIGN KEY (DEVICE_ID)
	REFERENCES DEVICE (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;


ALTER TABLE KASIDASI
	ADD FOREIGN KEY (DEVICE_ID)
	REFERENCES DEVICE (ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;



