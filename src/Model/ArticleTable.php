<?php
/**
 * ArticleTable.php - Article Table
 *
 * Table Model for Article
 *
 * @category Model
 * @package Article
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Article\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;

class ArticleTable extends CoreEntityTable {

    /**
     * ArticleTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'article-single';
    }

    /**
     * Fetch All Article Entities based on Filters
     *
     * @param bool $bPaginated
     * @param array $aWhere
     * @return Paginator Paginated Table Connection
     * @since 1.0.0
     */
    public function fetchAll($bPaginated = false,$aWhere = []) {
        $oSel = new Select($this->oTableGateway->getTable());

        # Build where
        $oWh = new Where();
        foreach(array_keys($aWhere) as $sWh) {
            $bIsLike = stripos($sWh,'-like');
            if($bIsLike === false) {

            } else {
                # its a like
                $oWh->like(substr($sWh,0,strlen($sWh)-strlen('-like')),$aWhere[$sWh].'%');
            }
        }
        if(array_key_exists('multi_tag',$aWhere)) {
            $oSel->join(['category_tag'=>'core_entity_tag_entity'],'category_tag.entity_idfs = article.Article_ID');
            $oWh->equalTo('category_tag.entity_tag_idfs',$aWhere['multi_tag']);
            $oWh->like('category_tag.entity_type',explode('-',$this->sSingleForm)[0]);
        }
        $oSel->where($oWh);

        # Return Paginator or Raw ResultSet based on selection
        if ($bPaginated) {
            # Create result set for user entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Article($this->oTableGateway->getAdapter()));

            # Create a new pagination adapter object
            $oPaginatorAdapter = new DbSelect(
            # our configured select object
                $oSel,
                # the adapter to run it against
                $this->oTableGateway->getAdapter(),
                # the result set to hydrate
                $resultSetPrototype
            );
            # Create Paginator with Adapter
            $oPaginator = new Paginator($oPaginatorAdapter);
            return $oPaginator;
        } else {
            $oResults = $this->oTableGateway->selectWith($oSel);
            return $oResults;
        }
    }

    /**
     * Get Article Entity
     *
     * @param int $id
     * @param string $sKey custom key
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Article_ID') {
        $id = (int) $id;
        $rowset = $this->oTableGateway->select([$sKey => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new \RuntimeException(sprintf(
                'Could not find article with identifier %d',
                $id
            ));
        }

        return $row;
    }

    /**
     * Save Article Entity
     *
     * @param Article $oArticle
     * @return int Article ID
     * @since 1.0.0
     */
    public function saveSingle(Article $oArticle) {
        $aData = [
            'label' => $oArticle->label,
        ];

        $aData = $this->attachDynamicFields($aData,$oArticle);

        $id = (int) $oArticle->id;

        if ($id === 0) {
            # Add Metadata
            $aData['created_by'] = CoreController::$oSession->oUser->getID();
            $aData['created_date'] = date('Y-m-d H:i:s',time());
            $aData['modified_by'] = CoreController::$oSession->oUser->getID();
            $aData['modified_date'] = date('Y-m-d H:i:s',time());

            # Insert Article
            $this->oTableGateway->insert($aData);

            # Return ID
            return $this->oTableGateway->lastInsertValue;
        }

        # Check if Article Entity already exists
        try {
            $this->getSingle($id);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf(
                'Cannot update article with identifier %d; does not exist',
                $id
            ));
        }

        # Update Metadata
        $aData['modified_by'] = CoreController::$oSession->oUser->getID();
        $aData['modified_date'] = date('Y-m-d H:i:s',time());

        # Update Article
        $this->oTableGateway->update($aData, ['Article_ID' => $id]);

        return $id;
    }

    /**
     * Generate daily stats for article
     *
     * @since 1.0.5
     */
    public function generateDailyStats() {
        # get all articles
        $iTotal = count($this->fetchAll(false));
        # get newly created articles
        $iNew = count($this->fetchAll(false,['created_date-like'=>date('Y-m-d',time())]));

        # add statistics
        CoreController::$aCoreTables['core-statistic']->insert([
            'stats_key'=>'article-daily',
            'data'=>json_encode(['new'=>$iNew,'total'=>$iTotal]),
            'date'=>date('Y-m-d H:i:s',time()),
        ]);
    }

    public function generateNew() {
        return new Article($this->oTableGateway->getAdapter());
    }
}