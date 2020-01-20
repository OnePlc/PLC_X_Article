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

use Application\Controller\CoreController;
use Application\Model\CoreEntityModel;
use OnePlace\Article\Model\Article;
use OnePlace\Article\Model\ArticleTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class ArticleController extends CoreController {
    /**
     * Article Table Object
     *
     * @since 1.0.0
     */
    private $oTableGateway;

    /**
     * ArticleController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param ArticleTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,ArticleTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'article-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Article Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('article');

        # Add Buttons for breadcrumb
        $this->setViewButtons('article-index');

        # Set Table Rows for Index
        $this->setIndexColumns('article-index');

        # Get Paginator
        $oPaginator = $this->oTableGateway->fetchAll(true);
        $iPage = (int) $this->params()->fromQuery('page', 1);
        $iPage = ($iPage < 1) ? 1 : $iPage;
        $oPaginator->setCurrentPageNumber($iPage);
        $oPaginator->setItemCountPerPage(3);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('article-index',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sTableName'=>'article-index',
            'aItems'=>$oPaginator,
        ]);
    }

    /**
     * Article Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('article');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Add Form
        if(!$oRequest->isPost()) {
            # Add Buttons for breadcrumb
            $this->setViewButtons('article-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('article-add',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
            ]);
        }

        # Get and validate Form Data
        $aFormData = $this->parseFormData($_REQUEST);

        # Save Add Form
        $oArticle = new Article($this->oDbAdapter);
        $oArticle->exchangeArray($aFormData);
        $iArticleID = $this->oTableGateway->saveSingle($oArticle);
        $oArticle = $this->oTableGateway->getSingle($iArticleID);

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oArticle,'article-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('article-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New Article
        $this->flashMessenger()->addSuccessMessage('Article successfully created');
        return $this->redirect()->toRoute('article',['action'=>'view','id'=>$iArticleID]);
    }

    /**
     * Article Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('article');

        # Get Request to decide wether to save or display form
        $oRequest = $this->getRequest();

        # Display Edit Form
        if(!$oRequest->isPost()) {

            # Get Article ID from URL
            $iArticleID = $this->params()->fromRoute('id', 0);

            # Try to get Article
            try {
                $oArticle = $this->oTableGateway->getSingle($iArticleID);
            } catch (\RuntimeException $e) {
                echo 'Article Not found';
                return false;
            }

            # Attach Article Entity to Layout
            $this->setViewEntity($oArticle);

            # Add Buttons for breadcrumb
            $this->setViewButtons('article-single');

            # Load Tabs for View Form
            $this->setViewTabs($this->sSingleForm);

            # Load Fields for View Form
            $this->setFormFields($this->sSingleForm);

            # Log Performance in DB
            $aMeasureEnd = getrusage();
            $this->logPerfomance('article-edit',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

            return new ViewModel([
                'sFormName' => $this->sSingleForm,
                'oArticle' => $oArticle,
            ]);
        }

        $iArticleID = $oRequest->getPost('Item_ID');
        $oArticle = $this->oTableGateway->getSingle($iArticleID);

        # Update Article with Form Data
        $oArticle = $this->attachFormData($_REQUEST,$oArticle);

        # Save Article
        $iArticleID = $this->oTableGateway->saveSingle($oArticle);

        $this->layout('layout/json');

        # Save Multiselect
        $this->updateMultiSelectFields($_REQUEST,$oArticle,'article-single');

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('article-save',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        # Display Success Message and View New User
        $this->flashMessenger()->addSuccessMessage('Article successfully saved');
        return $this->redirect()->toRoute('article',['action'=>'view','id'=>$iArticleID]);
    }

    /**
     * Article View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        # Set Layout based on users theme
        $this->setThemeBasedLayout('article');

        # Get Article ID from URL
        $iArticleID = $this->params()->fromRoute('id', 0);

        # Try to get Article
        try {
            $oArticle = $this->oTableGateway->getSingle($iArticleID);
        } catch (\RuntimeException $e) {
            echo 'Article Not found';
            return false;
        }

        # Attach Article Entity to Layout
        $this->setViewEntity($oArticle);

        # Add Buttons for breadcrumb
        $this->setViewButtons('article-view');

        # Load Tabs for View Form
        $this->setViewTabs($this->sSingleForm);

        # Load Fields for View Form
        $this->setFormFields($this->sSingleForm);

        # Log Performance in DB
        $aMeasureEnd = getrusage();
        $this->logPerfomance('article-view',$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"utime"),$this->rutime($aMeasureEnd,CoreController::$aPerfomanceLogStart,"stime"));

        return new ViewModel([
            'sFormName'=>$this->sSingleForm,
            'oArticle'=>$oArticle,
        ]);
    }
}
