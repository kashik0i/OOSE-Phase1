<?php
require_once "CampaignView.php";
require_once "CampaignModel.php";

$viewRef= new CampaignView();
#if(isset($viewRef))
#echo var_dump(($viewRef));
$viewRef->Show_AllCampaigns();






if(isset($_REQUEST["id"])){
    #echo $_REQUEST["id"];
    $campaignObj= new Campaign($_REQUEST["id"]);
    # echo var_dump($campaignObj);
}
else{
    $campaignObj = new Campaign(2);
}
$viewRef->Show_CampaignDetails($campaignObj);
?>