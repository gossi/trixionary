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
use gossi\trixionary\model\SkillDependency as ChildSkillDependency;
use gossi\trixionary\model\SkillDependencyQuery as ChildSkillDependencyQuery;
use gossi\trixionary\model\Map\SkillDependencyTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_skill_dependency' table.
 *
 *
 *
 * @method     ChildSkillDependencyQuery orderByDependencyId($order = Criteria::ASC) Order by the dependency_id column
 * @method     ChildSkillDependencyQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 *
 * @method     ChildSkillDependencyQuery groupByDependencyId() Group by the dependency_id column
 * @method     ChildSkillDependencyQuery groupByParentId() Group by the parent_id column
 *
 * @method     ChildSkillDependencyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSkillDependencyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSkillDependencyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSkillDependencyQuery leftJoinSkillRelatedByDependencyId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByDependencyId relation
 * @method     ChildSkillDependencyQuery rightJoinSkillRelatedByDependencyId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByDependencyId relation
 * @method     ChildSkillDependencyQuery innerJoinSkillRelatedByDependencyId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByDependencyId relation
 *
 * @method     ChildSkillDependencyQuery leftJoinSkillRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedByParentId relation
 * @method     ChildSkillDependencyQuery rightJoinSkillRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedByParentId relation
 * @method     ChildSkillDependencyQuery innerJoinSkillRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedByParentId relation
 *
 * @method     \gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSkillDependency findOne(ConnectionInterface $con = null) Return the first ChildSkillDependency matching the query
 * @method     ChildSkillDependency findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSkillDependency matching the query, or a new ChildSkillDependency object populated from the query conditions when no match is found
 *
 * @method     ChildSkillDependency findOneByDependencyId(int $dependency_id) Return the first ChildSkillDependency filtered by the dependency_id column
 * @method     ChildSkillDependency findOneByParentId(int $parent_id) Return the first ChildSkillDependency filtered by the parent_id column *

 * @method     ChildSkillDependency requirePk($key, ConnectionInterface $con = null) Return the ChildSkillDependency by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkillDependency requireOne(ConnectionInterface $con = null) Return the first ChildSkillDependency matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkillDependency requireOneByDependencyId(int $dependency_id) Return the first ChildSkillDependency filtered by the dependency_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkillDependency requireOneByParentId(int $parent_id) Return the first ChildSkillDependency filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkillDependency[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSkillDependency objects based on current ModelCriteria
 * @method     ChildSkillDependency[]|ObjectCollection findByDependencyId(int $dependency_id) Return ChildSkillDependency objects filtered by the dependency_id column
 * @method     ChildSkillDependency[]|ObjectCollection findByParentId(int $parent_id) Return ChildSkillDependency objects filtered by the parent_id column
 * @method     ChildSkillDependency[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SkillDependencyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\SkillDependencyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\SkillDependency', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSkillDependencyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSkillDependencyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSkillDependencyQuery) {
            return $criteria;
        }
        $query = new ChildSkillDependencyQuery();
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
     * @param array[$dependency_id, $parent_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSkillDependency|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SkillDependencyTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SkillDependencyTableMap::DATABASE_NAME);
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
     * @return ChildSkillDependency A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `dependency_id`, `parent_id` FROM `kk_trixionary_skill_dependency` WHERE `dependency_id` = :p0 AND `parent_id` = :p1';
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
            /** @var ChildSkillDependency $obj */
            $obj = new ChildSkillDependency();
            $obj->hydrate($row);
            SkillDependencyTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildSkillDependency|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SkillDependencyTableMap::COL_DEPENDENCY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SkillDependencyTableMap::COL_PARENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the dependency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDependencyId(1234); // WHERE dependency_id = 1234
     * $query->filterByDependencyId(array(12, 34)); // WHERE dependency_id IN (12, 34)
     * $query->filterByDependencyId(array('min' => 12)); // WHERE dependency_id > 12
     * </code>
     *
     * @see       filterBySkillRelatedByDependencyId()
     *
     * @param     mixed $dependencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterByDependencyId($dependencyId = null, $comparison = null)
    {
        if (is_array($dependencyId)) {
            $useMinMax = false;
            if (isset($dependencyId['min'])) {
                $this->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $dependencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dependencyId['max'])) {
                $this->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $dependencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $dependencyId, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @see       filterBySkillRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByDependencyId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillDependencyTableMap::COL_DEPENDENCY_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkillRelatedByDependencyId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByDependencyId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByDependencyId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByDependencyId');

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
            $this->addJoinObject($join, 'SkillRelatedByDependencyId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByDependencyId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByDependencyIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillRelatedByDependencyId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByDependencyId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByParentId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillDependencyTableMap::COL_PARENT_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkillRelatedByParentId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function joinSkillRelatedByParentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedByParentId');

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
            $this->addJoinObject($join, 'SkillRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedByParentId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedByParentId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSkillDependency $skillDependency Object to remove from the list of results
     *
     * @return $this|ChildSkillDependencyQuery The current query, for fluid interface
     */
    public function prune($skillDependency = null)
    {
        if ($skillDependency) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SkillDependencyTableMap::COL_DEPENDENCY_ID), $skillDependency->getDependencyId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SkillDependencyTableMap::COL_PARENT_ID), $skillDependency->getParentId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_skill_dependency table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillDependencyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SkillDependencyTableMap::clearInstancePool();
            SkillDependencyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillDependencyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SkillDependencyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SkillDependencyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SkillDependencyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SkillDependencyQuery
