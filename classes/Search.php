<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php
Class Search{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	

/*View all search category */
	
	public function getSearchCat(){
		$query = "SELECT * FROM tbl_category";
		return $result = $this->db->select($query);
	}

/*View search property process*/
	
	public function getSearchAd($data){
		$adArea = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['adarea']));
		
		$catId = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['catid']));
		
		$totalBed = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['totalbed']));
		
		$price = mysqli_real_escape_string($this->db->link, $this->fm->validation($data['price']));
		
	/*=============QUERY SHORTCUT==============*/	
		$where = '';
		$status = " AND tbl_ad.adStatus = '1'";
		
		$area =  " tbl_ad.adArea LIKE '%$adArea%'";
		
		$category = " tbl_ad.catId = $catId";
		
		$bed_range1 = " tbl_ad.totalBed = $totalBed";
		$bed_range2 = " tbl_ad.totalBed > 3";
		
		$priceL10   = " tbl_ad.adRent < 10000";
		$price10_20 = " tbl_ad.adRent BETWEEN 10000 AND 20000";
		$price20_30 = " tbl_ad.adRent BETWEEN 20000 AND 30000";
		$price30_40 = " tbl_ad.adRent BETWEEN 30000 AND 40000";
		$price40_50 = " tbl_ad.adRent BETWEEN 40000 AND 50000";
		$priceG50   = " tbl_ad.adRent >= 50000";
	/*=============QUERY SHORTCUT==============*/
	
	/*==========Filter By AREA============*/	
		if(!empty($adArea)){
			$where = " WHERE".$area;
		}
	/*==========Filter By TYPE============*/
		if(!empty($catId)){
			$where = " WHERE".$category;
		}
	/*==========Filter By BED============*/
		if(!empty($totalBed)){
			if($totalBed != '3+'){
				$where = " WHERE".$bed_range1;
			} else{
				$where = " WHERE".$bed_range2;
			}
		}
	/*==========Filter By PRICE============*/
		if(!empty($price)){
			if($price == '10-'){
				$where = " WHERE".$priceL10;
			} elseif($price == '10'){
				$where = " WHERE".$price10_20;
			} elseif($price == '20'){
				$where = " WHERE".$price20_30;
			} elseif($price == '30'){
				$where = " WHERE".$price30_40;
			} elseif($price == '40'){
				$where = " WHERE".$price40_50;
			} else{
				$where = " WHERE".$priceG50;
			}
		}
		
	/*==========Filter By AREA & TYPE============*/
		if(!empty($adArea) && !empty($catId)){
			$where = " WHERE".$area." AND".$category;
		}
		
	/*==========Filter By AREA & BED============*/
		if(!empty($adArea) && !empty($totalBed)){
			if($totalBed != '3+'){
				$where = " WHERE".$area." AND".$bed_range1;
			} else{
				$where = " WHERE".$area." AND".$bed_range2;
			}
		}
		
	/*==========Filter By AREA & PRICE============*/
		if(!empty($adArea) && !empty($price)){
			if($price == '10-'){
				$where = " WHERE".$area." AND".$priceL10;
			} elseif($price == '10'){
				$where = " WHERE".$area." AND".$price10_20;
			} elseif($price == '20'){
				$where = " WHERE".$area." AND".$price20_30;
			} elseif($price == '30'){
				$where = " WHERE".$area." AND".$price30_40;
			} elseif($price == '40'){
				$where = " WHERE".$area." AND".$price40_50;
			} else{
				$where = " WHERE".$area." AND".$priceG50;
			}
		}
		
	/*==========Filter By TYPE & BED============*/
		if(!empty($catId) && !empty($totalBed)){
			if($totalBed != '3+'){
				$where = " WHERE".$category." AND".$bed_range1;
			} else{
				$where = " WHERE".$category." AND".$bed_range2;
			}
		}
		
	/*==========Filter By TYPE & PRICE============*/
		if(!empty($catId) && !empty($price)){
			if($price == '10-'){
				$where = " WHERE".$category." AND".$priceL10;
			} elseif($price == '10'){
				$where = " WHERE".$category." AND".$price10_20;
			} elseif($price == '20'){
				$where = " WHERE".$category." AND".$price20_30;
			} elseif($price == '30'){
				$where = " WHERE".$category." AND".$price30_40;
			} elseif($price == '40'){
				$where = " WHERE".$category." AND".$price40_50;
			} else{
				$where = " WHERE".$category." AND".$priceG50;
			}
		}
		
	/*==========Filter By BED & PRICE============*/
		if(!empty($totalBed) && !empty($price)){
			if($totalBed != '3+'){
				if($price == '10-'){
					$where = " WHERE".$bed_range1." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$bed_range1." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$bed_range1." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$bed_range1." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$bed_range1." AND".$price40_50;
				} else{
					$where = " WHERE".$bed_range1." AND".$priceG50;
				}
				
			} else{
				if($price == '10-'){
					$where = " WHERE".$bed_range2." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$bed_range2." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$bed_range2." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$bed_range2." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$bed_range2." AND".$price40_50;
				} else{
					$where = " WHERE".$bed_range2." AND".$priceG50;
				}
			}
		}
	
	/*=========Filter By AREA & TYPE & BED===========*/
		if(!empty($adArea) && !empty($catId) && !empty($totalBed)){
			if($totalBed != '3+'){
				$where = " WHERE".$area." AND".$category." AND".$bed_range1;
			} else{
				$where = " WHERE".$area." AND".$category." AND".$bed_range2;
			}
		}
		
	/*=======Filter By AREA & TYPE & PRICE========*/
		if(!empty($adArea) && !empty($catId) && !empty($price)){
			if($price == '10-'){
				$where = " WHERE".$area." AND".$category." AND".$priceL10;
			} elseif($price == '10'){
				$where = " WHERE".$area." AND".$category." AND".$price10_20;
			} elseif($price == '20'){
				$where = " WHERE".$area." AND".$category." AND".$price20_30;
			} elseif($price == '30'){
				$where = " WHERE".$area." AND".$category." AND".$price30_40;
			} elseif($price == '40'){
				$where = " WHERE".$area." AND".$category." AND".$price40_50;
			} else{
				$where = " WHERE".$area." AND".$category." AND".$priceG50;
			}
		}
		
	/*=======Filter By AREA & BED & PRICE========*/
		if(!empty($adArea) && !empty($totalBed) && !empty($price)){
			if($totalBed != '3+'){
				if($price == '10-'){
					$where = " WHERE".$area." AND".$bed_range1." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$area." AND".$bed_range1." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$area." AND".$bed_range1." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$area." AND".$bed_range1." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$area." AND".$bed_range1." AND".$price40_50;
				} else{
					$where = " WHERE".$area." AND".$bed_range1." AND".$priceG50;
				}
			} else{
				if($price == '10-'){
					$where = " WHERE".$area." AND".$bed_range2." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$area." AND".$bed_range2." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$area." AND".$bed_range2." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$area." AND".$bed_range2." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$area." AND".$bed_range2." AND".$price40_50;
				} else{
					$where = " WHERE".$area." AND".$bed_range2." AND".$priceG50;
				}
			}
		}
		
	/*=======Filter By TYPE & BED & PRICE========*/
		if(!empty($catId) && !empty($totalBed) && !empty($price)){
			if($totalBed != '3+'){
				if($price == '10-'){
					$where = " WHERE".$category." AND".$bed_range1." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$category." AND".$bed_range1." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$category." AND".$bed_range1." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$category." AND".$bed_range1." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$category." AND".$bed_range1." AND".$price40_50;
				} else{
					$where = " WHERE".$category." AND".$bed_range1." AND".$priceG50;
				}
			} else{
				if($price == '10-'){
					$where = " WHERE".$category." AND".$bed_range2." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$category." AND".$bed_range2." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$category." AND".$bed_range2." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$category." AND".$bed_range2." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$category." AND".$bed_range2." AND".$price40_50;
				} else{
					$where = " WHERE".$category." AND".$bed_range2." AND".$priceG50;
				}
			}
		}
		
	/*=====Filter By AREA & TYPE & BED & PRICE=======*/
		if(!empty($adArea) && !empty($catId) && !empty($totalBed) && !empty($price)){
			if($totalBed != '3+'){
				if($price == '10-'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$price40_50;
				} else{
					$where = " WHERE".$area." AND".$category." AND".$bed_range1." AND".$priceG50;
				}
			} else{
				if($price == '10-'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$priceL10;
				} elseif($price == '10'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$price10_20;
				} elseif($price == '20'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$price20_30;
				} elseif($price == '30'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$price30_40;
				} elseif($price == '40'){
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$price40_50;
				} else{
					$where = " WHERE".$area." AND".$category." AND".$bed_range2." AND".$priceG50;
				}
			}
		}
		
		$query = "SELECT tbl_ad.*, tbl_category.catName FROM tbl_ad INNER JOIN tbl_category ON tbl_category.catId = tbl_ad.catId".$where.$status;
		$result = $this->db->select($query);
		return $result;
	}
	
	
}
?>