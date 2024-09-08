<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\MasterModel;
use Illuminate\Support\Facades\Redirect;

use Validator;
use Session;
use Flash;
use File;
use DB;

class DocumentAttributeController extends Controller
{
    use MultiActionTrait;

    public function __construct(MasterModel $masterModel)
    {      
       /*$this->ColorModel  = $color;
       $this->BaseModel          = $this->ColorModel;
       $this->LanguageService    = $langauge;*/
       $this->MasterModel          = $masterModel;
       /*$this->module_title       = "Color";*/
       $this->module_icon        = "fa-paint-brush";
       $this->module_view_folder = "admin.document_attributes";
       $this->module_url_path    = url(config('app.project.admin_panel_slug'));
    }

    public function index(Request $request){
        return redirect($this->module_url_path.'/document/attributes/manage/');
    }

    public function manage(Request $request)
    {

        $selectCols = array('TPC.id AS primaryKey','TPCT.color_name AS paperColor');
        $joinArray  = array('join'=>array('paper_color_translation AS TPCT','TPCT.color_id','=','TPC.id','left'));
        $whrCondition = array('TPCT.locale' => 'en');
        $resPaperColor = $this->MasterModel->getRecords('paper_color AS TPC',$selectCols,$joinArray,$whrCondition,'TPCT.color_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPS.size_name AS paperSize');
        /*$joinArray  = array('tbl_paper_size_translation AS TPST','TPST.id','=','TPS.id');
        $whrCondition = array('TPST.locale','=','en');*/
        $resPaperSize = $this->MasterModel->getRecords('paper_size AS TPS',$selectCols);

        $selectCols = array('TPT.id AS primaryKey','TPTT.name AS paperType');
        $joinArray  = array('join'=>array('paper_type_translation AS TPTT','TPTT.type_id','=','TPT.id','left'));
        $whrCondition = array('TPTT.locale' => 'en');
        $resPaperType = $this->MasterModel->getRecords('paper_type AS TPT',$selectCols,$joinArray,$whrCondition,'TPTT.name','asc');
        
        $selectCols = array('TPWG.id AS primaryKey','TPWG.weight_in_gsm AS paperGsm');
        $resPaperGsm = $this->MasterModel->getRecords('paper_weight_gsm AS TPWG',$selectCols,'','','TPWG.weight_in_gsm','asc');

        $selectCols = array('TBO.id AS primaryKey','TBOT.option_name AS paperFolding');
        $joinArray  = array('join'=>array('brochure_options_translation AS TBOT','TBOT.option_id','=','TBO.id','left'));
        $whrCondition = array('TBOT.locale' => 'en');
        $resPaperFoldings = $this->MasterModel->getRecords('brochure_options AS TBO',$selectCols,$joinArray,$whrCondition,'TBOT.option_name','asc');

        $selectCols = array('TBIND.id AS primaryKey','TBINDT.option_name AS paperBinding');
        $joinArray  = array('join'=>array('binding_options_translation AS TBINDT','TBINDT.option_id','=','TBIND.id','left'));
        $whrCondition = array('TBINDT.locale' => 'en');
        $resPaperBindings = $this->MasterModel->getRecords('binding_options AS TBIND',$selectCols,$joinArray,$whrCondition,'TBINDT.option_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPST.name AS paperSides');
        $joinArray  = array('join'=>array('paper_sides_translation AS TPST','TPST.sides_id','=','TPS.id','left'));
        $whrCondition = array('TPST.locale' => 'en');
        $resPaperSides = $this->MasterModel->getRecords('paper_sides AS TPS',$selectCols,$joinArray,$whrCondition,'TPST.name','asc');

        $selectCols = array('TDA.id AS primaryKey','TDA.*','TDTA.type_name AS documentName');
        $joinArray  = array('join'=>array('document_type_translation AS TDTA','TDTA.type_id','=','TDA.document_id','left'));
        $whrCondition = array('TDTA.locale' => 'en');
        $resCreatedDocuments = $this->MasterModel->getRecords('document_attributes AS TDA',$selectCols,$joinArray,$whrCondition,'TDTA.type_name','ASC');


        $this->arr_view_data['page_title']        = "Manage ";
        $this->arr_view_data['module_title']      = '';
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['resPaperSize']      = $resPaperSize;
        $this->arr_view_data['resPaperType']      = $resPaperType;
        $this->arr_view_data['resPaperGsm']       = $resPaperGsm;
        $this->arr_view_data['resPaperColor']     = $resPaperColor;
        $this->arr_view_data['resPaperSides']     = $resPaperSides;
        $this->arr_view_data['resPaperFoldings']  = $resPaperFoldings;
        $this->arr_view_data['resPaperBindings']  = $resPaperBindings;
        $this->arr_view_data['resCreatedDocuments']  = $resCreatedDocuments;
        return view($this->module_view_folder.'.manage',$this->arr_view_data);
    }

    public function checkDuplicate(Request $request)
    {
        $status = 'notfound';
        $userMsg = $errors = $datadpl = '';

        $rules = array('_id'  => 'required|numeric');
        $messages = array('_id.required' => 'Please select document type.','_id.numeric' => 'Document type is in invalid format.');

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
            return json_encode([
                'errors' => $validator->errors()->getMessages(),
                'code' => 422,
                'status' => 'fail',
            ]);
        }
        else
        {
            $_id = $request->input('_id');
            $isExists = $this->MasterModel->getRecords('document_attributes',array('id'),'',array('document_id' => $_id));
            if(count($isExists))
            {
                $status = 'found';
                $userMsg = 'Selected document is already exists.';
            }
        }

        $resp = array('status' => $status,'message'=> $userMsg);
        return response()->json($resp);
    }
    public function create_attributes(Request $request)
    {
        $documentType = $request->input('documentType');
        if(isset($documentType) && !empty($documentType))
        {
            $paperSize    = $request->input('paperSize');
            $paperType    = $request->input('paperType');
            $paperColor   = $request->input('paperColor');
            $paperFolding = $request->input('paperFolding');
            $paperBinding = $request->input('paperBinding');
            $paperSides   = $request->input('paperSides');
            
            $jsonSize = $jsonGsm = '';

            $cntSize = count($paperSize);
            for($i = 0; $i < $cntSize; $i++)
            {
                $jsonSize .= '"paperSize_'.$i.'": {"id": '.$paperSize[$i].'},';
                $jsonGsm  .= '"paperGsm_'.$i.'": {"id": "'.implode(',', $request->input('paperGsm_'.$i)).'"},';
            }

            $jsonSize = !empty($jsonSize)?'{'.substr($jsonSize,0,-1).'}' : NULL;
            $jsonGsm  = !empty($jsonGsm) ? '{'.substr($jsonGsm,0,-1).'}' : NULL;

            $paperType      = !empty($paperType)    ? implode(',', $paperType)  : NULL;
            $paperColor     = !empty($paperColor)   ? implode(',', $paperColor) : NULL;
            $paperSides     = !empty($paperSides)   ? implode(',', $paperSides) : NULL;
            $paperFolding   = !empty($paperFolding) ? implode(',', $paperFolding) : NULL;
            $paperBinding   = !empty($paperBinding) ? implode(',', $paperBinding) : NULL;

            $dataVals = array(
                            'document_id'   => $documentType,
                            'paper_size'    => $jsonSize,
                            'weight_gsm_options' => $jsonGsm,
                            'paper_type'         => $paperType,
                            'colour_options'     => $paperColor,
                            'side_options'       => $paperSides,
                            'brochure_options'   => $paperFolding,
                            'binding_options'    => $paperBinding
                        );
            $res = $this->MasterModel->insertRecord('document_attributes',$dataVals);
            if($res){
                $userMsg = 'Document attributes added successfully.';
                Flash::success($userMsg);
                return Redirect::back();
            }
            else{
                $userMsg = 'Error in adding document attributes.';
                Flash::error($userMsg);
                return Redirect::back();
            }
        }
        $selectCols = array('TDT.id AS primaryKey','TDTT.type_name AS documentType');
        $joinArray  = array('join'=>array('document_type_translation AS TDTT','TDTT.type_id','=','TDT.id','left'));
        $whrCondition = array('TDTT.locale' => 'en');
        $resDocumentType = $this->MasterModel->getRecords('document_type AS TDT',$selectCols,$joinArray,$whrCondition,'TDTT.type_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPS.size_name AS paperSize');
        /*$joinArray  = array('tbl_paper_size_translation AS TPST','TPST.id','=','TPS.id');
        $whrCondition = array('TPST.locale','=','en');*/
        $resPaperSize = $this->MasterModel->getRecords('paper_size AS TPS',$selectCols);

        $selectCols = array('TPT.id AS primaryKey','TPTT.name AS paperType');
        $joinArray  = array('join'=>array('paper_type_translation AS TPTT','TPTT.type_id','=','TPT.id','left'));
        $whrCondition = array('TPTT.locale' => 'en');
        $resPaperType = $this->MasterModel->getRecords('paper_type AS TPT',$selectCols,$joinArray,$whrCondition,'TPTT.name','asc');
        
        $selectCols = array('TPWG.id AS primaryKey','TPWG.weight_in_gsm AS paperGsm');
        $resPaperGsm = $this->MasterModel->getRecords('paper_weight_gsm AS TPWG',$selectCols,'','','TPWG.weight_in_gsm','asc');

        $selectCols = array('TPC.id AS primaryKey','TPCT.color_name AS paperColor');
        $joinArray  = array('join'=>array('paper_color_translation AS TPCT','TPCT.color_id','=','TPC.id','left')
                    );
        $whrCondition = array('TPCT.locale' => 'en');
        $resPaperColor = $this->MasterModel->getRecords('paper_color AS TPC',$selectCols,$joinArray,$whrCondition,'TPCT.color_name','asc');

        $selectCols = array('TPS.id AS primaryKey','TPST.name AS paperSides');
        $joinArray  = array('join'=>array('paper_sides_translation AS TPST','TPST.sides_id','=','TPS.id','left'));
        $whrCondition = array('TPST.locale' => 'en');
        $resPaperSides = $this->MasterModel->getRecords('paper_sides AS TPS',$selectCols,$joinArray,$whrCondition,'TPST.name','asc');

        $selectCols = array('TBO.id AS primaryKey','TBOT.option_name AS paperFolding');
        $joinArray  = array('join'=>array('brochure_options_translation AS TBOT','TBOT.option_id','=','TBO.id','left'));
        $whrCondition = array('TBOT.locale' => 'en');
        $resPaperFoldings = $this->MasterModel->getRecords('brochure_options AS TBO',$selectCols,$joinArray,$whrCondition,'TBOT.option_name','asc');

        $selectCols = array('TBIND.id AS primaryKey','TBINDT.option_name AS paperBinding');
        $joinArray  = array('join'=>array('binding_options_translation AS TBINDT','TBINDT.option_id','=','TBIND.id','left'));
        $whrCondition = array('TBINDT.locale' => 'en');
        $resPaperBindings = $this->MasterModel->getRecords('binding_options AS TBIND',$selectCols,$joinArray,$whrCondition,'TBINDT.option_name','asc');

        $this->arr_view_data['page_title']        = "Manage ";
        $this->arr_view_data['module_title']      = '';
        $this->arr_view_data['module_icon']       = $this->module_icon;
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['resDocumentType']   = $resDocumentType;
        $this->arr_view_data['resPaperSize']      = $resPaperSize;
        $this->arr_view_data['resPaperType']      = $resPaperType;
        $this->arr_view_data['resPaperGsm']       = $resPaperGsm;
        $this->arr_view_data['resPaperColor']     = $resPaperColor;
        $this->arr_view_data['resPaperSides']     = $resPaperSides;
        $this->arr_view_data['resPaperFoldings']  = $resPaperFoldings;
        $this->arr_view_data['resPaperBindings']  = $resPaperBindings;
        return view($this->module_view_folder.'.add',$this->arr_view_data); 
    }

}
