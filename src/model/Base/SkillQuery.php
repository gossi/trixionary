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
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\Map\SkillTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_skill' table.
 *
 *
 *
 * @method     ChildSkillQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSkillQuery orderBySportId($order = Criteria::ASC) Order by the sport_id column
 * @method     ChildSkillQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSkillQuery orderByAlternativeName($order = Criteria::ASC) Order by the alternative_name column
 * @method     ChildSkillQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildSkillQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSkillQuery orderByHistory($order = Criteria::ASC) Order by the history column
 * @method     ChildSkillQuery orderByIsTranslation($order = Criteria::ASC) Order by the is_translation column
 * @method     ChildSkillQuery orderByIsRotation($order = Criteria::ASC) Order by the is_rotation column
 * @method     ChildSkillQuery orderByIsAcyclic($order = Criteria::ASC) Order by the is_acyclic column
 * @method     ChildSkillQuery orderByIsCyclic($order = Criteria::ASC) Order by the is_cyclic column
 * @method     ChildSkillQuery orderByLongitudinalFlags($order = Criteria::ASC) Order by the longitudinal_flags column
 * @method     ChildSkillQuery orderByLatitudinalFlags($order = Criteria::ASC) Order by the latitudinal_flags column
 * @method     ChildSkillQuery orderByTransversalFlags($order = Criteria::ASC) Order by the transversal_flags column
 * @method     ChildSkillQuery orderByMovementDescription($order = Criteria::ASC) Order by the movement_description column
 * @method     ChildSkillQuery orderByVariationOfId($order = Criteria::ASC) Order by the variation_of_id column
 * @method     ChildSkillQuery orderByStartPositionId($order = Criteria::ASC) Order by the start_position_id column
 * @method     ChildSkillQuery orderByEndPositionId($order = Criteria::ASC) Order by the end_position_id column
 * @method     ChildSkillQuery orderByIsComposite($order = Criteria::ASC) Order by the is_composite column
 * @method     ChildSkillQuery orderByIsMultiple($order = Criteria::ASC) Order by the is_multiple column
 * @method     ChildSkillQuery orderByMultipleOfId($order = Criteria::ASC) Order by the multiple_of_id column
 * @method     ChildSkillQuery orderByMultiplier($order = Criteria::ASC) Order by the multiplier column
 * @method     ChildSkillQuery orderByGeneration($order = Criteria::ASC) Order by the generation column
 * @method     ChildSkillQuery orderByImportance($order = Criteria::ASC) Order by the importance column
 * @method     ChildSkillQuery orderByGenerationIds($order = Criteria::ASC) Order by the generation_ids column
 * @method     ChildSkillQuery orderByPictureId($order = Criteria::ASC) Order by the picture_id column
 * @method     ChildSkillQuery orderByKstrukturId($order = Criteria::ASC) Order by the kstruktur_id column
 * @method     ChildSkillQuery orderByFunctionPhaseId($order = Criteria::ASC) Order by the function_phase_id column
 * @method     ChildSkillQuery orderByObjectId($order = Criteria::ASC) Order by the object_id column
 * @method     ChildSkillQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSkillQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildSkillQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildSkillQuery groupById() Group by the id column
 * @method     ChildSkillQuery groupBySportId() Group by the sport_id column
 * @method     ChildSkillQuery groupByName() Group by the name column
 * @method     ChildSkillQuery groupByAlternativeName() Group by the alternative_name column
 * @method     ChildSkillQuery groupBySlug() Group by the slug column
 * @method     ChildSkillQuery groupByDescription() Group by the description column
 * @method     ChildSkillQuery groupByHistory() Group by the history column
 * @method     ChildSkillQuery groupByIsTranslation() Group by the is_translation column
 * @method     ChildSkillQuery groupByIsRotation() Group by the is_rotation column
 * @method     ChildSkillQuery groupByIsAcyclic() Group by the is_acyclic column
 * @method     ChildSkillQuery groupByIsCyclic() Group by the is_cyclic column
 * @method     ChildSkillQuery groupByLongitudinalFlags() Group by the longitudinal_flags column
 * @method     ChildSkillQuery groupByLatitudinalFlags() Group by the latitudinal_flags column
 * @method     ChildSkillQuery groupByTransversalFlags() Group by the transversal_flags column
 * @method     ChildSkillQuery groupByMovementDescription() Group by the movement_description column
 * @method     ChildSkillQuery groupByVariationOfId() Group by the variation_of_id column
 * @method     ChildSkillQuery groupByStartPositionId() Group by the start_position_id column
 * @method     ChildSkillQuery groupByEndPositionId() Group by the end_position_id column
 * @method     ChildSkillQuery groupByIsComposite() Group by the is_composite column
 * @method     ChildSkillQuery groupByIsMultiple() Group by the is_multiple column
 * @method     ChildSkillQuery groupByMultipleOfId() Group by the multiple_of_id column
 * @method     ChildSkillQuery groupByMultiplier() Group by the multiplier column
 * @method     ChildSkillQuery groupByGeneration() Group by the generation column
 * @method     ChildSkillQuery groupByImportance() Group by the importance column
 * @method     ChildSkillQuery groupByGenerationIds() Group by the generation_ids column
 * @method     ChildSkillQuery groupByPictureId() Group by the picture_id column
 * @method     ChildSkillQuery groupByKstrukturId() Group by the kstruktur_id column
 * @method     ChildSkillQuery groupByFunctionPhaseId() Group by the function_phase_id column
 * @method     ChildSkillQuery groupByObjectId() Group by the object_id column
 * @method     ChildSkillQuery groupByVersion() Group by the version column
 * @method     ChildSkillQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildSkillQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildSkillQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSkillQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSkillQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSkillQuery leftJoinSport($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sport relation
 * @method     ChildSkillQuery rightJoinSport($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sport relation
 * @method     ChildSkillQuery innerJoinSport($relationAlias = null) Adds a INNER JOIN clause to the query using the Sport relation
 *
 * @method     ChildSkillQuery leftJoinVariationOf($relationAlias = null) Adds a LEFT JOIN clause to the query using the VariationOf relation
 * @method     ChildSkillQuery rightJoinVariationOf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VariationOf relation
 * @method     ChildSkillQuery innerJoinVariationOf($relationAlias = null) Adds a INNER JOIN clause to the query using the VariationOf relation
 *
 * @method     ChildSkillQuery leftJoinMultipleOf($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultipleOf relation
 * @method     ChildSkillQuery rightJoinMultipleOf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultipleOf relation
 * @method     ChildSkillQuery innerJoinMultipleOf($relationAlias = null) Adds a INNER JOIN clause to the query using the MultipleOf relation
 *
 * @method     ChildSkillQuery leftJoinObject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Object relation
 * @method     ChildSkillQuery rightJoinObject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Object relation
 * @method     ChildSkillQuery innerJoinObject($relationAlias = null) Adds a INNER JOIN clause to the query using the Object relation
 *
 * @method     ChildSkillQuery leftJoinStartPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the StartPosition relation
 * @method     ChildSkillQuery rightJoinStartPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StartPosition relation
 * @method     ChildSkillQuery innerJoinStartPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the StartPosition relation
 *
 * @method     ChildSkillQuery leftJoinEndPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the EndPosition relation
 * @method     ChildSkillQuery rightJoinEndPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EndPosition relation
 * @method     ChildSkillQuery innerJoinEndPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the EndPosition relation
 *
 * @method     ChildSkillQuery leftJoinFeaturedPicture($relationAlias = null) Adds a LEFT JOIN clause to the query using the FeaturedPicture relation
 * @method     ChildSkillQuery rightJoinFeaturedPicture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FeaturedPicture relation
 * @method     ChildSkillQuery innerJoinFeaturedPicture($relationAlias = null) Adds a INNER JOIN clause to the query using the FeaturedPicture relation
 *
 * @method     ChildSkillQuery leftJoinKstrukturRoot($relationAlias = null) Adds a LEFT JOIN clause to the query using the KstrukturRoot relation
 * @method     ChildSkillQuery rightJoinKstrukturRoot($relationAlias = null) Adds a RIGHT JOIN clause to the query using the KstrukturRoot relation
 * @method     ChildSkillQuery innerJoinKstrukturRoot($relationAlias = null) Adds a INNER JOIN clause to the query using the KstrukturRoot relation
 *
 * @method     ChildSkillQuery leftJoinFunctionPhaseRoot($relationAlias = null) Adds a LEFT JOIN clause to the query using the FunctionPhaseRoot relation
 * @method     ChildSkillQuery rightJoinFunctionPhaseRoot($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FunctionPhaseRoot relation
 * @method     ChildSkillQuery innerJoinFunctionPhaseRoot($relationAlias = null) Adds a INNER JOIN clause to the query using the FunctionPhaseRoot relation
 *
 * @method     ChildSkillQuery leftJoinVariation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Variation relation
 * @method     ChildSkillQuery rightJoinVariation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Variation relation
 * @method     ChildSkillQuery innerJoinVariation($relationAlias = null) Adds a INNER JOIN clause to the query using the Variation relation
 *
 * @method     ChildSkillQuery leftJoinMultiple($relationAlias = null) Adds a LEFT JOIN clause to the query using the Multiple relation
 * @method     ChildSkillQuery rightJoinMultiple($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Multiple relation
 * @method     ChildSkillQuery innerJoinMultiple($relationAlias = null) Adds a INNER JOIN clause to the query using the Multiple relation
 *
 * @method     ChildSkillQuery leftJoinDescendent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Descendent relation
 * @method     ChildSkillQuery rightJoinDescendent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Descendent relation
 * @method     ChildSkillQuery innerJoinDescendent($relationAlias = null) Adds a INNER JOIN clause to the query using the Descendent relation
 *
 * @method     ChildSkillQuery leftJoinAscendent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ascendent relation
 * @method     ChildSkillQuery rightJoinAscendent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ascendent relation
 * @method     ChildSkillQuery innerJoinAscendent($relationAlias = null) Adds a INNER JOIN clause to the query using the Ascendent relation
 *
 * @method     ChildSkillQuery leftJoinPart($relationAlias = null) Adds a LEFT JOIN clause to the query using the Part relation
 * @method     ChildSkillQuery rightJoinPart($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Part relation
 * @method     ChildSkillQuery innerJoinPart($relationAlias = null) Adds a INNER JOIN clause to the query using the Part relation
 *
 * @method     ChildSkillQuery leftJoinComposite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Composite relation
 * @method     ChildSkillQuery rightJoinComposite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Composite relation
 * @method     ChildSkillQuery innerJoinComposite($relationAlias = null) Adds a INNER JOIN clause to the query using the Composite relation
 *
 * @method     ChildSkillQuery leftJoinSkillGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillGroup relation
 * @method     ChildSkillQuery rightJoinSkillGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillGroup relation
 * @method     ChildSkillQuery innerJoinSkillGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillGroup relation
 *
 * @method     ChildSkillQuery leftJoinPicture($relationAlias = null) Adds a LEFT JOIN clause to the query using the Picture relation
 * @method     ChildSkillQuery rightJoinPicture($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Picture relation
 * @method     ChildSkillQuery innerJoinPicture($relationAlias = null) Adds a INNER JOIN clause to the query using the Picture relation
 *
 * @method     ChildSkillQuery leftJoinVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Video relation
 * @method     ChildSkillQuery rightJoinVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Video relation
 * @method     ChildSkillQuery innerJoinVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the Video relation
 *
 * @method     ChildSkillQuery leftJoinReference($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reference relation
 * @method     ChildSkillQuery rightJoinReference($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reference relation
 * @method     ChildSkillQuery innerJoinReference($relationAlias = null) Adds a INNER JOIN clause to the query using the Reference relation
 *
 * @method     ChildSkillQuery leftJoinStructureNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the StructureNode relation
 * @method     ChildSkillQuery rightJoinStructureNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StructureNode relation
 * @method     ChildSkillQuery innerJoinStructureNode($relationAlias = null) Adds a INNER JOIN clause to the query using the StructureNode relation
 *
 * @method     ChildSkillQuery leftJoinKstrukturRelatedBySkillId($relationAlias = null) Adds a LEFT JOIN clause to the query using the KstrukturRelatedBySkillId relation
 * @method     ChildSkillQuery rightJoinKstrukturRelatedBySkillId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the KstrukturRelatedBySkillId relation
 * @method     ChildSkillQuery innerJoinKstrukturRelatedBySkillId($relationAlias = null) Adds a INNER JOIN clause to the query using the KstrukturRelatedBySkillId relation
 *
 * @method     ChildSkillQuery leftJoinFunctionPhaseRelatedBySkillId($relationAlias = null) Adds a LEFT JOIN clause to the query using the FunctionPhaseRelatedBySkillId relation
 * @method     ChildSkillQuery rightJoinFunctionPhaseRelatedBySkillId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FunctionPhaseRelatedBySkillId relation
 * @method     ChildSkillQuery innerJoinFunctionPhaseRelatedBySkillId($relationAlias = null) Adds a INNER JOIN clause to the query using the FunctionPhaseRelatedBySkillId relation
 *
 * @method     ChildSkillQuery leftJoinSkillVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SkillVersion relation
 * @method     ChildSkillQuery rightJoinSkillVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SkillVersion relation
 * @method     ChildSkillQuery innerJoinSkillVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the SkillVersion relation
 *
 * @method     \gossi\trixionary\model\SportQuery|\gossi\trixionary\model\SkillQuery|\gossi\trixionary\model\ObjectQuery|\gossi\trixionary\model\PositionQuery|\gossi\trixionary\model\PictureQuery|\gossi\trixionary\model\KstrukturQuery|\gossi\trixionary\model\FunctionPhaseQuery|\gossi\trixionary\model\SkillDependencyQuery|\gossi\trixionary\model\SkillPartQuery|\gossi\trixionary\model\SkillGroupQuery|\gossi\trixionary\model\VideoQuery|\gossi\trixionary\model\ReferenceQuery|\gossi\trixionary\model\StructureNodeQuery|\gossi\trixionary\model\SkillVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSkill findOne(ConnectionInterface $con = null) Return the first ChildSkill matching the query
 * @method     ChildSkill findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSkill matching the query, or a new ChildSkill object populated from the query conditions when no match is found
 *
 * @method     ChildSkill findOneById(int $id) Return the first ChildSkill filtered by the id column
 * @method     ChildSkill findOneBySportId(int $sport_id) Return the first ChildSkill filtered by the sport_id column
 * @method     ChildSkill findOneByName(string $name) Return the first ChildSkill filtered by the name column
 * @method     ChildSkill findOneByAlternativeName(string $alternative_name) Return the first ChildSkill filtered by the alternative_name column
 * @method     ChildSkill findOneBySlug(string $slug) Return the first ChildSkill filtered by the slug column
 * @method     ChildSkill findOneByDescription(string $description) Return the first ChildSkill filtered by the description column
 * @method     ChildSkill findOneByHistory(string $history) Return the first ChildSkill filtered by the history column
 * @method     ChildSkill findOneByIsTranslation(boolean $is_translation) Return the first ChildSkill filtered by the is_translation column
 * @method     ChildSkill findOneByIsRotation(boolean $is_rotation) Return the first ChildSkill filtered by the is_rotation column
 * @method     ChildSkill findOneByIsAcyclic(boolean $is_acyclic) Return the first ChildSkill filtered by the is_acyclic column
 * @method     ChildSkill findOneByIsCyclic(boolean $is_cyclic) Return the first ChildSkill filtered by the is_cyclic column
 * @method     ChildSkill findOneByLongitudinalFlags(int $longitudinal_flags) Return the first ChildSkill filtered by the longitudinal_flags column
 * @method     ChildSkill findOneByLatitudinalFlags(int $latitudinal_flags) Return the first ChildSkill filtered by the latitudinal_flags column
 * @method     ChildSkill findOneByTransversalFlags(int $transversal_flags) Return the first ChildSkill filtered by the transversal_flags column
 * @method     ChildSkill findOneByMovementDescription(string $movement_description) Return the first ChildSkill filtered by the movement_description column
 * @method     ChildSkill findOneByVariationOfId(int $variation_of_id) Return the first ChildSkill filtered by the variation_of_id column
 * @method     ChildSkill findOneByStartPositionId(int $start_position_id) Return the first ChildSkill filtered by the start_position_id column
 * @method     ChildSkill findOneByEndPositionId(int $end_position_id) Return the first ChildSkill filtered by the end_position_id column
 * @method     ChildSkill findOneByIsComposite(boolean $is_composite) Return the first ChildSkill filtered by the is_composite column
 * @method     ChildSkill findOneByIsMultiple(boolean $is_multiple) Return the first ChildSkill filtered by the is_multiple column
 * @method     ChildSkill findOneByMultipleOfId(int $multiple_of_id) Return the first ChildSkill filtered by the multiple_of_id column
 * @method     ChildSkill findOneByMultiplier(int $multiplier) Return the first ChildSkill filtered by the multiplier column
 * @method     ChildSkill findOneByGeneration(int $generation) Return the first ChildSkill filtered by the generation column
 * @method     ChildSkill findOneByImportance(int $importance) Return the first ChildSkill filtered by the importance column
 * @method     ChildSkill findOneByGenerationIds(string $generation_ids) Return the first ChildSkill filtered by the generation_ids column
 * @method     ChildSkill findOneByPictureId(int $picture_id) Return the first ChildSkill filtered by the picture_id column
 * @method     ChildSkill findOneByKstrukturId(int $kstruktur_id) Return the first ChildSkill filtered by the kstruktur_id column
 * @method     ChildSkill findOneByFunctionPhaseId(int $function_phase_id) Return the first ChildSkill filtered by the function_phase_id column
 * @method     ChildSkill findOneByObjectId(int $object_id) Return the first ChildSkill filtered by the object_id column
 * @method     ChildSkill findOneByVersion(int $version) Return the first ChildSkill filtered by the version column
 * @method     ChildSkill findOneByVersionCreatedAt(string $version_created_at) Return the first ChildSkill filtered by the version_created_at column
 * @method     ChildSkill findOneByVersionComment(string $version_comment) Return the first ChildSkill filtered by the version_comment column *

 * @method     ChildSkill requirePk($key, ConnectionInterface $con = null) Return the ChildSkill by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOne(ConnectionInterface $con = null) Return the first ChildSkill matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkill requireOneById(int $id) Return the first ChildSkill filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneBySportId(int $sport_id) Return the first ChildSkill filtered by the sport_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByName(string $name) Return the first ChildSkill filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByAlternativeName(string $alternative_name) Return the first ChildSkill filtered by the alternative_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneBySlug(string $slug) Return the first ChildSkill filtered by the slug column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByDescription(string $description) Return the first ChildSkill filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByHistory(string $history) Return the first ChildSkill filtered by the history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsTranslation(boolean $is_translation) Return the first ChildSkill filtered by the is_translation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsRotation(boolean $is_rotation) Return the first ChildSkill filtered by the is_rotation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsAcyclic(boolean $is_acyclic) Return the first ChildSkill filtered by the is_acyclic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsCyclic(boolean $is_cyclic) Return the first ChildSkill filtered by the is_cyclic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByLongitudinalFlags(int $longitudinal_flags) Return the first ChildSkill filtered by the longitudinal_flags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByLatitudinalFlags(int $latitudinal_flags) Return the first ChildSkill filtered by the latitudinal_flags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByTransversalFlags(int $transversal_flags) Return the first ChildSkill filtered by the transversal_flags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByMovementDescription(string $movement_description) Return the first ChildSkill filtered by the movement_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByVariationOfId(int $variation_of_id) Return the first ChildSkill filtered by the variation_of_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByStartPositionId(int $start_position_id) Return the first ChildSkill filtered by the start_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByEndPositionId(int $end_position_id) Return the first ChildSkill filtered by the end_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsComposite(boolean $is_composite) Return the first ChildSkill filtered by the is_composite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByIsMultiple(boolean $is_multiple) Return the first ChildSkill filtered by the is_multiple column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByMultipleOfId(int $multiple_of_id) Return the first ChildSkill filtered by the multiple_of_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByMultiplier(int $multiplier) Return the first ChildSkill filtered by the multiplier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByGeneration(int $generation) Return the first ChildSkill filtered by the generation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByImportance(int $importance) Return the first ChildSkill filtered by the importance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByGenerationIds(string $generation_ids) Return the first ChildSkill filtered by the generation_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByPictureId(int $picture_id) Return the first ChildSkill filtered by the picture_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByKstrukturId(int $kstruktur_id) Return the first ChildSkill filtered by the kstruktur_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByFunctionPhaseId(int $function_phase_id) Return the first ChildSkill filtered by the function_phase_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByObjectId(int $object_id) Return the first ChildSkill filtered by the object_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByVersion(int $version) Return the first ChildSkill filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildSkill filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkill requireOneByVersionComment(string $version_comment) Return the first ChildSkill filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkill[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSkill objects based on current ModelCriteria
 * @method     ChildSkill[]|ObjectCollection findById(int $id) Return ChildSkill objects filtered by the id column
 * @method     ChildSkill[]|ObjectCollection findBySportId(int $sport_id) Return ChildSkill objects filtered by the sport_id column
 * @method     ChildSkill[]|ObjectCollection findByName(string $name) Return ChildSkill objects filtered by the name column
 * @method     ChildSkill[]|ObjectCollection findByAlternativeName(string $alternative_name) Return ChildSkill objects filtered by the alternative_name column
 * @method     ChildSkill[]|ObjectCollection findBySlug(string $slug) Return ChildSkill objects filtered by the slug column
 * @method     ChildSkill[]|ObjectCollection findByDescription(string $description) Return ChildSkill objects filtered by the description column
 * @method     ChildSkill[]|ObjectCollection findByHistory(string $history) Return ChildSkill objects filtered by the history column
 * @method     ChildSkill[]|ObjectCollection findByIsTranslation(boolean $is_translation) Return ChildSkill objects filtered by the is_translation column
 * @method     ChildSkill[]|ObjectCollection findByIsRotation(boolean $is_rotation) Return ChildSkill objects filtered by the is_rotation column
 * @method     ChildSkill[]|ObjectCollection findByIsAcyclic(boolean $is_acyclic) Return ChildSkill objects filtered by the is_acyclic column
 * @method     ChildSkill[]|ObjectCollection findByIsCyclic(boolean $is_cyclic) Return ChildSkill objects filtered by the is_cyclic column
 * @method     ChildSkill[]|ObjectCollection findByLongitudinalFlags(int $longitudinal_flags) Return ChildSkill objects filtered by the longitudinal_flags column
 * @method     ChildSkill[]|ObjectCollection findByLatitudinalFlags(int $latitudinal_flags) Return ChildSkill objects filtered by the latitudinal_flags column
 * @method     ChildSkill[]|ObjectCollection findByTransversalFlags(int $transversal_flags) Return ChildSkill objects filtered by the transversal_flags column
 * @method     ChildSkill[]|ObjectCollection findByMovementDescription(string $movement_description) Return ChildSkill objects filtered by the movement_description column
 * @method     ChildSkill[]|ObjectCollection findByVariationOfId(int $variation_of_id) Return ChildSkill objects filtered by the variation_of_id column
 * @method     ChildSkill[]|ObjectCollection findByStartPositionId(int $start_position_id) Return ChildSkill objects filtered by the start_position_id column
 * @method     ChildSkill[]|ObjectCollection findByEndPositionId(int $end_position_id) Return ChildSkill objects filtered by the end_position_id column
 * @method     ChildSkill[]|ObjectCollection findByIsComposite(boolean $is_composite) Return ChildSkill objects filtered by the is_composite column
 * @method     ChildSkill[]|ObjectCollection findByIsMultiple(boolean $is_multiple) Return ChildSkill objects filtered by the is_multiple column
 * @method     ChildSkill[]|ObjectCollection findByMultipleOfId(int $multiple_of_id) Return ChildSkill objects filtered by the multiple_of_id column
 * @method     ChildSkill[]|ObjectCollection findByMultiplier(int $multiplier) Return ChildSkill objects filtered by the multiplier column
 * @method     ChildSkill[]|ObjectCollection findByGeneration(int $generation) Return ChildSkill objects filtered by the generation column
 * @method     ChildSkill[]|ObjectCollection findByImportance(int $importance) Return ChildSkill objects filtered by the importance column
 * @method     ChildSkill[]|ObjectCollection findByGenerationIds(string $generation_ids) Return ChildSkill objects filtered by the generation_ids column
 * @method     ChildSkill[]|ObjectCollection findByPictureId(int $picture_id) Return ChildSkill objects filtered by the picture_id column
 * @method     ChildSkill[]|ObjectCollection findByKstrukturId(int $kstruktur_id) Return ChildSkill objects filtered by the kstruktur_id column
 * @method     ChildSkill[]|ObjectCollection findByFunctionPhaseId(int $function_phase_id) Return ChildSkill objects filtered by the function_phase_id column
 * @method     ChildSkill[]|ObjectCollection findByObjectId(int $object_id) Return ChildSkill objects filtered by the object_id column
 * @method     ChildSkill[]|ObjectCollection findByVersion(int $version) Return ChildSkill objects filtered by the version column
 * @method     ChildSkill[]|ObjectCollection findByVersionCreatedAt(string $version_created_at) Return ChildSkill objects filtered by the version_created_at column
 * @method     ChildSkill[]|ObjectCollection findByVersionComment(string $version_comment) Return ChildSkill objects filtered by the version_comment column
 * @method     ChildSkill[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SkillQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\SkillQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Skill', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSkillQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSkillQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSkillQuery) {
            return $criteria;
        }
        $query = new ChildSkillQuery();
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
     * @return ChildSkill|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SkillTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SkillTableMap::DATABASE_NAME);
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
     * @return ChildSkill A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `sport_id`, `name`, `alternative_name`, `slug`, `description`, `history`, `is_translation`, `is_rotation`, `is_acyclic`, `is_cyclic`, `longitudinal_flags`, `latitudinal_flags`, `transversal_flags`, `movement_description`, `variation_of_id`, `start_position_id`, `end_position_id`, `is_composite`, `is_multiple`, `multiple_of_id`, `multiplier`, `generation`, `importance`, `generation_ids`, `picture_id`, `kstruktur_id`, `function_phase_id`, `object_id`, `version`, `version_created_at`, `version_comment` FROM `kk_trixionary_skill` WHERE `id` = :p0';
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
            /** @var ChildSkill $obj */
            $obj = new ChildSkill();
            $obj->hydrate($row);
            SkillTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSkill|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SkillTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SkillTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySportId($sportId = null, $comparison = null)
    {
        if (is_array($sportId)) {
            $useMinMax = false;
            if (isset($sportId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_SPORT_ID, $sportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sportId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_SPORT_ID, $sportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_SPORT_ID, $sportId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the alternative_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAlternativeName('fooValue');   // WHERE alternative_name = 'fooValue'
     * $query->filterByAlternativeName('%fooValue%'); // WHERE alternative_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alternativeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByAlternativeName($alternativeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alternativeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alternativeName)) {
                $alternativeName = str_replace('*', '%', $alternativeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_ALTERNATIVE_NAME, $alternativeName, $comparison);
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SkillTableMap::COL_SLUG, $slug, $comparison);
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SkillTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the history column
     *
     * Example usage:
     * <code>
     * $query->filterByHistory('fooValue');   // WHERE history = 'fooValue'
     * $query->filterByHistory('%fooValue%'); // WHERE history LIKE '%fooValue%'
     * </code>
     *
     * @param     string $history The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByHistory($history = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($history)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $history)) {
                $history = str_replace('*', '%', $history);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_HISTORY, $history, $comparison);
    }

    /**
     * Filter the query on the is_translation column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTranslation(true); // WHERE is_translation = true
     * $query->filterByIsTranslation('yes'); // WHERE is_translation = true
     * </code>
     *
     * @param     boolean|string $isTranslation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsTranslation($isTranslation = null, $comparison = null)
    {
        if (is_string($isTranslation)) {
            $isTranslation = in_array(strtolower($isTranslation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_TRANSLATION, $isTranslation, $comparison);
    }

    /**
     * Filter the query on the is_rotation column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRotation(true); // WHERE is_rotation = true
     * $query->filterByIsRotation('yes'); // WHERE is_rotation = true
     * </code>
     *
     * @param     boolean|string $isRotation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsRotation($isRotation = null, $comparison = null)
    {
        if (is_string($isRotation)) {
            $isRotation = in_array(strtolower($isRotation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_ROTATION, $isRotation, $comparison);
    }

    /**
     * Filter the query on the is_acyclic column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAcyclic(true); // WHERE is_acyclic = true
     * $query->filterByIsAcyclic('yes'); // WHERE is_acyclic = true
     * </code>
     *
     * @param     boolean|string $isAcyclic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsAcyclic($isAcyclic = null, $comparison = null)
    {
        if (is_string($isAcyclic)) {
            $isAcyclic = in_array(strtolower($isAcyclic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_ACYCLIC, $isAcyclic, $comparison);
    }

    /**
     * Filter the query on the is_cyclic column
     *
     * Example usage:
     * <code>
     * $query->filterByIsCyclic(true); // WHERE is_cyclic = true
     * $query->filterByIsCyclic('yes'); // WHERE is_cyclic = true
     * </code>
     *
     * @param     boolean|string $isCyclic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsCyclic($isCyclic = null, $comparison = null)
    {
        if (is_string($isCyclic)) {
            $isCyclic = in_array(strtolower($isCyclic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_CYCLIC, $isCyclic, $comparison);
    }

    /**
     * Filter the query on the longitudinal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitudinalFlags(1234); // WHERE longitudinal_flags = 1234
     * $query->filterByLongitudinalFlags(array(12, 34)); // WHERE longitudinal_flags IN (12, 34)
     * $query->filterByLongitudinalFlags(array('min' => 12)); // WHERE longitudinal_flags > 12
     * </code>
     *
     * @param     mixed $longitudinalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByLongitudinalFlags($longitudinalFlags = null, $comparison = null)
    {
        if (is_array($longitudinalFlags)) {
            $useMinMax = false;
            if (isset($longitudinalFlags['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitudinalFlags['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags, $comparison);
    }

    /**
     * Filter the query on the latitudinal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitudinalFlags(1234); // WHERE latitudinal_flags = 1234
     * $query->filterByLatitudinalFlags(array(12, 34)); // WHERE latitudinal_flags IN (12, 34)
     * $query->filterByLatitudinalFlags(array('min' => 12)); // WHERE latitudinal_flags > 12
     * </code>
     *
     * @param     mixed $latitudinalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByLatitudinalFlags($latitudinalFlags = null, $comparison = null)
    {
        if (is_array($latitudinalFlags)) {
            $useMinMax = false;
            if (isset($latitudinalFlags['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitudinalFlags['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags, $comparison);
    }

    /**
     * Filter the query on the transversal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByTransversalFlags(1234); // WHERE transversal_flags = 1234
     * $query->filterByTransversalFlags(array(12, 34)); // WHERE transversal_flags IN (12, 34)
     * $query->filterByTransversalFlags(array('min' => 12)); // WHERE transversal_flags > 12
     * </code>
     *
     * @param     mixed $transversalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByTransversalFlags($transversalFlags = null, $comparison = null)
    {
        if (is_array($transversalFlags)) {
            $useMinMax = false;
            if (isset($transversalFlags['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transversalFlags['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags, $comparison);
    }

    /**
     * Filter the query on the movement_description column
     *
     * Example usage:
     * <code>
     * $query->filterByMovementDescription('fooValue');   // WHERE movement_description = 'fooValue'
     * $query->filterByMovementDescription('%fooValue%'); // WHERE movement_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $movementDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByMovementDescription($movementDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($movementDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $movementDescription)) {
                $movementDescription = str_replace('*', '%', $movementDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_MOVEMENT_DESCRIPTION, $movementDescription, $comparison);
    }

    /**
     * Filter the query on the variation_of_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationOfId(1234); // WHERE variation_of_id = 1234
     * $query->filterByVariationOfId(array(12, 34)); // WHERE variation_of_id IN (12, 34)
     * $query->filterByVariationOfId(array('min' => 12)); // WHERE variation_of_id > 12
     * </code>
     *
     * @see       filterByVariationOf()
     *
     * @param     mixed $variationOfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVariationOfId($variationOfId = null, $comparison = null)
    {
        if (is_array($variationOfId)) {
            $useMinMax = false;
            if (isset($variationOfId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_VARIATION_OF_ID, $variationOfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationOfId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_VARIATION_OF_ID, $variationOfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_VARIATION_OF_ID, $variationOfId, $comparison);
    }

    /**
     * Filter the query on the start_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStartPositionId(1234); // WHERE start_position_id = 1234
     * $query->filterByStartPositionId(array(12, 34)); // WHERE start_position_id IN (12, 34)
     * $query->filterByStartPositionId(array('min' => 12)); // WHERE start_position_id > 12
     * </code>
     *
     * @see       filterByStartPosition()
     *
     * @param     mixed $startPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByStartPositionId($startPositionId = null, $comparison = null)
    {
        if (is_array($startPositionId)) {
            $useMinMax = false;
            if (isset($startPositionId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_START_POSITION_ID, $startPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startPositionId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_START_POSITION_ID, $startPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_START_POSITION_ID, $startPositionId, $comparison);
    }

    /**
     * Filter the query on the end_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEndPositionId(1234); // WHERE end_position_id = 1234
     * $query->filterByEndPositionId(array(12, 34)); // WHERE end_position_id IN (12, 34)
     * $query->filterByEndPositionId(array('min' => 12)); // WHERE end_position_id > 12
     * </code>
     *
     * @see       filterByEndPosition()
     *
     * @param     mixed $endPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByEndPositionId($endPositionId = null, $comparison = null)
    {
        if (is_array($endPositionId)) {
            $useMinMax = false;
            if (isset($endPositionId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_END_POSITION_ID, $endPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endPositionId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_END_POSITION_ID, $endPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_END_POSITION_ID, $endPositionId, $comparison);
    }

    /**
     * Filter the query on the is_composite column
     *
     * Example usage:
     * <code>
     * $query->filterByIsComposite(true); // WHERE is_composite = true
     * $query->filterByIsComposite('yes'); // WHERE is_composite = true
     * </code>
     *
     * @param     boolean|string $isComposite The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsComposite($isComposite = null, $comparison = null)
    {
        if (is_string($isComposite)) {
            $isComposite = in_array(strtolower($isComposite), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_COMPOSITE, $isComposite, $comparison);
    }

    /**
     * Filter the query on the is_multiple column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMultiple(true); // WHERE is_multiple = true
     * $query->filterByIsMultiple('yes'); // WHERE is_multiple = true
     * </code>
     *
     * @param     boolean|string $isMultiple The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByIsMultiple($isMultiple = null, $comparison = null)
    {
        if (is_string($isMultiple)) {
            $isMultiple = in_array(strtolower($isMultiple), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillTableMap::COL_IS_MULTIPLE, $isMultiple, $comparison);
    }

    /**
     * Filter the query on the multiple_of_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMultipleOfId(1234); // WHERE multiple_of_id = 1234
     * $query->filterByMultipleOfId(array(12, 34)); // WHERE multiple_of_id IN (12, 34)
     * $query->filterByMultipleOfId(array('min' => 12)); // WHERE multiple_of_id > 12
     * </code>
     *
     * @see       filterByMultipleOf()
     *
     * @param     mixed $multipleOfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByMultipleOfId($multipleOfId = null, $comparison = null)
    {
        if (is_array($multipleOfId)) {
            $useMinMax = false;
            if (isset($multipleOfId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_MULTIPLE_OF_ID, $multipleOfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($multipleOfId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_MULTIPLE_OF_ID, $multipleOfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_MULTIPLE_OF_ID, $multipleOfId, $comparison);
    }

    /**
     * Filter the query on the multiplier column
     *
     * Example usage:
     * <code>
     * $query->filterByMultiplier(1234); // WHERE multiplier = 1234
     * $query->filterByMultiplier(array(12, 34)); // WHERE multiplier IN (12, 34)
     * $query->filterByMultiplier(array('min' => 12)); // WHERE multiplier > 12
     * </code>
     *
     * @param     mixed $multiplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByMultiplier($multiplier = null, $comparison = null)
    {
        if (is_array($multiplier)) {
            $useMinMax = false;
            if (isset($multiplier['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_MULTIPLIER, $multiplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($multiplier['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_MULTIPLIER, $multiplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_MULTIPLIER, $multiplier, $comparison);
    }

    /**
     * Filter the query on the generation column
     *
     * Example usage:
     * <code>
     * $query->filterByGeneration(1234); // WHERE generation = 1234
     * $query->filterByGeneration(array(12, 34)); // WHERE generation IN (12, 34)
     * $query->filterByGeneration(array('min' => 12)); // WHERE generation > 12
     * </code>
     *
     * @param     mixed $generation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByGeneration($generation = null, $comparison = null)
    {
        if (is_array($generation)) {
            $useMinMax = false;
            if (isset($generation['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_GENERATION, $generation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($generation['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_GENERATION, $generation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_GENERATION, $generation, $comparison);
    }

    /**
     * Filter the query on the importance column
     *
     * Example usage:
     * <code>
     * $query->filterByImportance(1234); // WHERE importance = 1234
     * $query->filterByImportance(array(12, 34)); // WHERE importance IN (12, 34)
     * $query->filterByImportance(array('min' => 12)); // WHERE importance > 12
     * </code>
     *
     * @param     mixed $importance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByImportance($importance = null, $comparison = null)
    {
        if (is_array($importance)) {
            $useMinMax = false;
            if (isset($importance['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_IMPORTANCE, $importance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($importance['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_IMPORTANCE, $importance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_IMPORTANCE, $importance, $comparison);
    }

    /**
     * Filter the query on the generation_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByGenerationIds('fooValue');   // WHERE generation_ids = 'fooValue'
     * $query->filterByGenerationIds('%fooValue%'); // WHERE generation_ids LIKE '%fooValue%'
     * </code>
     *
     * @param     string $generationIds The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByGenerationIds($generationIds = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($generationIds)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $generationIds)) {
                $generationIds = str_replace('*', '%', $generationIds);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_GENERATION_IDS, $generationIds, $comparison);
    }

    /**
     * Filter the query on the picture_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPictureId(1234); // WHERE picture_id = 1234
     * $query->filterByPictureId(array(12, 34)); // WHERE picture_id IN (12, 34)
     * $query->filterByPictureId(array('min' => 12)); // WHERE picture_id > 12
     * </code>
     *
     * @see       filterByFeaturedPicture()
     *
     * @param     mixed $pictureId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByPictureId($pictureId = null, $comparison = null)
    {
        if (is_array($pictureId)) {
            $useMinMax = false;
            if (isset($pictureId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_PICTURE_ID, $pictureId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pictureId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_PICTURE_ID, $pictureId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_PICTURE_ID, $pictureId, $comparison);
    }

    /**
     * Filter the query on the kstruktur_id column
     *
     * Example usage:
     * <code>
     * $query->filterByKstrukturId(1234); // WHERE kstruktur_id = 1234
     * $query->filterByKstrukturId(array(12, 34)); // WHERE kstruktur_id IN (12, 34)
     * $query->filterByKstrukturId(array('min' => 12)); // WHERE kstruktur_id > 12
     * </code>
     *
     * @see       filterByKstrukturRoot()
     *
     * @param     mixed $kstrukturId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByKstrukturId($kstrukturId = null, $comparison = null)
    {
        if (is_array($kstrukturId)) {
            $useMinMax = false;
            if (isset($kstrukturId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_KSTRUKTUR_ID, $kstrukturId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($kstrukturId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_KSTRUKTUR_ID, $kstrukturId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_KSTRUKTUR_ID, $kstrukturId, $comparison);
    }

    /**
     * Filter the query on the function_phase_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFunctionPhaseId(1234); // WHERE function_phase_id = 1234
     * $query->filterByFunctionPhaseId(array(12, 34)); // WHERE function_phase_id IN (12, 34)
     * $query->filterByFunctionPhaseId(array('min' => 12)); // WHERE function_phase_id > 12
     * </code>
     *
     * @see       filterByFunctionPhaseRoot()
     *
     * @param     mixed $functionPhaseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByFunctionPhaseId($functionPhaseId = null, $comparison = null)
    {
        if (is_array($functionPhaseId)) {
            $useMinMax = false;
            if (isset($functionPhaseId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_FUNCTION_PHASE_ID, $functionPhaseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($functionPhaseId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_FUNCTION_PHASE_ID, $functionPhaseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_FUNCTION_PHASE_ID, $functionPhaseId, $comparison);
    }

    /**
     * Filter the query on the object_id column
     *
     * Example usage:
     * <code>
     * $query->filterByObjectId(1234); // WHERE object_id = 1234
     * $query->filterByObjectId(array(12, 34)); // WHERE object_id IN (12, 34)
     * $query->filterByObjectId(array('min' => 12)); // WHERE object_id > 12
     * </code>
     *
     * @see       filterByObject()
     *
     * @param     mixed $objectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByObjectId($objectId = null, $comparison = null)
    {
        if (is_array($objectId)) {
            $useMinMax = false;
            if (isset($objectId['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_OBJECT_ID, $objectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objectId['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_OBJECT_ID, $objectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_OBJECT_ID, $objectId, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(SkillTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(SkillTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);
    }

    /**
     * Filter the query on the version_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionComment('fooValue');   // WHERE version_comment = 'fooValue'
     * $query->filterByVersionComment('%fooValue%'); // WHERE version_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $versionComment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $versionComment)) {
                $versionComment = str_replace('*', '%', $versionComment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Sport object
     *
     * @param \gossi\trixionary\model\Sport|ObjectCollection $sport The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySport($sport, $comparison = null)
    {
        if ($sport instanceof \gossi\trixionary\model\Sport) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_SPORT_ID, $sport->getId(), $comparison);
        } elseif ($sport instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_SPORT_ID, $sport->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
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
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVariationOf($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_VARIATION_OF_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_VARIATION_OF_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVariationOf() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VariationOf relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinVariationOf($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VariationOf');

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
            $this->addJoinObject($join, 'VariationOf');
        }

        return $this;
    }

    /**
     * Use the VariationOf relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useVariationOfQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVariationOf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VariationOf', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByMultipleOf($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_MULTIPLE_OF_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_MULTIPLE_OF_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMultipleOf() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultipleOf relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinMultipleOf($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultipleOf');

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
            $this->addJoinObject($join, 'MultipleOf');
        }

        return $this;
    }

    /**
     * Use the MultipleOf relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useMultipleOfQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMultipleOf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultipleOf', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Object object
     *
     * @param \gossi\trixionary\model\Object|ObjectCollection $object The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByObject($object, $comparison = null)
    {
        if ($object instanceof \gossi\trixionary\model\Object) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_OBJECT_ID, $object->getId(), $comparison);
        } elseif ($object instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_OBJECT_ID, $object->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByObject() only accepts arguments of type \gossi\trixionary\model\Object or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Object relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinObject($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Object');

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
            $this->addJoinObject($join, 'Object');
        }

        return $this;
    }

    /**
     * Use the Object relation Object object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\ObjectQuery A secondary query class using the current class as primary query
     */
    public function useObjectQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinObject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Object', '\gossi\trixionary\model\ObjectQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Position object
     *
     * @param \gossi\trixionary\model\Position|ObjectCollection $position The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByStartPosition($position, $comparison = null)
    {
        if ($position instanceof \gossi\trixionary\model\Position) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_START_POSITION_ID, $position->getId(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_START_POSITION_ID, $position->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStartPosition() only accepts arguments of type \gossi\trixionary\model\Position or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StartPosition relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinStartPosition($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StartPosition');

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
            $this->addJoinObject($join, 'StartPosition');
        }

        return $this;
    }

    /**
     * Use the StartPosition relation Position object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\PositionQuery A secondary query class using the current class as primary query
     */
    public function useStartPositionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStartPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StartPosition', '\gossi\trixionary\model\PositionQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Position object
     *
     * @param \gossi\trixionary\model\Position|ObjectCollection $position The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByEndPosition($position, $comparison = null)
    {
        if ($position instanceof \gossi\trixionary\model\Position) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_END_POSITION_ID, $position->getId(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_END_POSITION_ID, $position->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEndPosition() only accepts arguments of type \gossi\trixionary\model\Position or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EndPosition relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinEndPosition($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EndPosition');

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
            $this->addJoinObject($join, 'EndPosition');
        }

        return $this;
    }

    /**
     * Use the EndPosition relation Position object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\PositionQuery A secondary query class using the current class as primary query
     */
    public function useEndPositionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEndPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EndPosition', '\gossi\trixionary\model\PositionQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Picture object
     *
     * @param \gossi\trixionary\model\Picture|ObjectCollection $picture The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByFeaturedPicture($picture, $comparison = null)
    {
        if ($picture instanceof \gossi\trixionary\model\Picture) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_PICTURE_ID, $picture->getId(), $comparison);
        } elseif ($picture instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_PICTURE_ID, $picture->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFeaturedPicture() only accepts arguments of type \gossi\trixionary\model\Picture or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FeaturedPicture relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinFeaturedPicture($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FeaturedPicture');

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
            $this->addJoinObject($join, 'FeaturedPicture');
        }

        return $this;
    }

    /**
     * Use the FeaturedPicture relation Picture object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\PictureQuery A secondary query class using the current class as primary query
     */
    public function useFeaturedPictureQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFeaturedPicture($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FeaturedPicture', '\gossi\trixionary\model\PictureQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Kstruktur object
     *
     * @param \gossi\trixionary\model\Kstruktur|ObjectCollection $kstruktur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByKstrukturRoot($kstruktur, $comparison = null)
    {
        if ($kstruktur instanceof \gossi\trixionary\model\Kstruktur) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_KSTRUKTUR_ID, $kstruktur->getId(), $comparison);
        } elseif ($kstruktur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_KSTRUKTUR_ID, $kstruktur->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByKstrukturRoot() only accepts arguments of type \gossi\trixionary\model\Kstruktur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the KstrukturRoot relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinKstrukturRoot($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('KstrukturRoot');

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
            $this->addJoinObject($join, 'KstrukturRoot');
        }

        return $this;
    }

    /**
     * Use the KstrukturRoot relation Kstruktur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\KstrukturQuery A secondary query class using the current class as primary query
     */
    public function useKstrukturRootQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinKstrukturRoot($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'KstrukturRoot', '\gossi\trixionary\model\KstrukturQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\FunctionPhase object
     *
     * @param \gossi\trixionary\model\FunctionPhase|ObjectCollection $functionPhase The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByFunctionPhaseRoot($functionPhase, $comparison = null)
    {
        if ($functionPhase instanceof \gossi\trixionary\model\FunctionPhase) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_FUNCTION_PHASE_ID, $functionPhase->getId(), $comparison);
        } elseif ($functionPhase instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillTableMap::COL_FUNCTION_PHASE_ID, $functionPhase->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFunctionPhaseRoot() only accepts arguments of type \gossi\trixionary\model\FunctionPhase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FunctionPhaseRoot relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinFunctionPhaseRoot($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FunctionPhaseRoot');

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
            $this->addJoinObject($join, 'FunctionPhaseRoot');
        }

        return $this;
    }

    /**
     * Use the FunctionPhaseRoot relation FunctionPhase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\FunctionPhaseQuery A secondary query class using the current class as primary query
     */
    public function useFunctionPhaseRootQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFunctionPhaseRoot($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FunctionPhaseRoot', '\gossi\trixionary\model\FunctionPhaseQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVariation($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skill->getVariationOfId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useVariationQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVariation() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Variation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinVariation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Variation');

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
            $this->addJoinObject($join, 'Variation');
        }

        return $this;
    }

    /**
     * Use the Variation relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useVariationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVariation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Variation', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByMultiple($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skill->getMultipleOfId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useMultipleQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultiple() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Multiple relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinMultiple($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Multiple');

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
            $this->addJoinObject($join, 'Multiple');
        }

        return $this;
    }

    /**
     * Use the Multiple relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useMultipleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMultiple($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Multiple', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillDependency object
     *
     * @param \gossi\trixionary\model\SkillDependency|ObjectCollection $skillDependency the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByDescendent($skillDependency, $comparison = null)
    {
        if ($skillDependency instanceof \gossi\trixionary\model\SkillDependency) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillDependency->getDependencyId(), $comparison);
        } elseif ($skillDependency instanceof ObjectCollection) {
            return $this
                ->useDescendentQuery()
                ->filterByPrimaryKeys($skillDependency->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDescendent() only accepts arguments of type \gossi\trixionary\model\SkillDependency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Descendent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinDescendent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Descendent');

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
            $this->addJoinObject($join, 'Descendent');
        }

        return $this;
    }

    /**
     * Use the Descendent relation SkillDependency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillDependencyQuery A secondary query class using the current class as primary query
     */
    public function useDescendentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDescendent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Descendent', '\gossi\trixionary\model\SkillDependencyQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillDependency object
     *
     * @param \gossi\trixionary\model\SkillDependency|ObjectCollection $skillDependency the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByAscendent($skillDependency, $comparison = null)
    {
        if ($skillDependency instanceof \gossi\trixionary\model\SkillDependency) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillDependency->getParentId(), $comparison);
        } elseif ($skillDependency instanceof ObjectCollection) {
            return $this
                ->useAscendentQuery()
                ->filterByPrimaryKeys($skillDependency->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAscendent() only accepts arguments of type \gossi\trixionary\model\SkillDependency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ascendent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinAscendent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ascendent');

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
            $this->addJoinObject($join, 'Ascendent');
        }

        return $this;
    }

    /**
     * Use the Ascendent relation SkillDependency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillDependencyQuery A secondary query class using the current class as primary query
     */
    public function useAscendentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAscendent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ascendent', '\gossi\trixionary\model\SkillDependencyQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillPart object
     *
     * @param \gossi\trixionary\model\SkillPart|ObjectCollection $skillPart the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByPart($skillPart, $comparison = null)
    {
        if ($skillPart instanceof \gossi\trixionary\model\SkillPart) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillPart->getPartId(), $comparison);
        } elseif ($skillPart instanceof ObjectCollection) {
            return $this
                ->usePartQuery()
                ->filterByPrimaryKeys($skillPart->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPart() only accepts arguments of type \gossi\trixionary\model\SkillPart or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Part relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinPart($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Part');

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
            $this->addJoinObject($join, 'Part');
        }

        return $this;
    }

    /**
     * Use the Part relation SkillPart object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillPartQuery A secondary query class using the current class as primary query
     */
    public function usePartQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPart($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Part', '\gossi\trixionary\model\SkillPartQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillPart object
     *
     * @param \gossi\trixionary\model\SkillPart|ObjectCollection $skillPart the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByComposite($skillPart, $comparison = null)
    {
        if ($skillPart instanceof \gossi\trixionary\model\SkillPart) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillPart->getCompositeId(), $comparison);
        } elseif ($skillPart instanceof ObjectCollection) {
            return $this
                ->useCompositeQuery()
                ->filterByPrimaryKeys($skillPart->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComposite() only accepts arguments of type \gossi\trixionary\model\SkillPart or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Composite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinComposite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Composite');

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
            $this->addJoinObject($join, 'Composite');
        }

        return $this;
    }

    /**
     * Use the Composite relation SkillPart object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillPartQuery A secondary query class using the current class as primary query
     */
    public function useCompositeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComposite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Composite', '\gossi\trixionary\model\SkillPartQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillGroup object
     *
     * @param \gossi\trixionary\model\SkillGroup|ObjectCollection $skillGroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillGroup($skillGroup, $comparison = null)
    {
        if ($skillGroup instanceof \gossi\trixionary\model\SkillGroup) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillGroup->getSkillId(), $comparison);
        } elseif ($skillGroup instanceof ObjectCollection) {
            return $this
                ->useSkillGroupQuery()
                ->filterByPrimaryKeys($skillGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySkillGroup() only accepts arguments of type \gossi\trixionary\model\SkillGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinSkillGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillGroup');

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
            $this->addJoinObject($join, 'SkillGroup');
        }

        return $this;
    }

    /**
     * Use the SkillGroup relation SkillGroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillGroupQuery A secondary query class using the current class as primary query
     */
    public function useSkillGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillGroup', '\gossi\trixionary\model\SkillGroupQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Picture object
     *
     * @param \gossi\trixionary\model\Picture|ObjectCollection $picture the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByPicture($picture, $comparison = null)
    {
        if ($picture instanceof \gossi\trixionary\model\Picture) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $picture->getSkillId(), $comparison);
        } elseif ($picture instanceof ObjectCollection) {
            return $this
                ->usePictureQuery()
                ->filterByPrimaryKeys($picture->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPicture() only accepts arguments of type \gossi\trixionary\model\Picture or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Picture relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinPicture($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Picture');

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
            $this->addJoinObject($join, 'Picture');
        }

        return $this;
    }

    /**
     * Use the Picture relation Picture object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\PictureQuery A secondary query class using the current class as primary query
     */
    public function usePictureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPicture($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Picture', '\gossi\trixionary\model\PictureQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Video object
     *
     * @param \gossi\trixionary\model\Video|ObjectCollection $video the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByVideo($video, $comparison = null)
    {
        if ($video instanceof \gossi\trixionary\model\Video) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $video->getSkillId(), $comparison);
        } elseif ($video instanceof ObjectCollection) {
            return $this
                ->useVideoQuery()
                ->filterByPrimaryKeys($video->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVideo() only accepts arguments of type \gossi\trixionary\model\Video or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Video relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinVideo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Video');

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
            $this->addJoinObject($join, 'Video');
        }

        return $this;
    }

    /**
     * Use the Video relation Video object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\VideoQuery A secondary query class using the current class as primary query
     */
    public function useVideoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVideo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Video', '\gossi\trixionary\model\VideoQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Reference object
     *
     * @param \gossi\trixionary\model\Reference|ObjectCollection $reference the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByReference($reference, $comparison = null)
    {
        if ($reference instanceof \gossi\trixionary\model\Reference) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $reference->getSkillId(), $comparison);
        } elseif ($reference instanceof ObjectCollection) {
            return $this
                ->useReferenceQuery()
                ->filterByPrimaryKeys($reference->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinReference($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useReferenceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReference($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reference', '\gossi\trixionary\model\ReferenceQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\StructureNode object
     *
     * @param \gossi\trixionary\model\StructureNode|ObjectCollection $structureNode the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByStructureNode($structureNode, $comparison = null)
    {
        if ($structureNode instanceof \gossi\trixionary\model\StructureNode) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $structureNode->getSkillId(), $comparison);
        } elseif ($structureNode instanceof ObjectCollection) {
            return $this
                ->useStructureNodeQuery()
                ->filterByPrimaryKeys($structureNode->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildSkillQuery The current query, for fluid interface
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
     * Filter the query by a related \gossi\trixionary\model\Kstruktur object
     *
     * @param \gossi\trixionary\model\Kstruktur|ObjectCollection $kstruktur the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByKstrukturRelatedBySkillId($kstruktur, $comparison = null)
    {
        if ($kstruktur instanceof \gossi\trixionary\model\Kstruktur) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $kstruktur->getSkillId(), $comparison);
        } elseif ($kstruktur instanceof ObjectCollection) {
            return $this
                ->useKstrukturRelatedBySkillIdQuery()
                ->filterByPrimaryKeys($kstruktur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByKstrukturRelatedBySkillId() only accepts arguments of type \gossi\trixionary\model\Kstruktur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the KstrukturRelatedBySkillId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinKstrukturRelatedBySkillId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('KstrukturRelatedBySkillId');

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
            $this->addJoinObject($join, 'KstrukturRelatedBySkillId');
        }

        return $this;
    }

    /**
     * Use the KstrukturRelatedBySkillId relation Kstruktur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\KstrukturQuery A secondary query class using the current class as primary query
     */
    public function useKstrukturRelatedBySkillIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinKstrukturRelatedBySkillId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'KstrukturRelatedBySkillId', '\gossi\trixionary\model\KstrukturQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\FunctionPhase object
     *
     * @param \gossi\trixionary\model\FunctionPhase|ObjectCollection $functionPhase the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByFunctionPhaseRelatedBySkillId($functionPhase, $comparison = null)
    {
        if ($functionPhase instanceof \gossi\trixionary\model\FunctionPhase) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $functionPhase->getSkillId(), $comparison);
        } elseif ($functionPhase instanceof ObjectCollection) {
            return $this
                ->useFunctionPhaseRelatedBySkillIdQuery()
                ->filterByPrimaryKeys($functionPhase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFunctionPhaseRelatedBySkillId() only accepts arguments of type \gossi\trixionary\model\FunctionPhase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FunctionPhaseRelatedBySkillId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinFunctionPhaseRelatedBySkillId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FunctionPhaseRelatedBySkillId');

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
            $this->addJoinObject($join, 'FunctionPhaseRelatedBySkillId');
        }

        return $this;
    }

    /**
     * Use the FunctionPhaseRelatedBySkillId relation FunctionPhase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\FunctionPhaseQuery A secondary query class using the current class as primary query
     */
    public function useFunctionPhaseRelatedBySkillIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFunctionPhaseRelatedBySkillId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FunctionPhaseRelatedBySkillId', '\gossi\trixionary\model\FunctionPhaseQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\SkillVersion object
     *
     * @param \gossi\trixionary\model\SkillVersion|ObjectCollection $skillVersion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillVersion($skillVersion, $comparison = null)
    {
        if ($skillVersion instanceof \gossi\trixionary\model\SkillVersion) {
            return $this
                ->addUsingAlias(SkillTableMap::COL_ID, $skillVersion->getId(), $comparison);
        } elseif ($skillVersion instanceof ObjectCollection) {
            return $this
                ->useSkillVersionQuery()
                ->filterByPrimaryKeys($skillVersion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySkillVersion() only accepts arguments of type \gossi\trixionary\model\SkillVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SkillVersion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function joinSkillVersion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SkillVersion');

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
            $this->addJoinObject($join, 'SkillVersion');
        }

        return $this;
    }

    /**
     * Use the SkillVersion relation SkillVersion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillVersionQuery A secondary query class using the current class as primary query
     */
    public function useSkillVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkillVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SkillVersion', '\gossi\trixionary\model\SkillVersionQuery');
    }

    /**
     * Filter the query by a related Skill object
     * using the kk_trixionary_skill_dependency table as cross reference
     *
     * @param Skill $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByParentId($skill, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useDescendentQuery()
            ->filterBySkillRelatedByParentId($skill, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Skill object
     * using the kk_trixionary_skill_dependency table as cross reference
     *
     * @param Skill $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByDependencyId($skill, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAscendentQuery()
            ->filterBySkillRelatedByDependencyId($skill, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Skill object
     * using the kk_trixionary_skill_part table as cross reference
     *
     * @param Skill $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByCompositeId($skill, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePartQuery()
            ->filterBySkillRelatedByCompositeId($skill, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Skill object
     * using the kk_trixionary_skill_part table as cross reference
     *
     * @param Skill $skill the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterBySkillRelatedByPartId($skill, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCompositeQuery()
            ->filterBySkillRelatedByPartId($skill, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Group object
     * using the kk_trixionary_skill_group table as cross reference
     *
     * @param Group $group the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkillQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useSkillGroupQuery()
            ->filterByGroup($group, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSkill $skill Object to remove from the list of results
     *
     * @return $this|ChildSkillQuery The current query, for fluid interface
     */
    public function prune($skill = null)
    {
        if ($skill) {
            $this->addUsingAlias(SkillTableMap::COL_ID, $skill->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_skill table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SkillTableMap::clearInstancePool();
            SkillTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SkillTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SkillTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SkillTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // versionable behavior

    /**
     * Checks whether versioning is enabled
     *
     * @return boolean
     */
    static public function isVersioningEnabled()
    {
        return self::$isVersioningEnabled;
    }

    /**
     * Enables versioning
     */
    static public function enableVersioning()
    {
        self::$isVersioningEnabled = true;
    }

    /**
     * Disables versioning
     */
    static public function disableVersioning()
    {
        self::$isVersioningEnabled = false;
    }

} // SkillQuery
