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
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

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
     * Get Article Entity
     *
     * @param int $id
     * @param string $sKey
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id,$sKey = 'Article_ID') {
        # Use core function
        return $this->getSingleEntity($id,$sKey);
    }

    /**
     * Save Article Entity
     *
     * @param Article $oArticle
     * @return int Article ID
     * @since 1.0.0
     */
    public function saveSingle(Article $oArticle) {
        $aDefaultData = [
            'label' => $oArticle->label,
        ];

        return $this->saveSingleEntity($oArticle,'Article_ID',$aDefaultData);
    }

    /**
     * Generate new single Entity
     *
     * @return Article
     * @since 1.0.5
     */
    public function generateNew() {
        return new Article($this->oTableGateway->getAdapter());
    }
}