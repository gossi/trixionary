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
use gossi\trixionary\model\SkillPart as ChildSkillPart;
use gossi\trixionary\model\SkillPartQuery as ChildSkillPartQuery;
use gossi\trixionary\model\Map\SkillPartTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_skill_part' table.
 *
 *
 *
 * @method     ChildSkillPartQuery orderByCompositeId($order = Criteria::ASC) Order by the composite_id column
 * @method     ChildSkillPartQuery orderByPartId($order = Criteria::ASC) Order by the part_id column
 *
 * @method     ChildSkillPartQuery groupByCompositeId() Group by the composite_id column
 * @method     ChildSkillPartQuery groupByPartId() Group by the part_id column
 *
 * @method     ChildSkillPartQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSkillPartQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSkillPartQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSkillPartQuery leftJoinSkillRelatedByPartId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByPartId relation
 * @method     ChildSkillPartQuery rightJoinSkillRelatedByPartId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByPartId relation
 * @method     ChildSkillPartQuery innerJoinSkillRelatedByPartId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByPartId relation
 *
 * @method     ChildSkillPartQuery leftJoinSkillRelatedByCompositeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByCompositeId relation
 * @method     ChildSkillPartQuery rightJoinSkillRelatedByCompositeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByCompositeId relation
 * @method     ChildSkillPartQuery innerJoinSkillRelatedByCompositeId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByCompositeId relation
 *
 * @method     \gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSkillPart findOne(ConnectionInterface $con = null) Return the first ChildSkillPart matching the query
 * @method     ChildSkillPart findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSkillPart matching the query, or a new ChildSkillPart object populated from the query conditions when no match is found
 *
 * @method     ChildSkillPart findOneByCompositeId(int $composite_id) Return the first ChildSkillPart filtered by the composite_id column
 * @method     ChildSkillPart findOneByPartId(int $part_id) Return the first ChildSkillPart filtered by the part_id column
 *
 * @method     ChildSkillPart[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSkillPart objects based on current ModelCriteria
 * @method     ChildSkillPart[]|ObjectCollection findByCompositeId(int $composite_id) Return ChildSkillPart objects filtered by the composite_id column
 * @method     ChildSkillPart[]|ObjectCollection findByPartId(int $part_id) Return ChildSkillPart objects filtered by the part_id column
 * @method     ChildSkillPart[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SkillPartQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\SkillPartQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\SkillPart', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSkillPartQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSkillPartQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSkillPartQuery) {
            return $criteria;
        }
        $query = new ChildSkillPartQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$composite_id, $part_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSkillPart|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SkillPartTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SkillPartTableMap::DATABASE_NAME);
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
     * @return ChildSkillPart A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `composite_id`, `part_id` FROM `kk_trixionary_skill_part` WHERE `composite_id` = :p0 AND `part_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSkillPart $obj */
            $obj = new ChildSkillPart();
            $obj->hydrate($row);
            SkillPartTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildSkillPart|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SkillPartTableMap::COL_PART_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SkillPartTableMap::COL_COMPOSITE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SkillPartTableMap::COL_PART_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the composite_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompositeId(1234); // WHERE composite_id = 1234
     * $query->filterByCompositeId(array(12, 34)); // WHERE composite_id IN (12, 34)
     * $query->filterByCompositeId(array('min' => 12)); // WHERE composite_id > 12
     * </code>
     *
     * @see       filterBySkillRelatedByCompositeId()
     *
     * @param     mixed $compositeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterByCompositeId($compositeId = null, $comparison = null)
    {
        if (is_array($compositeId)) {
            $useMinMax = false;
            if (isset($compositeId['min'])) {
                $this->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $compositeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($compositeId['max'])) {
                $this->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $compositeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $compositeId, $comparison);
    }

    /**
     * Filter the query on the part_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPartId(1234); // WHERE part_id = 1234
     * $query->filterByPartId(array(12, 34)); // WHERE part_id IN (12, 34)
     * $query->filterByPartId(array('min' => 12)); // WHERE part_id > 12
     * </code>
     *
     * @see       filterBySkillRelatedByPartId()
     *
     * @param     mixed $partId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterByPartId($partId = null, $comparison = null)
    {
        if (is_array($partId)) {
            $useMinMax = false;
            if (isset($partId['min'])) {
                $this->addUsingAlias(SkillPartTableMap::COL_PART_ID, $partId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($partId['max'])) {
                $this->addUsingAlias(SkillPartTableMap::COL_PART_ID, $partId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillPartTableMap::COL_PART_ID, $partId, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByPartId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillPartTableMap::COL_PART_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillPartTableMap::COL_PART_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkillRelatedByPartId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByPartId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByPartId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByPartId');

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
            $this->addJoinObject($join, 'SkillRelatedByPartId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByPartId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByPartIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillRelatedByPartId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByPartId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillPartQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByCompositeId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillPartTableMap::COL_COMPOSITE_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkillRelatedByCompositeId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByCompositeId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByCompositeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByCompositeId');

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
            $this->addJoinObject($join, 'SkillRelatedByCompositeId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByCompositeId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByCompositeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillRelatedByCompositeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByCompositeId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSkillPart $skillPart Object to remove from the list of results
     *
     * @return $this|ChildSkillPartQuery The current query, for fluid interface
     */
    public function prune($skillPart = null)
    {
        if ($skillPart) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SkillPartTableMap::COL_COMPOSITE_ID), $skillPart->getCompositeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SkillPartTableMap::COL_PART_ID), $skillPart->getPartId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_skill_part table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillPartTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SkillPartTableMap::clearInstancePool();
            SkillPartTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillPartTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SkillPartTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SkillPartTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SkillPartTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SkillPartQuery