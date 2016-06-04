<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1464951416.
 * Generated on 2016-06-03 12:56:56 by thomas
 */
class PropelMigration_1464951416
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'trixionary' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `kk_trixionary_object`

  ADD `fixed` TINYINT(1) AFTER `slug`;

ALTER TABLE `kk_trixionary_skill_dependency` DROP FOREIGN KEY `skill_dependency_fk_skill`;

ALTER TABLE `kk_trixionary_skill_dependency`

  DROP PRIMARY KEY,

  CHANGE `id` `dependency_id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`dependency_id`,`parent_id`);

ALTER TABLE `kk_trixionary_skill_dependency` ADD CONSTRAINT `skill_dependency_fk_skill`
    FOREIGN KEY (`dependency_id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `kk_trixionary_skill_part` DROP FOREIGN KEY `skill_part_fk_part`;

ALTER TABLE `kk_trixionary_skill_part`

  DROP PRIMARY KEY,

  CHANGE `id` `part_id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`part_id`,`composite_id`);

ALTER TABLE `kk_trixionary_skill_part` ADD CONSTRAINT `skill_part_fk_part`
    FOREIGN KEY (`part_id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `kk_trixionary_sport`

  ADD `object_plural_label` VARCHAR(255) AFTER `object_label`;

ALTER TABLE `kk_trixionary_structure_node_parent` DROP FOREIGN KEY `structure_node_parent_fk_node`;

ALTER TABLE `kk_trixionary_structure_node_parent`

  DROP PRIMARY KEY,

  CHANGE `id` `structure_node_id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`structure_node_id`,`parent_id`);

ALTER TABLE `kk_trixionary_structure_node_parent` ADD CONSTRAINT `structure_node_parent_fk_node`
    FOREIGN KEY (`structure_node_id`)
    REFERENCES `kk_trixionary_structure_node` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'trixionary' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `kk_trixionary_object`

  DROP `fixed`;

ALTER TABLE `kk_trixionary_skill_dependency` DROP FOREIGN KEY `skill_dependency_fk_skill`;

ALTER TABLE `kk_trixionary_skill_dependency`

  DROP PRIMARY KEY,

  CHANGE `dependency_id` `id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`id`,`parent_id`);

ALTER TABLE `kk_trixionary_skill_dependency` ADD CONSTRAINT `skill_dependency_fk_skill`
    FOREIGN KEY (`id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `kk_trixionary_skill_part` DROP FOREIGN KEY `skill_part_fk_part`;

ALTER TABLE `kk_trixionary_skill_part`

  DROP PRIMARY KEY,

  CHANGE `part_id` `id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`id`,`composite_id`);

ALTER TABLE `kk_trixionary_skill_part` ADD CONSTRAINT `skill_part_fk_part`
    FOREIGN KEY (`id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `kk_trixionary_sport`

  DROP `object_plural_label`;

ALTER TABLE `kk_trixionary_structure_node_parent` DROP FOREIGN KEY `structure_node_parent_fk_node`;

ALTER TABLE `kk_trixionary_structure_node_parent`

  DROP PRIMARY KEY,

  CHANGE `structure_node_id` `id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`id`,`parent_id`);

ALTER TABLE `kk_trixionary_structure_node_parent` ADD CONSTRAINT `structure_node_parent_fk_node`
    FOREIGN KEY (`id`)
    REFERENCES `kk_trixionary_structure_node` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}