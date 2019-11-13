<?php
header("Access-Control-Allow-Origin:*");              //允许跨域
header("Content-Type:text/html;charset=utf-8");       //设置字符集
date_default_timezone_set("PRC");                     //设置时区


class Common {
	//定义属性 不能是函数  因为这就违背了类的封装特性  将数据的控制权放在了类的外面
	//定义当前时间的公有属性
    private $time;


	function __construct()
	{
		$this->time = date('Y-m-d H:i:s',time());
	}


	/**
	 * curl接口调用【get】
	 * @param $api , 接口地址
	 * @param $flag ,是否验证ssl
	 * @return 成功返回数据，失败返回false
	 */
	public function curl_get($api,$flag=0)
	{
	    $ch=curl_init();
	    curl_setopt($ch, CURLOPT_URL, $api);
	    curl_setopt($ch,CURLOPT_HEADER,FALSE);       #设置头文件的信息作为数据流输出
	    if(! $flag) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    # 禁止 cURL 验证对等证书
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);   #设置获取的信息以文件流的形式返回，而不是直接输出。
	    $res=curl_exec($ch);
	    curl_close($ch);
	    return $res;
	}

    /**
     * @param $posturl  地址
     * @param $data     数据
     * @return mixed
     */
	public function curl_post($posturl,$data)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    //启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch, CURLOPT_URL, $posturl);//上传类
	    $info= curl_exec($ch);
	    curl_close($ch);
	    return $info;
	}

	//连接mysql数据库
	/**
	 * @param $host      主机名
	 * @param $username  用户名
	 * @param $password  密码
	 * @param $db        数据库名
	 * @return bool
	 */
	public function link_mysql($host,$username,$password,$db)
	{
		$link = mysqli_connect($host,$username,$password);
		if (!$link) {echo json_encode(array('code' => '400','msg' => '数据库连接失败'));die;}
		$con = mysqli_select_db($link,$db);
		if (!$con) {echo json_encode(array('code' => '400','msg' => '数据库选择失败'));die;}
		mysqli_set_charset($link,'utf8');
		return $link;
	}


	//连接sqlserver数据库
	public function link_sqlserver($host,$username,$password,$db)
	{
		if (!$link=mssql_connect($host,$username,$password)){
			echo json_encode(array('code' => '400','msg' => '数据库连接失败'));die;
		}
		if (!$con=mssql_select_db($db,$link)) {
			echo json_encode(array('code' => '400','msg' => '数据库选择失败'));die;
		}
		return $link;
	}


	//计算运费   欧盟  美康
	public function freight($link,$AccountNumber,$StartCity,$EndCity,$box,$WDQJ,$table = 'A_00_PriceType')
	{
		//查询是否有运费的规则
		$SqlPriceType = "select TableName from $table where AccountNumber = '$AccountNumber'";
//		var_dump($SqlPriceType);die;
		$ResPriceType = mssql_query($SqlPriceType,$link);
		$ResultPriceType = '';   //预定义一个变量存放结果
		while ($res = mssql_fetch_array($ResPriceType,MSSQL_ASSOC)) {
			$ResultPriceType[] = $res;
		}
		if (!$ResultPriceType) {return json_encode(array('code' => '400'));die;}
		$TableName = $ResultPriceType['0']['TableName'];
		//查询该账号的运费计算方式
		$SqlPriceModel = "select PackageName,BPrice,BMode from $TableName where AccountNumber = '$AccountNumber' and StartCity = '$StartCity' and EndCity = '$EndCity' and WDQJ = '$WDQJ'";
		$ResPriceModel = mssql_query($SqlPriceModel,$link);
		$ResultPriceModel = '';   //预定义一个变量存放结果
		while ($resmodel = mssql_fetch_array($ResPriceModel,MSSQL_ASSOC)) {
			$ResultPriceModel[] = $resmodel;
		}
		if (!$ResultPriceModel) {return json_encode(array('code' => '400'));die;}
		//先将该温区下所有的价格取出存为数组
		$price = [];
		foreach ($ResultPriceModel as $key => $value) {
			$price[$value['PackageName']] = $value['BPrice'];
		}
		//根据BModel来判断计算方式
		$sum = 0;
		if ($ResultPriceModel['0']['BMode'] == '0') {
			foreach ($box as $key => $value) {
				$type = $value['type'];
				$sum += $value['num']*$price[$type];
			}
			if ($sum == '0') {
				return json_encode(array('code' => '400'));die;
			}
			return json_encode(array('code' => '200','sum' => $sum));
		} else {
			//找出最高报价，算出运费*0.9+最高报价*0.1
			//定义一个最高价的变量
			$high = '0';
			foreach ($box as $key => $value) {
				$price[$value['type']] > $high ? $high = $price[$value['type']] : $high = $high;
			}
			foreach ($box as $key => $value) {
				$type = $value['type'];
				$sum += $value['num']*$price[$type]*0.9;
			}
			$sum = $sum+$high*0.1;//最终的运费
			if ($sum == '0') {
				return json_encode(array('code' => '400'));die;
			}
			return json_encode(array('code' => '200','sum' => $sum));
		}
	}

	//包材进出记录
	public function Record($link,$Name,$Company,$City,$Depart,$table1,$table2 = 'A_00_0c')
	{
		//查询是否需要记录进出数量
		$Sql0c = "select ID from $table2 where Name = '$Name'";
		$Res0c = mssql_query($Sql0c,$link);
		$Result0c = '';   //预定义一个变量存放结果
		while ($res = mssql_fetch_array($Res0c,MSSQL_ASSOC)) {
			$Result0c[] = $res;
		}
		if (!$Result0c) {return json_encode(array('code' => '400'));die;}
		//查询表中是否已经存在记录
		$date = date('Y-m-d');//当前的日期
		$SqlB0 = "select ID from $table1 where Company = '$Company' and Depart = '$Depart' and City = '$City' and PackageName = '$Name' and InDate = '$date'";
		$ResB0 = mssql_query($SqlB0,$link);
		$ResultB0 = '';   //预定义一个变量存放结果
		while ($res = mssql_fetch_array($ResB0,MSSQL_ASSOC)) {
			$ResultB0[] = $res;
		}
		if ($ResultB0) {
			return json_encode(array('code' => '300'));  //更新即可
		} else {
			return json_encode(array('code' => '500'));  //新增数据
		}
	}

    //mysql数据库写入
    /**
     * @param $link    数据库资源
     * @param $data    插入的数组
     * @param $table   表名
     * @return bool|int|string
     */
    public function mysql_insert($link,$data,$table)
    {
        $keys = join(',', array_keys($data));
        $vals = "'" . join("','", array_values($data)) . "'";
        $query = "INSERT INTO {$table}({$keys}) VALUES({$vals})";
        $result = mysqli_query($link, $query);
        if ($result) {
            $id = mysqli_insert_id($link);
        } else {
            echo json_encode(array('code' => '400','msg' => '数据插入错误'));die;
        }
//        mysqli_close($link);
        return $id;
    }

    //sqlserver数据库写入
	/**
	 * @param $link                        				数据库资源
	 * @param $data										写入的数据
	 * @param $table									写入的表名
	 * @param string $logname							日志文件名
	 * @return mixed
	 */
    public function mssql_insert($link,$data,$table,$logname = 'Null')
    {
        $keys = join(',', array_keys($data));
        $vals = "'" . join("','", array_values($data)) . "'";
        $query = "INSERT INTO {$table}({$keys}) VALUES({$vals})";
		if ($logname != 'Null') {
			file_put_contents("$logname",date('Y-m-d H:i:s')."\r\n".$query."\r\n",FILE_APPEND);
		}
        $result = mssql_query($query,$link);
        if ($result) {
            $sql_id = "select top 1 id from {$table} order by id desc";
            $res_id = mssql_query($sql_id,$link);
            $result_id = mssql_fetch_array($res_id,MSSQL_ASSOC);
            $id = $result_id['id'];  //返回主键id
        }
//        mssql_close($link);
        return $id;
    }

    //sqlserver数据查询
    /**
     * @param $link                              数据库资源
     * @param $table                             数据表名
     * @param string $field                      查询的字段
     * @param string $where                      查询条件
     * @param string $sort                       排序规则
	 * @param string $logname					  日志文件名
     * @param int $result_type                   数据取出的规则
     * @return array|string
     */
    public function mssql_select($link,$table,$field = '*',$where = 'Null',$sort = 'id desc',$result_type = MSSQL_ASSOC,$logname = 'Null')
    {
        if ($where == 'Null') {
            $sql = "SELECT {$field} FROM {$table} order by {$sort}";
        } else {
            $sql = "SELECT {$field} from {$table} where {$where} order by {$sort}";
        }
//		var_dump($sql);
		if ($logname != 'Null') {
			file_put_contents("$logname",date('Y-m-d H:i:s')."\r\n".$sql."\r\n",FILE_APPEND);
		}
//        var_dump($sql);
        $res = mssql_query($sql,$link);
//        var_dump($res);
        $result = '';
        while ($result1 = mssql_fetch_array($res,$result_type)) {
            $result[] = $result1;
        }
//		var_dump($result);
//        mysqli_close($link);
        return $result;
    }

	//sqlserver数据更新
	/**
	 * @param $link                    连接资源
	 * @param $data                    更新数据
	 * @param $table                   更新数据表
	 * @param $where                   更新条件
	 * @param string $logname          日志文件
	 * @return mixed
	 */
	public function mssql_update($link,$data,$table,$where,$logname='Null')
	{
		$set = '';
		foreach ($data as $key => $val) {
			$set .= "{$key}='{$val}',";
		}
		$set = trim($set, ',');
		$sql = "UPDATE {$table} SET {$set} where {$where}";
		$result = mssql_query($sql,$link);
		if ($logname != 'Null') {
			file_put_contents("$logname",date('Y-m-d H:i:s')."\r\n".$sql.'==='.$result."\r\n",FILE_APPEND);
		}
		return $result;
	}
}