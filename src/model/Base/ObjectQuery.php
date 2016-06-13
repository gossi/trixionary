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
use gossi\trixionary\model\Object as ChildObject;
use gossi\trixionary\model\ObjectQuery as ChildObjectQuery;
use gossi\trixionary\model\Map\ObjectTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_object' table.
 *
 *
 *
 * @method     ChildObjectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjectQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildObjectQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildObjectQuery orderByFixed($order = Criteria::ASC) Order by the fixed column
 * @method     ChildObjectQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildObjectQuery orderBySportId($order = Criteria::ASC) Order by the sport_id column
 * @method     ChildObjectQuery orderBySkillCount($order = Criteria::ASC) Order by the skill_count column
 *
 * @method     ChildObjectQuery groupById() Group by the id column
 * @method     ChildObjectQuery groupByTitle() Group by the title column
 * @method     ChildObjectQuery groupBySlug() Group by the slug column
 * @method     ChildObjectQuery groupByFixed() Group by the fixed column
 * @method     ChildObjectQuery groupByDescription() Group by the description column
 * @method     ChildObjectQuery groupBySportId() Group by the sport_id column
 * @method     ChildObjectQuery groupBySkillCount() Group by the skill_count column
 *
 * @method     ChildObjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjectQuery leftJoinSport($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sport relation
 * @method     ChildObjectQuery rightJoinSport($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sport relation
 * @method     ChildObjectQuery innerJoinSport($relationAlias = null) Adds a INNER JOIN clause to the query using the Sport relation
 *
 * @method     ChildObjectQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildObjectQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildObjectQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     \gossi\trixionary\model\SportQuery|\gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObject findOne(ConnectionInterface $con = null) Return the first ChildObject matching the query
 * @method     ChildObject findOneOrCreate(ConnectionInterface $con = null) Return the first ChildObject matching the query, or a new ChildObject object populated from the query conditions when no match is found
 *
 * @method     ChildObject findOneById(int $id) Return the first ChildObject filtered by the id column
 * @method     ChildObject findOneByTitle(string $title) Return the first ChildObject filtered by the title column
 * @method     ChildObject findOneBySlug(string $slug) Return the first ChildObject filtered by the slug column
 * @method     ChildObject findOneByFixed(boolean $fixed) Return the first ChildObject filtered by the fixed column
 * @method     ChildObject findOneByDescription(string $description) Return the first ChildObject filtered by the description column
 * @method     ChildObject findOneBySportId(int $sport_id) Return the first ChildObject filtered by the sport_id column
 * @method     ChildObject findOneBySkillCount(int $skill_count) Return the first ChildObject filtered by the skill_count column *

 * @method     ChildObject requirePk($key, ConnectionInterface $con = null) Return the ChildObject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOne(ConnectionInterface $con = null) Return the first ChildObject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObject requireOneById(int $id) Return the first ChildObject filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneByTitle(string $title) Return the first ChildObject filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneBySlug(string $slug) Return the first ChildObject filtered by the slug column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneByFixed(boolean $fixed) Return the first ChildObject filtered by the fixed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneByDescription(string $description) Return the first ChildObject filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneBySportId(int $sport_id) Return the first ChildObject filtered by the sport_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObject requireOneBySkillCount(int $skill_count) Return the first ChildObject filtered by the skill_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObject[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildObject objects based on current ModelCriteria
 * @method     ChildObject[]|ObjectCollection findById(int $id) Return ChildObject objects filtered by the id column
 * @method     ChildObject[]|ObjectCollection findByTitle(string $title) Return ChildObject objects filtered by the title column
 * @method     ChildObject[]|ObjectCollection findBySlug(string $slug) Return ChildObject objects filtered by the slug column
 * @method     ChildObject[]|ObjectCollection findByFixed(boolean $fixed) Return ChildObject objects filtered by the fixed column
 * @method     ChildObject[]|ObjectCollection findByDescription(string $description) Return ChildObject objects filtered by the description column
 * @method     ChildObject[]|ObjectCollection findBySportId(int $sport_id) Return ChildObject objects filtered by the sport_id column
 * @method     ChildObject[]|ObjectCollection findBySkillCount(int $skill_count) Return ChildObject objects filtered by the skill_count column
 * @method     ChildObject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\ObjectQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Object', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjectQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildObjectQuery) {
            return $criteria;
        }
        $query = new ChildObjectQuery();
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
     * @return ChildObject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ObjectTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjectTableMap::DATABASE_NAME);
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
     * @return ChildObject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `title`, `slug`, `fixed`, `description`, `sport_id`, `skill_count` FROM `kk_trixionary_object` WHERE `id` = :p0';
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
            /** @var ChildObject $obj */
            $obj = new ChildObject();
            $obj->hydrate($row);
            ObjectTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildObject|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ObjectTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ObjectTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ObjectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ObjectTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildObjectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ObjectTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ObjectTableMap::COL_SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the fixed column
     *
     * Example usage:
     * <code>
     * $query->filterByFixed(true); // WHERE fixed = true
     * $query->filterByFixed('yes'); // WHERE fixed = true
     * </code>
     *
     * @param     boolean|string $fixed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterByFixed($fixed = null, $comparison = null)
    {
        if (is_string($fixed)) {
            $fixed = in_array(strtolower($fixed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ObjectTableMap::COL_FIXED, $fixed, $comparison);
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
     * @return $this|ChildObjectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ObjectTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the sport_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySportId(1234); // WHERE sport_id = 1234
     * $query->filterBySportId(array(12, 34)); // WHERE sport_id IN (12, 34)
     * $query->filterBySportId(array('min' => 12)); // WHERE sport_id > 12
     * </code>
     *
     * @see       filterBySport()
     *
     * @param     mixed $sportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterBySportId($sportId = null, $comparison = null)
    {
        if (is_array($sportId)) {
            $useMinMax = false;
            if (isset($sportId['min'])) {
                $this->addUsingAlias(ObjectTableMap::COL_SPORT_ID, $sportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sportId['max'])) {
                $this->addUsingAlias(ObjectTableMap::COL_SPORT_ID, $sportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ObjectTableMap::COL_SPORT_ID, $sportId, $comparison);
    }

    /**
     * Filter the query on the skill_count column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillCount(1234); // WHERE skill_count = 1234
     * $query->filterBySkillCount(array(12, 34)); // WHERE skill_count IN (12, 34)
     * $query->filterBySkillCount(array('min' => 12)); // WHERE skill_count > 12
     * </code>
     *
     * @param     mixed $skillCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function filterBySkillCount($skillCount = null, $comparison = null)
    {
        if (is_array($skillCount)) {
            $useMinMax = false;
            if (isset($skillCount['min'])) {
                $this->addUsingAlias(ObjectTableMap::COL_SKILL_COUNT, $skillCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillCount['max'])) {
                $this->addUsingAlias(ObjectTableMap::COL_SKILL_COUNT, $skillCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ObjectTableMap::COL_SKILL_COUNT, $skillCount, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Sport object
     *
     * @param \gossi\trixionary\model\Sport|ObjectCollection $sport The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildObjectQuery The current query, for fluid interface
     */
    public function filterBySport($sport, $comparison = null)
    {
        if ($sport instanceof \gossi\trixionary\model\Sport) {
            return $this
                ->addUsingAlias(ObjectTableMap::COL_SPORT_ID, $sport->getId(), $comparison);
        } elseif ($sport instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ObjectTableMap::COL_SPORT_ID, $sport->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySport() only accepts arguments of type \gossi\trixionary\model\Sport or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sport relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function joinSport($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sport');

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
            $this->addJoinObject($join, 'Sport');
        }

        return $this;
    }

    /**
     * Use the Sport relation Sport object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SportQuery A secondary query class using the current class as primary query
     */
    public function useSportQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSport($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sport', '\gossi\trixionary\model\SportQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildObjectQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(ObjectTableMap::COL_ID, $skill->getObjectId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useSkillQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function joinSkill($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useSkillQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSkill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Skill', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildObject $object Object to remove from the list of results
     *
     * @return $this|ChildObjectQuery The current query, for fluid interface
     */
    public function prune($object = null)
    {
        if ($object) {
            $this->addUsingAlias(ObjectTableMap::COL_ID, $object->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_object table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjectTableMap::clearInstancePool();
            ObjectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ObjectQuery
