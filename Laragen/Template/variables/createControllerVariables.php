<?php

$entity = $this->arrayData[0];


$contentFile = '
<?php

namespace <nameSpaceController>;

//use Illuminate\Http\Request;
use App\Models\<name>;
use Illuminate\Support\Facades\DB;


class <name>Controller extends Controller
{
  
 
  public function index()
  {
    $msg = DB::table(\'<tableName>\')
      ->select(\'<columns_string>\')
      ->get();
    return response()->json([\'msg\' => $msg]);
  }

  public function store(Request $request)
  {
    $msg = <name>::create($request->all());
    return response()->json([\'msg\' => $msg]);
  }

  public function show($id)
  {
    $msg = <name>::findOrFail($id);
    //outras opções:
    //$msg = DB::table(\'<tableName>\')->select(\'<fillabels>\')->find($id);
    //$msg = DB::table(\'<tableName>\')->select(\'<fillabels>\')->where(\'name\', $id)->first(); //comparando entradas nome e id compatíveis.
    return response()->json([\'msg\' => $msg]);
    
  }

  public function update(Request $request, $id)
  {
    $data = $request->all();
    $msg  = <name>::findOrFail($id);
    $msg  = $msg->update($data);//bool
    return response()->json([\'msg\' => $msg, \'data\' => $data]);
  }

  public function destroy($id)
  {
    $msg = <name>::findOrFail($id);
    $msg = $msg->delete();
    return response()->json([\'msg\' => $msg ]);
  }
}';

//fazer os str_replace de cada uma das tags. Atenção ao <colunas_string>

$contentFile = str_replace($oldModel, $newContent, $contentFile);