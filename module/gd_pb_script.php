<?
function getguids($cd){return md5(microtime(true).$cd); }class dbmysql {public $connect;public $is;public $attach;public $isdebug;public $isdebug2;public function db(){return $this->connect;}function __construct($id,$pw,$dbn,$bcon=1){$this->is = 0;if($bcon == 1) $this->is = $this->connectdb($id,$pw,$dbn);$this->isdebug =0;}function __destruct(){$this->disconnectdb();}	public function attach($dbconn){$this->connect = $dbconn;$this->is = 1;$this->attach = 1;}public function setopt(){$this->isdebug2 = 1;}public function connectdb($id,$pw,$dbn){ $this->connect = mysql_connect("localhost",$id,$pw);if (!$this->connect) {die("");return 0;} $iscon = mysql_select_db($dbn, $this->connect);if (!$iscon) {die ("");return 0;}@mysql_query("set names utf8"); return 1;}public function changedb($dbn){$iscon = mysql_select_db($dbn, $this->connect);if (!$iscon) {die ("");return 0;}return 1;}public function disconnectdb(){if($this->attach) return;mysql_close ($this->connect);} public function query($query){if($this->isdebug2 == 1) return;if($this->isdebug == 1) echo($query . "<BR>");if($this->is == 0) $this->is = $this->connectdb();return mysql_query($query, $this->connect);}public function querydatafirst($query){$rus = $this->query($query);$rarr = mysql_fetch_array($rus);return $rarr;}public function querydatafirst2($query){$rus = $this->query($query);$rarr = mysql_fetch_array($rus,MYSQL_ASSOC);return $rarr;}public function qdf($query){return $this->querydatafirst2($query);}public function querydata2($query){$rus = $this->query($query);while ($vRs = mysql_fetch_array($rus,MYSQL_ASSOC)) {$rarr[] = $vRs;}return $rarr;}public function querydata($query){$rus = $this->query($query);while ($vRs = mysql_fetch_array($rus)) {$rarr[] = $vRs;}return $rarr;}
///////////////////////////////////////////////////////	
public function getBoard($field,$query,$max,$page,$pagecount=10){if(!$page) $page = 1;$start=($page-1)*$max;$qry = "select count(*) $query";$length = $this->gettablesize($qry);$qry = "select $field $query limit $start,$max";$arr = $this->querydata($qry);$total_page = ceil($length/$max);$big_total_page=ceil($total_page/$pagecount);$big_page=ceil($page/$pagecount);$page_content[data] = $arr;$page_content[length] = $length;if($big_page>1){$big_front_page=($big_page-1)*$pagecount;$page_content[pre] = $big_front_page;}$start=($big_page-1)*$pagecount+1;$end=$big_page*$pagecount;if($end>$total_page) $end=$total_page;for($a=$start,$b=0;$a<=$end;$a++,$b++){$page_content[$b] = $a;}if($big_page<$big_total_page){$big_next_page=($big_page*$pagecount)+1;$page_content[next] = $big_next_page;}return $page_content;}public function getBoard2($field,$query,$order,$max,$page,$pagecount=10){if(!$page) $page = 1;$start=($page-1)*$max;$qry = "select count(*) $query";$length = $this->gettablesize($qry);$qry = "select $field $query $order limit $start,$max";$arr = $this->querydata($qry);$total_page = ceil($length/$max);$big_total_page=ceil($total_page/$pagecount);$big_page=ceil($page/$pagecount);$page_content[data] = $arr;$page_content[length] = $length;if($big_page>1){$big_front_page=($big_page-1)*$pagecount;$page_content[pre] = $big_front_page;}$start=($big_page-1)*$pagecount+1;$end=$big_page*$pagecount;if($end>$total_page) $end=$total_page;for($a=$start,$b=0;$a<=$end;$a++,$b++){$page_content[$b] = $a;}if($big_page<$big_total_page){$big_next_page=($big_page*$pagecount)+1;$page_content[next] = $big_next_page;}return $page_content;}	
public function gettablesize($query){$query = $query;$rwnsz = $this->querydatafirst($query);return $rwnsz[0];}public function updateCounter($table,$field,$where){if($table){$qry = "UPDATE $table SET $field = $field+1 WHERE $where ";return $this->query($qry);}}public function updatermCounter($table,$field,$where){if($table){$qry = "UPDATE $table SET $field = $field-1 WHERE $where ";return $this->query($qry);}}	public function update($table,$fieldval,$where,$testmode=0){if($table){$qry = "UPDATE $table SET $fieldval WHERE $where ";if($testmode==1) {echo($qry . "\n"); return;}			return $this->query($qry);}}public function del($table,$where){if($table && $where){$qry = "delete from $table WHERE $where ";return $this->query($qry);}}public function ins($table,$fields,$values,$testmode=0){if($table){$qry = "INSERT INTO $table($fields) values($values)";if($testmode==1) {echo($qry . "\n"); return;}return $this->query($qry);}}public function ins_data($table,$datas,$testmode=0){
$fields = "";$values = "";while ($key = key($datas)) {$value = current($datas);if($fields){$fields.=",";}if($values){$values.=",";}$fields .= $key;if($value == "now()"){$values .= "$value";}else{$values .= "'$value'";}next($datas);
}$this->ins($table,$fields,$values,$testmode);}public function update_data($table,$datas,$where,$testmode=0){
//	UPDATE g_company SET  business = 'makeup',map = 'nate' WHERE ind =2
$fields = "";while ($key = key($datas)) {if($fields){$fields.=",";}$value = current($datas);if($value == "now()") $fields .= "$key=$value";else $fields .= "$key='$value'";next($datas);}$this->update($table,$fields,$where,$testmode);}
public function getfields($table){$dr = $this->querydata2("desc $table");$nsz = count($dr);for($i = 0; $i< $nsz; $i++){$ret[] = "`".$dr[$i][Field]."`";}return $ret;}public function getfieldlist($table){$r = $this->getfields($table);
//return implode(',',$r);
$nsz = count($r);for($i = 0; $i< $nsz; $i++){if($i) $ret.=",";$ret .= "$r[$i]";}return $ret;}};
//dbwhere : mysql make where 
class dbwhere{public $fieldinfo;	public $arr_where;	public $mode;public function dbwhere($ddb,$ismode="and"){	$this->setfield($ddb,$ismode);	}public function add($fld,$val,$eq="="){$w["field"] = $fld;		$w["value"] = $val;		$w["eq"] = $eq;	$w["dp"]="1";		$this->arr_where[] = $w;}public function addstring($val){$w["string"] = $val;		$w["eq"] = $eq;			$w["dp"]="3";		$this->arr_where[] = $w;}public function addfromto($fld,$from,$to){$w["field"] = $fld;		$w["from"] = $from;		$w["to"] = $to;	$w["dp"]="2";		$this->arr_where[] = $w;}public function addwhere($dbw,$isfields=1){$s_w= $dbw->getstring("0",$isfields);if($s_w){$w["string"] = $s_w;$w["dp"] ="0";$this->arr_where[] = $w;}}
public function remove($ind){
$nsz = count($this->arr_where);for($i=0;$i<$nsz;$i++){	if($i != $ind)	$narr[] = $this->arr_where[$i];	}unset($this->arr_where);$this->arr_where = $narr;}
public function rm($fld){
$nsz = count($this->arr_where);for($i=0;$i<$nsz;$i++){	if($fld != $this->arr_where[$i]["field"])	$narr[] = $this->arr_where[$i];	}unset($this->arr_where);$this->arr_where = $narr;}public function getstring($isface="1",$isflds="1"){$aw = $this->arr_where; $fs = $this->fieldinfo;$wnsz = count($aw); $fnsz = count($fs);for($j=0;$j<$wnsz;$j++){for($i=0;$i<$fnsz;$i++){$efs = str_replace("`","",$fs[$i]);	if($aw[$j]["field"] == $efs || $aw[$j]["dp"] == "0" || $isflds == 0 ||  $aw[$j]["dp"] == "3" ){$raw[] = $aw[$j];break;}
}}$rnsz = count($raw);$s_where = "";for($i=0;$i<$rnsz;$i++){$dr = $raw[$i];	if($i) $s_where .= $this->mode;if($dr["dp"] == "1"){$s_where .=" `$dr[field]` $dr[eq] '$dr[value]' ";}else if($dr["dp"]=="2"){$s_where .=" `$dr[field]` between '$dr[from]' and '$dr[to]' ";}else{$s_where .=" ($dr[string]) ";}}if($isface=="1"){$s_where = "where" . $s_where;}else{if($s_where == "")$s_where = "1";}return $s_where;}public function setfield($ddb,$ismode){		$this->fieldinfo = $ddb->fields;	$this->mode = $ismode;	}}
///////////////////////////
class dborder{public $fieldinfo; public $arr_ord;public function dborder($ddb){	$this->setfield($ddb);	}public function setfield($ddb){		$this->fieldinfo = $ddb->fields;}public function add($fld,$pos="desc"){		$ord["field"] = $fld;		$ord["pos"] = $pos;		$this->arr_ord[] = $ord;	}public function remove($ind){$nsz = count($this->arr_ord);for($i=0;$i<$nsz;$i++){	if($i != $ind)	$narr[] = $this->arr_ord[$i];	}
unset($this->arr_ord);$this->arr_ord = $narr;}public function rm($fld){$nsz = count($this->arr_ord);for($i=0;$i<$nsz;$i++){	if($fld != $this->arr_ord[$i]["field"])	$narr[] = $this->arr_ord[$i];	}unset($this->arr_ord);$this->arr_ord= $narr;
}public function getstring($isface="1",$isflds="1"){$aw = $this->arr_ord; $fs = $this->fieldinfo;$wnsz = count($aw); $fnsz = count($fs);for($j=0;$j<$wnsz;$j++){
for($i=0;$i<$fnsz;$i++){$efs = str_replace("`","",$fs[$i]);			if($aw[$j]["field"] == $efs){$raw[] = $aw[$j];break;}}}$rnsz = count($raw);$s_ord= "";for($i=0;$i<$rnsz;$i++){$dr = $raw[$i];			if($i) $s_ord .= ",";			$s_ord .=" `$dr[field]`  $dr[pos] ";}
if($isface=="1") $s_ord = "order by" . $s_ord;return $s_ord;}}
///////////////////////////////
class dbbase{public $db;	public $fields;	public $fields_fld;	public $tablename;	public $subqry;	public $issubqry;public function setdb($db){global $_SERVER;if(file_exists(dirname($_SERVER[SCRIPT_FILENAME]) . "/ajax_load.php")){$db->setopt();}	$this->db= $db;	$this->fields = $db->getfields($this->tablename);$this->fields_fld = $db->getfieldlist($this->tablename);}
//필드 재정리( $db->getfieldlist 와동일)
public function resetfield(){$r = $this->fields;$nsz = count($r);for($i = 0; $i< $nsz; $i++){if($i) $ret.=",";$ret .= $r[$i];}$this->fields_fld = $ret;}public function rmsubqry(){$this->subqry = "";$this->issubqry ="";}public function addsubqry($aq){$this->subqry = $aq;$this->issubqry ="1";}public function addfield($fld){$this->fields[] = $fld;$this->resetfield();
}//필드 삭제
public function rmfield($fld){$nsz = count($this->fields);for($i = 0; $i< $nsz; $i++){if($this->fields[$i] != $fld){$newfld[] = $this->fields[$i];}}$this->fields = $newfld;$this->resetfield();}	public function dbbase($db = null,$tname=null){if($tname)$this->tablename= $tname;if($db)	$this->setdb($db);}public function isfieldset($datas){$nsz = count($this->fields);$isf = 0;while ($key = key($datas)) {for($i=0; $i<$nsz; $i++){				if($this->fields[$i] == "`$key`")	$isf = 1;			}			if($isf == 1){				$isf = 0;				$ret[$key]= current($datas);			}		   next($datas);		}		return $ret;}public function query($qry){
$this->db->query($qry);}public function addcount($field,$where){$tbl = $this->tablename;$this->db->updateCounter($tbl,$field,$where);}public function mincount($field,$where){$tbl = $this->tablename;$this->db->updatermCounter($tbl,$field,$where);}
public function board($field=null,$where=null,$max=10,$page=1,$pagecount=10){if($field == null) $field = $this->fields_fld;$tbl = $this->tablename;if($this->issubqry == "1") $adds = "," . $this->subqry;$q = "from $tbl $adds where $where";return $this->db->getBoard($field,$q,$max,$page,$pagecount=10);
}
public function boardex($field=null,$where=null,$max=10,$page=1,$pagecount=10){
if($field == null) $field = $this->fields_fld;
$tbl = $this->tablename;
if($this->issubqry == "1") $adds = "," . $this->subqry;
$q = "from $tbl $adds $where";
return $this->db->getBoard($field,$q,$max,$page,$pagecount=10);}public function select($fields = null,$add = null){if($fields == null) $fields = $this->fields_fld;if($this->issubqry == "1") $adds = "," . $this->subqry;$tbl = $this->tablename;return $this->db->querydata2("select $fields from $tbl $adds $add");}public function sel2($field=null,$where=null,$orderby=null,$limitstart=0,$limitmax=null){if($fields == null) $fields = $this->fields_fld;if($where) $rwhere = " where $where ";if($orderby) $rorder = " ORDER BY $orderby ";if($limitmax) $limit = " LIMIT $limitstart,$limitmax ";if($limitstart) $limit = " LIMIT $limitstart ";$tbl = $this->tablename;return $this->db->querydata2("select $fields from $tbl $rwhere $rorder $limit");}public function selone($fields = null,$add = null){if($fields == null) $fields = $this->fields_fld;$tbl = $this->tablename;return $this->db->querydatafirst2("select $fields from $tbl $add");}public function get($fields = null,$add = null){if($fields == null) $fields = $this->fields_fld;$tbl = $this->tablename;$d = $this->db->querydatafirst("select $fields from $tbl $add");return $d[0];}	public function del($ind){$tbl = $this->tablename;$this->db->del($tbl,"ind='$ind'");}public function delex($key,$value){if($key){$tbl = $this->tablename;$this->db->del($tbl,"$key='$value'");}
}public function ins($data){$tbl = $this->tablename;$d2 = $this->isfieldset($data);$this->db->ins_data($tbl,$d2);}public function modify($data,$ind){if($ind){
$d2 = $this->isfieldset($data);$tbl = $this->tablename;$this->db->update_data($tbl,$d2,"ind='$ind'");}}public function modifyex($data,$key,$value){if($key){$d2 = $this->isfieldset($data);$tbl = $this->tablename;$this->db->update_data($tbl,$d2,"$key='$value'");}}	};

class tagview {
public $strtail;
public function setstring($strtop,$strtail){
$this->strtail = $strtail;
echo($strtop);
}
function __construct($strtop=null,$strtail=null){
if($strtop != null) $this->setstring($strtop,$strtail);
}
function __destruct() {
echo($this->strtail);
}
};
class debug_ticker {
public $time;
public $disp;
public $show;
public function getTickTimer(){
return (round(microtime(true)*1000))/1000;
}
public function addTicker($name){
$ticker[name] = $name;
$ticker[stime] = $this->getTickTimer();
$ticker[rtick] = -1;
$this->time[] = $ticker;
}
public function finTicker($name){
$endtime = $this->getTickTimer();
$nsz = count($this->time);
for($i = 0; $i<$nsz; $i++){
$d = $this->time[$i];
if($d[name] == $name){
$rtick = $endtime - $d[stime];
$this->time[$i][etick] = $endtime;
$this->time[$i][rtick] = $rtick;}}}function __construct($disp){$this->addTicker("init");$this->disp = $disp;$this->show = 1;}function show($s){$this->show = $s;}function __destruct() {if($sd == 0) return;$endtime =$this->getTickTimer();$nsz = count($this->time);for($i = 0; $i<$nsz; $i++){$d = $this->time[$i];if($d[rtick]!=-1) {$rtick = $d[rtick];}else{$rtick = $endtime - $d[stime]; }trace("debug_ticker : $d[name] ($rtick)sec",$this->disp);}}};function gethtmlfile($filename){$fd = fopen ($filename, "r");$contents = fread ($fd, filesize($filename));fclose ($fd); return $contents;}function GetGUID($ucode){return md5(microtime(true).$ucode); }function trace($val,$mode=0){if(DEBUG){echo("<!--[TRACE / *********** ] ");print_r($val); echo(" -->\n"); if($mode==1) print_r($val);}}function xml2array($contents, $get_attributes = 1, $priority = 'tag'){$parser = xml_parser_create('');xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);xml_parse_into_struct($parser, trim($contents), $xml_values);
xml_parser_free($parser);if (!$xml_values)return; $xml_array = array ();$parents = array ();$opened_tags = array ();
$arr = array ();$current = & $xml_array;$repeated_tag_index = array ();foreach ($xml_values as $data){
unset ($attributes, $value);extract($data);unset($result);$attributes_data = array ();
if (isset ($value)){if ($priority == 'tag')$result = $value;else$result['value'] = $value;}if (isset ($attributes) and $get_attributes){
foreach ($attributes as $attr => $val){if ($priority == 'tag')$attributes_data[$attr] = $val;
else$result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
}}if ($type == "open") {$parent[$level -1] = & $current;
if (!is_array($current) or (!in_array($tag, array_keys($current)))){
$current[$tag] = $result;if ($attributes_data)
$current[$tag . '_attr'] = $attributes_data;$repeated_tag_index[$tag . '_' . $level] = 1;$current = & $current[$tag];}else{if (isset ($current[$tag][0])){
$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
$repeated_tag_index[$tag . '_' . $level]++;
}else{$current[$tag] = array ($current[$tag],$result);
$repeated_tag_index[$tag . '_' . $level] = 2;
if (isset ($current[$tag . '_attr']))                    {
$current[$tag]['0_attr'] = $current[$tag . '_attr'];
unset ($current[$tag . '_attr']);}}$last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
$current = & $current[$tag][$last_item_index];
}}elseif ($type == "complete"){if (!isset ($current[$tag])){$current[$tag] = $result;$repeated_tag_index[$tag . '_' . $level] = 1;
if ($priority == 'tag' and $attributes_data)$current[$tag . '_attr'] = $attributes_data;}else {if (isset ($current[$tag][0]) and is_array($current[$tag])){
$current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
if ($priority == 'tag' and $get_attributes and $attributes_data){
$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
}$repeated_tag_index[$tag . '_' . $level]++;}else{$current[$tag] = array ($current[$tag],$result);
$repeated_tag_index[$tag . '_' . $level] = 1;if ($priority == 'tag' and $get_attributes){if (isset ($current[$tag . '_attr'])){
$current[$tag]['0_attr'] = $current[$tag . '_attr'];
unset ($current[$tag . '_attr']);}if ($attributes_data){$current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
}}$repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
}}}elseif ($type == 'close'){$current = & $parent[$level -1];}}return ($xml_array);}
?>
