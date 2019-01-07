<?php
/*ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);*/
class HomeSqlService{
    public $sql = "";

    //kiran

    public function getDirectMessages($chatId,$userId){
        $sql = "SELECT * FROM users INNER JOIN direct_messages ON direct_messages.user_id =users.user_id AND direct_messages.chatuser_id=$chatId$userId OR direct_messages.user_id =users.user_id AND direct_messages.chatuser_id=$userId$chatId ORDER BY `direct_messages`.`timestamp` DESC";

        return $sql;
    }

    //kiran

      public function getuserslistd($userId){
        $sql = "SELECT * FROM users where users.user_id<>'$userId'";
        return $sql;
    }

    public function postMessagesd($post_message,$chatId,$userId){
        $sql = "INSERT INTO `Web_Programming_2018_AS`.`direct_messages` (`chatuser_id`, `message`, `user_id`) VALUES ($chatId$userId, '$post_message', '$userId')";
        return $sql;
    }

    //kiran
    public function userGroups($user_id) {
        
        $sql = "INSERT INTO users_groups (user_id,group_id) VALUES ('$user_id','16')";       
    
    return $sql;
    }
    public function checkGitUser($email) {
        
        $sql = "SELECT * FROM users WHERE emailID = '$email'";       
    
    return $sql;
    }
    public function GitNewUser($email,$username,$git_image) {
        
        $sql = "INSERT INTO users (firstName,lastName,displayName, emailID, password,userimg) VALUES(' ',' ','$username', '$email', 'default','$git_image')";       
    
    return $sql;
    }
     public function getGravatar($grav_url,$email) {
        
        $sql = "UPDATE users SET userimg = '$grav_url' WHERE emailID = '$email'";       
    
    return $sql;
    }
    public function getGroupsDetails($userId,$usertype) {
        
        $sql = "SELECT * FROM users_groups INNER JOIN groups ON users_groups.user_id = $userId AND groups.group_id 
                 = users_groups.group_id";       
    
    return $sql;
    }

    public function getAllGroupsDetails() {
        
        $sql = "SELECT DISTINCT groups.group_name,groups.group_id FROM users_groups INNER JOIN groups ON  groups.group_id = users_groups.group_id";       
    
    return $sql;
    }



    public function getGroupMessages($groupId){
    	$sql = "SELECT * FROM users INNER JOIN group_messages ON group_messages.user_id =users.user_id AND group_messages.group_id=$groupId ORDER BY `group_messages`.`timestamp`  DESC";
    	return $sql;
    }

    public function postMessages($post_message,$groupId,$userId){
    	$sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages` (`group_id`, `messages`, `user_id`) VALUES ('$groupId', '$post_message', '$userId')";
    	return $sql;
    }

    public function postMessageswithCode($post_message,$groupId,$userId,$textorcode){
        $sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages` (`group_id`, `messages`, `user_id`,`codeText`) VALUES ('$groupId', '$post_message', '$userId','$textorcode')";
        return $sql;
    }

    public function setReactions($reactions,$messageId,$userId){
    	$sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages_reactions` (`message_id`, `user_id`, `reaction`) VALUES ('$messageId', '$userId', '$reactions');";
    	return $sql;
    }

    public function getReactions($groupId,$userId){
    	$sql = "SELECT * FROM `group_messages`, group_messages_reactions where group_messages.message_id = group_messages_reactions.message_id AND group_messages.group_id=$groupId AND group_messages_reactions.user_id=$userId  ORDER BY `group_messages_reactions`.`reactions_timestamp` DESC LIMIT 1";
    	return $sql;
    }

    public function getComments($groupId){
    	$sql = "SELECT * FROM `comments_messages`INNER JOIN `group_messages` ON comments_messages.message_id = group_messages.message_id AND group_messages.group_id = $groupId INNER JOIN users ON users.user_id = comments_messages.user_id";
    	return $sql;
    }

    public function postComments($userId,$messageId,$comment){
        $sql = "INSERT INTO `Web_Programming_2018_AS`.`comments_messages` (`message_id`, `user_id`, `comment_message`) VALUES ('$messageId', '$userId', '$comment')";
        return $sql;
    }

    public function getuserslist(){
        $sql = "SELECT * FROM users";
        return $sql;
    }

    public function getUsersDetails($user_id){
        $sql = "SELECT * FROM `users_groups` INNER JOIN `users` ON users_groups.user_id = '$user_id' AND users.user_id = '$user_id' INNER JOIN groups ON users_groups.group_id = groups.group_id AND groups.grp_type='public' ";
        return $sql;
    }

    public function deleteMessage($deleteMessage){
        $sql = "DELETE FROM group_messages WHERE message_id='$deleteMessage'";
        return $sql;
    }

    public function getUsersForNewGroup($user_id){
        $sql = "SELECT * FROM users where user_id <> '$user_id'";
        return $sql;
    }

    public function setArchive($archive_id,$archive_value){
        $sql = "UPDATE `Web_Programming_2018_AS`.`groups` SET `archived_status` = '$archive_value' WHERE `groups`.`group_id` = $archive_id;";
        return $sql;
    }

    public function getArchive($archive_id){
        $sql = "SELECT * FROM `groups` WHERE group_id='$archive_id'";
        return $sql;
    }

    public function getSearchResults($search)
    {
        $sql = "SELECT * FROM  users WHERE displayName LIKE '%".$search."%' ";
        return $sql;
    }

    public function setLikedisLikeCount($message_id,$likes,$dislikes)
    {

        
            $sql = "UPDATE group_messages SET likeCount = '$likes',dislikeCount = '$dislikes' WHERE message_id = '$message_id'";
        /*}else if($reactions =="-1"){
            $sql = "UPDATE group_messages SET likeCount = likeCount - 1 WHERE message_id = '$message_id'";

        }else if($reactions =="2"){
            $sql = "UPDATE group_messages SET dislikeCount = dislikeCount + 1,likeCount = likeCount - 1 WHERE message_id = '$message_id'";

        }else if($reactions =="-2"){
            $sql = "UPDATE group_messages SET dislikeCount = dislikeCount - 1 WHERE message_id = '$message_id'";

        }*/
        return $sql;
    }


    public function getReactionCount($reactionCount)
    {
        $sql = "SELECT * FROM group_messages WHERE message_id = $reactionCount";
        return $sql;
    }
    
    public function getNumberofMessages($user_id)
    {
        $sql = "SELECT group_id,COUNT(*) as count FROM group_messages WHERE user_id = '$user_id' GROUP BY group_id ORDER BY count DESC";
        return $sql;
    }

    public function getNumberofUsers($numberofUsers)
    {
        $sql = "SELECT * FROM `users_groups`, users where users_groups.group_id='$numberofUsers' and users.user_id = users_groups.user_id";
        return $sql;
    }

    public function deleteUsers($deleteUsers)
    {
        $sql = "DELETE FROM users_groups WHERE user_id='$deleteUsers'";
        return $sql;
    }

    public function numberOfUsersFormetrics($deleteUser,$numberOfUsers)
    {
        $sql = "SELECT * FROM `group_messages` where group_id=$deleteUser and user_id=$numberOfUsers";
        return $sql;
    }




}
?>