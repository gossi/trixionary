
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
    `athlete_label` VARCHAR(255),
    `object_slug` VARCHAR(255),
    `object_label` VARCHAR(255),
    `object_plural_label` VARCHAR(255),
    `skill_slug` VARCHAR(255),
    `skill_label` VARCHAR(255),
    `skill_plural_label` VARCHAR(255),
    `skill_picture_url` VARCHAR(255),
    `group_slug` VARCHAR(255),
    `group_label` VARCHAR(255),
    `group_plural_label` VARCHAR(255),
    `transition_label` VARCHAR(255),
    `transition_plural_label` VARCHAR(255),
    `transitions_slug` VARCHAR(255),
    `position_slug` VARCHAR(255),
    `position_label` VARCHAR(255),
    `feature_composition` TINYINT(1) DEFAULT 0,
    `feature_tester` TINYINT(1) DEFAULT 0,
    `is_default` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_object
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_object`;

CREATE TABLE `kk_trixionary_object`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `slug` VARCHAR(255),
    `fixed` TINYINT(1) DEFAULT 1,
    `description` TEXT,
    `sport_id` INTEGER NOT NULL,
    `skill_count` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `object_fi_sport` (`sport_id`),
    CONSTRAINT `object_fk_sport`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE CASCADE
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
    `description` TEXT,
    PRIMARY KEY (`id`),
    INDEX `position_fi_sport` (`sport_id`),
    CONSTRAINT `position_fk_sport`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE CASCADE
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
    `is_translation` TINYINT(1) DEFAULT 0,
    `is_rotation` TINYINT(1) DEFAULT 0,
    `is_acyclic` TINYINT(1) DEFAULT 0,
    `is_cyclic` TINYINT(1) DEFAULT 0,
    `longitudinal_flags` INTEGER,
    `latitudinal_flags` INTEGER,
    `transversal_flags` INTEGER,
    `movement_description` TEXT,
    `sequence_picture_url` VARCHAR(255),
    `variation_of_id` INTEGER COMMENT 'Indicates a variation',
    `start_position_id` INTEGER,
    `end_position_id` INTEGER,
    `is_composite` TINYINT(1) DEFAULT 0 COMMENT 'This skill is a composite',
    `is_multiple` TINYINT(1) DEFAULT 0 COMMENT 'This skill is a multiplier',
    `multiple_of_id` INTEGER,
    `multiplier` INTEGER,
    `generation` INTEGER,
    `importance` INTEGER DEFAULT 0,
    `picture_id` INTEGER,
    `video_id` INTEGER,
    `tutorial_id` INTEGER,
    `kstruktur_id` INTEGER,
    `function_phase_id` INTEGER,
    `object_id` INTEGER,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `skill_fi_sport` (`sport_id`),
    INDEX `skill_fi_variation` (`variation_of_id`),
    INDEX `skill_fi_multiple` (`multiple_of_id`),
    INDEX `skill_fi_object` (`object_id`),
    INDEX `skill_fi_start_position` (`start_position_id`),
    INDEX `skill_fi_end_position` (`end_position_id`),
    INDEX `skill_fi_featured_picture` (`picture_id`),
    INDEX `skill_fi_featured_video` (`video_id`),
    INDEX `skill_fi_featured_tutorial` (`tutorial_id`),
    INDEX `skill_fi_kstruktur` (`kstruktur_id`),
    INDEX `skill_fi_function_phase` (`function_phase_id`),
    CONSTRAINT `skill_fk_sport`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_fk_variation`
        FOREIGN KEY (`variation_of_id`)
        REFERENCES `kk_trixionary_skill` (`id`),
    CONSTRAINT `skill_fk_multiple`
        FOREIGN KEY (`multiple_of_id`)
        REFERENCES `kk_trixionary_skill` (`id`),
    CONSTRAINT `skill_fk_object`
        FOREIGN KEY (`object_id`)
        REFERENCES `kk_trixionary_object` (`id`),
    CONSTRAINT `skill_fk_start_position`
        FOREIGN KEY (`start_position_id`)
        REFERENCES `kk_trixionary_position` (`id`),
    CONSTRAINT `skill_fk_end_position`
        FOREIGN KEY (`end_position_id`)
        REFERENCES `kk_trixionary_position` (`id`),
    CONSTRAINT `skill_fk_featured_picture`
        FOREIGN KEY (`picture_id`)
        REFERENCES `kk_trixionary_picture` (`id`)
        ON DELETE SET NULL,
    CONSTRAINT `skill_fk_featured_video`
        FOREIGN KEY (`video_id`)
        REFERENCES `kk_trixionary_video` (`id`)
        ON DELETE SET NULL,
    CONSTRAINT `skill_fk_featured_tutorial`
        FOREIGN KEY (`tutorial_id`)
        REFERENCES `kk_trixionary_video` (`id`)
        ON DELETE SET NULL,
    CONSTRAINT `skill_fk_kstruktur`
        FOREIGN KEY (`kstruktur_id`)
        REFERENCES `kk_trixionary_kstruktur` (`id`),
    CONSTRAINT `skill_fk_function_phase`
        FOREIGN KEY (`function_phase_id`)
        REFERENCES `kk_trixionary_function_phase` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_lineage
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_lineage`;

CREATE TABLE `kk_trixionary_lineage`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `skill_id` INTEGER NOT NULL,
    `ancestor_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `lineage_fi_skill` (`skill_id`),
    INDEX `lineage_fi_ancestor` (`ancestor_id`),
    CONSTRAINT `lineage_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `lineage_fk_ancestor`
        FOREIGN KEY (`ancestor_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_dependency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_dependency`;

CREATE TABLE `kk_trixionary_skill_dependency`
(
    `dependency_id` INTEGER NOT NULL,
    `parent_id` INTEGER NOT NULL,
    PRIMARY KEY (`dependency_id`,`parent_id`),
    INDEX `skill_dependency_fi_parent` (`parent_id`),
    CONSTRAINT `skill_dependency_fk_skill`
        FOREIGN KEY (`dependency_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_dependency_fk_parent`
        FOREIGN KEY (`parent_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_part
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_part`;

CREATE TABLE `kk_trixionary_skill_part`
(
    `part_id` INTEGER NOT NULL,
    `composite_id` INTEGER NOT NULL,
    PRIMARY KEY (`part_id`,`composite_id`),
    INDEX `skill_part_fi_composite` (`composite_id`),
    CONSTRAINT `skill_part_fk_part`
        FOREIGN KEY (`part_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_part_fk_composite`
        FOREIGN KEY (`composite_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
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
    `skill_count` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `group_fi_sport` (`sport_id`),
    CONSTRAINT `group_fk_sport`
        FOREIGN KEY (`sport_id`)
        REFERENCES `kk_trixionary_sport` (`id`)
        ON DELETE CASCADE
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
    INDEX `skill_group_fi_group` (`group_id`),
    CONSTRAINT `skill_group_fk_group`
        FOREIGN KEY (`group_id`)
        REFERENCES `kk_trixionary_group` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_group_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
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
    `url` VARCHAR(255),
    `thumb_url` VARCHAR(255),
    `skill_id` INTEGER NOT NULL,
    `photographer` VARCHAR(255),
    `photographer_id` INTEGER,
    `athlete` VARCHAR(255),
    `athlete_id` INTEGER,
    `uploader_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `picture_fi_skill` (`skill_id`),
    CONSTRAINT `picture_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
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
    `url` VARCHAR(255),
    `is_tutorial` TINYINT(1),
    `athlete` VARCHAR(255),
    `athlete_id` INTEGER,
    `uploader_id` INTEGER,
    `skill_id` INTEGER NOT NULL,
    `reference_id` INTEGER,
    `poster_url` VARCHAR(255),
    `provider` VARCHAR(255),
    `provider_id` VARCHAR(255),
    `player_url` VARCHAR(255),
    `width` INTEGER,
    `height` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `video_fi_skill` (`skill_id`),
    INDEX `video_fi_reference` (`reference_id`),
    CONSTRAINT `video_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `video_fk_reference`
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
    `managed` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_reference
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_reference`;

CREATE TABLE `kk_trixionary_skill_reference`
(
    `skill_id` INTEGER NOT NULL,
    `reference_id` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`reference_id`),
    INDEX `skill_reference_fi_reference` (`reference_id`),
    CONSTRAINT `skill_reference_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_reference_fk_reference`
        FOREIGN KEY (`reference_id`)
        REFERENCES `kk_trixionary_reference` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_structure_node
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_structure_node`;

CREATE TABLE `kk_trixionary_structure_node`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(255),
    `skill_id` INTEGER NOT NULL,
    `title` VARCHAR(255),
    `descendant_class` VARCHAR(100),
    PRIMARY KEY (`id`),
    INDEX `structure_node_fi_skill` (`skill_id`),
    CONSTRAINT `structure_node_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_structure_node_parent
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_structure_node_parent`;

CREATE TABLE `kk_trixionary_structure_node_parent`
(
    `structure_node_id` INTEGER NOT NULL,
    `parent_id` INTEGER NOT NULL,
    PRIMARY KEY (`structure_node_id`,`parent_id`),
    INDEX `structure_node_parent_fi_parent` (`parent_id`),
    CONSTRAINT `structure_node_parent_fk_node`
        FOREIGN KEY (`structure_node_id`)
        REFERENCES `kk_trixionary_structure_node` (`id`),
    CONSTRAINT `structure_node_parent_fk_parent`
        FOREIGN KEY (`parent_id`)
        REFERENCES `kk_trixionary_structure_node` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_kstruktur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_kstruktur`;

CREATE TABLE `kk_trixionary_kstruktur`
(
    `id` INTEGER NOT NULL,
    `type` VARCHAR(255),
    `skill_id` INTEGER NOT NULL,
    `title` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_kstruktur_i_b22279` (`skill_id`),
    CONSTRAINT `kk_trixionary_kstruktur_fk_d85fca`
        FOREIGN KEY (`id`)
        REFERENCES `kk_trixionary_structure_node` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `kk_trixionary_kstruktur_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_function_phase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_function_phase`;

CREATE TABLE `kk_trixionary_function_phase`
(
    `id` INTEGER NOT NULL,
    `type` VARCHAR(255),
    `skill_id` INTEGER NOT NULL,
    `title` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `kk_trixionary_function_phase_i_b22279` (`skill_id`),
    CONSTRAINT `kk_trixionary_function_phase_fk_d85fca`
        FOREIGN KEY (`id`)
        REFERENCES `kk_trixionary_structure_node` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `kk_trixionary_function_phase_fk_3713ea`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kk_trixionary_skill_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kk_trixionary_skill_version`;

CREATE TABLE `kk_trixionary_skill_version`
(
    `id` INTEGER NOT NULL,
    `sport_id` INTEGER NOT NULL,
    `name` VARCHAR(255),
    `alternative_name` VARCHAR(255),
    `slug` VARCHAR(255),
    `description` TEXT,
    `history` TEXT,
    `is_translation` TINYINT(1) DEFAULT 0,
    `is_rotation` TINYINT(1) DEFAULT 0,
    `is_acyclic` TINYINT(1) DEFAULT 0,
    `is_cyclic` TINYINT(1) DEFAULT 0,
    `longitudinal_flags` INTEGER,
    `latitudinal_flags` INTEGER,
    `transversal_flags` INTEGER,
    `movement_description` TEXT,
    `sequence_picture_url` VARCHAR(255),
    `variation_of_id` INTEGER COMMENT 'Indicates a variation',
    `start_position_id` INTEGER,
    `end_position_id` INTEGER,
    `is_composite` TINYINT(1) DEFAULT 0 COMMENT 'This skill is a composite',
    `is_multiple` TINYINT(1) DEFAULT 0 COMMENT 'This skill is a multiplier',
    `multiple_of_id` INTEGER,
    `multiplier` INTEGER,
    `generation` INTEGER,
    `importance` INTEGER DEFAULT 0,
    `picture_id` INTEGER,
    `video_id` INTEGER,
    `tutorial_id` INTEGER,
    `kstruktur_id` INTEGER,
    `function_phase_id` INTEGER,
    `object_id` INTEGER,
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` DATETIME,
    `version_comment` VARCHAR(255),
    `variation_of_id_version` INTEGER DEFAULT 0,
    `multiple_of_id_version` INTEGER DEFAULT 0,
    `kk_trixionary_skill_ids` TEXT,
    `kk_trixionary_skill_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `kk_trixionary_skill_version_fk_717d45`
        FOREIGN KEY (`id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
