<?php
use App\Models\MasterModel;

/******************************************** START : COMMON - FUNCTION ********************************************/
    function perform_active($id,$table,$column_name)
    {
        $whrCondition   =   array('id' => $id);
        $dataVals       = array($column_name => 'yes');
        if(MasterModel::updateRecord($table,$whrCondition,$dataVals))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function perform_block($id,$table,$column_name)
    {
        $whrCondition   =   array('id' => $id);
        $dataVals       = array($column_name => 'no');
        if(MasterModel::updateRecord($table,$whrCondition,$dataVals))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    function perform_delete($id,$table,$column_name,$sub_table,$sub_column_name)
    {
        $whrCondition   =   array($column_name => $id);
        if(MasterModel::deleteRecord($table,$whrCondition))
        {
            if($sub_table != '' && $sub_column_name!='')
            {
                $sub_whrCondition   =   array($sub_column_name => $id);
                MasterModel::deleteRecord($sub_table,$sub_whrCondition);
            }
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

/******************************************** END : COMMON - FUNCTION ********************************************/   

?>
