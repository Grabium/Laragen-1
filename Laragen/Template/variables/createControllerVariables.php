<?php

$entity = $this->arrayData[0];


$contentFile = '
<?php

namespace <nameSpaceController>;

use Illuminate\Http\Request;
use App\Models\<name>;
use Illuminate\Support\Facades\DB;


class <name>Controller extends Controller
{
  
 
  public function index()
  {
    $msg = DB::table(\'<tableName>\')
      ->select(<fillabels_not_hidden>)
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
    //other options:
    //$msg = DB::table(\'<tableName>\')->select(\'<fillabels_not_hidden>\')->find($id);
    //$msg = DB::table(\'<tableName>\')->select(\'<fillabels_not_hidden>\')->where(\'name\', $id)->first(); //comparando entradas nome e id compatíveis.
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


$contentFile = str_replace('<name>', $entity->name, $contentFile);
$contentFile = str_replace('<nameSpaceController>', $entity->nameSpaceController, $contentFile);
$contentFile = str_replace('<tableName>', $entity->tableName, $contentFile);

$fillabels_not_hidden = '';
foreach($entity->fillable as $k => $item){
  if(in_array($item, $entity->hidden)){continue;}
  $fillabels_not_hidden .= "'$item', ";
}
$fillabels_not_hidden = substr($fillabels_not_hidden, 0, -2);
$contentFile = str_replace('<fillabels_not_hidden>', $fillabels_not_hidden, $contentFile);
