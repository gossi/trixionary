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
use gossi\trixionary\model\StructureNodeParent as ChildStructureNodeParent;
use gossi\trixionary\model\StructureNodeParentQuery as ChildStructureNodeParentQuery;
use gossi\trixionary\model\Map\StructureNodeParentTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_structure_node_parent' table.
 *
 *
 *
 * @method     ChildStructureNodeParentQuery orderByStructureNodeId($order = Criteria::ASC) Order by the structure_node_id column
 * @method     ChildStructureNodeParentQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 *
 * @method     ChildStructureNodeParentQuery groupByStructureNodeId() Group by the structure_node_id column
 * @method     ChildStructureNodeParentQuery groupByParentId() Group by the parent_id column
 *
 * @method     ChildStructureNodeParentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStructureNodeParentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStructureNodeParentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStructureNodeParentQuery leftJoinStructureNodeRelatedByStructureNodeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNodeRelatedByStructureNodeId relation
 * @method     ChildStructureNodeParentQuery rightJoinStructureNodeRelatedByStructureNodeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNodeRelatedByStructureNodeId relation
 * @method     ChildStructureNodeParentQuery innerJoinStructureNodeRelatedByStructureNodeId($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNodeRelatedByStructureNodeId relation
 *
 * @method     ChildStructureNodeParentQuery leftJoinStructureNodeRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNodeRelatedByParentId relation
 * @method     ChildStructureNodeParentQuery rightJoinStructureNodeRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNodeRelatedByParentId relation
 * @method     ChildStructureNodeParentQuery innerJoinStructureNodeRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNodeRelatedByParentId relation
 *
 * @method     \gossi\trixionary\model\StructureNodeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStructureNodeParent findOne(ConnectionInterface $con = null) Return the first ChildStructureNodeParent matching the query
 * @method     ChildStructureNodeParent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStructureNodeParent matching the query, or a new ChildStructureNodeParent object populated from the query conditions when no match is found
 *
 * @method     ChildStructureNodeParent findOneByStructureNodeId(int $structure_node_id) Return the first ChildStructureNodeParent filtered by the structure_node_id column
 * @method     ChildStructureNodeParent findOneByParentId(int $parent_id) Return the first ChildStructureNodeParent filtered by the parent_id column *

 * @method     ChildStructureNodeParent requirePk($key, ConnectionInterface $con = null) Return the ChildStructureNodeParent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructureNodeParent requireOne(ConnectionInterface $con = null) Return the first ChildStructureNodeParent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStructureNodeParent requireOneByStructureNodeId(int $structure_node_id) Return the first ChildStructureNodeParent filtered by the structure_node_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStructureNodeParent requireOneByParentId(int $parent_id) Return the first ChildStructureNodeParent filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStructureNodeParent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStructureNodeParent objects based on current ModelCriteria
 * @method     ChildStructureNodeParent[]|ObjectCollection findByStructureNodeId(int $structure_node_id) Return ChildStructureNodeParent objects filtered by the structure_node_id column
 * @method     ChildStructureNodeParent[]|ObjectCollection findByParentId(int $parent_id) Return ChildStructureNodeParent objects filtered by the parent_id column
 * @method     ChildStructureNodeParent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StructureNodeParentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\StructureNodeParentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\StructureNodeParent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStructureNodeParentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStructureNodeParentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStructureNodeParentQuery) {
            return $criteria;
        }
        $query = new ChildStructureNodeParentQuery();
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
     * @param array[$structure_node_id, $parent_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildStructureNodeParent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = StructureNodeParentTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StructureNodeParentTableMap::DATABASE_NAME);
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
     * @return ChildStructureNodeParent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `structure_node_id`, `parent_id` FROM `kk_trixionary_structure_node_parent` WHERE `structure_node_id` = :p0 AND `parent_id` = :p1';
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
            /** @var ChildStructureNodeParent $obj */
            $obj = new ChildStructureNodeParent();
            $obj->hydrate($row);
            StructureNodeParentTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildStructureNodeParent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(StructureNodeParentTableMap::COL_PARENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the structure_node_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStructureNodeId(1234); // WHERE structure_node_id = 1234
     * $query->filterByStructureNodeId(array(12, 34)); // WHERE structure_node_id IN (12, 34)
     * $query->filterByStructureNodeId(array('min' => 12)); // WHERE structure_node_id > 12
     * </code>
     *
     * @see       filterByStructureNodeRelatedByStructureNodeId()
     *
     * @param     mixed $structureNodeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByStructureNodeId($structureNodeId = null, $comparison = null)
    {
        if (is_array($structureNodeId)) {
            $useMinMax = false;
            if (isset($structureNodeId['min'])) {
                $this->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $structureNodeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($structureNodeId['max'])) {
                $this->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $structureNodeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $structureNodeId, $comparison);
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
     * @see       filterByStructureNodeRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\StructureNode object
     *
     * @param \gossi\trixionary\model\StructureNode|ObjectCollection $structureNode The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByStructureNodeRelatedByStructureNodeId($structureNode, $comparison = null)
    {
        if ($structureNode instanceof \gossi\trixionary\model\StructureNode) {
            return $this
                ->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $structureNode->getId(), $comparison);
        } elseif ($structureNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID, $structureNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStructureNodeRelatedByStructureNodeId() only accepts arguments of type \gossi\trixionary\model\StructureNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StructureNodeRelatedByStructureNodeId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function joinStructureNodeRelatedByStructureNodeId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StructureNodeRelatedByStructureNodeId');

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
            $this->addJoinObject($join, 'StructureNodeRelatedByStructureNodeId');
        }

        return $this;
    }

    /**
     * Use the StructureNodeRelatedByStructureNodeId relation StructureNode object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\StructureNodeQuery A secondary query class using the current class as primary query
     */
    public function useStructureNodeRelatedByStructureNodeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStructureNodeRelatedByStructureNodeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StructureNodeRelatedByStructureNodeId', '\gossi\trixionary\model\StructureNodeQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\StructureNode object
     *
     * @param \gossi\trixionary\model\StructureNode|ObjectCollection $structureNode The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function filterByStructureNodeRelatedByParentId($structureNode, $comparison = null)
    {
        if ($structureNode instanceof \gossi\trixionary\model\StructureNode) {
            return $this
                ->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $structureNode->getId(), $comparison);
        } elseif ($structureNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StructureNodeParentTableMap::COL_PARENT_ID, $structureNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStructureNodeRelatedByParentId() only accepts arguments of type \gossi\trixionary\model\StructureNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StructureNodeRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function joinStructureNodeRelatedByParentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StructureNodeRelatedByParentId');

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
            $this->addJoinObject($join, 'StructureNodeRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the StructureNodeRelatedByParentId relation StructureNode object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\StructureNodeQuery A secondary query class using the current class as primary query
     */
    public function useStructureNodeRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStructureNodeRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StructureNodeRelatedByParentId', '\gossi\trixionary\model\StructureNodeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStructureNodeParent $structureNodeParent Object to remove from the list of results
     *
     * @return $this|ChildStructureNodeParentQuery The current query, for fluid interface
     */
    public function prune($structureNodeParent = null)
    {
        if ($structureNodeParent) {
            $this->addCond('pruneCond0', $this->getAliasedColName(StructureNodeParentTableMap::COL_STRUCTURE_NODE_ID), $structureNodeParent->getStructureNodeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(StructureNodeParentTableMap::COL_PARENT_ID), $structureNodeParent->getParentId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_structure_node_parent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeParentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StructureNodeParentTableMap::clearInstancePool();
            StructureNodeParentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeParentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StructureNodeParentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StructureNodeParentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StructureNodeParentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StructureNodeParentQuery
