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
use gossi\trixionary\model\StructureNode as ChildStructureNode;
use gossi\trixionary\model\StructureNodeQuery as ChildStructureNodeQuery;
use gossi\trixionary\model\Map\StructureNodeTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_structure_node' table.
 *
 *
 *
 * @method     ChildStructureNodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStructureNodeQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildStructureNodeQuery orderBySkillId($order = Criteria::ASC) Order by the skill_id column
 * @method     ChildStructureNodeQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildStructureNodeQuery orderByDescendantClass($order = Criteria::ASC) Order by the descendant_class column
 *
 * @method     ChildStructureNodeQuery groupById() Group by the id column
 * @method     ChildStructureNodeQuery groupByType() Group by the type column
 * @method     ChildStructureNodeQuery groupBySkillId() Group by the skill_id column
 * @method     ChildStructureNodeQuery groupByTitle() Group by the title column
 * @method     ChildStructureNodeQuery groupByDescendantClass() Group by the descendant_class column
 *
 * @method     ChildStructureNodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStructureNodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStructureNodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStructureNodeQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildStructureNodeQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildStructureNodeQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     ChildStructureNodeQuery leftJoinStructureNodeParentRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNodeParentRelatedById relation
 * @method     ChildStructureNodeQuery rightJoinStructureNodeParentRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNodeParentRelatedById relation
 * @method     ChildStructureNodeQuery innerJoinStructureNodeParentRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNodeParentRelatedById relation
 *
 * @method     ChildStructureNodeQuery leftJoinStructureNodeParentRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNodeParentRelatedByParentId relation
 * @method     ChildStructureNodeQuery rightJoinStructureNodeParentRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNodeParentRelatedByParentId relation
 * @method     ChildStructureNodeQuery innerJoinStructureNodeParentRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNodeParentRelatedByParentId relation
 *
 * @method     ChildStructureNodeQuery leftJoinKstruktur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Kstruktur relation
 * @method     ChildStructureNodeQuery rightJoinKstruktur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Kstruktur relation
 * @method     ChildStructureNodeQuery innerJoinKstruktur($relationAlias = null) Adds a INNER JOIN clause to the query using the Kstruktur relation
 *
 * @method     ChildStructureNodeQuery leftJoinFunctionPhase($relationAlias = null) Adds a LEFT JOIN clause to the query using the FunctionPhase relation
 * @method     ChildStructureNodeQuery rightJoinFunctionPhase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FunctionPhase relation
 * @method     ChildStructureNodeQuery innerJoinFunctionPhase($relationAlias = null) Adds a INNER JOIN clause to the query using the FunctionPhase relation
 *
 * @method     \gossi\trixionary\model\SkillQuery|\gossi\trixionary\model\StructureNodeParentQuery|\gossi\trixionary\model\KstrukturQuery|\gossi\trixionary\model\FunctionPhaseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStructureNode findOne(ConnectionInterface $con = null) Return the first ChildStructureNode matching the query
 * @method     ChildStructureNode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStructureNode matching the query, or a new ChildStructureNode object populated from the query conditions when no match is found
 *
 * @method     ChildStructureNode findOneById(int $id) Return the first ChildStructureNode filtered by the id column
 * @method     ChildStructureNode findOneByType(string $type) Return the first ChildStructureNode filtered by the type column
 * @method     ChildStructureNode findOneBySkillId(int $skill_id) Return the first ChildStructureNode filtered by the skill_id column
 * @method     ChildStructureNode findOneByTitle(string $title) Return the first ChildStructureNode filtered by the title column
 * @method     ChildStructureNode findOneByDescendantClass(string $descendant_class) Return the first ChildStructureNode filtered by the descendant_class column
 *
 * @method     ChildStructureNode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStructureNode objects based on current ModelCriteria
 * @method     ChildStructureNode[]|ObjectCollection findById(int $id) Return ChildStructureNode objects filtered by the id column
 * @method     ChildStructureNode[]|ObjectCollection findByType(string $type) Return ChildStructureNode objects filtered by the type column
 * @method     ChildStructureNode[]|ObjectCollection findBySkillId(int $skill_id) Return ChildStructureNode objects filtered by the skill_id column
 * @method     ChildStructureNode[]|ObjectCollection findByTitle(string $title) Return ChildStructureNode objects filtered by the title column
 * @method     ChildStructureNode[]|ObjectCollection findByDescendantClass(string $descendant_class) Return ChildStructureNode objects filtered by the descendant_class column
 * @method     ChildStructureNode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StructureNodeQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\StructureNodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\StructureNode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStructureNodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStructureNodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStructureNodeQuery) {
            return $criteria;
        }
        $query = new ChildStructureNodeQuery();
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
     * @return ChildStructureNode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = StructureNodeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StructureNodeTableMap::DATABASE_NAME);
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
     * @return ChildStructureNode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `type`, `skill_id`, `title`, `descendant_class` FROM `kk_trixionary_structure_node` WHERE `id` = :p0';
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
            /** @var ChildStructureNode $obj */
            $obj = new ChildStructureNode();
            $obj->hydrate($row);
            StructureNodeTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildStructureNode|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StructureNodeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StructureNodeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StructureNodeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StructureNodeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StructureNodeTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(StructureNodeTableMap::COL_TYPE, $type, $comparison);
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterBySkillId($skillId = null, $comparison = null)
    {
        if (is_array($skillId)) {
            $useMinMax = false;
            if (isset($skillId['min'])) {
                $this->addUsingAlias(StructureNodeTableMap::COL_SKILL_ID, $skillId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillId['max'])) {
                $this->addUsingAlias(StructureNodeTableMap::COL_SKILL_ID, $skillId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StructureNodeTableMap::COL_SKILL_ID, $skillId, $comparison);
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(StructureNodeTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the descendant_class column
     *
     * Example usage:
     * <code>
     * $query->filterByDescendantClass('fooValue');   // WHERE descendant_class = 'fooValue'
     * $query->filterByDescendantClass('%fooValue%'); // WHERE descendant_class LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descendantClass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByDescendantClass($descendantClass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descendantClass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descendantClass)) {
                $descendantClass = str_replace('*', '%', $descendantClass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(StructureNodeTableMap::COL_DESCENDANT_CLASS, $descendantClass, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_SKILL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_SKILL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
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
     * Filter the query by a related \gossi\trixionary\model\StructureNodeParent object
     *
     * @param \gossi\trixionary\model\StructureNodeParent|ObjectCollection $structureNodeParent  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByStructureNodeParentRelatedById($structureNodeParent, $comparison = null)
    {
        if ($structureNodeParent instanceof \gossi\trixionary\model\StructureNodeParent) {
            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_ID, $structureNodeParent->getId(), $comparison);
        } elseif ($structureNodeParent instanceof ObjectCollection) {
            return $this
                ->useStructureNodeParentRelatedByIdQuery()
                ->filterByPrimaryKeys($structureNodeParent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStructureNodeParentRelatedById() only accepts arguments of type \gossi\trixionary\model\StructureNodeParent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StructureNodeParentRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function joinStructureNodeParentRelatedById($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StructureNodeParentRelatedById');

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
            $this->addJoinObject($join, 'StructureNodeParentRelatedById');
        }

        return $this;
    }

    /**
     * Use the StructureNodeParentRelatedById relation StructureNodeParent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\StructureNodeParentQuery A secondary query class using the current class as primary query
     */
    public function useStructureNodeParentRelatedByIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStructureNodeParentRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StructureNodeParentRelatedById', '\gossi\trixionary\model\StructureNodeParentQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\StructureNodeParent object
     *
     * @param \gossi\trixionary\model\StructureNodeParent|ObjectCollection $structureNodeParent  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByStructureNodeParentRelatedByParentId($structureNodeParent, $comparison = null)
    {
        if ($structureNodeParent instanceof \gossi\trixionary\model\StructureNodeParent) {
            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_ID, $structureNodeParent->getParentId(), $comparison);
        } elseif ($structureNodeParent instanceof ObjectCollection) {
            return $this
                ->useStructureNodeParentRelatedByParentIdQuery()
                ->filterByPrimaryKeys($structureNodeParent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStructureNodeParentRelatedByParentId() only accepts arguments of type \gossi\trixionary\model\StructureNodeParent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StructureNodeParentRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function joinStructureNodeParentRelatedByParentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StructureNodeParentRelatedByParentId');

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
            $this->addJoinObject($join, 'StructureNodeParentRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the StructureNodeParentRelatedByParentId relation StructureNodeParent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\StructureNodeParentQuery A secondary query class using the current class as primary query
     */
    public function useStructureNodeParentRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStructureNodeParentRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StructureNodeParentRelatedByParentId', '\gossi\trixionary\model\StructureNodeParentQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Kstruktur object
     *
     * @param \gossi\trixionary\model\Kstruktur|ObjectCollection $kstruktur  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByKstruktur($kstruktur, $comparison = null)
    {
        if ($kstruktur instanceof \gossi\trixionary\model\Kstruktur) {
            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_ID, $kstruktur->getId(), $comparison);
        } elseif ($kstruktur instanceof ObjectCollection) {
            return $this
                ->useKstrukturQuery()
                ->filterByPrimaryKeys($kstruktur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByKstruktur() only accepts arguments of type \gossi\trixionary\model\Kstruktur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Kstruktur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function joinKstruktur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Kstruktur');

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
            $this->addJoinObject($join, 'Kstruktur');
        }

        return $this;
    }

    /**
     * Use the Kstruktur relation Kstruktur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\KstrukturQuery A secondary query class using the current class as primary query
     */
    public function useKstrukturQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinKstruktur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Kstruktur', '\gossi\trixionary\model\KstrukturQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\FunctionPhase object
     *
     * @param \gossi\trixionary\model\FunctionPhase|ObjectCollection $functionPhase  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByFunctionPhase($functionPhase, $comparison = null)
    {
        if ($functionPhase instanceof \gossi\trixionary\model\FunctionPhase) {
            return $this
                ->addUsingAlias(StructureNodeTableMap::COL_ID, $functionPhase->getId(), $comparison);
        } elseif ($functionPhase instanceof ObjectCollection) {
            return $this
                ->useFunctionPhaseQuery()
                ->filterByPrimaryKeys($functionPhase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFunctionPhase() only accepts arguments of type \gossi\trixionary\model\FunctionPhase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FunctionPhase relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function joinFunctionPhase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FunctionPhase');

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
            $this->addJoinObject($join, 'FunctionPhase');
        }

        return $this;
    }

    /**
     * Use the FunctionPhase relation FunctionPhase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\FunctionPhaseQuery A secondary query class using the current class as primary query
     */
    public function useFunctionPhaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFunctionPhase($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FunctionPhase', '\gossi\trixionary\model\FunctionPhaseQuery');
    }

    /**
     * Filter the query by a related StructureNode object
     * using the kk_trixionary_structure_node_parent table as cross reference
     *
     * @param StructureNode $structureNode the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByStructureNodeRelatedByParentId($structureNode, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useStructureNodeParentRelatedByIdQuery()
            ->filterByStructureNodeRelatedByParentId($structureNode, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related StructureNode object
     * using the kk_trixionary_structure_node_parent table as cross reference
     *
     * @param StructureNode $structureNode the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStructureNodeQuery The current query, for fluid interface
     */
    public function filterByStructureNodeRelatedById($structureNode, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useStructureNodeParentRelatedByParentIdQuery()
            ->filterByStructureNodeRelatedById($structureNode, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStructureNode $structureNode Object to remove from the list of results
     *
     * @return $this|ChildStructureNodeQuery The current query, for fluid interface
     */
    public function prune($structureNode = null)
    {
        if ($structureNode) {
            $this->addUsingAlias(StructureNodeTableMap::COL_ID, $structureNode->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_structure_node table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StructureNodeTableMap::clearInstancePool();
            StructureNodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StructureNodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StructureNodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StructureNodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StructureNodeQuery
