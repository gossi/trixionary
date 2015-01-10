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
use gossi\trixionary\model\Kstruktur as ChildKstruktur;
use gossi\trixionary\model\KstrukturQuery as ChildKstrukturQuery;
use gossi\trixionary\model\StructureNodeQuery as ChildStructureNodeQuery;
use gossi\trixionary\model\Map\KstrukturTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_kstruktur' table.
 *
 *
 *
 * @method     ChildKstrukturQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildKstrukturQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildKstrukturQuery orderBySkillId($order = Criteria::ASC) Order by the skill_id column
 * @method     ChildKstrukturQuery orderByTitle($order = Criteria::ASC) Order by the title column
 *
 * @method     ChildKstrukturQuery groupById() Group by the id column
 * @method     ChildKstrukturQuery groupByType() Group by the type column
 * @method     ChildKstrukturQuery groupBySkillId() Group by the skill_id column
 * @method     ChildKstrukturQuery groupByTitle() Group by the title column
 *
 * @method     ChildKstrukturQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildKstrukturQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildKstrukturQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildKstrukturQuery leftJoinStructureNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNode relation
 * @method     ChildKstrukturQuery rightJoinStructureNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNode relation
 * @method     ChildKstrukturQuery innerJoinStructureNode($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNode relation
 *
 * @method     ChildKstrukturQuery leftJoinSkillRelatedBySkillId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillRelatedBySkillId relation
 * @method     ChildKstrukturQuery rightJoinSkillRelatedBySkillId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillRelatedBySkillId relation
 * @method     ChildKstrukturQuery innerJoinSkillRelatedBySkillId($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillRelatedBySkillId relation
 *
 * @method     ChildKstrukturQuery leftJoinRootSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the RootSkill relation
 * @method     ChildKstrukturQuery rightJoinRootSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RootSkill relation
 * @method     ChildKstrukturQuery innerJoinRootSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the RootSkill relation
 *
 * @method     \gossi\trixionary\model\StructureNodeQuery|\gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildKstruktur findOne(ConnectionInterface $con = null) Return the first ChildKstruktur matching the query
 * @method     ChildKstruktur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildKstruktur matching the query, or a new ChildKstruktur object populated from the query conditions when no match is found
 *
 * @method     ChildKstruktur findOneById(int $id) Return the first ChildKstruktur filtered by the id column
 * @method     ChildKstruktur findOneByType(string $type) Return the first ChildKstruktur filtered by the type column
 * @method     ChildKstruktur findOneBySkillId(int $skill_id) Return the first ChildKstruktur filtered by the skill_id column
 * @method     ChildKstruktur findOneByTitle(string $title) Return the first ChildKstruktur filtered by the title column
 *
 * @method     ChildKstruktur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildKstruktur objects based on current ModelCriteria
 * @method     ChildKstruktur[]|ObjectCollection findById(int $id) Return ChildKstruktur objects filtered by the id column
 * @method     ChildKstruktur[]|ObjectCollection findByType(string $type) Return ChildKstruktur objects filtered by the type column
 * @method     ChildKstruktur[]|ObjectCollection findBySkillId(int $skill_id) Return ChildKstruktur objects filtered by the skill_id column
 * @method     ChildKstruktur[]|ObjectCollection findByTitle(string $title) Return ChildKstruktur objects filtered by the title column
 * @method     ChildKstruktur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class KstrukturQuery extends ChildStructureNodeQuery
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\KstrukturQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Kstruktur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildKstrukturQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildKstrukturQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildKstrukturQuery) {
            return $criteria;
        }
        $query = new ChildKstrukturQuery();
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
     * @return ChildKstruktur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = KstrukturTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(KstrukturTableMap::DATABASE_NAME);
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
     * @return ChildKstruktur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `type`, `skill_id`, `title` FROM `kk_trixionary_kstruktur` WHERE `id` = :p0';
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
            /** @var ChildKstruktur $obj */
            $obj = new ChildKstruktur();
            $obj->hydrate($row);
            KstrukturTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildKstruktur|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(KstrukturTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(KstrukturTableMap::COL_ID, $keys, Criteria::IN);
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
     * @see       filterByStructureNode()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(KstrukturTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(KstrukturTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KstrukturTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(KstrukturTableMap::COL_TYPE, $type, $comparison);
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
     * @see       filterBySkillRelatedBySkillId()
     *
     * @param     mixed $skillId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterBySkillId($skillId = null, $comparison = null)
    {
        if (is_array($skillId)) {
            $useMinMax = false;
            if (isset($skillId['min'])) {
                $this->addUsingAlias(KstrukturTableMap::COL_SKILL_ID, $skillId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillId['max'])) {
                $this->addUsingAlias(KstrukturTableMap::COL_SKILL_ID, $skillId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KstrukturTableMap::COL_SKILL_ID, $skillId, $comparison);
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
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
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

        return $this->addUsingAlias(KstrukturTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\StructureNode object
     *
     * @param \gossi\trixionary\model\StructureNode|ObjectCollection $structureNode The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterByStructureNode($structureNode, $comparison = null)
    {
        if ($structureNode instanceof \gossi\trixionary\model\StructureNode) {
            return $this
                ->addUsingAlias(KstrukturTableMap::COL_ID, $structureNode->getId(), $comparison);
        } elseif ($structureNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(KstrukturTableMap::COL_ID, $structureNode->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStructureNode() only accepts arguments of type \gossi\trixionary\model\StructureNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StructureNode relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function joinStructureNode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StructureNode');

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
            $this->addJoinObject($join, 'StructureNode');
        }

        return $this;
    }

    /**
     * Use the StructureNode relation StructureNode object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\StructureNodeQuery A secondary query class using the current class as primary query
     */
    public function useStructureNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStructureNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StructureNode', '\gossi\trixionary\model\StructureNodeQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedBySkillId($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(KstrukturTableMap::COL_SKILL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(KstrukturTableMap::COL_SKILL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkillRelatedBySkillId() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillRelatedBySkillId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function joinSkillRelatedBySkillId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillRelatedBySkillId');

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
            $this->addJoinObject($join, 'SkillRelatedBySkillId');
        }

        return $this;
    }

    /**
     * Use the SkillRelatedBySkillId relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillRelatedBySkillIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillRelatedBySkillId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillRelatedBySkillId', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildKstrukturQuery The current query, for fluid interface
     */
    public function filterByRootSkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(KstrukturTableMap::COL_ID, $skill->getKstrukturId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useRootSkillQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRootSkill() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RootSkill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function joinRootSkill($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RootSkill');

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
            $this->addJoinObject($join, 'RootSkill');
        }

        return $this;
    }

    /**
     * Use the RootSkill relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useRootSkillQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRootSkill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RootSkill', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildKstruktur $kstruktur Object to remove from the list of results
     *
     * @return $this|ChildKstrukturQuery The current query, for fluid interface
     */
    public function prune($kstruktur = null)
    {
        if ($kstruktur) {
            $this->addUsingAlias(KstrukturTableMap::COL_ID, $kstruktur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_kstruktur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KstrukturTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            KstrukturTableMap::clearInstancePool();
            KstrukturTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(KstrukturTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(KstrukturTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            KstrukturTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            KstrukturTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // KstrukturQuery
