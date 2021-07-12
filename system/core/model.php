<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model
{
    protected $db;
    protected $_result;
    protected $_table;
    function __construct($table = '')
    {
        $this->db = & Database::handler();
        if ($table == '')
        {
            $table = strtolower(get_class($this));
        }
        $this->_table = $table;
    }
    function __toString()
    {
        return get_class($this) . ' model';
    }
    function selectAll()
    {
        $query = 'select * from `' . $this->_table . '`';
        return $this->query($query);
    }
    function select($id)
    {
        $query = 'select * from `' . $this->_table . '` where `id`=\'' . mysql_real_escape_string($id) . '\'';
        return $this->query($query, true);
    }
    /* Custom SQL Query */

    function query($query, $singleResult = false)
    {
        $this->_result = mysql_query($query, $this->db);
        if (preg_match("/select/i", $query))
        {
            $result = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = mysql_num_fields($this->_result);
            for ($i = 0;$i < $numOfFields;++$i)
            {
                array_push($table, mysql_field_table($this->_result, $i));
                array_push($field, mysql_field_name($this->_result, $i));
            }
            while ($row = mysql_fetch_row($this->_result))
            {
                for ($i = 0;$i < $numOfFields;++$i)
                {
                    $table[$i] = trim(ucfirst($table[$i]) , "s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult === true)
                {
                    mysql_free_result($this->_result);
                    return $tempResults;
                }
                array_push($result, $tempResults);
            }
            mysql_free_result($this->_result);
            return ($result);
        }
    }
    /** Get number of rows **/
    function getNumRows()
    {
        return mysql_num_rows($this->_result);
    }
    /** Free resources allocated by a query **/
    function freeResult()
    {
        mysql_free_result($this->_result);
    }
}
/* Akhir file model.php */
/* Lokasi: ./model.php */

