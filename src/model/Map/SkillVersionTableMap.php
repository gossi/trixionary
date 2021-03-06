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
use gossi\trixionary\model\SkillVersion;
use gossi\trixionary\model\SkillVersionQuery;


/**
 * This class defines the structure of the 'kk_trixionary_skill_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SkillVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SkillVersionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_skill_version';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\SkillVersion';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SkillVersion';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 38;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 38;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_skill_version.id';

    /**
     * the column name for the sport_id field
     */
    const COL_SPORT_ID = 'kk_trixionary_skill_version.sport_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'kk_trixionary_skill_version.name';

    /**
     * the column name for the alternative_name field
     */
    const COL_ALTERNATIVE_NAME = 'kk_trixionary_skill_version.alternative_name';

    /**
     * the column name for the slug field
     */
    const COL_SLUG = 'kk_trixionary_skill_version.slug';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'kk_trixionary_skill_version.description';

    /**
     * the column name for the history field
     */
    const COL_HISTORY = 'kk_trixionary_skill_version.history';

    /**
     * the column name for the is_translation field
     */
    const COL_IS_TRANSLATION = 'kk_trixionary_skill_version.is_translation';

    /**
     * the column name for the is_rotation field
     */
    const COL_IS_ROTATION = 'kk_trixionary_skill_version.is_rotation';

    /**
     * the column name for the is_acyclic field
     */
    const COL_IS_ACYCLIC = 'kk_trixionary_skill_version.is_acyclic';

    /**
     * the column name for the is_cyclic field
     */
    const COL_IS_CYCLIC = 'kk_trixionary_skill_version.is_cyclic';

    /**
     * the column name for the longitudinal_flags field
     */
    const COL_LONGITUDINAL_FLAGS = 'kk_trixionary_skill_version.longitudinal_flags';

    /**
     * the column name for the latitudinal_flags field
     */
    const COL_LATITUDINAL_FLAGS = 'kk_trixionary_skill_version.latitudinal_flags';

    /**
     * the column name for the transversal_flags field
     */
    const COL_TRANSVERSAL_FLAGS = 'kk_trixionary_skill_version.transversal_flags';

    /**
     * the column name for the movement_description field
     */
    const COL_MOVEMENT_DESCRIPTION = 'kk_trixionary_skill_version.movement_description';

    /**
     * the column name for the sequence_picture_url field
     */
    const COL_SEQUENCE_PICTURE_URL = 'kk_trixionary_skill_version.sequence_picture_url';

    /**
     * the column name for the variation_of_id field
     */
    const COL_VARIATION_OF_ID = 'kk_trixionary_skill_version.variation_of_id';

    /**
     * the column name for the start_position_id field
     */
    const COL_START_POSITION_ID = 'kk_trixionary_skill_version.start_position_id';

    /**
     * the column name for the end_position_id field
     */
    const COL_END_POSITION_ID = 'kk_trixionary_skill_version.end_position_id';

    /**
     * the column name for the is_composite field
     */
    const COL_IS_COMPOSITE = 'kk_trixionary_skill_version.is_composite';

    /**
     * the column name for the is_multiple field
     */
    const COL_IS_MULTIPLE = 'kk_trixionary_skill_version.is_multiple';

    /**
     * the column name for the multiple_of_id field
     */
    const COL_MULTIPLE_OF_ID = 'kk_trixionary_skill_version.multiple_of_id';

    /**
     * the column name for the multiplier field
     */
    const COL_MULTIPLIER = 'kk_trixionary_skill_version.multiplier';

    /**
     * the column name for the generation field
     */
    const COL_GENERATION = 'kk_trixionary_skill_version.generation';

    /**
     * the column name for the importance field
     */
    const COL_IMPORTANCE = 'kk_trixionary_skill_version.importance';

    /**
     * the column name for the picture_id field
     */
    const COL_PICTURE_ID = 'kk_trixionary_skill_version.picture_id';

    /**
     * the column name for the video_id field
     */
    const COL_VIDEO_ID = 'kk_trixionary_skill_version.video_id';

    /**
     * the column name for the tutorial_id field
     */
    const COL_TUTORIAL_ID = 'kk_trixionary_skill_version.tutorial_id';

    /**
     * the column name for the kstruktur_id field
     */
    const COL_KSTRUKTUR_ID = 'kk_trixionary_skill_version.kstruktur_id';

    /**
     * the column name for the function_phase_id field
     */
    const COL_FUNCTION_PHASE_ID = 'kk_trixionary_skill_version.function_phase_id';

    /**
     * the column name for the object_id field
     */
    const COL_OBJECT_ID = 'kk_trixionary_skill_version.object_id';

    /**
     * the column name for the version field
     */
    const COL_VERSION = 'kk_trixionary_skill_version.version';

    /**
     * the column name for the version_created_at field
     */
    const COL_VERSION_CREATED_AT = 'kk_trixionary_skill_version.version_created_at';

    /**
     * the column name for the version_comment field
     */
    const COL_VERSION_COMMENT = 'kk_trixionary_skill_version.version_comment';

    /**
     * the column name for the variation_of_id_version field
     */
    const COL_VARIATION_OF_ID_VERSION = 'kk_trixionary_skill_version.variation_of_id_version';

    /**
     * the column name for the multiple_of_id_version field
     */
    const COL_MULTIPLE_OF_ID_VERSION = 'kk_trixionary_skill_version.multiple_of_id_version';

    /**
     * the column name for the kk_trixionary_skill_ids field
     */
    const COL_KK_TRIXIONARY_SKILL_IDS = 'kk_trixionary_skill_version.kk_trixionary_skill_ids';

    /**
     * the column name for the kk_trixionary_skill_versions field
     */
    const COL_KK_TRIXIONARY_SKILL_VERSIONS = 'kk_trixionary_skill_version.kk_trixionary_skill_versions';

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
        self::TYPE_PHPNAME       => array('Id', 'SportId', 'Name', 'AlternativeName', 'Slug', 'Description', 'History', 'IsTranslation', 'IsRotation', 'IsAcyclic', 'IsCyclic', 'LongitudinalFlags', 'LatitudinalFlags', 'TransversalFlags', 'MovementDescription', 'SequencePictureUrl', 'VariationOfId', 'StartPositionId', 'EndPositionId', 'IsComposite', 'IsMultiple', 'MultipleOfId', 'Multiplier', 'Generation', 'Importance', 'PictureId', 'VideoId', 'TutorialId', 'KstrukturId', 'FunctionPhaseId', 'ObjectId', 'Version', 'VersionCreatedAt', 'VersionComment', 'VariationOfIdVersion', 'MultipleOfIdVersion', 'KkTrixionarySkillIds', 'KkTrixionarySkillVersions', ),
        self::TYPE_CAMELNAME     => array('id', 'sportId', 'name', 'alternativeName', 'slug', 'description', 'history', 'isTranslation', 'isRotation', 'isAcyclic', 'isCyclic', 'longitudinalFlags', 'latitudinalFlags', 'transversalFlags', 'movementDescription', 'sequencePictureUrl', 'variationOfId', 'startPositionId', 'endPositionId', 'isComposite', 'isMultiple', 'multipleOfId', 'multiplier', 'generation', 'importance', 'pictureId', 'videoId', 'tutorialId', 'kstrukturId', 'functionPhaseId', 'objectId', 'version', 'versionCreatedAt', 'versionComment', 'variationOfIdVersion', 'multipleOfIdVersion', 'kkTrixionarySkillIds', 'kkTrixionarySkillVersions', ),
        self::TYPE_COLNAME       => array(SkillVersionTableMap::COL_ID, SkillVersionTableMap::COL_SPORT_ID, SkillVersionTableMap::COL_NAME, SkillVersionTableMap::COL_ALTERNATIVE_NAME, SkillVersionTableMap::COL_SLUG, SkillVersionTableMap::COL_DESCRIPTION, SkillVersionTableMap::COL_HISTORY, SkillVersionTableMap::COL_IS_TRANSLATION, SkillVersionTableMap::COL_IS_ROTATION, SkillVersionTableMap::COL_IS_ACYCLIC, SkillVersionTableMap::COL_IS_CYCLIC, SkillVersionTableMap::COL_LONGITUDINAL_FLAGS, SkillVersionTableMap::COL_LATITUDINAL_FLAGS, SkillVersionTableMap::COL_TRANSVERSAL_FLAGS, SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION, SkillVersionTableMap::COL_SEQUENCE_PICTURE_URL, SkillVersionTableMap::COL_VARIATION_OF_ID, SkillVersionTableMap::COL_START_POSITION_ID, SkillVersionTableMap::COL_END_POSITION_ID, SkillVersionTableMap::COL_IS_COMPOSITE, SkillVersionTableMap::COL_IS_MULTIPLE, SkillVersionTableMap::COL_MULTIPLE_OF_ID, SkillVersionTableMap::COL_MULTIPLIER, SkillVersionTableMap::COL_GENERATION, SkillVersionTableMap::COL_IMPORTANCE, SkillVersionTableMap::COL_PICTURE_ID, SkillVersionTableMap::COL_VIDEO_ID, SkillVersionTableMap::COL_TUTORIAL_ID, SkillVersionTableMap::COL_KSTRUKTUR_ID, SkillVersionTableMap::COL_FUNCTION_PHASE_ID, SkillVersionTableMap::COL_OBJECT_ID, SkillVersionTableMap::COL_VERSION, SkillVersionTableMap::COL_VERSION_CREATED_AT, SkillVersionTableMap::COL_VERSION_COMMENT, SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION, SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION, SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS, SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS, ),
        self::TYPE_FIELDNAME     => array('id', 'sport_id', 'name', 'alternative_name', 'slug', 'description', 'history', 'is_translation', 'is_rotation', 'is_acyclic', 'is_cyclic', 'longitudinal_flags', 'latitudinal_flags', 'transversal_flags', 'movement_description', 'sequence_picture_url', 'variation_of_id', 'start_position_id', 'end_position_id', 'is_composite', 'is_multiple', 'multiple_of_id', 'multiplier', 'generation', 'importance', 'picture_id', 'video_id', 'tutorial_id', 'kstruktur_id', 'function_phase_id', 'object_id', 'version', 'version_created_at', 'version_comment', 'variation_of_id_version', 'multiple_of_id_version', 'kk_trixionary_skill_ids', 'kk_trixionary_skill_versions', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'SportId' => 1, 'Name' => 2, 'AlternativeName' => 3, 'Slug' => 4, 'Description' => 5, 'History' => 6, 'IsTranslation' => 7, 'IsRotation' => 8, 'IsAcyclic' => 9, 'IsCyclic' => 10, 'LongitudinalFlags' => 11, 'LatitudinalFlags' => 12, 'TransversalFlags' => 13, 'MovementDescription' => 14, 'SequencePictureUrl' => 15, 'VariationOfId' => 16, 'StartPositionId' => 17, 'EndPositionId' => 18, 'IsComposite' => 19, 'IsMultiple' => 20, 'MultipleOfId' => 21, 'Multiplier' => 22, 'Generation' => 23, 'Importance' => 24, 'PictureId' => 25, 'VideoId' => 26, 'TutorialId' => 27, 'KstrukturId' => 28, 'FunctionPhaseId' => 29, 'ObjectId' => 30, 'Version' => 31, 'VersionCreatedAt' => 32, 'VersionComment' => 33, 'VariationOfIdVersion' => 34, 'MultipleOfIdVersion' => 35, 'KkTrixionarySkillIds' => 36, 'KkTrixionarySkillVersions' => 37, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'sportId' => 1, 'name' => 2, 'alternativeName' => 3, 'slug' => 4, 'description' => 5, 'history' => 6, 'isTranslation' => 7, 'isRotation' => 8, 'isAcyclic' => 9, 'isCyclic' => 10, 'longitudinalFlags' => 11, 'latitudinalFlags' => 12, 'transversalFlags' => 13, 'movementDescription' => 14, 'sequencePictureUrl' => 15, 'variationOfId' => 16, 'startPositionId' => 17, 'endPositionId' => 18, 'isComposite' => 19, 'isMultiple' => 20, 'multipleOfId' => 21, 'multiplier' => 22, 'generation' => 23, 'importance' => 24, 'pictureId' => 25, 'videoId' => 26, 'tutorialId' => 27, 'kstrukturId' => 28, 'functionPhaseId' => 29, 'objectId' => 30, 'version' => 31, 'versionCreatedAt' => 32, 'versionComment' => 33, 'variationOfIdVersion' => 34, 'multipleOfIdVersion' => 35, 'kkTrixionarySkillIds' => 36, 'kkTrixionarySkillVersions' => 37, ),
        self::TYPE_COLNAME       => array(SkillVersionTableMap::COL_ID => 0, SkillVersionTableMap::COL_SPORT_ID => 1, SkillVersionTableMap::COL_NAME => 2, SkillVersionTableMap::COL_ALTERNATIVE_NAME => 3, SkillVersionTableMap::COL_SLUG => 4, SkillVersionTableMap::COL_DESCRIPTION => 5, SkillVersionTableMap::COL_HISTORY => 6, SkillVersionTableMap::COL_IS_TRANSLATION => 7, SkillVersionTableMap::COL_IS_ROTATION => 8, SkillVersionTableMap::COL_IS_ACYCLIC => 9, SkillVersionTableMap::COL_IS_CYCLIC => 10, SkillVersionTableMap::COL_LONGITUDINAL_FLAGS => 11, SkillVersionTableMap::COL_LATITUDINAL_FLAGS => 12, SkillVersionTableMap::COL_TRANSVERSAL_FLAGS => 13, SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION => 14, SkillVersionTableMap::COL_SEQUENCE_PICTURE_URL => 15, SkillVersionTableMap::COL_VARIATION_OF_ID => 16, SkillVersionTableMap::COL_START_POSITION_ID => 17, SkillVersionTableMap::COL_END_POSITION_ID => 18, SkillVersionTableMap::COL_IS_COMPOSITE => 19, SkillVersionTableMap::COL_IS_MULTIPLE => 20, SkillVersionTableMap::COL_MULTIPLE_OF_ID => 21, SkillVersionTableMap::COL_MULTIPLIER => 22, SkillVersionTableMap::COL_GENERATION => 23, SkillVersionTableMap::COL_IMPORTANCE => 24, SkillVersionTableMap::COL_PICTURE_ID => 25, SkillVersionTableMap::COL_VIDEO_ID => 26, SkillVersionTableMap::COL_TUTORIAL_ID => 27, SkillVersionTableMap::COL_KSTRUKTUR_ID => 28, SkillVersionTableMap::COL_FUNCTION_PHASE_ID => 29, SkillVersionTableMap::COL_OBJECT_ID => 30, SkillVersionTableMap::COL_VERSION => 31, SkillVersionTableMap::COL_VERSION_CREATED_AT => 32, SkillVersionTableMap::COL_VERSION_COMMENT => 33, SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION => 34, SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION => 35, SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS => 36, SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS => 37, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'sport_id' => 1, 'name' => 2, 'alternative_name' => 3, 'slug' => 4, 'description' => 5, 'history' => 6, 'is_translation' => 7, 'is_rotation' => 8, 'is_acyclic' => 9, 'is_cyclic' => 10, 'longitudinal_flags' => 11, 'latitudinal_flags' => 12, 'transversal_flags' => 13, 'movement_description' => 14, 'sequence_picture_url' => 15, 'variation_of_id' => 16, 'start_position_id' => 17, 'end_position_id' => 18, 'is_composite' => 19, 'is_multiple' => 20, 'multiple_of_id' => 21, 'multiplier' => 22, 'generation' => 23, 'importance' => 24, 'picture_id' => 25, 'video_id' => 26, 'tutorial_id' => 27, 'kstruktur_id' => 28, 'function_phase_id' => 29, 'object_id' => 30, 'version' => 31, 'version_created_at' => 32, 'version_comment' => 33, 'variation_of_id_version' => 34, 'multiple_of_id_version' => 35, 'kk_trixionary_skill_ids' => 36, 'kk_trixionary_skill_versions' => 37, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, )
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
        $this->setName('kk_trixionary_skill_version');
        $this->setPhpName('SkillVersion');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\SkillVersion');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'kk_trixionary_skill', 'id', true, null, null);
        $this->addColumn('sport_id', 'SportId', 'INTEGER', true, null, null);
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
        $this->addColumn('sequence_picture_url', 'SequencePictureUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('variation_of_id', 'VariationOfId', 'INTEGER', false, null, null);
        $this->addColumn('start_position_id', 'StartPositionId', 'INTEGER', false, null, null);
        $this->addColumn('end_position_id', 'EndPositionId', 'INTEGER', false, null, null);
        $this->addColumn('is_composite', 'IsComposite', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_multiple', 'IsMultiple', 'BOOLEAN', false, 1, false);
        $this->addColumn('multiple_of_id', 'MultipleOfId', 'INTEGER', false, null, null);
        $this->addColumn('multiplier', 'Multiplier', 'INTEGER', false, null, null);
        $this->addColumn('generation', 'Generation', 'INTEGER', false, null, null);
        $this->addColumn('importance', 'Importance', 'INTEGER', false, null, 0);
        $this->addColumn('picture_id', 'PictureId', 'INTEGER', false, null, null);
        $this->addColumn('video_id', 'VideoId', 'INTEGER', false, null, null);
        $this->addColumn('tutorial_id', 'TutorialId', 'INTEGER', false, null, null);
        $this->addColumn('kstruktur_id', 'KstrukturId', 'INTEGER', false, null, null);
        $this->addColumn('function_phase_id', 'FunctionPhaseId', 'INTEGER', false, null, null);
        $this->addColumn('object_id', 'ObjectId', 'INTEGER', false, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('variation_of_id_version', 'VariationOfIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('multiple_of_id_version', 'MultipleOfIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('kk_trixionary_skill_ids', 'KkTrixionarySkillIds', 'ARRAY', false, null, null);
        $this->addColumn('kk_trixionary_skill_versions', 'KkTrixionarySkillVersions', 'ARRAY', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \gossi\trixionary\model\SkillVersion $obj A \gossi\trixionary\model\SkillVersion object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getVersion()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \gossi\trixionary\model\SkillVersion object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \gossi\trixionary\model\SkillVersion) {
                $key = serialize(array((string) $value->getId(), (string) $value->getVersion()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \gossi\trixionary\model\SkillVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 31 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 31 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 31 + $offset
                : self::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? SkillVersionTableMap::CLASS_DEFAULT : SkillVersionTableMap::OM_CLASS;
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
     * @return array           (SkillVersion object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SkillVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SkillVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SkillVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SkillVersionTableMap::OM_CLASS;
            /** @var SkillVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SkillVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = SkillVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SkillVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SkillVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SkillVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SkillVersionTableMap::COL_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_SPORT_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_ALTERNATIVE_NAME);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_SLUG);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_HISTORY);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_TRANSLATION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_ROTATION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_ACYCLIC);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_CYCLIC);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_LATITUDINAL_FLAGS);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_SEQUENCE_PICTURE_URL);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VARIATION_OF_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_START_POSITION_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_END_POSITION_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_COMPOSITE);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IS_MULTIPLE);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_MULTIPLE_OF_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_MULTIPLIER);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_GENERATION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_IMPORTANCE);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_PICTURE_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VIDEO_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_TUTORIAL_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_KSTRUKTUR_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_FUNCTION_PHASE_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_OBJECT_ID);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS);
            $criteria->addSelectColumn(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS);
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
            $criteria->addSelectColumn($alias . '.sequence_picture_url');
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
            $criteria->addSelectColumn($alias . '.video_id');
            $criteria->addSelectColumn($alias . '.tutorial_id');
            $criteria->addSelectColumn($alias . '.kstruktur_id');
            $criteria->addSelectColumn($alias . '.function_phase_id');
            $criteria->addSelectColumn($alias . '.object_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.variation_of_id_version');
            $criteria->addSelectColumn($alias . '.multiple_of_id_version');
            $criteria->addSelectColumn($alias . '.kk_trixionary_skill_ids');
            $criteria->addSelectColumn($alias . '.kk_trixionary_skill_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(SkillVersionTableMap::DATABASE_NAME)->getTable(SkillVersionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SkillVersionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SkillVersionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SkillVersionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SkillVersion or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SkillVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\SkillVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SkillVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SkillVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SkillVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SkillVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SkillVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SkillVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_skill_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SkillVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SkillVersion or Criteria object.
     *
     * @param mixed               $criteria Criteria or SkillVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SkillVersion object
        }


        // Set the correct dbName
        $query = SkillVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SkillVersionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SkillVersionTableMap::buildTableMap();
