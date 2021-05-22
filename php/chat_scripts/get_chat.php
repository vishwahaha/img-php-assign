<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    function get_chat($from_user_id, $to_user_id, $connect){
        $query = "SELECT * FROM vishwa_chat WHERE (from_user = ? AND to_user = ?) OR (from_user = ? AND to_user = ?) ORDER BY sent_on DESC";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssss", $from_user_id, $to_user_id, $to_user_id, $from_user_id);
        if($stmt->execute()){
            $res = $stmt->get_result();
            $result = $res->fetch_all(MYSQLI_ASSOC);
            $output = '';
            foreach($result as $row){
                if($row["from_user"] == $from_user_id){
                    $output .= '<div class="to-msg message-card"><div class="card-body">'.$row["msg"].'</div></div>';
                }
                elseif($row["from_user"] == $to_user_id){
                    $output .= '<div class="from-msg message-card"><div class="card-body">'.$row["msg"].'</div></div>';
                }
            }
            return $output;
        }
    }
?>