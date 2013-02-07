<?php

class CouponController extends Controller
{
	 public function beforeAction()
        {
                $user = Yii::app()->session->get('user');
                if(!isset($user)) {
                        $this->redirect(Yii::app()->user->loginUrl);
                        return false;
                }       
                return true;
        }  
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionGenerate()
	{
		if(isset($_POST['count']) && !empty($_POST['count']))
		{
			$count  = intval($_POST['count']);
			$loop = $count/10;
		try{
			$dataMapper->startTransaction();
			for ($i = 0; $i < $loop; $i++) {
			$dataArray = $this->generateCouponCodeData();
			$dataMapper->insertCouponCodes($dataArray);	
			}
			$dataMapper->commitTransaction();
		}
		catch (Exception $e){
			if($e instanceof Marrydoor_Exception_Database)
				$dataMapper->rollBackTransaction();
				$log->LogInfo('duplicate entries in the DB'.$e->getMessage());
		}
		}
		$this->render('success');
	}
	
		public function actionPrint()
			{
				$this->render('printCoupon');
			}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
			
private function createCouponCode() {
    $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $code = '' ;
    while ($i < 15)
    {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $code = $code . $tmp;
        $i++;
    }
    return $code;
    }
    
    private function generateCouponCodeData()
    {
    	$dataArray = array();
    	$batchNumber = $this->generateBatchNumber();
	    $serialNumber = $this->generateRandumSerialNumber();
	    for ($i = 0; $i < 10; $i++) {
	    	$dataArray[$i]['couponCode'] = $this->createCouponCode();
	    	$dataArray[$i]['batchNumber'] = $batchNumber;
	    	$dataArray[$i]['serialNumber'] = $serialNumber;
	    	$dataArray[$i]['startDate'] = $_POST['startDate'];
	    	$dataArray[$i]['endDate'] = $_POST['endDate'];
	    	$dataArray[$i]['couponId'] = $serialNumber.$i;
	    	if(isset($_POST['type']) && $_POST['type'] == 'normal') 
	    	{	
	    		$dataArray[$i]['validity'] = 0;
	    		$dataArray[$i]['couponType'] = 'normal';
	    	}
	    	else
	    	{
	    	
	    	$dataArray[$i]['validity'] = isset($_POST['validity']) ? $_POST['validity'] : 0;
	    	$dataArray[$i]['couponType'] = 'promo';
	    	}
	    }
	    return $dataArray;
    }
    
    private function generateBatchNumber()
    {
    	return date('dmY');
    }

    private function generateRandumSerialNumber()
    {
    	$chars = "0123456789";
			$res = "";
		for ($i = 0; $i < 8; $i++) {
		    $res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		return $res;
    }
    
public function insertCouponCodes($dataArray)
	{
		$insertQuery = "insert into {$this->databaseName}.coupon (couponCode,creationDate,startDate,endDate,validity,batchNo,serialNo,couponId,couponType) values";
		foreach ($dataArray as $key => $value) {
			$insertQuery.= "('{$value['couponCode']}',now(),'{$value['startDate']}','{$value['endDate']}',{$value['validity']},'{$value['batchNumber']}',{$value['serialNumber']},'{$value['couponId']}','{$value['couponType']}')";
			if($key != 9)
			$insertQuery.= ',';
			else 
			$insertQuery.= '';
		}
		$this->query($insertQuery);
	}
			
			
			
}