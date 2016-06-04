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
use gossi\trixionary\model\Position as ChildPosition;
use gossi\trixionary\model\PositionQuery as ChildPositionQuery;
use gossi\trixionary\model\Map\PositionTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_position' table.
 *
 *
 *
 * @method     ChildPositionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPositionQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildPositionQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildPositionQuery orderBySportId($order = Criteria::ASC) Order by the sport_id column
 * @method     ChildPositionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildPositionQuery groupById() Group by the id column
 * @method     ChildPositionQuery groupByTitle() Group by the title column
 * @method     ChildPositionQuery groupBySlug() Group by the slug column
 * @method     ChildPositionQuery groupBySportId() Group by the sport_id column
 * @method     ChildPositionQuery groupByDescription() Group by the description column
 *
 * @method     ChildPositionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionQuery leftJoinSport($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sport relation
 * @method     ChildPositionQuery rightJoinSport($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sport relation
 * @method     ChildPositionQuery innerJoinSport($relationAlias = null) Adds a INNER JOIN clause to the query using the Sport relation
 *
 * @method     ChildPositionQuery leftJoinSkillRelatedByStartPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByStartPositionId relation
 * @method     ChildPositionQuery rightJoinSkillRelatedByStartPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByStartPositionId relation
 * @method     ChildPositionQuery innerJoinSkillRelatedByStartPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByStartPositionId relation
 *
 * @method     ChildPositionQuery leftJoinSkillRelatedByEndPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByEndPositionId relation
 * @method     ChildPositionQuery rightJoinSkillRelatedByEndPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByEndPositionId relation
 * @method     ChildPositionQuery innerJoinSkillRelatedByEndPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByEndPositionId relation
 *
 * @method     \gossi\trixionary\model\SportQuery|\gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPosition findOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query
 * @method     ChildPosition findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPosition matching the query, or a new ChildPosition object populated from the query conditions when no match is found
 *
 * @method     ChildPosition findOneById(int $id) Return the first ChildPosition filtered by the id column
 * @method     ChildPosition findOneByTitle(string $title) Return the first ChildPosition filtered by the title column
 * @method     ChildPosition findOneBySlug(string $slug) Return the first ChildPosition filtered by the slug column
 * @method     ChildPosition findOneBySportId(int $sport_id) Return the first ChildPosition filtered by the sport_id column
 * @method     ChildPosition findOneByDescription(string $description) Return the first ChildPosition filtered by the description column *

 * @method     ChildPosition requirePk($key, ConnectionInterface $con = null) Return the ChildPosition by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition requireOneById(int $id) Return the first ChildPosition filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByTitle(string $title) Return the first ChildPosition filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneBySlug(string $slug) Return the first ChildPosition filtered by the slug column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneBySportId(int $sport_id) Return the first ChildPosition filtered by the sport_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByDescription(string $description) Return the first ChildPosition filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPosition objects based on current ModelCriteria
 * @method     ChildPosition[]|ObjectCollection findById(int $id) Return ChildPosition objects filtered by the id column
 * @method     ChildPosition[]|ObjectCollection findByTitle(string $title) Return ChildPosition objects filtered by the title column
 * @method     ChildPosition[]|ObjectCollection findBySlug(string $slug) Return ChildPosition objects filtered by the slug column
 * @method     ChildPosition[]|ObjectCollection findBySportId(int $sport_id) Return ChildPosition objects filtered by the sport_id column
 * @method     ChildPosition[]|ObjectCollection findByDescription(string $description) Return ChildPosition objects filtered by the description column
 * @method     ChildPosition[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PositionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\PositionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Position', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPositionQuery) {
            return $criteria;
        }
        $query = new ChildPositionQuery();
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
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PositionTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionTableMap::DATABASE_NAME);
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
     * @return ChildPosition A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `title`, `slug`, `sport_id`, `description` FROM `kk_trixionary_position` WHERE `id` = :p0';
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
            /** @var ChildPosition $obj */
            $obj = new ChildPosition();
            $obj->hydrate($row);
            PositionTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PositionTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PositionTableMap::COL_SLUG, $slug, $comparison);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterBySportId($sportId = null, $comparison = null)
    {
        if (is_array($sportId)) {
            $useMinMax = false;
            if (isset($sportId['min'])) {
                $this->addUsingAlias(PositionTableMap::COL_SPORT_ID, $sportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sportId['max'])) {
                $this->addUsingAlias(PositionTableMap::COL_SPORT_ID, $sportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_SPORT_ID, $sportId, $comparison);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PositionTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Sport object
     *
     * @param \gossi\trixionary\model\Sport|ObjectCollection $sport The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPositionQuery The current query, for fluid interface
     */
    public function filterBySport($sport, $comparison = null)
    {
        if ($sport instanceof \gossi\trixionary\model\Sport) {
            return $this
                ->addUsingAlias(PositionTableMap::COL_SPORT_ID, $sport->getId(), $comparison);
        } elseif ($sport instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionTableMap::COL_SPORT_ID, $sport->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPositionQuery The current query, for fluid interface
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
     * @return ChildPositionQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByStartPositionId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(PositionTableMap::COL_ID, $skill->getStartPositionId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useSkillRelatedByStartPositionIdQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySkillRelatedByStartPositionId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByStartPositionId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByStartPositionId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByStartPositionId');

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
            $this->addJoinObject($join, 'SkillRelatedByStartPositionId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByStartPositionId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByStartPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSkillRelatedByStartPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByStartPositionId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPositionQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByEndPositionId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(PositionTableMap::COL_ID, $skill->getEndPositionId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useSkillRelatedByEndPositionIdQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySkillRelatedByEndPositionId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByEndPositionId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByEndPositionId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByEndPositionId');

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
            $this->addJoinObject($join, 'SkillRelatedByEndPositionId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByEndPositionId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByEndPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSkillRelatedByEndPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByEndPositionId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPosition $position Object to remove from the list of results
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function prune($position = null)
    {
        if ($position) {
            $this->addUsingAlias(PositionTableMap::COL_ID, $position->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_position table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionTableMap::clearInstancePool();
            PositionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PositionQuery
