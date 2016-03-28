<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_product".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $ean13
 * @property integer $color
 * @property resource $image
 * @property string $price_extra
 * @property string $default_code
 * @property string $name_template
 * @property boolean $active
 * @property string $variants
 * @property resource $image_medium
 * @property resource $image_small
 * @property integer $product_tmpl_id
 * @property string $price_margin
 * @property boolean $track_outgoing
 * @property boolean $track_incoming
 * @property string $valuation
 * @property boolean $track_production
 * @property string $partner_code
 * @property string $expired_date
 * @property string $batch_code
 * @property string $partner_desc
 * @property boolean $not_stock
 * @property boolean $is_rent_item
 * @property boolean $hr_expense_ok
 * @property integer $categ_id
 * @property string $set_location
 * @property string $set_loc
 *
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property CatatanLine[] $catatanLines
 * @property DeliveryCarrier[] $deliveryCarriers
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property DeliveryNoteLineMaterial[] $deliveryNoteLineMaterials
 * @property DeliveryNoteLineMaterial[] $deliveryNoteLineMaterials0
 * @property DetailPb[] $detailPbs
 * @property HrExpenseLine[] $hrExpenseLines
 * @property InternalMoveLine[] $internalMoveLines
 * @property InternalMoveLineDetail[] $internalMoveLineDetails
 * @property InternalMoveRequestLine[] $internalMoveRequestLines
 * @property MakeProcurement[] $makeProcurements
 * @property MoveSetData[] $moveSetDatas
 * @property MrpBom[] $mrpBoms
 * @property MrpProduction[] $mrpProductions
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property OrderRequisitionDeliveryLine[] $orderRequisitionDeliveryLines
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals
 * @property ProcurementOrder[] $procurementOrders
 * @property ProductBatchLine[] $productBatchLines
 * @property ProductByLocation[] $productByLocations
 * @property ProductByLocation[] $productByLocations0
 * @property ProductListLine[] $productListLines
 * @property ProductPackaging[] $productPackagings
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductCategory $categ
 * @property ProductTemplate $productTmpl
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property ProductSplit[] $productSplits
 * @property ProductSplit[] $productSplits0
 * @property ProductVariants[] $productVariants
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines
 * @property RawMaterialLine[] $rawMaterialLines
 * @property RentRequisitionDetail[] $rentRequisitionDetails
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderMaterialLine[] $saleOrderMaterialLines
 * @property SbmAdhocOrderRequestOutput[] $sbmAdhocOrderRequestOutputs
 * @property SbmAdhocOrderRequestOutputMaterial[] $sbmAdhocOrderRequestOutputMaterials
 * @property SbmWorkOrderOutput[] $sbmWorkOrderOutputs
 * @property SbmWorkOrderOutputRawMaterial[] $sbmWorkOrderOutputRawMaterials
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockMove[] $stockMoves
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockProductByLocation[] $stockProductByLocations
 * @property StockProductionLot[] $stockProductionLots
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property SuperNoteProductRel[] $superNoteProductRels
 * @property WeekStatusLine[] $weekStatusLines
 * @property WizardCreatePbLine[] $wizardCreatePbLines
 * @property WizardDetailPb[] $wizardDetailPbs
 * @property WizardPoCancelItemLine[] $wizardPoCancelItemLines
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 * @property WizardStockByLocation[] $wizardStockByLocations
 * @property WizardStockByLocationLine[] $wizardStockByLocationLines
 */
class ProductProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'color', 'product_tmpl_id', 'categ_id'], 'integer'],
            [['create_date', 'write_date', 'expired_date'], 'safe'],
            [['image', 'image_medium', 'image_small', 'valuation', 'set_location'], 'string'],
            [['price_extra', 'price_margin'], 'number'],
            [['active', 'track_outgoing', 'track_incoming', 'track_production', 'not_stock', 'is_rent_item', 'hr_expense_ok'], 'boolean'],
            [['product_tmpl_id', 'valuation'], 'required'],
            [['ean13'], 'string', 'max' => 13],
            [['default_code', 'variants', 'partner_code', 'batch_code', 'set_loc'], 'string', 'max' => 64],
            [['name_template'], 'string', 'max' => 128],
            [['partner_desc'], 'string', 'max' => 254],
            [['default_code'], 'unique'],
            [['name_template'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'ean13' => 'Ean13',
            'color' => 'Color',
            'image' => 'Image',
            'price_extra' => 'Price Extra',
            'default_code' => 'Default Code',
            'name_template' => 'Name Template',
            'active' => 'Active',
            'variants' => 'Variants',
            'image_medium' => 'Image Medium',
            'image_small' => 'Image Small',
            'product_tmpl_id' => 'Product Tmpl ID',
            'price_margin' => 'Price Margin',
            'track_outgoing' => 'Track Outgoing',
            'track_incoming' => 'Track Incoming',
            'valuation' => 'Valuation',
            'track_production' => 'Track Production',
            'partner_code' => 'Partner Code',
            'expired_date' => 'Expired Date',
            'batch_code' => 'Batch Code',
            'partner_desc' => 'Partner Desc',
            'not_stock' => 'Not Stock',
            'is_rent_item' => 'Is Rent Item',
            'hr_expense_ok' => 'Hr Expense Ok',
            'categ_id' => 'Categ ID',
            'set_location' => 'Set Location',
            'set_loc' => 'Set Loc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineMaterials()
    {
        return $this->hasMany(DeliveryNoteLineMaterial::className(), ['name_moved0' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineMaterials0()
    {
        return $this->hasMany(DeliveryNoteLineMaterial::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines()
    {
        return $this->hasMany(HrExpenseLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines()
    {
        return $this->hasMany(InternalMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLineDetails()
    {
        return $this->hasMany(InternalMoveLineDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequestLines()
    {
        return $this->hasMany(InternalMoveRequestLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements()
    {
        return $this->hasMany(MakeProcurement::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveryLines()
    {
        return $this->hasMany(OrderRequisitionDeliveryLine::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines()
    {
        return $this->hasMany(ProductBatchLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductByLocations()
    {
        return $this->hasMany(ProductByLocation::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductByLocations0()
    {
        return $this->hasMany(ProductByLocation::className(), ['product_product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackagings()
    {
        return $this->hasMany(ProductPackaging::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateg()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'categ_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTmpl()
    {
        return $this->hasOne(ProductTemplate::className(), ['id' => 'product_tmpl_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSplits()
    {
        return $this->hasMany(ProductSplit::className(), ['item_splited_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSplits0()
    {
        return $this->hasMany(ProductSplit::className(), ['item_to_split' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariants::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitionDetails()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleAdvancePaymentInvs()
    {
        return $this->hasMany(SaleAdvancePaymentInv::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderMaterialLines()
    {
        return $this->hasMany(SaleOrderMaterialLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmAdhocOrderRequestOutputs()
    {
        return $this->hasMany(SbmAdhocOrderRequestOutput::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmAdhocOrderRequestOutputMaterials()
    {
        return $this->hasMany(SbmAdhocOrderRequestOutputMaterial::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputs()
    {
        return $this->hasMany(SbmWorkOrderOutput::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputRawMaterials()
    {
        return $this->hasMany(SbmWorkOrderOutputRawMaterial::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductByLocations()
    {
        return $this->hasMany(StockProductByLocation::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLots()
    {
        return $this->hasMany(StockProductionLot::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNoteProductRels()
    {
        return $this->hasMany(SuperNoteProductRel::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardCreatePbLines()
    {
        return $this->hasMany(WizardCreatePbLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs()
    {
        return $this->hasMany(WizardDetailPb::className(), ['product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItemLines()
    {
        return $this->hasMany(WizardPoCancelItemLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocations()
    {
        return $this->hasMany(WizardStockByLocation::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocationLines()
    {
        return $this->hasMany(WizardStockByLocationLine::className(), ['product_id' => 'id']);
    }
}
