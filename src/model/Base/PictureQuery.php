<?php

namespace gossi\trixionary\model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use gossi\trixionary\model\Picture as ChildPicture;
use gossi\trixionary\model\PictureQuery as ChildPictureQuery;
use gossi\trixionary\model\Map\PictureTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_picture' table.
 *
 *
 *
 * @method     ChildPictureQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPictureQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildPictureQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPictureQuery orderBySkillId($order = Criteria::ASC) Order by the skill_id column
 * @method     ChildPictureQuery orderByPhotographer($order = Criteria::ASC) Order by the photographer column
 * @method     ChildPictureQuery orderByPhotographerId($order = Criteria::ASC) Order by the photographer_id column
 * @method     ChildPictureQuery orderByMovender($order = Criteria::ASC) Order by the movender column
 * @method     ChildPictureQuery orderByMovenderId($order = Criteria::ASC) Order by the movender_id column
 * @method     ChildPictureQuery orderByUploaderId($order = Criteria::ASC) Order by the uploader_id column
 *
 * @method     ChildPictureQuery groupById() Group by the id column
 * @method     ChildPictureQuery groupByTitle() Group by the title column
 * @method     ChildPictureQuery groupByDescription() Group by the description column
 * @method     ChildPictureQuery groupBySkillId() Group by the skill_id column
 * @method     ChildPictureQuery groupByPhotographer() Group by the photographer column
 * @method     ChildPictureQuery groupByPhotographerId() Group by the photographer_id column
 * @method     ChildPictureQuery groupByMovender() Group by the movender column
 * @method     ChildPictureQuery groupByMovenderId() Group by the movender_id column
 * @method     ChildPictureQuery groupByUploaderId() Group by the uploader_id column
 *
 * @method     ChildPictureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPictureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPictureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPictureQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildPictureQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildPictureQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     ChildPictureQuery leftJoinFeaturedSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the FeaturedSkill relation
 * @method     ChildPictureQuery rightJoinFeaturedSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FeaturedSkill relation
 * @method     ChildPictureQuery innerJoinFeaturedSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the FeaturedSkill relation
 *
 * @method     \gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPicture findOne(ConnectionInterface $con = null) Return the first ChildPicture matching the query
 * @method     ChildPicture findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPicture matching the query, or a new ChildPicture object populated from the query conditions when no match is found
 *
 * @method     ChildPicture findOneById(int $id) Return the first ChildPicture filtered by the id column
 * @method     ChildPicture findOneByTitle(string $title) Return the first ChildPicture filtered by the title column
 * @method     ChildPicture findOneByDescription(string $description) Return the first ChildPicture filtered by the description column
 * @method     ChildPicture findOneBySkillId(int $skill_id) Return the first ChildPicture filtered by the skill_id column
 * @method     ChildPicture findOneByPhotographer(string $photographer) Return the first ChildPicture filtered by the photographer column
 * @method     ChildPicture findOneByPhotographerId(int $photographer_id) Return the first ChildPicture filtered by the photographer_id column
 * @method     ChildPicture findOneByMovender(string $movender) Return the first ChildPicture filtered by the movender column
 * @method     ChildPicture findOneByMovenderId(int $movender_id) Return the first ChildPicture filtered by the movender_id column
 * @method     ChildPicture findOneByUploaderId(int $uploader_id) Return the first ChildPicture filtered by the uploader_id column
 *
 * @method     ChildPicture[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPicture objects based on current ModelCriteria
 * @method     ChildPicture[]|ObjectCollection findById(int $id) Return ChildPicture objects filtered by the id column
 * @method     ChildPicture[]|ObjectCollection findByTitle(string $title) Return ChildPicture objects filtered by the title column
 * @method     ChildPicture[]|ObjectCollection findByDescription(string $description) Return ChildPicture objects filtered by the description column
 * @method     ChildPicture[]|ObjectCollection findBySkillId(int $skill_id) Return ChildPicture objects filtered by the skill_id column
 * @method     ChildPicture[]|ObjectCollection findByPhotographer(string $photographer) Return ChildPicture objects filtered by the photographer column
 * @method     ChildPicture[]|ObjectCollection findByPhotographerId(int $photographer_id) Return ChildPicture objects filtered by the photographer_id column
 * @method     ChildPicture[]|ObjectCollection findByMovender(string $movender) Return ChildPicture objects filtered by the movender column
 * @method     ChildPicture[]|ObjectCollection findByMovenderId(int $movender_id) Return ChildPicture objects filtered by the movender_id column
 * @method     ChildPicture[]|ObjectCollection findByUploaderId(int $uploader_id) Return ChildPicture objects filtered by the uploader_id column
 * @method     ChildPicture[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PictureQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\PictureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Picture', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPictureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPictureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPictureQuery) {
            return $criteria;
        }
        $query = new ChildPictureQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPicture|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PictureTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PictureTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPicture A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `title`, `description`, `skill_id`, `photographer`, `photographer_id`, `movender`, `movender_id`, `uploader_id` FROM `kk_trixionary_picture` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPicture $obj */
            $obj = new ChildPicture();
            $obj->hydrate($row);
            PictureTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPicture|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PictureTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PictureTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PictureTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PictureTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the skill_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillId(1234); // WHERE skill_id = 1234
     * $query->filterBySkillId(array(12, 34)); // WHERE skill_id IN (12, 34)
     * $query->filterBySkillId(array('min' => 12)); // WHERE skill_id > 12
     * </code>
     *
     * @see       filterBySkill()
     *
     * @param     mixed $skillId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterBySkillId($skillId = null, $comparison = null)
    {
        if (is_array($skillId)) {
            $useMinMax = false;
            if (isset($skillId['min'])) {
                $this->addUsingAlias(PictureTableMap::COL_SKILL_ID, $skillId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillId['max'])) {
                $this->addUsingAlias(PictureTableMap::COL_SKILL_ID, $skillId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_SKILL_ID, $skillId, $comparison);
    }

    /**
     * Filter the query on the photographer column
     *
     * Example usage:
     * <code>
     * $query->filterByPhotographer('fooValue');   // WHERE photographer = 'fooValue'
     * $query->filterByPhotographer('%fooValue%'); // WHERE photographer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $photographer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByPhotographer($photographer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($photographer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $photographer)) {
                $photographer = str_replace('*', '%', $photographer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_PHOTOGRAPHER, $photographer, $comparison);
    }

    /**
     * Filter the query on the photographer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPhotographerId(1234); // WHERE photographer_id = 1234
     * $query->filterByPhotographerId(array(12, 34)); // WHERE photographer_id IN (12, 34)
     * $query->filterByPhotographerId(array('min' => 12)); // WHERE photographer_id > 12
     * </code>
     *
     * @param     mixed $photographerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByPhotographerId($photographerId = null, $comparison = null)
    {
        if (is_array($photographerId)) {
            $useMinMax = false;
            if (isset($photographerId['min'])) {
                $this->addUsingAlias(PictureTableMap::COL_PHOTOGRAPHER_ID, $photographerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($photographerId['max'])) {
                $this->addUsingAlias(PictureTableMap::COL_PHOTOGRAPHER_ID, $photographerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_PHOTOGRAPHER_ID, $photographerId, $comparison);
    }

    /**
     * Filter the query on the movender column
     *
     * Example usage:
     * <code>
     * $query->filterByMovender('fooValue');   // WHERE movender = 'fooValue'
     * $query->filterByMovender('%fooValue%'); // WHERE movender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $movender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByMovender($movender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($movender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $movender)) {
                $movender = str_replace('*', '%', $movender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_MOVENDER, $movender, $comparison);
    }

    /**
     * Filter the query on the movender_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMovenderId(1234); // WHERE movender_id = 1234
     * $query->filterByMovenderId(array(12, 34)); // WHERE movender_id IN (12, 34)
     * $query->filterByMovenderId(array('min' => 12)); // WHERE movender_id > 12
     * </code>
     *
     * @param     mixed $movenderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByMovenderId($movenderId = null, $comparison = null)
    {
        if (is_array($movenderId)) {
            $useMinMax = false;
            if (isset($movenderId['min'])) {
                $this->addUsingAlias(PictureTableMap::COL_MOVENDER_ID, $movenderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($movenderId['max'])) {
                $this->addUsingAlias(PictureTableMap::COL_MOVENDER_ID, $movenderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_MOVENDER_ID, $movenderId, $comparison);
    }

    /**
     * Filter the query on the uploader_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUploaderId(1234); // WHERE uploader_id = 1234
     * $query->filterByUploaderId(array(12, 34)); // WHERE uploader_id IN (12, 34)
     * $query->filterByUploaderId(array('min' => 12)); // WHERE uploader_id > 12
     * </code>
     *
     * @param     mixed $uploaderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function filterByUploaderId($uploaderId = null, $comparison = null)
    {
        if (is_array($uploaderId)) {
            $useMinMax = false;
            if (isset($uploaderId['min'])) {
                $this->addUsingAlias(PictureTableMap::COL_UPLOADER_ID, $uploaderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploaderId['max'])) {
                $this->addUsingAlias(PictureTableMap::COL_UPLOADER_ID, $uploaderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PictureTableMap::COL_UPLOADER_ID, $uploaderId, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPictureQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(PictureTableMap::COL_SKILL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PictureTableMap::COL_SKILL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkill() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Skill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function joinSkill($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Skill');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Skill');
        }

        return $this;
    }

    /**
     * Use the Skill relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Skill', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPictureQuery The current query, for fluid interface
     */
    public function filterByFeaturedSkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(PictureTableMap::COL_ID, $skill->getPictureId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useFeaturedSkillQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFeaturedSkill() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FeaturedSkill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function joinFeaturedSkill($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FeaturedSkill');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FeaturedSkill');
        }

        return $this;
    }

    /**
     * Use the FeaturedSkill relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useFeaturedSkillQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFeaturedSkill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FeaturedSkill', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPicture $picture Object to remove from the list of results
     *
     * @return $this|ChildPictureQuery The current query, for fluid interface
     */
    public function prune($picture = null)
    {
        if ($picture) {
            $this->addUsingAlias(PictureTableMap::COL_ID, $picture->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_picture table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PictureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PictureTableMap::clearInstancePool();
            PictureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PictureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PictureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PictureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PictureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PictureQuery