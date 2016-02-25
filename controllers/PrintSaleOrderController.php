<?php
namespace app\controllers;

use Yii;
use app\models\SaleOrder;
use app\models\ResPartner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;



class PrintSaleOrderController extends Controller
{
	
	public function actionSaleorder($id)
	{
		$this->layout=False;
		$model = SaleOrder::findOne($id);
		if ($model===null){
			throw new NotFoundHttpException;
		}

		$dataContent=[];
		$dataContentModel=$model->saleOrderLines;
		$no=1;
		foreach ($dataContentModel as $key => $value) {
			$price_sub =number_format($value->product_uom_qty*$value->price_unit,2);
			$unit =number_format($value->price_unit,2);
			if($value->name===null){
				$deskription_orderline ="";
			}
			else{
				$deskription_orderline = $value->name;
			}
			$dataContent[$key]['no']=$no;	
			$dataContent[$key]['product_uom_qty']=$value->product_uom_qty;
			$dataContent[$key]['unit']=$value->productUom->name;
			$dataContent[$key]['default_code']=$value->product->default_code;
			$dataContent[$key]['name_product']=$value->product->name_template;
			$dataContent[$key]['unit_price']=$unit;
			$dataContent[$key]['price_sub']=$price_sub;
			$dataContent[$key]['deskription_orderline']=$deskription_orderline;
			$dataContent[$key]['material_line']=[];

			foreach ($value->materialLines as $keyM => $vM) {
				if ($vM->desc===null){
					$descriptionMaterial ="";
				}
				else{
					$descriptionMaterial = $vM->desc;
				}
				$dataContent[$key]['material_line'][] = [
					'product_id'=>$vM->product->name_template,
					'partNumber'=>$vM->product->default_code,
					'descriptionMaterial'=>$descriptionMaterial,
					'qty'=>$vM->qty,
					'uom'=>$vM->uom0->name
				];
			}
			$material=[];
			foreach ($value->materialLines as $key_material => $valueMaterial) {
				$material[]= "<li>".$valueMaterial->product->name_template."</li>";
			}
			$comma_separated = implode("", $material);
			$dataContent[$key]['material']=$comma_separated;
			$no++;
		}

		if ($model->partner->state===null){
			$state="";
		}
		else{
			$state=$model->partner->state->name;
		}

		if ($model->partner->country===null){
			$country="";
		}
		else{
			$country=$model->partner->country->name;
		}

		if ($model->attention0!==null){
			$AttentionName = $model->attention0->name;
			$AttentionPhone = $model->attention0->phone;

			if ($model->attention0->fax!==null){
			$fax=$model->attention0->fax;
			}
			else if ($model->partner->fax!==null)
			{
				$fax=$model->partner->fax;

				}
			else{
				$fax="";
			}

			if ($model->attention0->email!==null){
				$email=$model->attention0->email;
			}
			else if ($model->partner->fax!==null)
			 {
				$email=$model->partner->email;

				}
			else{
				$email="";
			}


		}
		else{
			$fax="";
			$email="";
			$AttentionName = "";
			$AttentionPhone = "";
		}
		if($model->partner_shipping_id){
			if ($model->partnerShipping->street){
				$street_shipping =$model->partnerShipping->street;
			}
			else{
				$street_shipping ="";
			}
			if ($model->partnerShipping->street2){
				$street_shipping_2 =$model->partnerShipping->street2;
			}
			else{
				$street_shipping_2="";
			}

			if ($model->partnerShipping->city){
				$city_shipping=$model->partnerShipping->city;
			}
			else{
				$city_shipping="";
			}

			if ($model->partnerShipping->state_id){
				$state_shipping=$model->partnerShipping->state->name;
			}
			else{
				$state_shipping="";
			}
			if ($model->partnerShipping->country_id){
				$country_shipping = $model->partnerShipping->country->name;
			}
			else{
				$country_shipping="";
			}
			
		}


		if($model->partner_invoice_id){
			if ($model->partnerInvoice->street){
				$street_invoice =$model->partnerInvoice->street;
			}
			else{
				$street_invoice ="";
			}
			if ($model->partnerInvoice->street2){
				$street_invoice_2 =$model->partnerInvoice->street2;
			}
			else{
				$street_invoice_2="";
			}

			if ($model->partnerInvoice->city){
				$city_invoice=$model->partnerInvoice->city;
			}
			else{
				$city_invoice="";
			}

			if ($model->partnerInvoice->state_id){
				$state_invoice=$model->partnerInvoice->state->name;
			}
			else{
				$state_invoice="";
			}
			if ($model->partnerInvoice->country_id){
				$country_invoice = $model->partnerInvoice->country->name;
			}
			else{
				$country_invoice="";
			}
			
		}

		
		return $this->render('saleorder',
			[
			'model'=>$model,
			'state'=>$state,
			'country'=>$country,
			'fax'=>$fax,
			'email'=>$email,
			'AttentionName'=>$AttentionName,
			'AttentionPhone'=>$AttentionPhone,
			'street_shipping'=>$street_shipping,
			'street_shipping_2'=>$street_shipping_2,
			'city_shipping'=>$city_shipping,
			'state_shipping'=>$state_shipping,
			'country_shipping'=>$country_shipping,
			'street_invoice'=>$street_invoice,
			'street_invoice_2'=>$street_invoice_2,
			'city_invoice'=>$city_invoice,
			'state_invoice'=>$state_invoice,
			'country_invoice'=>$country_invoice,
			'dataContent'=>$dataContent

			]
			);
	
	}

	public function actionRfq($id)
	{
		$this->layout=False;
		$model = SaleOrder::findOne($id);
		if ($model===null){
			throw new NotFoundHttpException;
		}


		$dataContent=[];
		$dataContentModel=$model->saleOrderLines;
		$no=1;
		foreach ($dataContentModel as $key => $value) {
			$price_sub =number_format($value->product_uom_qty*$value->price_unit,2);
			$unit =number_format($value->price_unit,2);
			if($value->name===null){
				$deskription_orderline ="";
			}
			else{
				$deskription_orderline = $value->name;
			}
			$dataContent[$key]['no']=$no;	
			$dataContent[$key]['product_uom_qty']=$value->product_uom_qty;
			$dataContent[$key]['unit']=$value->productUom->name;
			$dataContent[$key]['default_code']=$value->product->default_code;
			$dataContent[$key]['name_product']=$value->product->name_template;
			$dataContent[$key]['unit_price']=$unit;
			$dataContent[$key]['price_sub']=$price_sub;
			$dataContent[$key]['deskription_orderline']=$deskription_orderline;
			$dataContent[$key]['material_line']=[];

			foreach ($value->materialLines as $keyM => $vM) {
				if ($vM->desc===null){
					$descriptionMaterial ="";
				}
				else{
					$descriptionMaterial = $vM->desc;
				}
				$dataContent[$key]['material_line'][] = [
					'product_id'=>$vM->product->name_template,
					'partNumber'=>$vM->product->default_code,
					'descriptionMaterial'=>$descriptionMaterial,
					'qty'=>$vM->qty,
					'uom'=>$vM->uom0->name
				];
			}
		
			$no++;
		}



		if ($model->partner->state===null){
			$state="";
		}
		else{
			$state=$model->partner->state->name;
		}

		if ($model->partner->country===null){
			$country="";
		}
		else{
			$country=$model->partner->country->name;
		}
		if ($model->attention0!==null){
			$AttentionName = $model->attention0->name;
			$AttentionPhone = $model->attention0->phone;

			if ($model->attention0->fax!==null){
			$fax=$model->attention0->fax;
			}
			else if ($model->partner->fax!==null)
			{
				$fax=$model->partner->fax;

				}
			else{
				$fax="";
			}

			if ($model->attention0->email!==null){
				$email=$model->attention0->email;
			}
			else if ($model->partner->fax!==null)
			 {
				$email=$model->partner->email;

				}
			else{
				$email="";
			}


		}
		else{
			$fax="";
			$email="";
			$AttentionName = "";
			$AttentionPhone = "";
		}
		
		return $this->render('rfq',
			[
			'model'=>$model,
			'state'=>$state,
			'country'=>$country,
			'fax'=>$fax,
			'email'=>$email,
			'AttentionName'=>$AttentionName,
			'AttentionPhone'=>$AttentionPhone,
			'dataContent'=>$dataContent
			]
			);
	
	}
}