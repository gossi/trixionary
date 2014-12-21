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
use gossi\trixionary\model\Video;
use gossi\trixionary\model\VideoQuery;


/**
 * This class defines the structure of the 'kk_trixionary_video' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VideoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VideoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_video';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Video';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Video';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_video.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'kk_trixionary_video.title';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'kk_trixionary_video.description';

    /**
     * the column name for the is_tutorial field
     */
    const COL_IS_TUTORIAL = 'kk_trixionary_video.is_tutorial';

    /**
     * the column name for the movender field
     */
    const COL_MOVENDER = 'kk_trixionary_video.movender';

    /**
     * the column name for the movender_id field
     */
    const COL_MOVENDER_ID = 'kk_trixionary_video.movender_id';

    /**
     * the column name for the uploader_id field
     */
    const COL_UPLOADER_ID = 'kk_trixionary_video.uploader_id';

    /**
     * the column name for the skill_id field
     */
    const COL_SKILL_ID = 'kk_trixionary_video.skill_id';

    /**
     * the column name for the reference_id field
     */
    const COL_REFERENCE_ID = 'kk_trixionary_video.reference_id';

    /**
     * the column name for the poster_url field
     */
    const COL_POSTER_URL = 'kk_trixionary_video.poster_url';

    /**
     * the column name for the provider field
     */
    const COL_PROVIDER = 'kk_trixionary_video.provider';

    /**
     * the column name for the provider_id field
     */
    const COL_PROVIDER_ID = 'kk_trixionary_video.provider_id';

    /**
     * the column name for the player_url field
     */
    const COL_PLAYER_URL = 'kk_trixionary_video.player_url';

    /**
     * the column name for the width field
     */
    const COL_WIDTH = 'kk_trixionary_video.width';

    /**
     * the column name for the height field
     */
    const COL_HEIGHT = 'kk_trixionary_video.height';

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
        self::TYPE_PHPNAME       => array('Id', 'Title', 'Description', 'IsTutorial', 'Movender', 'MovenderId', 'UploaderId', 'SkillId', 'ReferenceId', 'PosterUrl', 'Provider', 'ProviderId', 'PlayerUrl', 'Width', 'Height', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'description', 'isTutorial', 'movender', 'movenderId', 'uploaderId', 'skillId', 'referenceId', 'posterUrl', 'provider', 'providerId', 'playerUrl', 'width', 'height', ),
        self::TYPE_COLNAME       => array(VideoTableMap::COL_ID, VideoTableMap::COL_TITLE, VideoTableMap::COL_DESCRIPTION, VideoTableMap::COL_IS_TUTORIAL, VideoTableMap::COL_MOVENDER, VideoTableMap::COL_MOVENDER_ID, VideoTableMap::COL_UPLOADER_ID, VideoTableMap::COL_SKILL_ID, VideoTableMap::COL_REFERENCE_ID, VideoTableMap::COL_POSTER_URL, VideoTableMap::COL_PROVIDER, VideoTableMap::COL_PROVIDER_ID, VideoTableMap::COL_PLAYER_URL, VideoTableMap::COL_WIDTH, VideoTableMap::COL_HEIGHT, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'description', 'is_tutorial', 'movender', 'movender_id', 'uploader_id', 'skill_id', 'reference_id', 'poster_url', 'provider', 'provider_id', 'player_url', 'width', 'height', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'Description' => 2, 'IsTutorial' => 3, 'Movender' => 4, 'MovenderId' => 5, 'UploaderId' => 6, 'SkillId' => 7, 'ReferenceId' => 8, 'PosterUrl' => 9, 'Provider' => 10, 'ProviderId' => 11, 'PlayerUrl' => 12, 'Width' => 13, 'Height' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'description' => 2, 'isTutorial' => 3, 'movender' => 4, 'movenderId' => 5, 'uploaderId' => 6, 'skillId' => 7, 'referenceId' => 8, 'posterUrl' => 9, 'provider' => 10, 'providerId' => 11, 'playerUrl' => 12, 'width' => 13, 'height' => 14, ),
        self::TYPE_COLNAME       => array(VideoTableMap::COL_ID => 0, VideoTableMap::COL_TITLE => 1, VideoTableMap::COL_DESCRIPTION => 2, VideoTableMap::COL_IS_TUTORIAL => 3, VideoTableMap::COL_MOVENDER => 4, VideoTableMap::COL_MOVENDER_ID => 5, VideoTableMap::COL_UPLOADER_ID => 6, VideoTableMap::COL_SKILL_ID => 7, VideoTableMap::COL_REFERENCE_ID => 8, VideoTableMap::COL_POSTER_URL => 9, VideoTableMap::COL_PROVIDER => 10, VideoTableMap::COL_PROVIDER_ID => 11, VideoTableMap::COL_PLAYER_URL => 12, VideoTableMap::COL_WIDTH => 13, VideoTableMap::COL_HEIGHT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'description' => 2, 'is_tutorial' => 3, 'movender' => 4, 'movender_id' => 5, 'uploader_id' => 6, 'skill_id' => 7, 'reference_id' => 8, 'poster_url' => 9, 'provider' => 10, 'provider_id' => 11, 'player_url' => 12, 'width' => 13, 'height' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('kk_trixionary_video');
        $this->setPhpName('Video');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Video');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('is_tutorial', 'IsTutorial', 'BOOLEAN', false, 1, null);
        $this->addColumn('movender', 'Movender', 'VARCHAR', false, 255, null);
        $this->addColumn('movender_id', 'MovenderId', 'INTEGER', false, null, null);
        $this->addColumn('uploader_id', 'UploaderId', 'INTEGER', false, null, null);
        $this->addForeignKey('skill_id', 'SkillId', 'INTEGER', 'kk_trixionary_skill', 'id', true, null, null);
        $this->addForeignKey('reference_id', 'ReferenceId', 'INTEGER', 'kk_trixionary_reference', 'id', false, null, null);
        $this->addColumn('poster_url', 'PosterUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('provider', 'Provider', 'VARCHAR', false, 255, null);
        $this->addColumn('provider_id', 'ProviderId', 'VARCHAR', false, 255, null);
        $this->addColumn('player_url', 'PlayerUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('width', 'Width', 'INTEGER', false, null, null);
        $this->addColumn('height', 'Height', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array('skill_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Reference', '\\gossi\\trixionary\\model\\Reference', RelationMap::MANY_TO_ONE, array('reference_id' => 'id', ), null, null);
    } // buildRelations()

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
        return $withPrefix ? VideoTableMap::CLASS_DEFAULT : VideoTableMap::OM_CLASS;
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
     * @return array           (Video object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VideoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VideoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VideoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VideoTableMap::OM_CLASS;
            /** @var Video $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VideoTableMap::addInstanceToPool($obj, $key);
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
            $key = VideoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VideoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Video $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VideoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VideoTableMap::COL_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_TITLE);
            $criteria->addSelectColumn(VideoTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(VideoTableMap::COL_IS_TUTORIAL);
            $criteria->addSelectColumn(VideoTableMap::COL_MOVENDER);
            $criteria->addSelectColumn(VideoTableMap::COL_MOVENDER_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_UPLOADER_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_SKILL_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_REFERENCE_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_POSTER_URL);
            $criteria->addSelectColumn(VideoTableMap::COL_PROVIDER);
            $criteria->addSelectColumn(VideoTableMap::COL_PROVIDER_ID);
            $criteria->addSelectColumn(VideoTableMap::COL_PLAYER_URL);
            $criteria->addSelectColumn(VideoTableMap::COL_WIDTH);
            $criteria->addSelectColumn(VideoTableMap::COL_HEIGHT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.is_tutorial');
            $criteria->addSelectColumn($alias . '.movender');
            $criteria->addSelectColumn($alias . '.movender_id');
            $criteria->addSelectColumn($alias . '.uploader_id');
            $criteria->addSelectColumn($alias . '.skill_id');
            $criteria->addSelectColumn($alias . '.reference_id');
            $criteria->addSelectColumn($alias . '.poster_url');
            $criteria->addSelectColumn($alias . '.provider');
            $criteria->addSelectColumn($alias . '.provider_id');
            $criteria->addSelectColumn($alias . '.player_url');
            $criteria->addSelectColumn($alias . '.width');
            $criteria->addSelectColumn($alias . '.height');
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
        return Propel::getServiceContainer()->getDatabaseMap(VideoTableMap::DATABASE_NAME)->getTable(VideoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VideoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VideoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VideoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Video or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Video object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Video) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VideoTableMap::DATABASE_NAME);
            $criteria->add(VideoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VideoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VideoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VideoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_video table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VideoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Video or Criteria object.
     *
     * @param mixed               $criteria Criteria or Video object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Video object
        }

        if ($criteria->containsKey(VideoTableMap::COL_ID) && $criteria->keyContainsValue(VideoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VideoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VideoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VideoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VideoTableMap::buildTableMap();
