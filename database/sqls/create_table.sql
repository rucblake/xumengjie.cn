CREATE TABLE `indices` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `key` VARCHAR(255) NOT NULL DEFAULT '',
  `value` VARCHAR(255) NOT NULL DEFAULT '',
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;

CREATE TABLE `articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `desc` VARCHAR(255) NOT NULL DEFAULT '',
  `content` LONGBLOB,
  `ext` BLOB,
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;

CREATE TABLE `videos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `desc` VARCHAR(255) NOT NULL DEFAULT '',
  `url` VARCHAR(255) NOT NULL DEFAULT '',
  `from` VARCHAR(255) NOT NULL DEFAULT '',
  `attachments` VARCHAR(255) NOT NULL DEFAULT '',
  `type` TINYINT(4) NOT NULL DEFAULT 0,
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `ext` BLOB,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;

CREATE TABLE `news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `desc` VARCHAR(255) NOT NULL DEFAULT '',
  `url` VARCHAR(255) NOT NULL DEFAULT '',
  `from` VARCHAR(255) NOT NULL DEFAULT '',
  `attachments` VARCHAR(255) NOT NULL DEFAULT '',
  `type` TINYINT(4) NOT NULL DEFAULT 0,
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `ext` BLOB,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;

CREATE TABLE `images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hash_key` VARCHAR(255) NOT NULL DEFAULT '',
  `md5` VARCHAR(255) NOT NULL DEFAULT '',
  `url` VARCHAR(255) NOT NULL DEFAULT '',
  `origin_name` VARCHAR(255) NOT NULL DEFAULT '',
  `width` VARCHAR(255) NOT NULL DEFAULT '',
  `height` TINYINT(4) NOT NULL DEFAULT 0,
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `ext` BLOB,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;

CREATE TABLE `weibo_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL DEFAULT '',
  `password` VARCHAR(255) NOT NULL DEFAULT '',
  `cookie` VARCHAR(255) NOT NULL DEFAULT '',
  `login_at` VARCHAR(255) NOT NULL DEFAULT '',
  `status` TINYINT(4) NOT NULL DEFAULT 1,
  `ext` BLOB,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB,
CHARACTER SET = utf8mb4 ;