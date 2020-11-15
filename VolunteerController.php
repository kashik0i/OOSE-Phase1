<?php
require_once "VolunteerView.php";
require_once "VolunteerModel.php";







$update=false;
if(isset($_REQUEST["id"]))
{
    $volunteerObj= new Volunteer($_REQUEST["id"]);
    if (isset($_REQUEST["Update"])) {
        #$volunteerObj = new Volunteer($_REQUEST["id"]);
        $update=true;
    }
    else if(isset($_REQUEST["SubmitUpdate"]))
    {
        #$volunteerObj = new Volunteer($_REQUEST["id"]);
        $result=$volunteerObj->Update_Volunteer($_POST);
        if ($result == 1) {
            echo "Record has been updated successfully\n";
        }
        $volunteerObj = new Volunteer($_REQUEST["id"]);
        //echo var_dump($_POST);
    }
    else if(isset($_REQUEST["Next"]))
    {
        $Next = Volunteer::Next($_REQUEST["id"]);
        if($Next!=null)
        $volunteerObj= $Next;
    } 
    else if (isset($_REQUEST["Previous"])) 
    {
        $Prev = Volunteer::Previous($_REQUEST["id"]);
        if ($Prev != null)
            $volunteerObj = $Prev;
    }
}
else{
    $volunteerObj = new Volunteer(2);
}
$viewRef = new VolunteerView();
$viewRef->Show_AllVolunteers();
$viewRef->Show_VolunteerDetails($volunteerObj);
if($update)$viewRef->Show_VolunteerUpdateForm($volunteerObj);

#$viewRef->attach_xhr();

?>