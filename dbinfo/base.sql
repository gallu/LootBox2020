-- 
CREATE TABLE users (
    user_id SERIAL,
    pc_name VARCHAR(64) NOT NULL,
    email VARBINARY(254) NOT NULL UNIQUE KEY,
    pw VARCHAR(256) NOT NULL,
    PRIMARY KEY (user_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが1ユーザを意味するテーブル';
-- 
CREATE TABLE cards (
    card_id BIGINT UNSIGNED NOT NULL UNIQUE ,
    card_name VARCHAR(64) NOT NULL COMMENT 'カード名',
    card_type VARCHAR(64) NOT NULL COMMENT 'カードタイプ',
    card_text TEXT NOT NULL COMMENT 'カードテキスト',
    card_illustrator VARCHAR(64) NOT NULL COMMENT 'イラスト',
    PRIMARY KEY (card_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが1枚のカード情報を意味するテーブル';
-- 
CREATE TABLE gachas (
    gacha_id BIGINT UNSIGNED NOT NULL UNIQUE ,
    gacha_name VARCHAR(64) NOT NULL COMMENT 'がちゃ名',
    gacha_number TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '引ける枚数',
    gacha_cost VARBINARY(256) NOT NULL COMMENT 'コスト(マクロ)',
    gacha_from DATETIME NOT NULL COMMENT 'がちゃ可能期間 from',
    gacha_to DATETIME NOT NULL COMMENT 'がちゃ可能期間 to',
    PRIMARY KEY (gacha_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1setのがちゃ」を意味するテーブル';
-- 
CREATE TABLE gacha_details (
    gacha_id BIGINT UNSIGNED NOT NULL COMMENT 'どのがちゃの情報なのか',
    card_id BIGINT UNSIGNED NOT NULL COMMENT 'どのカードなのか',
    gacha_probability INT UNSIGNED NOT NULL COMMENT '確率',
    -- 
    CONSTRAINT gacha_details_gacha_id FOREIGN KEY (gacha_id) REFERENCES gachas (gacha_id),
    CONSTRAINT gacha_details_card_id FOREIGN KEY (card_id) REFERENCES cards (card_id),
    INDEX gacha_id_idx (gacha_id),
    PRIMARY KEY (gacha_id, card_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1setのがちゃで引ける1枚のカード」を意味するテーブル';

-- 
/*
1	250
1	250
 */
DROP TABLE user_card_1;
CREATE TABLE user_card_1 (
    user_card_1_id SERIAL,
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'どのユーザの所持物なのか',
    card_id BIGINT UNSIGNED NOT NULL COMMENT 'どのカードなのか',
    created_at DATETIME NOT NULL ,
    CONSTRAINT user_card_1_user_id FOREIGN KEY (user_id) REFERENCES users (user_id),
    CONSTRAINT user_card_1_card_id FOREIGN KEY (card_id) REFERENCES cards (card_id),
    INDEX user_id_idx (user_id),
    PRIMARY KEY (user_card_1_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1ユーザが引いた1枚のカード」を意味するテーブル';

/*
1	250	2
 */
CREATE TABLE user_card_2 (
    user_id BIGINT UNSIGNED NOT NULL COMMENT 'どのユーザの所持物なのか',
    card_id BIGINT UNSIGNED NOT NULL COMMENT 'どのカードなのか',
    num INT UNSIGNED NOT NULL COMMENT '何枚持っているか',
    created_at DATETIME NOT NULL ,
    updated_at DATETIME NOT NULL ,
    CONSTRAINT user_card_2_user_id FOREIGN KEY (user_id) REFERENCES users (user_id),
    CONSTRAINT user_card_2_card_id FOREIGN KEY (card_id) REFERENCES cards (card_id),
    INDEX user_id_idx (user_id),
    PRIMARY KEY (user_id, card_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1ユーザが引いた1種類のカード」を意味するテーブル';

-- 
CREATE TABLE daily_gacha (
    user_id BIGINT UNSIGNED NOT NULL ,
    CONSTRAINT daily_gacha_user_id FOREIGN KEY (user_id) REFERENCES users (user_id),
    PRIMARY KEY (user_id)
)CHARACTER SET 'utf8mb4', COMMENT='1レコードが「1日のデイリーガチャの記録」を意味するテーブル';


