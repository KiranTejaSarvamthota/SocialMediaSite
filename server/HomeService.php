<?php
require_once "connect.php";
include "homeSql.php";
//session_start();
class HomeWebService{
   

 function __construct() {
    $database_connection = new DatabaseConnection();
    $this->conn = $database_connection->getConnection();
 }


//kiran

    public function getDirectMessages($chatId,$userId){
        $sql_service = new HomeSqlService();
        $getDirectMessages = $sql_service->getDirectMessages($chatId,$userId);

        $result = $this->conn->query($getDirectMessages);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $directMessages['directMessages'][] = $row;
                $directMessages['userType'] = $_SESSION['userType'];
            }
        }else{
            $directMessages['directMessages'] = "No Messages";
            
        }
        $this->conn->close();
        return $directMessages;
    }

//kiran


    public function postMessagesd($post_message,$chatId,$userId){
        $sql_service = new HomeSqlService();
        $postMessagesd = $sql_service->postMessagesd($post_message,$chatId,$userId);

        $result = $this->conn->query($postMessagesd);
        if($result === TRUE){
            $getDirectMessages = $sql_service->getDirectMessages($chatId,$userId);

            $result = $this->conn->query($getDirectMessages);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $directMessages['directMessages'][] = $row;
                    $directMessages['userType'] = $_SESSION['userType'];
                    $directMessages['chatId'] = $_SESSION['chat_id'];

                }
            }else{
                $directMessages['directMessages'] = "No Messages";
                return 'fail messages';
            }
        }else{
            //$post_message['postMessages'][] = "Messages not posted";
            return 'fail messages';
        }
        $this->conn->close();
        $directMessages['userType'] = $_SESSION['userType'];
        $directMessages['displayName'] = $_SESSION['displayName'];
        return $directMessages;
    }


    //kiran

    public function getuserslistd($userId){
        $sql_service = new HomeSqlService();
        $getuserslistd = $sql_service->getuserslistd($userId);
        $result = $this->conn->query($getuserslistd);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $users['users'][] = $row;
            }

        }else{
            $users['users'][] = "No Users Found";
        }
        $this->conn->close();
        return $users;
    }

    public function getGravatar($grav_url,$email){
        // die(json_encode($_SESSION));
        $sql_service = new HomeSqlService();
       
        $getGravatar = $sql_service->getGravatar($grav_url,$email);
        $result = $this->conn->query($getGravatar);
         
        $this->conn->close();
        return $result;   
    }

    public function getGroups($userID,$usertype){
        // die(json_encode($_SESSION));
        $sql_service = new HomeSqlService();
        if($usertype==1){
        $getGroupList = $sql_service->getAllGroupsDetails();
        }else{
        $getGroupList = $sql_service->getGroupsDetails($userID,$usertype);
        // echo $getUserDetails;
        }
        $result = $this->conn->query($getGroupList);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $groups['groups'][] = $row;
                $groups['displayName'] = $_SESSION['displayName'];
                $groups['userType'] = $_SESSION['userType'];
                
             }
        } 
        else {
            $groups['displayName'] = $_SESSION['displayName'];
            $groups['groups']='No Groups';
            
        }
        
        
        $this->conn->close();
        return $groups;   
    }

    public function getGroupMessages($groupId){
        $sql_service = new HomeSqlService();
        $getGroupMessages = $sql_service->getGroupMessages($groupId);

        $result = $this->conn->query($getGroupMessages);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $groupMessages['groupMessages'][] = $row;
                $groupMessages['userType'] = $_SESSION['userType'];
            }
        }else{
            $groupMessages['groupMessages'] = "No Messages";
            
        }
        $this->conn->close();
        return $groupMessages;
    }

    public function postMessages($post_message,$groupId,$userId){
        $sql_service = new HomeSqlService();
        $postMessages = $sql_service->postMessages($post_message,$groupId,$userId);

        $result = $this->conn->query($postMessages);
        if($result === TRUE){
            $getGroupMessages = $sql_service->getGroupMessages($groupId);

            $result = $this->conn->query($getGroupMessages);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $groupMessages['groupMessages'][] = $row;
                    $groupMessages['userType'] = $_SESSION['userType'];
                    $groupMessages['groupId'] = $_SESSION['group_id'];

                }
            }else{
                $groupMessages['groupMessages'] = "No Messages";
                return 'fail messages';
            }
        }else{
            //$post_message['postMessages'][] = "Messages not posted";
            return 'fail messages';
        }
        $this->conn->close();
        $groupMessages['userType'] = $_SESSION['userType'];
        $groupMessages['displayName'] = $_SESSION['displayName'];
        return $groupMessages;
    }



    public function postMessageswithCode($post_message,$groupId,$userId,$codetext){
        $sql_service = new HomeSqlService();
        $postMessages = $sql_service->postMessageswithCode($post_message,$groupId,$userId,$codetext);

        $result = $this->conn->query($postMessages);
        if($result === TRUE){
            $getGroupMessages = $sql_service->getGroupMessages($groupId);

            $result = $this->conn->query($getGroupMessages);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $groupMessages['groupMessages'][] = $row;
                    $groupMessages['userType'] = $_SESSION['userType'];
                    $groupMessages['groupId'] = $_SESSION['group_id'];

                }
            }else{
                $groupMessages['groupMessages'] = "No Messages";
                return 'fail messages';
            }
        }else{
            //$post_message['postMessages'][] = "Messages not posted";
            return 'fail messages';
        }
        $this->conn->close();
        $groupMessages['userType'] = $_SESSION['userType'];
        $groupMessages['displayName'] = $_SESSION['displayName'];
        return $groupMessages;
    }






    public function setReaction($reactions,$messageId,$userId,$likes,$dislikes){
        $sql_service = new HomeSqlService();
            $likedisLikeCount = $sql_service->setLikeDisLikeCount($messageId,$likes,$dislikes);
            $result_likeCount = $this->conn->query($likedisLikeCount);
        
        $post_reaction = $sql_service->setReactions($reactions,$messageId,$userId);
        $result = $this->conn->query($post_reaction);
        if($result === TRUE){
            return $reactions;
        }else{
            return "fail";
        }
        $this->conn->close();
    }

    public function getReaction($groupId,$userId){
        $sql_service = new HomeSqlService();
        $get_reactions = $sql_service->getReactions($groupId,$userId);
        $result = $this->conn->query($get_reactions);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reactions['reactions'][] = $row;
            }
        } 
        else {
            $reactions['reactions']='No reactions';
            //return 'fail groups';
        }

        $this->conn->close();
        return $reactions;

    }

    public function getComments($groupId){
        $sql_service = new HomeSqlService();
        $get_comments = $sql_service->getComments($groupId);
        $result = $this->conn->query($get_comments);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $comments['comments'][] = $row;
            }
        }else{
            $comments['comments'][] = "No comments";
        }

        $this->conn->close();
        return $comments;
    }

    public function postComments($userId,$messageId,$comment,$groupId){
        $sql_service = new HomeSqlService();
        $post_comments = $sql_service->postComments($userId,$messageId,$comment);
        $result = $this->conn->query($post_comments);
        if($result === TRUE){
            $get_comments = $sql_service->getComments($groupId);
        $result = $this->conn->query($get_comments);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $comments['comments'][] = $row;
                $comments['groupId'] = $groupId;
            }
        }else{
            $comments['comments'][] = "No comments";
        }

        }else{
            //$post_message['postMessages'][] = "Messages not posted";
            return 'fail messages'.$post_comments;
        }
        $this->conn->close();
        return $comments;
    }

    public function getuserslist(){
        $sql_service = new HomeSqlService();
        $getuserslist = $sql_service->getuserslist();
        $result = $this->conn->query($getuserslist);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $users['users'][] = $row;
            }

        }else{
            $users['users'][] = "No Users Found";
        }
        $this->conn->close();
        return $users;
    }

    public function getUsersDetails($user_id){
        $sql_service = new HomeSqlService();
        $getUsersDetails = $sql_service->getUsersDetails($user_id);
        $getNumberofMessages = $sql_service->getNumberofMessages($user_id);
        $result_number = $this->conn->query($getNumberofMessages);
        $result = $this->conn->query($getUsersDetails);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                
                $userDetails['userDetails'][] = $row;
                }
            

        }else{
            $userDetails['userDetails'][] = "No Users Found";
        }

        while($row_number = $result_number->fetch_assoc()){
            $userDetails['getNumberofMessages'][] = $row_number;
        }
        $this->conn->close();
        return $userDetails;

    }

    public function deleteMessage($delete_message){
        $sql_service = new HomeSqlService();
        $deleteMessage = $sql_service->deleteMessage($delete_message);
        $result = $this->conn->query($deleteMessage);
        if($result === TRUE){
            $delete = "deleted";
        }else{
            $delete = "not deleted";


        }
        return $delete;
    }

    public function getUsersForNewGroup($user_id){
        $sql_service = new HomeSqlService();
        $getUsersForNewGroup = $sql_service->getUsersForNewGroup($user_id);
        $result = $this->conn->query($getUsersForNewGroup);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $Newuserlist['newUsers'][] = $row;
            }

        }else{
            $Newuserlist['newUsers'][] = "No Users Found";
        }
        return $Newuserlist;
    }

    public function setArchive($archive_id,$archive_value){
        $sql_service = new HomeSqlService();
        $setArchive = $sql_service->setArchive($archive_id,$archive_value);
        $result = $this->conn->query($setArchive);
        if($result === TRUE){
            $archived = "archived";
        }else{
            $archived = "not archived";


        }
        return $archived;
    }

    public function getArchive($archive_id,$usertype){
        $sql_service = new HomeSqlService();
        $setArchive = $sql_service->getArchive($archive_id);
        $result = $this->conn->query($setArchive);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $archiveStatus['archive'][] = $row;
                $archiveStatus['usertype'] = $_SESSION['userType'];
            }

        }else{
            $archiveStatus['archive'][] = "No archives Found";
        }
        return $archiveStatus;
        
    }


    public function getSearchResults($search){
        $sql_service = new HomeSqlService();
        $getSearchResults = $sql_service->getSearchResults($search);
        $result = $this->conn->query($getSearchResults);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $searchResults['results'][] = $row;
                $searchResults['usertype'] = $_SESSION['userType'];
            }

        }else{
            $searchResults['results'][] = "No results Found";
        }
        return $searchResults;
    }

    public function getReactionCount($reactionCount){
        $sql_service = new HomeSqlService();
        $getReactionCount = $sql_service->getReactionCount($reactionCount);
        $result = $this->conn->query($getReactionCount);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $reactionCounts['reactionCount'][] = $row;
                $reactionCounts['usertype'] = $_SESSION['userType'];
            }

        }else{
            $reactionCounts['results'][] = "No results Found";
        }
        return $reactionCounts;
    }

    public function getNumberofUsers($numberOfUsers){
        $sql_service = new HomeSqlService();
        $getNumberofUsers = $sql_service->getNumberofUsers($numberOfUsers);
        $result = $this->conn->query($getNumberofUsers);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $getCount['usersCount'][] = $row;
                $getCount['usertype'] = $_SESSION['userType'];
            }
        }else{
            $getCount['usersCount'][] = "No results Found";
        }
        return $getCount;
    }

    public function deleteUsers($deleteUser){
        $sql_service = new HomeSqlService();
        $deleteUsers = $sql_service->deleteUsers($deleteUser);
        $result = $this->conn->query($deleteUsers);
        if($result === TRUE){
            $updatedUsers = "deleted";
        }else{
            $updatedUsers = "not deleted";


        }
        return $updatedUsers;
    }

    public function numberOfUsersFormetrics($deleteUser,$numberOfUsers){
        $sql_service = new HomeSqlService();
        $deleteUsers = $sql_service->numberOfUsersFormetrics($deleteUser,$numberOfUsers);
        $result = $this->conn->query($deleteUsers);
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $getCount['numberOfUsersFormetrics'][] = $row;
                $getCount['usertype'] = $_SESSION['userType'];
            }
        }else{
            $getCount['numberOfUsersFormetrics'][] = "No results Found";
        }
        return $getCount;
        
    }


  
}


