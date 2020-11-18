<?
function write_code($time_key){
    $time[0] = substr($time_key, 0, 5);
    $time[1] = substr($time_key, 5, 9);
    if(substr($time_key, 9, 1) == 0){$last_key = 5;}
    else{$last_key = substr($time_key, 9, 1);}
    
    //각 배열에 넣는다.
    for($i=0 ; $i <= 1 ; $i++){
        for($sub_i=0 ; $sub_i <= 4 ; $sub_i++){
            $array_time[$i][$sub_i] = substr($time[$i], $sub_i,1);
        }
        //각 배열의 중복 제거
        $array_time[$i] = array_unique($array_time[$i]); // 큰값 원하면 안해두 된다
        //각 배열의 합 * $time_key 의 마지막 값
        $array_time[$i] = array_sum($array_time[$i]) * $last_key;
    }
    $array_time[2] = max($array_time[0],$array_time[1]);
    $array_time[3] = min($array_time[0],$array_time[1]);
/*    // 맨 마지막 수 홀수 ,짝수로 큰수를 구할지 작은수를 구할지 결정
    if($last_key % 2 == 1){ //홀수라면
        $array_time[4] = 1; // 작은값을 구해라 옵션
        $array_time[5] = "작은값은?"; //한글텍스트문장
        $array_time[6] = $array_time[3]; //정답
    }
    else{
        $array_time[4] = 2; // 큰값을 구해라 옵션
        $array_time[5] = "큰값은?"; //한글텍스트문장
        $array_time[6] = $array_time[2]; //정갑
    }
*/
    return $array_time;
}
?>