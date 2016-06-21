<?php

namespace gossi\trixionary\model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use gossi\trixionary\model\Skill;
use gossi\trixionary\model\SkillQuery;


/**
 * This class defines the structure of the 'kk_trixionary_skill' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SkillTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SkillTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_skill';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Skill';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Skill';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 31;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 31;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_skill.id';

    /**
     * the column name for the sport_id field
     */
    const COL_SPORT_ID = 'kk_trixionary_skill.sport_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'kk_trixionary_skill.name';

    /**
     * the column name for the alternative_name field
     */
    const COL_ALTERNATIVE_NAME = 'kk_trixionary_skill.alternative_name';

    /**
     * the column name for the slug field
     */
    const COL_SLUG = 'kk_trixionary_skill.slug';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'kk_trixionary_skill.description';

    /**
     * the column name for the history field
     */
    const COL_HISTORY = 'kk_trixionary_skill.history';

    /**
     * the column name for the is_translation field
     */
    const COL_IS_TRANSLATION = 'kk_trixionary_skill.is_translation';

    /**
     * the column name for the is_rotation field
     */
    const COL_IS_ROTATION = 'kk_trixionary_skill.is_rotation';

    /**
     * the column name for the is_acyclic field
     */
    const COL_IS_ACYCLIC = 'kk_trixionary_skill.is_acyclic';

    /**
     * the column name for the is_cyclic field
     */
    const COL_IS_CYCLIC = 'kk_trixionary_skill.is_cyclic';

    /**
     * the column name for the longitudinal_flags field
     */
    const COL_LONGITUDINAL_FLAGS = 'kk_trixionary_skill.longitudinal_flags';

    /**
     * the column name for the latitudinal_flags field
     */
    const COL_LATITUDINAL_FLAGS = 'kk_trixionary_skill.latitudinal_flags';

    /**
     * the column name for the transversal_flags field
     */
    const COL_TRANSVERSAL_FLAGS = 'kk_trixionary_skill.transversal_flags';

    /**
     * the column name for the movement_description field
     */
    const COL_MOVEMENT_DESCRIPTION = 'kk_trixionary_skill.movement_description';

    /**
     * the column name for the variation_of_id field
     */
    const COL_VARIATION_OF_ID = 'kk_trixionary_skill.variation_of_id';

    /**
     * the column name for the start_position_id field
     */
    const COL_START_POSITION_ID = 'kk_trixionary_skill.start_position_id';

    /**
     * the column name for the end_position_id field
     */
    const COL_END_POSITION_ID = 'kk_trixionary_skill.end_position_id';

    /**
     * the column name for the is_composite field
     */
    const COL_IS_COMPOSITE = 'kk_trixionary_skill.is_composite';

    /**
     * the column name for the is_multiple field
     */
    const COL_IS_MULTIPLE = 'kk_trixionary_skill.is_multiple';

    /**
     * the column name for the multiple_of_id field
     */
    const COL_MULTIPLE_OF_ID = 'kk_trixionary_skill.multiple_of_id';

    /**
     * the column name for the multiplier field
     */
    const COL_MULTIPLIER = 'kk_trixionary_skill.multiplier';

    /**
     * the column name for the generation field
     */
    const COL_GENERATION = 'kk_trixionary_skill.generation';

    /**
     * the column name for the importance field
     */
    const COL_IMPORTANCE = 'kk_trixionary_skill.importance';

    /**
     * the column name for the picture_id field
     */
    const COL_PICTURE_ID = 'kk_trixionary_skill.picture_id';

    /**
     * the column name for the kstruktur_id field
     */
    const COL_KSTRUKTUR_ID = 'kk_trixionary_skill.kstruktur_id';

    /**
     * the column name for the function_phase_id field
     */
    const COL_FUNCTION_PHASE_ID = 'kk_trixionary_skill.function_phase_id';

    /**
     * the column name for the object_id field
     */
    const COL_OBJECT_ID = 'kk_trixionary_skill.object_id';

    /**
     * the column name for the version field
     */
    const COL_VERSION = 'kk_trixionary_skill.version';

    /**
     * the column name for the version_created_at field
     */
    const COL_VERSION_CREATED_AT = 'kk_trixionary_skill.version_created_at';

    /**
     * the column name for the version_comment field
     */
    const COL_VERSION_COMMENT = 'kk_trixionary_skill.version_comment';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'SportId', 'Name', 'AlternativeName', 'Slug', 'Description', 'History', 'IsTranslation', 'IsRotation', 'IsAcyclic', 'IsCyclic', 'LongitudinalFlags', 'LatitudinalFlags', 'TransversalFlags', 'MovementDescription', 'VariationOfId', 'StartPositionId', 'EndPositionId', 'IsComposite', 'IsMultiple', 'MultipleOfId', 'Multiplier', 'Generation', 'Importance', 'PictureId', 'KstrukturId', 'FunctionPhaseId', 'ObjectId', 'Version', 'VersionCreatedAt', 'VersionComment', ),
        self::TYPE_CAMELNAME     => array('id', 'sportId', 'name', 'alternativeName', 'slug', 'description', 'history', 'isTranslation', 'isRotation', 'isAcyclic', 'isCyclic', 'longitudinalFlags', 'latitudinalFlags', 'transversalFlags', 'movementDescription', 'variationOfId', 'startPositionId', 'endPositionId', 'isComposite', 'isMultiple', 'multipleOfId', 'multiplier', 'generation', 'importance', 'pictureId', 'kstrukturId', 'functionPhaseId', 'objectId', 'version', 'versionCreatedAt', 'versionComment', ),
        self::TYPE_COLNAME       => array(SkillTableMap::COL_ID, SkillTableMap::COL_SPORT_ID, SkillTableMap::COL_NAME, SkillTableMap::COL_ALTERNATIVE_NAME, SkillTableMap::COL_SLUG, SkillTableMap::COL_DESCRIPTION, SkillTableMap::COL_HISTORY, SkillTableMap::COL_IS_TRANSLATION, SkillTableMap::COL_IS_ROTATION, SkillTableMap::COL_IS_ACYCLIC, SkillTableMap::COL_IS_CYCLIC, SkillTableMap::COL_LONGITUDINAL_FLAGS, SkillTableMap::COL_LATITUDINAL_FLAGS, SkillTableMap::COL_TRANSVERSAL_FLAGS, SkillTableMap::COL_MOVEMENT_DESCRIPTION, SkillTableMap::COL_VARIATION_OF_ID, SkillTableMap::COL_START_POSITION_ID, SkillTableMap::COL_END_POSITION_ID, SkillTableMap::COL_IS_COMPOSITE, SkillTableMap::COL_IS_MULTIPLE, SkillTableMap::COL_MULTIPLE_OF_ID, SkillTableMap::COL_MULTIPLIER, SkillTableMap::COL_GENERATION, SkillTableMap::COL_IMPORTANCE, SkillTableMap::COL_PICTURE_ID, SkillTableMap::COL_KSTRUKTUR_ID, SkillTableMap::COL_FUNCTION_PHASE_ID, SkillTableMap::COL_OBJECT_ID, SkillTableMap::COL_VERSION, SkillTableMap::COL_VERSION_CREATED_AT, SkillTableMap::COL_VERSION_COMMENT, ),
        self::TYPE_FIELDNAME     => array('id', 'sport_id', 'name', 'alternative_name', 'slug', 'description', 'history', 'is_translation', 'is_rotation', 'is_acyclic', 'is_cyclic', 'longitudinal_flags', 'latitudinal_flags', 'transversal_flags', 'movement_description', 'variation_of_id', 'start_position_id', 'end_position_id', 'is_composite', 'is_multiple', 'multiple_of_id', 'multiplier', 'generation', 'importance', 'picture_id', 'kstruktur_id', 'function_phase_id', 'object_id', 'version', 'version_created_at', 'version_comment', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'SportId' => 1, 'Name' => 2, 'AlternativeName' => 3, 'Slug' => 4, 'Description' => 5, 'History' => 6, 'IsTranslation' => 7, 'IsRotation' => 8, 'IsAcyclic' => 9, 'IsCyclic' => 10, 'LongitudinalFlags' => 11, 'LatitudinalFlags' => 12, 'TransversalFlags' => 13, 'MovementDescription' => 14, 'VariationOfId' => 15, 'StartPositionId' => 16, 'EndPositionId' => 17, 'IsComposite' => 18, 'IsMultiple' => 19, 'MultipleOfId' => 20, 'Multiplier' => 21, 'Generation' => 22, 'Importance' => 23, 'PictureId' => 24, 'KstrukturId' => 25, 'FunctionPhaseId' => 26, 'ObjectId' => 27, 'Version' => 28, 'VersionCreatedAt' => 29, 'VersionComment' => 30, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'sportId' => 1, 'name' => 2, 'alternativeName' => 3, 'slug' => 4, 'description' => 5, 'history' => 6, 'isTranslation' => 7, 'isRotation' => 8, 'isAcyclic' => 9, 'isCyclic' => 10, 'longitudinalFlags' => 11, 'latitudinalFlags' => 12, 'transversalFlags' => 13, 'movementDescription' => 14, 'variationOfId' => 15, 'startPositionId' => 16, 'endPositionId' => 17, 'isComposite' => 18, 'isMultiple' => 19, 'multipleOfId' => 20, 'multiplier' => 21, 'generation' => 22, 'importance' => 23, 'pictureId' => 24, 'kstrukturId' => 25, 'functionPhaseId' => 26, 'objectId' => 27, 'version' => 28, 'versionCreatedAt' => 29, 'versionComment' => 30, ),
        self::TYPE_COLNAME       => array(SkillTableMap::COL_ID => 0, SkillTableMap::COL_SPORT_ID => 1, SkillTableMap::COL_NAME => 2, SkillTableMap::COL_ALTERNATIVE_NAME => 3, SkillTableMap::COL_SLUG => 4, SkillTableMap::COL_DESCRIPTION => 5, SkillTableMap::COL_HISTORY => 6, SkillTableMap::COL_IS_TRANSLATION => 7, SkillTableMap::COL_IS_ROTATION => 8, SkillTableMap::COL_IS_ACYCLIC => 9, SkillTableMap::COL_IS_CYCLIC => 10, SkillTableMap::COL_LONGITUDINAL_FLAGS => 11, SkillTableMap::COL_LATITUDINAL_FLAGS => 12, SkillTableMap::COL_TRANSVERSAL_FLAGS => 13, SkillTableMap::COL_MOVEMENT_DESCRIPTION => 14, SkillTableMap::COL_VARIATION_OF_ID => 15, SkillTableMap::COL_START_POSITION_ID => 16, SkillTableMap::COL_END_POSITION_ID => 17, SkillTableMap::COL_IS_COMPOSITE => 18, SkillTableMap::COL_IS_MULTIPLE => 19, SkillTableMap::COL_MULTIPLE_OF_ID => 20, SkillTableMap::COL_MULTIPLIER => 21, SkillTableMap::COL_GENERATION => 22, SkillTableMap::COL_IMPORTANCE => 23, SkillTableMap::COL_PICTURE_ID => 24, SkillTableMap::COL_KSTRUKTUR_ID => 25, SkillTableMap::COL_FUNCTION_PHASE_ID => 26, SkillTableMap::COL_OBJECT_ID => 27, SkillTableMap::COL_VERSION => 28, SkillTableMap::COL_VERSION_CREATED_AT => 29, SkillTableMap::COL_VERSION_COMMENT => 30, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'sport_id' => 1, 'name' => 2, 'alternative_name' => 3, 'slug' => 4, 'description' => 5, 'history' => 6, 'is_translation' => 7, 'is_rotation' => 8, 'is_acyclic' => 9, 'is_cyclic' => 10, 'longitudinal_flags' => 11, 'latitudinal_flags' => 12, 'transversal_flags' => 13, 'movement_description' => 14, 'variation_of_id' => 15, 'start_position_id' => 16, 'end_position_id' => 17, 'is_composite' => 18, 'is_multiple' => 19, 'multiple_of_id' => 20, 'multiplier' => 21, 'generation' => 22, 'importance' => 23, 'picture_id' => 24, 'kstruktur_id' => 25, 'function_phase_id' => 26, 'object_id' => 27, 'version' => 28, 'version_created_at' => 29, 'version_comment' => 30, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('kk_trixionary_skill');
        $this->setPhpName('Skill');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Skill');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('sport_id', 'SportId', 'INTEGER', 'kk_trixionary_sport', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('alternative_name', 'AlternativeName', 'VARCHAR', false, 255, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('history', 'History', 'LONGVARCHAR', false, null, null);
        $this->addColumn('is_translation', 'IsTranslation', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_rotation', 'IsRotation', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_acyclic', 'IsAcyclic', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_cyclic', 'IsCyclic', 'BOOLEAN', false, 1, false);
        $this->addColumn('longitudinal_flags', 'LongitudinalFlags', 'INTEGER', false, null, null);
        $this->addColumn('latitudinal_flags', 'LatitudinalFlags', 'INTEGER', false, null, null);
        $this->addColumn('transversal_flags', 'TransversalFlags', 'INTEGER', false, null, null);
        $this->addColumn('movement_description', 'MovementDescription', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('variation_of_id', 'VariationOfId', 'INTEGER', 'kk_trixionary_skill', 'id', false, null, null);
        $this->addForeignKey('start_position_id', 'StartPositionId', 'INTEGER', 'kk_trixionary_position', 'id', false, null, null);
        $this->addForeignKey('end_position_id', 'EndPositionId', 'INTEGER', 'kk_trixionary_position', 'id', false, null, null);
        $this->addColumn('is_composite', 'IsComposite', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_multiple', 'IsMultiple', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('multiple_of_id', 'MultipleOfId', 'INTEGER', 'kk_trixionary_skill', 'id', false, null, null);
        $this->addColumn('multiplier', 'Multiplier', 'INTEGER', false, null, null);
        $this->addColumn('generation', 'Generation', 'INTEGER', false, null, null);
        $this->addColumn('importance', 'Importance', 'INTEGER', false, null, 0);
        $this->addForeignKey('picture_id', 'PictureId', 'INTEGER', 'kk_trixionary_picture', 'id', false, null, null);
        $this->addForeignKey('kstruktur_id', 'KstrukturId', 'INTEGER', 'kk_trixionary_kstruktur', 'id', false, null, null);
        $this->addForeignKey('function_phase_id', 'FunctionPhaseId', 'INTEGER', 'kk_trixionary_function_phase', 'id', false, null, null);
        $this->addForeignKey('object_id', 'ObjectId', 'INTEGER', 'kk_trixionary_object', 'id', false, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', false, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Sport', '\\gossi\\trixionary\\model\\Sport', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sport_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('VariationOf', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':variation_of_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('MultipleOf', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':multiple_of_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Object', '\\gossi\\trixionary\\model\\Object', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':object_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('StartPosition', '\\gossi\\trixionary\\model\\Position', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':start_position_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('EndPosition', '\\gossi\\trixionary\\model\\Position', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':end_position_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('FeaturedPicture', '\\gossi\\trixionary\\model\\Picture', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':picture_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('KstrukturRoot', '\\gossi\\trixionary\\model\\Kstruktur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':kstruktur_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('FunctionPhaseRoot', '\\gossi\\trixionary\\model\\FunctionPhase', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':function_phase_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Variation', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':variation_of_id',
    1 => ':id',
  ),
), null, null, 'Variations', false);
        $this->addRelation('Multiple', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':multiple_of_id',
    1 => ':id',
  ),
), null, null, 'Multiples', false);
        $this->addRelation('LineageRelatedBySkillId', '\\gossi\\trixionary\\model\\Lineage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'LineagesRelatedBySkillId', false);
        $this->addRelation('LineageRelatedByAncestorId', '\\gossi\\trixionary\\model\\Lineage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ancestor_id',
    1 => ':id',
  ),
), null, null, 'LineagesRelatedByAncestorId', false);
        $this->addRelation('Child', '\\gossi\\trixionary\\model\\SkillDependency', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':dependency_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Children', false);
        $this->addRelation('Parent', '\\gossi\\trixionary\\model\\SkillDependency', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Parents', false);
        $this->addRelation('Part', '\\gossi\\trixionary\\model\\SkillPart', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':part_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Parts', false);
        $this->addRelation('Composite', '\\gossi\\trixionary\\model\\SkillPart', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':composite_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Composites', false);
        $this->addRelation('SkillGroup', '\\gossi\\trixionary\\model\\SkillGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'SkillGroups', false);
        $this->addRelation('Picture', '\\gossi\\trixionary\\model\\Picture', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Pictures', false);
        $this->addRelation('Video', '\\gossi\\trixionary\\model\\Video', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Videos', false);
        $this->addRelation('Reference', '\\gossi\\trixionary\\model\\Reference', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), null, null, 'References', false);
        $this->addRelation('StructureNode', '\\gossi\\trixionary\\model\\StructureNode', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'StructureNodes', false);
        $this->addRelation('KstrukturRelatedBySkillId', '\\gossi\\trixionary\\model\\Kstruktur', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'KstruktursRelatedBySkillId', false);
        $this->addRelation('FunctionPhaseRelatedBySkillId', '\\gossi\\trixionary\\model\\FunctionPhase', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'FunctionPhasesRelatedBySkillId', false);
        $this->addRelation('SkillVersion', '\\gossi\\trixionary\\model\\SkillVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'SkillVersions', false);
        $this->addRelation('SkillRelatedByParentId', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SkillsRelatedByParentId');
        $this->addRelation('SkillRelatedByDependencyId', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SkillsRelatedByDependencyId');
        $this->addRelation('SkillRelatedByCompositeId', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SkillsRelatedByCompositeId');
        $this->addRelation('SkillRelatedByPartId', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SkillsRelatedByPartId');
        $this->addRelation('Group', '\\gossi\\trixionary\\model\\Group', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Groups');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'versionable' => array('version_column' => 'version', 'version_table' => 'skill_version', 'log_created_at' => 'true', 'log_created_by' => 'false', 'log_comment' => 'true', 'version_created_at_column' => 'version_created_at', 'version_created_by_column' => 'version_created_by', 'version_comment_column' => 'version_comment', 'indices' => 'false', ),
            'aggregate_column_relation_aggregate_column' => array('foreign_table' => 'kk_trixionary_object', 'update_method' => 'updateSkillCount', 'aggregate_name' => 'SkillCount', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to kk_trixionary_skill     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        LineageTableMap::clearInstancePool();
        SkillDependencyTableMap::clearInstancePool();
        SkillPartTableMap::clearInstancePool();
        SkillGroupTableMap::clearInstancePool();
        PictureTableMap::clearInstancePool();
        VideoTableMap::clearInstancePool();
        StructureNodeTableMap::clearInstancePool();
        KstrukturTableMap::clearInstancePool();
        FunctionPhaseTableMap::clearInstancePool();
        SkillVersionTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SkillTableMap::CLASS_DEFAULT : SkillTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Skill object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SkillTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SkillTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SkillTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SkillTableMap::OM_CLASS;
            /** @var Skill $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SkillTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SkillTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SkillTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Skill $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SkillTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SkillTableMap::COL_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_SPORT_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_NAME);
            $criteria->addSelectColumn(SkillTableMap::COL_ALTERNATIVE_NAME);
            $criteria->addSelectColumn(SkillTableMap::COL_SLUG);
            $criteria->addSelectColumn(SkillTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SkillTableMap::COL_HISTORY);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_TRANSLATION);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_ROTATION);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_ACYCLIC);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_CYCLIC);
            $criteria->addSelectColumn(SkillTableMap::COL_LONGITUDINAL_FLAGS);
            $criteria->addSelectColumn(SkillTableMap::COL_LATITUDINAL_FLAGS);
            $criteria->addSelectColumn(SkillTableMap::COL_TRANSVERSAL_FLAGS);
            $criteria->addSelectColumn(SkillTableMap::COL_MOVEMENT_DESCRIPTION);
            $criteria->addSelectColumn(SkillTableMap::COL_VARIATION_OF_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_START_POSITION_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_END_POSITION_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_COMPOSITE);
            $criteria->addSelectColumn(SkillTableMap::COL_IS_MULTIPLE);
            $criteria->addSelectColumn(SkillTableMap::COL_MULTIPLE_OF_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_MULTIPLIER);
            $criteria->addSelectColumn(SkillTableMap::COL_GENERATION);
            $criteria->addSelectColumn(SkillTableMap::COL_IMPORTANCE);
            $criteria->addSelectColumn(SkillTableMap::COL_PICTURE_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_KSTRUKTUR_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_FUNCTION_PHASE_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_OBJECT_ID);
            $criteria->addSelectColumn(SkillTableMap::COL_VERSION);
            $criteria->addSelectColumn(SkillTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(SkillTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.sport_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.alternative_name');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.history');
            $criteria->addSelectColumn($alias . '.is_translation');
            $criteria->addSelectColumn($alias . '.is_rotation');
            $criteria->addSelectColumn($alias . '.is_acyclic');
            $criteria->addSelectColumn($alias . '.is_cyclic');
            $criteria->addSelectColumn($alias . '.longitudinal_flags');
            $criteria->addSelectColumn($alias . '.latitudinal_flags');
            $criteria->addSelectColumn($alias . '.transversal_flags');
            $criteria->addSelectColumn($alias . '.movement_description');
            $criteria->addSelectColumn($alias . '.variation_of_id');
            $criteria->addSelectColumn($alias . '.start_position_id');
            $criteria->addSelectColumn($alias . '.end_position_id');
            $criteria->addSelectColumn($alias . '.is_composite');
            $criteria->addSelectColumn($alias . '.is_multiple');
            $criteria->addSelectColumn($alias . '.multiple_of_id');
            $criteria->addSelectColumn($alias . '.multiplier');
            $criteria->addSelectColumn($alias . '.generation');
            $criteria->addSelectColumn($alias . '.importance');
            $criteria->addSelectColumn($alias . '.picture_id');
            $criteria->addSelectColumn($alias . '.kstruktur_id');
            $criteria->addSelectColumn($alias . '.function_phase_id');
            $criteria->addSelectColumn($alias . '.object_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_comment');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SkillTableMap::DATABASE_NAME)->getTable(SkillTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SkillTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SkillTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SkillTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Skill or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Skill object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Skill) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SkillTableMap::DATABASE_NAME);
            $criteria->add(SkillTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SkillQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SkillTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SkillTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_skill table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SkillQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Skill or Criteria object.
     *
     * @param mixed               $criteria Criteria or Skill object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Skill object
        }

        if ($criteria->containsKey(SkillTableMap::COL_ID) && $criteria->keyContainsValue(SkillTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SkillTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SkillQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SkillTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SkillTableMap::buildTableMap();
