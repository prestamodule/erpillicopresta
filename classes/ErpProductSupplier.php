<?php
/**
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Illicopresta SA <contact@illicopresta.com>
*  @copyright 2007-2014 Illicopresta
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class ErpProductSupplier extends ProductSupplierCore
{
	public static function getAllProductSupplierPrice($id_product, $id_product_attribute, $with_currency = false)
	{
		// build query
		$query = new DbQuery();
		$query->select('ps.product_supplier_price_te, s.name as supplier_name');
		if ($with_currency)
						$query->select('ps.id_currency');
		$query->from('product_supplier', 'ps');
		$query->where('ps.id_product = '.(int)$id_product.' AND ps.id_product_attribute = '.(int)$id_product_attribute);
		$query->leftJoin('supplier', 's', 'ps.id_supplier = s.id_supplier');

		if (!$with_currency)
						return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);

		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
	}

}