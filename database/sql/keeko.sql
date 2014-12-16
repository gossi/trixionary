
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- kk_trixionary_sport
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_sport`;

CREATE TABLE `kk_trixionary_sport`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `slug` VARCHAR(255),
    `skill_slug` VARCHAR(255),
    `skill_label` VARCHAR(255),
    `skill_plural_label` VARCHAR(255),
    `group_slug` VARCHAR(255),
    `group_label` VARCHAR(255),
    `group_plural_label` VARCHAR(255),
    `transitions_slug` VARCHAR(255),
    `transition_label` VARCHAR(255),
    `transition_plural_label` VARCHAR(255),
    `position_slug` VARCHAR(255),
    `position_label` VARCHAR(255),
    `compositional` TINYINT(1) COMMENT 'Whether this is a technical compositional type of sport',
    `is_default` TINYINT(1),
    `movender` VARCHAR(255),
    `has_movendum` TINYINT(1),
    `movendum` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_position
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_position`;

CREATE TABLE `kk_trixionary_position`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `slug` VARCHAR(255),
    `sport_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_position_fi_ff4efb` (`sport_id`),
    CONSTRAINT `kk_trixionary_position_fk_ff4efb`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill`;

CREATE TABLE `kk_trixionary_skill`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `sport_id` INTEGER NOT NULL,
    `name` VARCHAR(255),
    `alternative_name` VARCHAR(255),
    `slug` VARCHAR(255),
    `description` TEXT,
    `history` TEXT,
    `is_translation` TINYINT(1),
    `is_rotation` TINYINT(1),
    `is_cyclic` TINYINT(1),
    `longitudinal_flags` INTEGER,
    `latitudinal_flags` INTEGER,
    `transversal_flags` INTEGER,
    `movement_description` TEXT,
    `variation_of_id` INTEGER COMMENT 'Indicates a variation',
    `start_position_id` INTEGER,
    `end_position_id` INTEGER,
    `is_composite` TINYINT(1),
    `is_multiple` TINYINT(1),
    `multiple_of_id` INTEGER,
    `multiplier` INTEGER,
    `generation` INTEGER,
    `importance` INTEGER,
    `generation_ids` TEXT,
    `picture_id` INTEGER,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_skill_fi_ff4efb` (`sport_id`),
    INDEX `kk_trixionary_skill_fi_e3be95` (`variation_of_id`),
    INDEX `kk_trixionary_skill_fi_e1e91e` (`multiple_of_id`),
    INDEX `kk_trixionary_skill_fi_ed8398` (`start_position_id`),
    INDEX `kk_trixionary_skill_fi_964073` (`end_position_id`),
    INDEX `kk_trixionary_skill_fi_86690d` (`picture_id`),
    CONSTRAINT `kk_trixionary_skill_fk_ff4efb`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE RESTRICT,
    CONSTRAINT `kk_trixionary_skill_fk_e3be95`
        FOREIGN KEY (`variation_of_id`)
        REFERENCES `kk_trixionary_skill` (`id`),
    CONSTRAINT `kk_trixionary_skill_fk_e1e91e`
        FOREIGN KEY (`multiple_of_id`)
        REFERENCES `kk_trixionary_skill` (`id`),
    CONSTRAINT `kk_trixionary_skill_fk_ed8398`
        FOREIGN KEY (`start_position_id`)
        REFERENCES `kk_trixionary_position` (`id`),
    CONSTRAINT `kk_trixionary_skill_fk_964073`
        FOREIGN KEY (`end_position_id`)
        REFERENCES `kk_trixionary_position` (`id`),
    CONSTRAINT `kk_trixionary_skill_fk_86690d`
        FOREIGN KEY (`picture_id`)
        REFERENCES `kk_trixionary_picture` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_dependency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_dependency`;

CREATE TABLE `kk_trixionary_skill_dependency`
(
    `skill_id` INTEGER NOT NULL,
    `depends_id` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`depends_id`),
    INDEX `kk_trixionary_skill_dependency_fi_e7a2d5` (`depends_id`),
    CONSTRAINT `kk_trixionary_skill_dependency_fk_e7a2d5`
        FOREIGN KEY (`depends_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE RESTRICT,
    CONSTRAINT `kk_trixionary_skill_dependency_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_part
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_part`;

CREATE TABLE `kk_trixionary_skill_part`
(
    `composite_id` INTEGER NOT NULL,
    `part_id` INTEGER NOT NULL,
    PRIMARY KEY (`composite_id`,`part_id`),
    INDEX `kk_trixionary_skill_part_fi_e530c3` (`part_id`),
    CONSTRAINT `kk_trixionary_skill_part_fk_e530c3`
        FOREIGN KEY (`part_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE RESTRICT,
    CONSTRAINT `kk_trixionary_skill_part_fk_2d2ee6`
        FOREIGN KEY (`composite_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_group`;

CREATE TABLE `kk_trixionary_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `description` TEXT,
    `slug` VARCHAR(255),
    `sport_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_group_fi_ff4efb` (`sport_id`),
    CONSTRAINT `kk_trixionary_group_fk_ff4efb`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_group`;

CREATE TABLE `kk_trixionary_skill_group`
(
    `skill_id` INTEGER NOT NULL,
    `group_id` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`group_id`),
    INDEX `kk_trixionary_skill_group_fi_b8c14a` (`group_id`),
    CONSTRAINT `kk_trixionary_skill_group_fk_b8c14a`
        FOREIGN KEY (`group_id`)
        REFERENCES `kk_trixionary_group` (`id`)
        ON DELETE RESTRICT,
    CONSTRAINT `kk_trixionary_skill_group_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_picture
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_picture`;

CREATE TABLE `kk_trixionary_picture`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `description` TEXT,
    `skill_id` INTEGER NOT NULL,
    `photographer` VARCHAR(255),
    `photographer_id` INTEGER,
    `movender` VARCHAR(255),
    `movender_id` INTEGER,
    `uploader_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_picture_fi_3713ea` (`skill_id`),
    CONSTRAINT `kk_trixionary_picture_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_video
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_video`;

CREATE TABLE `kk_trixionary_video`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `description` TEXT,
    `is_tutorial` TINYINT(1),
    `movender` VARCHAR(255),
    `movender_id` INTEGER,
    `uploader_id` INTEGER,
    `skill_id` INTEGER NOT NULL,
    `reference_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_video_fi_3713ea` (`skill_id`),
    INDEX `kk_trixionary_video_fi_231192` (`reference_id`),
    CONSTRAINT `kk_trixionary_video_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`),
    CONSTRAINT `kk_trixionary_video_fk_231192`
        FOREIGN KEY (`reference_id`)
        REFERENCES `kk_trixionary_reference` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_reference
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_reference`;

CREATE TABLE `kk_trixionary_reference`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255),
    `skill_id` INTEGER NOT NULL,
    `title` VARCHAR(255),
    `year` INTEGER,
    `publisher` VARCHAR(255),
    `journal` VARCHAR(255),
    `number` VARCHAR(255),
    `school` VARCHAR(255),
    `author` VARCHAR(255),
    `edition` VARCHAR(255),
    `volume` VARCHAR(255),
    `address` VARCHAR(255),
    `editor` VARCHAR(255),
    `howpublished` VARCHAR(255),
    `note` VARCHAR(255),
    `booktitle` VARCHAR(255),
    `pages` VARCHAR(255),
    `url` VARCHAR(255),
    `lastchecked` DATE,
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_reference_fi_3713ea` (`skill_id`),
    CONSTRAINT `kk_trixionary_reference_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_kk_trixionary_skill_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_kk_trixionary_skill_version`;

CREATE TABLE `kk_trixionary_kk_trixionary_skill_version`
(
    `id` INTEGER NOT NULL,
    `sport_id` INTEGER NOT NULL,
    `name` VARCHAR(255),
    `alternative_name` VARCHAR(255),
    `slug` VARCHAR(255),
    `description` TEXT,
    `history` TEXT,
    `is_translation` TINYINT(1),
    `is_rotation` TINYINT(1),
    `is_cyclic` TINYINT(1),
    `longitudinal_flags` INTEGER,
    `latitudinal_flags` INTEGER,
    `transversal_flags` INTEGER,
    `movement_description` TEXT,
    `variation_of_id` INTEGER COMMENT 'Indicates a variation',
    `start_position_id` INTEGER,
    `end_position_id` INTEGER,
    `is_composite` TINYINT(1),
    `is_multiple` TINYINT(1),
    `multiple_of_id` INTEGER,
    `multiplier` INTEGER,
    `generation` INTEGER,
    `importance` INTEGER,
    `generation_ids` TEXT,
    `picture_id` INTEGER,
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` DATETIME,
    `version_comment` VARCHAR(255),
    `variation_of_id_version` INTEGER DEFAULT 0,
    `multiple_of_id_version` INTEGER DEFAULT 0,
    `kk_trixionary_skill_ids` TEXT,
    `kk_trixionary_skill_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `kk_trixionary_kk_trixionary_skill_version_fk_717d45`
        FOREIGN KEY (`id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
