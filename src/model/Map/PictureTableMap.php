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
use gossi\trixionary\model\Picture;
use gossi\trixionary\model\PictureQuery;


/**
 * This class defines the structure of the 'kk_trixionary_picture' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PictureTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PictureTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_picture';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Picture';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Picture';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_picture.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'kk_trixionary_picture.title';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'kk_trixionary_picture.description';

    /**
     * the column name for the url field
     */
    const COL_URL = 'kk_trixionary_picture.url';

    /**
     * the column name for the thumb_url field
     */
    const COL_THUMB_URL = 'kk_trixionary_picture.thumb_url';

    /**
     * the column name for the skill_id field
     */
    const COL_SKILL_ID = 'kk_trixionary_picture.skill_id';

    /**
     * the column name for the photographer field
     */
    const COL_PHOTOGRAPHER = 'kk_trixionary_picture.photographer';

    /**
     * the column name for the photographer_id field
     */
    const COL_PHOTOGRAPHER_ID = 'kk_trixionary_picture.photographer_id';

    /**
     * the column name for the athlete field
     */
    const COL_ATHLETE = 'kk_trixionary_picture.athlete';

    /**
     * the column name for the athlete_id field
     */
    const COL_ATHLETE_ID = 'kk_trixionary_picture.athlete_id';

    /**
     * the column name for the uploader_id field
     */
    const COL_UPLOADER_ID = 'kk_trixionary_picture.uploader_id';

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
        self::TYPE_PHPNAME       => array('Id', 'Title', 'Description', 'Url', 'ThumbUrl', 'SkillId', 'Photographer', 'PhotographerId', 'Athlete', 'AthleteId', 'UploaderId', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'description', 'url', 'thumbUrl', 'skillId', 'photographer', 'photographerId', 'athlete', 'athleteId', 'uploaderId', ),
        self::TYPE_COLNAME       => array(PictureTableMap::COL_ID, PictureTableMap::COL_TITLE, PictureTableMap::COL_DESCRIPTION, PictureTableMap::COL_URL, PictureTableMap::COL_THUMB_URL, PictureTableMap::COL_SKILL_ID, PictureTableMap::COL_PHOTOGRAPHER, PictureTableMap::COL_PHOTOGRAPHER_ID, PictureTableMap::COL_ATHLETE, PictureTableMap::COL_ATHLETE_ID, PictureTableMap::COL_UPLOADER_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'description', 'url', 'thumb_url', 'skill_id', 'photographer', 'photographer_id', 'athlete', 'athlete_id', 'uploader_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'Description' => 2, 'Url' => 3, 'ThumbUrl' => 4, 'SkillId' => 5, 'Photographer' => 6, 'PhotographerId' => 7, 'Athlete' => 8, 'AthleteId' => 9, 'UploaderId' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'description' => 2, 'url' => 3, 'thumbUrl' => 4, 'skillId' => 5, 'photographer' => 6, 'photographerId' => 7, 'athlete' => 8, 'athleteId' => 9, 'uploaderId' => 10, ),
        self::TYPE_COLNAME       => array(PictureTableMap::COL_ID => 0, PictureTableMap::COL_TITLE => 1, PictureTableMap::COL_DESCRIPTION => 2, PictureTableMap::COL_URL => 3, PictureTableMap::COL_THUMB_URL => 4, PictureTableMap::COL_SKILL_ID => 5, PictureTableMap::COL_PHOTOGRAPHER => 6, PictureTableMap::COL_PHOTOGRAPHER_ID => 7, PictureTableMap::COL_ATHLETE => 8, PictureTableMap::COL_ATHLETE_ID => 9, PictureTableMap::COL_UPLOADER_ID => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'description' => 2, 'url' => 3, 'thumb_url' => 4, 'skill_id' => 5, 'photographer' => 6, 'photographer_id' => 7, 'athlete' => 8, 'athlete_id' => 9, 'uploader_id' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('kk_trixionary_picture');
        $this->setPhpName('Picture');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Picture');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('thumb_url', 'ThumbUrl', 'VARCHAR', false, 255, null);
        $this->addForeignKey('skill_id', 'SkillId', 'INTEGER', 'kk_trixionary_skill', 'id', true, null, null);
        $this->addColumn('photographer', 'Photographer', 'VARCHAR', false, 255, null);
        $this->addColumn('photographer_id', 'PhotographerId', 'INTEGER', false, null, null);
        $this->addColumn('athlete', 'Athlete', 'VARCHAR', false, 255, null);
        $this->addColumn('athlete_id', 'AthleteId', 'INTEGER', false, null, null);
        $this->addColumn('uploader_id', 'UploaderId', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':skill_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('FeaturedSkill', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':picture_id',
    1 => ':id',
  ),
), null, null, 'FeaturedSkills', false);
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
        return $withPrefix ? PictureTableMap::CLASS_DEFAULT : PictureTableMap::OM_CLASS;
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
     * @return array           (Picture object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PictureTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PictureTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PictureTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PictureTableMap::OM_CLASS;
            /** @var Picture $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PictureTableMap::addInstanceToPool($obj, $key);
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
            $key = PictureTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PictureTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Picture $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PictureTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PictureTableMap::COL_ID);
            $criteria->addSelectColumn(PictureTableMap::COL_TITLE);
            $criteria->addSelectColumn(PictureTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(PictureTableMap::COL_URL);
            $criteria->addSelectColumn(PictureTableMap::COL_THUMB_URL);
            $criteria->addSelectColumn(PictureTableMap::COL_SKILL_ID);
            $criteria->addSelectColumn(PictureTableMap::COL_PHOTOGRAPHER);
            $criteria->addSelectColumn(PictureTableMap::COL_PHOTOGRAPHER_ID);
            $criteria->addSelectColumn(PictureTableMap::COL_ATHLETE);
            $criteria->addSelectColumn(PictureTableMap::COL_ATHLETE_ID);
            $criteria->addSelectColumn(PictureTableMap::COL_UPLOADER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.thumb_url');
            $criteria->addSelectColumn($alias . '.skill_id');
            $criteria->addSelectColumn($alias . '.photographer');
            $criteria->addSelectColumn($alias . '.photographer_id');
            $criteria->addSelectColumn($alias . '.athlete');
            $criteria->addSelectColumn($alias . '.athlete_id');
            $criteria->addSelectColumn($alias . '.uploader_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PictureTableMap::DATABASE_NAME)->getTable(PictureTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PictureTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PictureTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PictureTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Picture or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Picture object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PictureTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Picture) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PictureTableMap::DATABASE_NAME);
            $criteria->add(PictureTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PictureQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PictureTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PictureTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_picture table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PictureQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Picture or Criteria object.
     *
     * @param mixed               $criteria Criteria or Picture object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PictureTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Picture object
        }

        if ($criteria->containsKey(PictureTableMap::COL_ID) && $criteria->keyContainsValue(PictureTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PictureTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PictureQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PictureTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PictureTableMap::buildTableMap();
