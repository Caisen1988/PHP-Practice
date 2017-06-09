<?php
/*
数据操作类
*/


abstract class MysqlClass
{
    protected $sen;
    protected $m_tableName;

    public function __construct(){
        //connect to DB:

    }

    public function getAll() {
        $sql = "select * from {$this->m_tableName}";
        $result = array();
        $this->sen-ExecQuery($sql, $result);
        return $result;
    }

    protected function filterParameters($param, $filterType = 1) {

        if (is_array($param)) {
            foreach ($param as $k => $v) {
                $param[$k] = $this->filterParameters($v, $filterType);
            }
        } elseif (is_string($param)) {
            if($filterType == 1) {
                $param = htmlspecialchars($param);
                // 过滤引号
                $trans = array(
                    "'" => '&apos;'
                );
                $param = strtr($param,$trans);
            } else {
                $param = addslashes($param);
            }

        }
        return $param;
    }

    public function getByPrimaryKey($arrPrimaryKey=array()) {
        $sql = "SELECT * FROM " . $this->m_tableName . " WHERE 1 = 1";
        foreach($arrPrimaryKey as $field => $value){
            $sql .= " AND " . $field . " = '" . $value  . "'";
        }
        $result = array();
        $this->sen->ExecQuery($sql, $result);
        isset($result[0]) && $result = $result[0];
        return $result;
    }

    public function updateByPrimaryKey($arrPrimaryKey, $data, $filterType = 1) {

        $data = $this->filterParameters($data, $filterType);
        $updateData = array();
        foreach($data as $field => $value){
            $updateData[] = $field . " = '" . $value . "'";
        }

        $sql = "UPDATE " . $this->m_tableName . " SET " . implode(", ", $updateData) . " WHERE 1 = 1";
        foreach($arrPrimaryKey as $field => $value){
            $sql .= " AND " . $field . " = '" . $value  . "'";
        }

        if ($this->sen->ExecUpdate($sql) >= 0) {
            return true;
        } else {
            $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }

    }

    /**
     * 根据主键ID获取详细信息（通用函数）
     * @param array  $primaryArr('id',123)
     * @author  jaspersong
     */
    public function getActInfoById($primaryArr=array()){
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        if (!empty($primaryArr)){
            $sql = "SELECT * FROM `{$this->m_tableName}` WHERE `{$primaryArr[0]}`='{$primaryArr[1]}'";
        }else {
            $sql = "SELECT * FROM `{$this->m_tableName}` WHERE 1";
        }
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");

        $res = $this->sen->ExecQuery($sql, $result);
        if ($res > 0) {
            return $result;
        } else {
            $this->sen->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return $res;
        }
    }

    /**
     * 删除操作
     * @param  array('id',12)
     * @return boolean
     * @since  2015-9-17
     * @author jaspersong
     */
    public function delColumnById($primaryArr=array()){
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "EXEC " . __METHOD__ . " \n");
        $sql = "DELETE FROM `{$this->m_tableName}` WHERE `{$primaryArr[0]}` = '{$primaryArr[1]}'";
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        return $this->sen->ExecUpdate($sql);
    }

    /**
     *更新操作
     * @param array $ids
     * @return boolean
     * @since 2015-9-14
     * @author jaspersong
     */
    public function updateColumnByIds($primaryArr=array(), $data=array()){
        $data = $this->filterParameters($data);
        $keys = array_keys($data);
        $values = array_values($data);
        foreach ($keys as &$v) {
            $v = '`' . $v . '`';
        }
        foreach ($values as &$v) {
            if( $v != 'NOW()' ){
                $v = '"' . $v . '"';
            }
        }
        $setStr = '';
        for ($i = 0; $i < count($keys); $i++) {
            $setStr .= $keys[$i] . '=' . $values[$i] . ',';
        }
        $setStr = substr($setStr, 0, -1);

        $sql = 'UPDATE `' . $this->m_tableName . '` SET ' . $setStr . ' WHERE `'.$primaryArr[0].'`="'.$primaryArr[1].'"';
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $ret = $this->dao->ExecUpdate($sql);
        if ($ret >= 0) {
            return true;
        } else {
            $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }
    }

    public function insertColumn($data = array(), $filterType = 1){
        $data = $this->filterParameters($data, $filterType);
        $keys = array_keys($data);
        $values = array_values($data);
        foreach ($keys as &$v) {
            $v = '`' . $v . '`';
        }
        foreach ($values as &$v) {
           if( $v != 'NOW()' ){
                $v = '"' . $v . '"';
            }
        }

        $sql = 'INSERT INTO `' . $this->m_tableName . '` (' . implode(',', $keys) . ') VALUES (' . implode(',', $values) . ')';
        $this->OssLog->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");

        $ret = $this->dao->ExecUpdate($sql);
        if ($ret >= 0) {
            return $ret;
        } else {
            $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }
    }

    public function batchInsert($data, $filterType = 1) {

        if(!is_array($data) || !$data) {
            return false;
        }

        $data = $this->filterParameters($data, $filterType);

        $arrField = array_keys($data[0]);
        $arrValue = array();

        foreach($arrField as $k => $field) {
            $field = '`' . trim($field) . '`';
            $arrField[$k] = $field;
        }

        foreach($data as $value) {
            foreach($value as $filed => $v) {
                $v = trim($v);
                $v !== 'NOW()' && $v = '"' . $v . '"';
                $value[$filed] = $v;
            }
            $arrValue[] = "(" . implode(",", $value) . ")";
        }

        $sql = 'INSERT INTO ' . $this->m_tableName . ' (' . implode(',', $arrField) . ') VALUES ' . implode(',', $arrValue);
        $this->OssLog->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $ret = $this->sen->ExecUpdate($sql);
        if ($ret >= 0) {
            return $ret;
        } else {
            $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }
    }

    /**
     * @param $data
     * @param int $filterType
     * @return bool
     * example
          $data = array(
              array(
                  'iApplyId' => 1,
                  'dtCreateTime' => date('Y-m-d H:i:s')
              ).
              array(
                  'iApplyId' => 2,
                  'dtCreateTime' => date('Y-m-d H:i:s')
              )
          );
     */
    public function batchReplace($data, $filterType = 1) {

        if(!is_array($data) || !$data) {
            return false;
        }

        $data = $this->filterParameters($data, $filterType);

        $arrField = array_keys($data[0]);
        $arrValue = array();

        foreach($arrField as $k => $field) {
            $field = '`' . trim($field) . '`';
            $arrField[$k] = $field;
        }

        foreach($data as $value) {
            foreach($value as $filed => $v) {
                $v = trim($v);
                $v !== 'NOW()' && $v = '"' . $v . '"';
                $value[$filed] = $v;
            }
            $arrValue[] = "(" . implode(",", $value) . ")";
        }

        $sql = 'REPLACE INTO ' . $this->m_tableName . ' (' . implode(',', $arrField) . ') VALUES ' . implode(',', $arrValue);
        $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . "\n");
        $ret = $this->sen->ExecUpdate($sql);
        if ($ret >= 0) {
            return $ret;
        } else {
            $this->writeLog(__FILE__, __LINE__, LP_DEBUG, "SQL: " . $sql . " EXEC error\n");
            return false;
        }
    }

}
