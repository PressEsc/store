<?php
class ModelExtensionTotalAdditionalDiscount extends Model {
	public function getTotal($total){
		if(is_array($this->config->get('total_additional_discount_array'))){
			$modules = $this->config->get('total_additional_discount_array');
		}else{
			$modules = array();
		}
		
		$type='';
		$discount=0;
		foreach($modules as $module){
			if($module['customer_group_id']==$this->config->get('config_customer_group_id')){
				if($total['total'] >= $module['to_total']   && $total['total'] <= $module['from_total']){
					$type = $module['type'];
					$discount = $module['discount'];
					break;
				}
			}
			
			if($module['customer_group_id']==0){
				if($total['total'] >= $module['to_total']   && $total['total'] <= $module['from_total']){
					$type = $module['type'];
					$discount = $module['discount'];
					break;
				}
			}
		}
		
		$title = $this->config->get('additional_discount_title'.$this->config->get('config_language_id'));
		
		if($type=='F'){
			$discount_total = $discount;
			$discount_title  =  $title.' ( '. $this->currency->format(-$discount, $this->session->data['currency']) .' )';
		}else{
			$discount_total =  ($total['total']*$discount/100);
			$discount_title = $title.' (-'. $discount .'%)';
		}
		
		if($discount_total){
			$total['totals'][] = array(
				'code'       => 'additional_discount',
				'title'      => $discount_title,
				'value'      => -$discount_total,
				'sort_order' => $this->config->get('total_additional_discount_sort_order')
			);
			$total['total'] -= $discount_total;
		}
	}
}