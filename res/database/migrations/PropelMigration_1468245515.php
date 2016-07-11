<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1468245515.
 * Generated on 2016-07-11 15:58:35 by thomas
 */
class PropelMigration_1468245515
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
  'keeko' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_picture`;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_tutorial`;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_video`;

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_picture`
    FOREIGN KEY (`picture_id`)
    REFERENCES `kk_trixionary_picture` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_tutorial`
    FOREIGN KEY (`tutorial_id`)
    REFERENCES `kk_trixionary_video` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_video`
    FOREIGN KEY (`video_id`)
    REFERENCES `kk_trixionary_video` (`id`)
    ON DELETE SET NULL;

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
  'keeko' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_picture`;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_tutorial`;

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_featured_video`;

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_picture`
    FOREIGN KEY (`picture_id`)
    REFERENCES `kk_trixionary_picture` (`id`);

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_tutorial`
    FOREIGN KEY (`tutorial_id`)
    REFERENCES `kk_trixionary_video` (`id`);

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_featured_video`
    FOREIGN KEY (`video_id`)
    REFERENCES `kk_trixionary_video` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}