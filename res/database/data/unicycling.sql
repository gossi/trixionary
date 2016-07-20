INSERT INTO `kk_trixionary_sport` 
	(`title`, `slug`, `athlete_label`,
	`object_slug`, `object_label`, `object_plural_label`, 
	`skill_slug`, `skill_label`, `skill_plural_label`, `skill_picture_url`,
	`group_slug`, `group_label`, `group_plural_label`,
	`transitions_slug`, `transition_label`, `transition_plural_label`, 
	`position_slug`, `position_label`,
	`feature_composition`, `feature_tester`, `is_default`) 
	VALUES 
	('Unicycling', 'unicycling', 'Rider',
	'unicycle', 'Unicycle', 'Unicycles',
	'trick', 'Trick', 'Tricks', 'http://localhost/keeko/_files/managed/gossi/trixionary/unicycling/skill.jpg',
	'struct', 'Struct', 'Structs',
	'transitions', 'Transition', 'Transitions',
	'position', 'Position', 
	'1', '1', '1');
	
INSERT INTO `kk_trixionary_object` 
	(`title`, `slug`, `description`, `sport_id`) 
	VALUES 
	('Freestyle', 'freestyle', 'Freestyle Unicycle', '1');
