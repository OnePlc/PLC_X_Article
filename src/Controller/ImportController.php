<?php
/**
 * ArticleController.php - Main Controller
 *
 * Main Controller Article Module
 *
 * @category Controller
 * @package Article
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Article\Controller;

use Application\Controller\CoreUpdateController;
use Application\Model\CoreEntityModel;
use OnePlace\Article\Model\ArticleTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\ResultSet;

class ImportController extends CoreUpdateController {
    /**
     * ArticleController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param ArticleTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter, ArticleTable $oTableGateway, $oServiceManager)
    {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'article-single';
        parent::__construct($oDbAdapter, $oTableGateway, $oServiceManager);

        if ($oTableGateway) {
            # Attach TableGateway to Entity Models
            if (! isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }


    private function mapTag($oArtModelTbl,$iTagID,$sOldTagKey = 'Model_ID', $iOldTagID = 0) {
        $iModelIDFS = 0;
        $oOldModel = $oArtModelTbl->select([$sOldTagKey=>$iOldTagID]);
        if(count($oOldModel) > 0) {
            $oOldModel = $oOldModel->current();
            $sLabel = '';
            if(!isset($oOldModel->label)) {
                $sLabel = $oOldModel->firstname.' '.$oOldModel->lastname;
            } else {
                $sLabel = $oOldModel->label;
            }
            if($sLabel == '') {
                return 0;
            }
            $oModel = CoreUpdateController::$aCoreTables['core-entity-tag']->select([
                'entity_form_idfs' => 'article-single',
                'tag_idfs' => $iTagID,
                'tag_value' =>$sLabel
            ]);
            if(count($oModel) > 0) {
                $oModel = $oModel->current();
                $iModelIDFS = $oModel->Entitytag_ID;
            } else {
                if($sLabel != '') {
                    CoreUpdateController::$aCoreTables['core-entity-tag']->insert([
                        'entity_form_idfs' => 'article-single',
                        'tag_idfs' => $iTagID,
                        'tag_value' => $sLabel,
                        'parent_tag_idfs' => 0,
                        'created_by' => 1,
                        'created_date' => date('Y-m-d H:i:s', time()),
                        'modified_by' => 1,
                        'modified_date' => date('Y-m-d H:i:s', time()),
                    ]);
                    $iModelIDFS = CoreUpdateController::$aCoreTables['core-entity-tag']->lastInsertValue;
                }
            }
        }
        return $iModelIDFS;
    }
   public function indexAction()
   {
       $this->setThemeBasedLayout('import');

       //$adapter = CoreUpdateController::$oServiceManager->get(AdapterInterface::class);
       $oImportAdapter = new Adapter([
           'driver'=>'Pdo_Mysql',
           'database'=>'plc_vibold',
           'username'=>'plc_vibkg',
           'password'=>'HemH6dNifhsioDSE234df',
           'hostname'=>'localhost',
           'charset'=>'utf8',
       ]);

       $oNewArtTbl = new TableGateway('article', CoreUpdateController::$oDbAdapter);

       $oMediaTbl = new TableGateway('core_gallery_media', CoreUpdateController::$oDbAdapter);
       $oArtTbl = new TableGateway('article', $oImportAdapter);
       $oContactTbl = new TableGateway('contact', $oImportAdapter);
       $oArtModelTbl = new TableGateway('article_model', $oImportAdapter);
       $oArtSystemTbl = new TableGateway('article_system', $oImportAdapter);
       $oArtCoolantTbl = new TableGateway('article_coolant', $oImportAdapter);
       $oArtCatTbl = new TableGateway('article_category', $oImportAdapter);
       $oArtCatArtTbl = new TableGateway('article_article_category', $oImportAdapter);
       $oArtCondTbl = new TableGateway('article_condition', $oImportAdapter);
       $oArtLoadBTbl = new TableGateway('article_loadbase', $oImportAdapter);
       $oArtOriginTbl = new TableGateway('article_origin', $oImportAdapter);
       $oArtStateTbl = new TableGateway('article_state', $oImportAdapter);
       $oWarrantyTbl = new TableGateway('article_warranty', $oImportAdapter);
       $oDeliverytimeTbl = new TableGateway('article_deliverytime', $oImportAdapter);
       $oArtLocationTbl = new TableGateway('location', $oImportAdapter);

       # Import categories
       echo 'start importing categories...';
       $oOldCatsDB = $oArtCatTbl->select();
       foreach($oOldCatsDB as $oCat) {
           CoreUpdateController::$aCoreTables['core-entity-tag']->insert([
               'entity_form_idfs' => 'article-single',
               'tag_idfs' => 1,
               'tag_value' => $oCat->label,
               'parent_tag_idfs' => 0,
               'created_by' => 1,
               'modified_by' => 1,
               'created_date' => date('Y-m-d H:i:s',time()),
               'modified_date' => date('Y-m-d H:i:s',time()),
           ]);
       }

       $oImportArts = $oArtTbl->select();

       echo 'Start importing '.count($oImportArts).' articles';
       foreach($oImportArts as $oArt) {
           $iModelIDFS = 0;
           if($oArt->model_idfs != 0) {
               $iModelIDFS = $this->mapTag($oArtModelTbl,3,'Model_ID',$oArt->model_idfs);
           }
           $iManufacturerIDFS = 0;
           if($oArt->supplier_idfs != 0) {
               $iManufacturerIDFS = $this->mapTag($oContactTbl,13,'Contact_ID',$oArt->supplier_idfs);
           }
           $iSystemIDFS = 0;
           if($oArt->system_idfs != 0) {
               $iSystemIDFS = $this->mapTag($oArtSystemTbl,4,'System_ID',$oArt->system_idfs);
           }
           $iCoolantIDFS = 0;
           if($oArt->coolant_idfs != 0) {
               $iCoolantIDFS = $this->mapTag($oArtCoolantTbl,5,'Coolant_ID',$oArt->coolant_idfs);
           }
           $iConditionIDFS = 0;
           if($oArt->condition_idfs != 0) {
               $iConditionIDFS = $this->mapTag($oArtCondTbl,6,'Condition_ID',$oArt->condition_idfs);
           }
           $iLoadBaseIDFS = 0;
           if($oArt->loadbase_idfs != 0) {
               $iLoadBaseIDFS = $this->mapTag($oArtLoadBTbl,7,'Loadbase_ID',$oArt->loadbase_idfs);
           }
           $iLocationIDFS = 0;
           if($oArt->location_idfs != 0) {
               $iLocationIDFS = $this->mapTag($oArtLocationTbl,8,'Location_ID',$oArt->location_idfs);
           }
           $iOriginIDFS = 0;
           if($oArt->origin_idfs != 0) {
               $iOriginIDFS = $this->mapTag($oArtOriginTbl,9,'Origin_ID',$oArt->origin_idfs);
           }
           $iStateIDFS = 0;
           if($oArt->state_idfs != 0) {
               $iStateIDFS = $this->mapTag($oArtStateTbl,2,'State_ID',$oArt->state_idfs);
           }
           $iOwnerID = 0;
           if($oArt->owner_idfs != 0) {
               $iOwnerID = $this->mapTag($oContactTbl,12,'Contact_ID',$oArt->owner_idfs);
           }
           $iWarrantyID = 0;
           if($oArt->warranty_idfs != 0) {
               $iWarrantyID = $this->mapTag($oWarrantyTbl,10,'Warranty_ID',$oArt->warranty_idfs);
           }
           $iDeadlineReceivedByID = 0;
           if($oArt->deadline_received_by_idfs != 0) {
               $iDeadlineReceivedByID = $this->mapTag($oContactTbl,12,'Contact_ID',$oArt->deadline_received_by_idfs);
           }
           $iPriceUsReceivedByID = 0;
           if($oArt->priceus_received_by_idfs != 0) {
               $iPriceUsReceivedByID = $this->mapTag($oContactTbl,12,'Contact_ID',$oArt->priceus_received_by_idfs);
           }
           $iDeliverytimeID = 0;
           if($oArt->deliverytime_idfs != 0) {
               $iDeliverytimeID = $this->mapTag($oDeliverytimeTbl,11,'Deliverytime_ID',$oArt->deliverytime_idfs);
           }

           $aNewArt = [
               'label' => $oArt->label,
               'custom_art_nr' => $oArt->article_ref_nr,
               'weblink_ext1' => $oArt->weblink_ext1,
               'weblink_ext2' => $oArt->weblink_manufacturer,
               'weblink_youtube' => '',
               'custom_machine_address' => $oArt->custom_machine_address,
               'featured_image' => $oArt->article_title_image_idfs,
               'price_us' => $oArt->price_us,
               'price_sell' => $oArt->price_sell,
               'price_retailer' => $oArt->price_retailer,
               'price_new' => $oArt->price_new,
               'price_margin' => $oArt->price_margin,
               'year_of_construction' => $oArt->year_of_construction,
               'caliber' => $oArt->caliber,
               'descriptive_nr' => $oArt->descriptive_nr,
               'lifetime' => $oArt->lifetime,
               'weight' => $oArt->weight,
               'special_addons' => $oArt->special_addons,
               'description' => $oArt->description,
               'description_internal' => $oArt->description_internal,
               'sell_ready_date' => $oArt->sell_ready_date,
               'info_received_date' => $oArt->info_received_date,
               'deadline_received_date' => $oArt->deadline_received_date,
               'priceus_received_date' => $oArt->priceus_received_date,
               'model_idfs' => $iModelIDFS,
               'manufacturer_idfs' => $iManufacturerIDFS,
               'system_idfs' => $iSystemIDFS,
               'coolant_idfs' => $iCoolantIDFS,
               'condition_idfs' => $iConditionIDFS,
               'loadbase_idfs' => $iLoadBaseIDFS,
               'location_idfs' => $iLocationIDFS,
               'origin_idfs' => $iOriginIDFS,
               'state_idfs' => $iStateIDFS,
               'show_on_web_idfs' => ($oArt->show_on_web_idfs == 0) ? 1 : (($oArt->show_on_web_idfs == 1) ? 2 : 0),
               'still_in_use_idfs' => ($oArt->still_in_use_idfs == 0) ? 1 : (($oArt->still_in_use_idfs == 1) ? 2 : 0),
               'owner_idfs' => $iOwnerID,
               'warranty_idfs' => $iWarrantyID,
               'deadline_received_by' => $iDeadlineReceivedByID,
               'priceus_received_by' => $iPriceUsReceivedByID,
               'deliverytime_idfs' => $iDeliverytimeID,
               'description_en_us' => '',
               'created_by' => $oArt->created_by,
               'created_date' => $oArt->created_date,
               'modified_by' => $oArt->modified_by,
               'modified_date' => $oArt->modified_date,
           ];

           $oNewArtTbl->insert($aNewArt);
           $iNewArtID = $oNewArtTbl->lastInsertValue;

           $iOldCats = $oArtCatArtTbl->select(['article_idfs' => $oArt->Article_ID]);
           if(count($iOldCats) > 0) {
               foreach($iOldCats as $oOldCatArtLnk) {
                   $oOldCat = $oArtCatTbl->select(['Category_ID' => $oOldCatArtLnk->category_idfs])->current();
                   $iNewCat = CoreUpdateController::$aCoreTables['core-entity-tag']->select([
                       'tag_idfs' => 1,
                       'entity_form_idfs' => 'article-single',
                       'tag_value' => $oOldCat->label,
                   ])->current();
                   CoreUpdateController::$aCoreTables['core-entity-tag-entity']->insert([
                       'entity_idfs' => $iNewArtID,
                       'entity_tag_idfs' => $iNewCat->Entitytag_ID,
                       'entity_type' => 'article',
                   ]);
               }
           }

           mkdir($_SERVER['DOCUMENT_ROOT'].'/data/article/'.$iNewArtID);
           $iSortID = 0;
           foreach(glob('/var/www/backupdata/data/article/'.$oArt->Article_ID.'/*') as $sImg) {
               $oMediaTbl->insert([
                   'filename' => basename($sImg),
                   'entity_idfs' => $iNewArtID,
                   'entity_type' => 'article',
                   'is_public' => 1,
                   'created_by' => 1,
                   'modified_by' => 1,
                   'modified_date' => date('Y-m-d H:i:s',time()),
                   'created_date' => date('Y-m-d H:i:s',time()),
                   'sort_id' => $iSortID,
               ]);
               $iSortID++;
               copy($sImg, $_SERVER['DOCUMENT_ROOT'].'/data/article/'.$iNewArtID.'/'.basename($sImg));
           }
       }

       return new ViewModel([

       ]);
   }
}
