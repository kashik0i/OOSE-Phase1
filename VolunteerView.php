<?php

require_once 'VolunteerModel.php';
class VolunteerView
{
    public function __construct()
    {
        
    }
    public function Show_AllVolunteers()
    {
        $Result = Volunteer::Select_AllVolunteersInDb();
        echo "<table border=2><tr><td>Volunteers</td><td>";
        for ($i=0;$i<count($Result);$i++)
        {
            #VolunteerController.php?id=".$Result[$i]->Id
            echo("<a class='static' href='VolunteerController.php?id=".$Result[$i]->Id."' >".$Result[$i]->LastName."</a>\n");
            #echo("<button class='xhr ". $Result[$i]->Id."' id=".$Result[$i]->Id." >".$Result[$i]->LastName."</button>\n");
        }
        echo "</td></tr></table>";
    }
    public function Show_VolunteerUpdateForm(Volunteer $volunteer)
    {   echo "<form action='VolunteerController.php?id=$volunteer->Id&SubmitUpdate' method='post'>";
        $input="<input type='text' name=";
        echo "<table border=2><tr><td>Id</td><td>".$volunteer->Id."</td></tr>";

        echo "<tr><td>First Name</td><td>$input'FirstName'></td></tr>";
        echo "<tr><td>Last Name</td><td>$input'LastName'></td></tr>";
        echo "<tr><td>Address</td><td>$input'Address'></td></tr>";
        $input = "<input type='submit'>";
        echo "<tr><td>Submit</td><td>$input</td></tr></table></form>";
       
    }
    public function Show_VolunteerDetails(Volunteer $volunteer)
    {
        echo "<table border=2><tr><td>Id</td><td>$volunteer->Id</td></tr>";

        echo "<tr><td>First Name</td><td>".$volunteer->FirstName."</td></tr>";
        echo "<tr><td>Last Name</td><td>".$volunteer->LastName."</td></tr>";
        echo "<tr><td>Address</td><td>".$volunteer->Address."</td></tr>";
        echo "<tr><td>Campaigns Volunteered for</td><td>";
        
        for ($i=0;$i<count($volunteer->PreviousCampaigns);$i++)
        {
            echo "<a href=CampaignController.php?id=".$volunteer->PreviousCampaigns[$i]->Id.">".$volunteer->PreviousCampaigns[$i]->Name."</a>";
        }
        echo "</td></tr><tr><td>Options</td><td>
        <a href='VolunteerController.php?id=$volunteer->Id&Update'>Update</a>
        <a href='VolunteerController.php?Delete'>Delete</a>
        <a href='VolunteerController.php?Insert'>Insert</a>
        <a href='VolunteerController.php?id=$volunteer->Id&Previous'>Previous</a>
        <a href='VolunteerController.php?id=$volunteer->Id&Next'>Next</a></td></tr></table>";
    }
    public function attach_xhr()
    {
        echo "
        <script>
            var elements = document.getElementsByClassName('xhr');
            
            for(var i=0;i<elements.length;i++)
            {
                var lols='VolunteerController.php?id='+elements[i].classList[1];
                //console.log(lols);
                elements[i].setAttribute('onclick','Get_xhr(lols);');
            }
        </script>";
    }
}
