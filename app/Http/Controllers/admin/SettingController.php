<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Carbon\Carbon;

class SettingController extends Controller
{
   
   public function index(Request $request)
   {
   	if ($request->isMethod('get')) {
      return view('admin.setting.index');
  	 }
    else{
  	   	 	$validator = Validator::make($request->all(), [
			'logo' => 'mimes:jpeg,bmp,png,jpg|max:2000',
			'favicon' => 'mimes:jpeg,bmp,png,jpg|max:2000',
		       ]);

	     if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 'danger', 'message' => $validator->errors()]);
              }



          foreach($_POST as $key => $value){
				 if($key == "_token"){
					 continue;
				 }	 
				 $data = array();
				 $data['value'] = $value; 
				 $data['updated_at'] = Carbon::now();
				 if(Setting::where('name', $key)->exists()){				
					Setting::where('name','=',$key)->update($data);			
				 }else{
					$data['name'] = $key; 
					$data['created_at'] = Carbon::now();
					Setting::insert($data); 
				 }
		    }

		   if($request->hasFile('logo')) {
                $storagepath = $request->file('logo')->store('public/logo');
                $fileName = basename($storagepath);
                $logo['name']='logo';
                $logo['value'] = $fileName;

                //if file chnage then delete old one
                $oldFile = $request->get('oldLogo','');
                if( $oldFile != ''){
                    $file_path = "public/logo/".$oldFile;
                    Storage::delete($file_path);
                }
            }
            else{
            	$logo['name']='logo';
                $logo['value'] = $request->get('oldLogo','');
            }

             if($request->hasFile('favicon')) {
                $storagepath = $request->file('favicon')->store('public/logo');
                $fileName = basename($storagepath);
                $data1['name']='favicon';
                $data1['value'] = $fileName;

                //if file chnage then delete old one
                $oldFile = $request->get('oldfavicon','');
                if( $oldFile != ''){
                    $file_path = "public/logo/".$oldFile;
                    Storage::delete($file_path);
                }
            }
            else{
            	$data1['name']='favicon';
                $data1['value'] = $request->get('oldfavicon','');
               }

           if(Setting::where('name', "logo")->exists()){				
				Setting::where('name','=',"logo")->update($logo);			
			}else{
				 
				$logo['created_at'] = Carbon::now();
				Setting::insert($logo); 
			}

			if(Setting::where('name', "favicon")->exists()){				
				Setting::where('name','=',"favicon")->update($data1);			
			}else{ 
				$data1['created_at'] = Carbon::now();
				Setting::insert($data1); 
			}

		   return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('System Configuration Updated.')]);
  	 }
   }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchLocale (Request $request, $locale)
    {
        session(['APP_LOCALE' => $locale]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBackup () {
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        
        $mysqli = new \mysqli($host, $username, $password, $database); 
        $mysqli->select_db($database); 
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables = $mysqli->query('SHOW TABLES');

        while($row = $queryTables->fetch_row()) { 
            $target_tables[] = $row[0]; 
        }

        foreach ($target_tables as $table) {
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 ) {
                        $content .= "\nINSERT INTO ".$table." VALUES";
                    }

                    $content .= "\n(";

                    for($j=0; $j<$fields_amount; $j++) {

                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j])); 
                        
                        if (isset($row[$j])) {
                            $content .= '"'.$row[$j].'"' ; 
                        } else {   
                            $content .= '""';
                        }     
                        
                        if ($j<($fields_amount-1)) {
                            $content.= ',';
                        }      
                    }
                    $content .=")";

                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {   
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }

                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        $backup_name = $database."_".date('H-i-s')."_".date('d-m-Y')."_".str_random(5).".sql";
        header('Content-Type: application/octet-stream');   
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");  
        echo $content; exit;
    }
}
