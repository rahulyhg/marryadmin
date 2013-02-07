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
		$user = Yii::app()->session->get('user');
		if(isset($_POST['count']) && !empty($_POST['count']))
		{
			$count  = intval($_POST['count']);
			$loop = $count/10;
			$connection=Yii::app()->db;
			try{
				$transaction=$connection->beginTransaction();
				for ($i = 0; $i < $loop; $i++) {
					$batchNumber = $this->generateBatchNumber();
					$serialNumber = $this->generateRandumSerialNumber();

					for ($i = 0; $i < 10; $i++) {
			$coupon = new Coupon();
	    	$coupon->couponCode = $this->createCouponCode();
	    	$coupon->batchNo = $batchNumber;
	    	$coupon->serialNo = $serialNumber;
	    	$coupon->creationDate = new CDbExpression('NOW()');
	    	$coupon->startDate = $_POST['startDate'];
	    	$coupon->endDate = $_POST['endDate'];
	    	$coupon->couponId = $serialNumber.$i;
	    	if(isset($_POST['type']) && $_POST['type'] == 'normal')
	    	{
	    		$coupon->validity = 0;
	    		$coupon->couponType = 'normal';
	    	}
	    	else
	    	{

	    		$coupon->validity = isset($_POST['validity']) ? $_POST['validity'] : 0;
	    		$coupon->couponType = 'promo';
	    	}
	    	$coupon->save();
	    }
	    	$couponLog = new CouponLogs();
	    	$couponLog->batchNo = $batchNumber;
	    	$couponLog->creationTime = new CDbExpression('NOW()'); 
	    	$couponLog->adminUserId = $user->adminId;
	    	$couponLog->save(); 
	    	
				}
				$transaction->commit();
			}
			catch (Exception $e){
				$transaction->rollback();
				$this->forward('index',array('error'=>true));
				return;
			}
		$this->render('success');
		}
		else
		{
			$this->render('index');
		}
	}

	public function actionPrint()
	{
		$this->render('printCoupon');
	}

		
	public function actionExport()
	{
		if(isset($_POST['startDate']) && !empty($_POST['startDate']))
		{
				$condition = "startDate >= {$_POST['startDate']} and endDate <= {$_POST['endDate']} and isUsed != 1";
				$data= Coupon::model()->findAll(array('condition'=>$condition,
				'order'=> 'serialNo DESC' ));
				$file = $this->generateCSV($data);
					
		}
			$this->render('printCoupon',array('file'=>$file ));
		}
		
			
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

		private function generateCouponCodeData($_POST)
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

		public function generateCSV($data)
		{
			$fileName = date('j-n-Y_i_s');
			$fp = fopen("{$fileName}.csv", 'w');
			$column = true;
			foreach ($data as $row) {
				if($column)
				{
					$columns = array_keys($row);
					fputcsv($fp, $columns);
				}
				$column = false;
				fputcsv($fp, $row);
			}
			fclose($fp);
			return $fileName;
		}
			
	}