
<link rel="stylesheet" href="css/listFriend.css">

<div class="right-content">
    <?php 
        if(!defined('ARRAYFRIEND')) {
            $friends_id = db_getFriends($_SESSION['connected']);
            $onclickfct = 'submitFormProfilLink';
        }
        if(is_string($friends_id[0])) {
            for($j = 0; $j <count($friends_id); $j++) {
                $friends_id[$j] = array($friends_id[$j]);
            } 
        }
    ?>
    <div id="list_friend" class="close-friends">
        <?php  
            if(defined('ARRAYFRIEND') && !defined('CONVERSIONABLE') && isset($vieweduser_id)) {
                ?><b><?=$vieweduserData[0]?>'s Friends</b><?php 
            } else {
                ?><b>Your Friends</b><?php 
            }
       
            for ($i=0; $i < count($friends_id); $i++) { 
                $friendData = db_getUserData($friends_id[$i][0]);
        ?>
        <!-- FRIEND LISTE -->
        <div class="close-f friends_list  
            <?php  
            $compteurform;
            if(!defined('SELECTEDFRIEND')) {
                if($i==0){ echo 'selected_friends'; }
                } else if($friendData[0] == $last_communicate_friend[0]) { echo 'selected_friends'; }
            ?>"
            id="user<?=$i?>" <?php if(!defined('CONVERSIONABLE')) {  ?>onclick='<?php echo $onclickfct ?>(<?=$i?>);'<?php ; } ?>
        >  
            <div class="friend-profil-link"  onclick='<?php echo $onclickfct ?>(<?=$i?>);'>
                <img src="<?= $friendData[9] ?>" <?php if( $onclickfct == 'selectDiscussion'){echo "onclick = 'submitFormProfilLink($i)'";}?>>
                <div>
                     <p id="pseudo-close-f-display<?=$i?>" class="userName<?=$i?>"><?= $friendData[0] ?></p>
                </div>
                <form id="form-profil-link<?=$i?>" method="GET" action="<?= PROFIL ?>">
                    <input type="hidden" name="user" id="user<?=$i?>" value="<?= $friendData[0] ?>">
                </form>
            </div>
            <?php  if(defined('CONVERSIONABLE')) { ?>
            <div class="close-message">
                <ion-icon name="paper-plane" onclick = 'submitFormConvLink(<?=$i?>)'>
                    <form id="form-conversation-link<?=$i?>" method="GET" action="<?= CONVERSATION ?>">
                        <input type="hidden" name="user_conv" value="<?= $friendData[0] ?>">
                    </form>
                </ion-icon>
            </div>
            <?php } ?>
            <?php  if(defined('TRASHABLE')) { ?>
            <div class="close-message">
                <ion-icon name="trash" onclick="delete_friend()"></ion-icon>
            </div>
            <?php }  ?>
        </div>
        <?php $compteurform = $i; } ?>
        <!-- FRIEND REQUEST -->
        <?php if(defined('CONVERSIONABLE')) { ?>
        <b>Friend Requests</b>
        <div id="div_friend_requests" class="close-friends">
            <?php 
                $friend_requests = db_getFriendRequest($_SESSION['connected']);
                for ($i=0; $i < count($friend_requests) ; $i++) {
                    $compteurform++;
                    $friendReqData = db_getUserData($friend_requests[$i][0]);
                    ?>
                        <div class="close-f friend-profil-link" onclick="submitFormProfilLink(<?=$compteurform?>)">
                            <img src='<?= $friendReqData[9]?>'></img>
                            <span id='friend_req<?= $friendReqData[0]?>'><?= $friendReqData[0]?></span>
                            <ion-icon name="checkmark"></ion-icon>
                        </div>
                        <form id="form-profil-link<?=$compteurform?>" method="GET" action="<?= PROFIL ?>">
                            <input type="hidden" name="user" id="user<?=$i?>" value="<?= $friendReqData[0] ?>">
                        </form>
                    <?php
                }
            ?>
        </div>
    <?php } ?>
    </div>
    
   
</div>
