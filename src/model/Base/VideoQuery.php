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
use gossi\trixionary\model\Video as ChildVideo;
use gossi\trixionary\model\VideoQuery as ChildVideoQuery;
use gossi\trixionary\model\Map\VideoTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_video' table.
 *
 *
 *
 * @method     ChildVideoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVideoQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildVideoQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildVideoQuery orderByIsTutorial($order = Criteria::ASC) Order by the is_tutorial column
 * @method     ChildVideoQuery orderByMovender($order = Criteria::ASC) Order by the movender column
 * @method     ChildVideoQuery orderByMovenderId($order = Criteria::ASC) Order by the movender_id column
 * @method     ChildVideoQuery orderByUploaderId($order = Criteria::ASC) Order by the uploader_id column
 * @method     ChildVideoQuery orderBySkillId($order = Criteria::ASC) Order by the skill_id column
 * @method     ChildVideoQuery orderByReferenceId($order = Criteria::ASC) Order by the reference_id column
 * @method     ChildVideoQuery orderByPosterUrl($order = Criteria::ASC) Order by the poster_url column
 * @method     ChildVideoQuery orderByProvider($order = Criteria::ASC) Order by the provider column
 * @method     ChildVideoQuery orderByProviderId($order = Criteria::ASC) Order by the provider_id column
 * @method     ChildVideoQuery orderByPlayerUrl($order = Criteria::ASC) Order by the player_url column
 * @method     ChildVideoQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method     ChildVideoQuery orderByHeight($order = Criteria::ASC) Order by the height column
 *
 * @method     ChildVideoQuery groupById() Group by the id column
 * @method     ChildVideoQuery groupByTitle() Group by the title column
 * @method     ChildVideoQuery groupByDescription() Group by the description column
 * @method     ChildVideoQuery groupByIsTutorial() Group by the is_tutorial column
 * @method     ChildVideoQuery groupByMovender() Group by the movender column
 * @method     ChildVideoQuery groupByMovenderId() Group by the movender_id column
 * @method     ChildVideoQuery groupByUploaderId() Group by the uploader_id column
 * @method     ChildVideoQuery groupBySkillId() Group by the skill_id column
 * @method     ChildVideoQuery groupByReferenceId() Group by the reference_id column
 * @method     ChildVideoQuery groupByPosterUrl() Group by the poster_url column
 * @method     ChildVideoQuery groupByProvider() Group by the provider column
 * @method     ChildVideoQuery groupByProviderId() Group by the provider_id column
 * @method     ChildVideoQuery groupByPlayerUrl() Group by the player_url column
 * @method     ChildVideoQuery groupByWidth() Group by the width column
 * @method     ChildVideoQuery groupByHeight() Group by the height column
 *
 * @method     ChildVideoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVideoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVideoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVideoQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildVideoQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildVideoQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     ChildVideoQuery leftJoinReference($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reference relation
 * @method     ChildVideoQuery rightJoinReference($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reference relation
 * @method     ChildVideoQuery innerJoinReference($relationAlias = null) Adds a INNER JOIN clause to the query using the Reference relation
 *
 * @method     \gossi\trixionary\model\SkillQuery|\gossi\trixionary\model\ReferenceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVideo findOne(ConnectionInterface $con = null) Return the first ChildVideo matching the query
 * @method     ChildVideo findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVideo matching the query, or a new ChildVideo object populated from the query conditions when no match is found
 *
 * @method     ChildVideo findOneById(int $id) Return the first ChildVideo filtered by the id column
 * @method     ChildVideo findOneByTitle(string $title) Return the first ChildVideo filtered by the title column
 * @method     ChildVideo findOneByDescription(string $description) Return the first ChildVideo filtered by the description column
 * @method     ChildVideo findOneByIsTutorial(boolean $is_tutorial) Return the first ChildVideo filtered by the is_tutorial column
 * @method     ChildVideo findOneByMovender(string $movender) Return the first ChildVideo filtered by the movender column
 * @method     ChildVideo findOneByMovenderId(int $movender_id) Return the first ChildVideo filtered by the movender_id column
 * @method     ChildVideo findOneByUploaderId(int $uploader_id) Return the first ChildVideo filtered by the uploader_id column
 * @method     ChildVideo findOneBySkillId(int $skill_id) Return the first ChildVideo filtered by the skill_id column
 * @method     ChildVideo findOneByReferenceId(int $reference_id) Return the first ChildVideo filtered by the reference_id column
 * @method     ChildVideo findOneByPosterUrl(string $poster_url) Return the first ChildVideo filtered by the poster_url column
 * @method     ChildVideo findOneByProvider(string $provider) Return the first ChildVideo filtered by the provider column
 * @method     ChildVideo findOneByProviderId(string $provider_id) Return the first ChildVideo filtered by the provider_id column
 * @method     ChildVideo findOneByPlayerUrl(string $player_url) Return the first ChildVideo filtered by the player_url column
 * @method     ChildVideo findOneByWidth(int $width) Return the first ChildVideo filtered by the width column
 * @method     ChildVideo findOneByHeight(int $height) Return the first ChildVideo filtered by the height column
 *
 * @method     ChildVideo[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVideo objects based on current ModelCriteria
 * @method     ChildVideo[]|ObjectCollection findById(int $id) Return ChildVideo objects filtered by the id column
 * @method     ChildVideo[]|ObjectCollection findByTitle(string $title) Return ChildVideo objects filtered by the title column
 * @method     ChildVideo[]|ObjectCollection findByDescription(string $description) Return ChildVideo objects filtered by the description column
 * @method     ChildVideo[]|ObjectCollection findByIsTutorial(boolean $is_tutorial) Return ChildVideo objects filtered by the is_tutorial column
 * @method     ChildVideo[]|ObjectCollection findByMovender(string $movender) Return ChildVideo objects filtered by the movender column
 * @method     ChildVideo[]|ObjectCollection findByMovenderId(int $movender_id) Return ChildVideo objects filtered by the movender_id column
 * @method     ChildVideo[]|ObjectCollection findByUploaderId(int $uploader_id) Return ChildVideo objects filtered by the uploader_id column
 * @method     ChildVideo[]|ObjectCollection findBySkillId(int $skill_id) Return ChildVideo objects filtered by the skill_id column
 * @method     ChildVideo[]|ObjectCollection findByReferenceId(int $reference_id) Return ChildVideo objects filtered by the reference_id column
 * @method     ChildVideo[]|ObjectCollection findByPosterUrl(string $poster_url) Return ChildVideo objects filtered by the poster_url column
 * @method     ChildVideo[]|ObjectCollection findByProvider(string $provider) Return ChildVideo objects filtered by the provider column
 * @method     ChildVideo[]|ObjectCollection findByProviderId(string $provider_id) Return ChildVideo objects filtered by the provider_id column
 * @method     ChildVideo[]|ObjectCollection findByPlayerUrl(string $player_url) Return ChildVideo objects filtered by the player_url column
 * @method     ChildVideo[]|ObjectCollection findByWidth(int $width) Return ChildVideo objects filtered by the width column
 * @method     ChildVideo[]|ObjectCollection findByHeight(int $height) Return ChildVideo objects filtered by the height column
 * @method     ChildVideo[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VideoQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\VideoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Video', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVideoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVideoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVideoQuery) {
            return $criteria;
        }
        $query = new ChildVideoQuery();
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
     * @return ChildVideo|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VideoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VideoTableMap::DATABASE_NAME);
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
     * @return ChildVideo A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `title`, `description`, `is_tutorial`, `movender`, `movender_id`, `uploader_id`, `skill_id`, `reference_id`, `poster_url`, `provider`, `provider_id`, `player_url`, `width`, `height` FROM `kk_trixionary_video` WHERE `id` = :p0';
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
            /** @var ChildVideo $obj */
            $obj = new ChildVideo();
            $obj->hydrate($row);
            VideoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildVideo|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VideoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VideoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VideoTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VideoTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the is_tutorial column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTutorial(true); // WHERE is_tutorial = true
     * $query->filterByIsTutorial('yes'); // WHERE is_tutorial = true
     * </code>
     *
     * @param     boolean|string $isTutorial The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByIsTutorial($isTutorial = null, $comparison = null)
    {
        if (is_string($isTutorial)) {
            $isTutorial = in_array(strtolower($isTutorial), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VideoTableMap::COL_IS_TUTORIAL, $isTutorial, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VideoTableMap::COL_MOVENDER, $movender, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByMovenderId($movenderId = null, $comparison = null)
    {
        if (is_array($movenderId)) {
            $useMinMax = false;
            if (isset($movenderId['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_MOVENDER_ID, $movenderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($movenderId['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_MOVENDER_ID, $movenderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_MOVENDER_ID, $movenderId, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByUploaderId($uploaderId = null, $comparison = null)
    {
        if (is_array($uploaderId)) {
            $useMinMax = false;
            if (isset($uploaderId['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_UPLOADER_ID, $uploaderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploaderId['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_UPLOADER_ID, $uploaderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_UPLOADER_ID, $uploaderId, $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterBySkillId($skillId = null, $comparison = null)
    {
        if (is_array($skillId)) {
            $useMinMax = false;
            if (isset($skillId['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_SKILL_ID, $skillId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillId['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_SKILL_ID, $skillId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_SKILL_ID, $skillId, $comparison);
    }

    /**
     * Filter the query on the reference_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReferenceId(1234); // WHERE reference_id = 1234
     * $query->filterByReferenceId(array(12, 34)); // WHERE reference_id IN (12, 34)
     * $query->filterByReferenceId(array('min' => 12)); // WHERE reference_id > 12
     * </code>
     *
     * @see       filterByReference()
     *
     * @param     mixed $referenceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByReferenceId($referenceId = null, $comparison = null)
    {
        if (is_array($referenceId)) {
            $useMinMax = false;
            if (isset($referenceId['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_REFERENCE_ID, $referenceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($referenceId['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_REFERENCE_ID, $referenceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_REFERENCE_ID, $referenceId, $comparison);
    }

    /**
     * Filter the query on the poster_url column
     *
     * Example usage:
     * <code>
     * $query->filterByPosterUrl('fooValue');   // WHERE poster_url = 'fooValue'
     * $query->filterByPosterUrl('%fooValue%'); // WHERE poster_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $posterUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPosterUrl($posterUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($posterUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $posterUrl)) {
                $posterUrl = str_replace('*', '%', $posterUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_POSTER_URL, $posterUrl, $comparison);
    }

    /**
     * Filter the query on the provider column
     *
     * Example usage:
     * <code>
     * $query->filterByProvider('fooValue');   // WHERE provider = 'fooValue'
     * $query->filterByProvider('%fooValue%'); // WHERE provider LIKE '%fooValue%'
     * </code>
     *
     * @param     string $provider The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByProvider($provider = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($provider)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $provider)) {
                $provider = str_replace('*', '%', $provider);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_PROVIDER, $provider, $comparison);
    }

    /**
     * Filter the query on the provider_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderId('fooValue');   // WHERE provider_id = 'fooValue'
     * $query->filterByProviderId('%fooValue%'); // WHERE provider_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $providerId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByProviderId($providerId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($providerId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $providerId)) {
                $providerId = str_replace('*', '%', $providerId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_PROVIDER_ID, $providerId, $comparison);
    }

    /**
     * Filter the query on the player_url column
     *
     * Example usage:
     * <code>
     * $query->filterByPlayerUrl('fooValue');   // WHERE player_url = 'fooValue'
     * $query->filterByPlayerUrl('%fooValue%'); // WHERE player_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $playerUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByPlayerUrl($playerUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playerUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $playerUrl)) {
                $playerUrl = str_replace('*', '%', $playerUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_PLAYER_URL, $playerUrl, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE width > 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight(1234); // WHERE height = 1234
     * $query->filterByHeight(array(12, 34)); // WHERE height IN (12, 34)
     * $query->filterByHeight(array('min' => 12)); // WHERE height > 12
     * </code>
     *
     * @param     mixed $height The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(VideoTableMap::COL_HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(VideoTableMap::COL_HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VideoTableMap::COL_HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVideoQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(VideoTableMap::COL_SKILL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VideoTableMap::COL_SKILL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildVideoQuery The current query, for fluid interface
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
     * Filter the query by a related \gossi\trixionary\model\Reference object
     *
     * @param \gossi\trixionary\model\Reference|ObjectCollection $reference The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVideoQuery The current query, for fluid interface
     */
    public function filterByReference($reference, $comparison = null)
    {
        if ($reference instanceof \gossi\trixionary\model\Reference) {
            return $this
                ->addUsingAlias(VideoTableMap::COL_REFERENCE_ID, $reference->getId(), $comparison);
        } elseif ($reference instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VideoTableMap::COL_REFERENCE_ID, $reference->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByReference() only accepts arguments of type \gossi\trixionary\model\Reference or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reference relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function joinReference($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reference');

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
            $this->addJoinObject($join, 'Reference');
        }

        return $this;
    }

    /**
     * Use the Reference relation Reference object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\ReferenceQuery A secondary query class using the current class as primary query
     */
    public function useReferenceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinReference($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reference', '\gossi\trixionary\model\ReferenceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVideo $video Object to remove from the list of results
     *
     * @return $this|ChildVideoQuery The current query, for fluid interface
     */
    public function prune($video = null)
    {
        if ($video) {
            $this->addUsingAlias(VideoTableMap::COL_ID, $video->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_video table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VideoTableMap::clearInstancePool();
            VideoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VideoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VideoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VideoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VideoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VideoQuery
