<?php
require_once "CampaignModel.php";
class CampaignView
{
    public function __construct()
    {
        #echo "1";
    }
    public function Show_AllCampaigns()
    {
        $Result = Campaign::Select_AllCampaignsInDb();
        for ($i = 0; $i < count($Result); $i++) {
            echo ("<a href=CampaignController.php?id=" . $Result[$i]->Id . ">" . $Result[$i]->Name  . "</a>\n");
        }
    }
    public function Show_CampaignDetails(Campaign $campaign)
    {
        echo "<table border=2><tr><td>Id</td><td>" . $campaign->Id . "</td></tr>";

        echo "<tr><td>Name</td><td>" . $campaign->Name . "</td></tr>";
        echo "<tr><td>Description</td><td>" . $campaign->Description . "</td></tr>";
        echo "<tr><td>CreationDate</td><td>" . $campaign->CreationDate . "</td></tr>";
        echo "<tr><td>TotalDonation</td><td>" . $campaign->TotalDonation . "</td></tr>";
        echo "<tr><td>Campaigns donations for</td><td>";
        for ($i = 0; $i < count($campaign->PreviousDonation); $i++) {
            echo "<a href=DonationController.php?id=" . $campaign->PreviousDonation[$i]->Id . ">" . $campaign->PreviousDonation[$i]->Id . "</a>";
        }
        echo "</td></tr></table>";
    }
}


?>