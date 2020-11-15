<?php
require_once "My_DB.php";
require_once "DonationModel.php";
class Campaign
{
    public $Id;
    public $Name;
    public $CreationDate;
    public $Description;
    public $TotalDonation;
    public $PreviousDonation=array();
    
    public function __construct($id)
    {
        #echo "1111111111111111111111";
        $db=DbConnection::getInstance();
        
        $sql = "SELECT * from campaign WHERE Campaign_Id=$id";
        $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $this->Id = $row["Campaign_Id"];
            $this->Description = $row["Description"];
            $this->CreationDate = $row["Creation_Date"];
            $this->TotalDonation = $row["Total_Donation"];
            $this->Name = $row["Name"];
            #echo "<script>console.log('hello')</script>";
            # Campaign->CampaignDonation<-Donation {Id}{Campaign_Id}{Donation_Id}
            $sql = "SELECT Donation_Id from campaign_Donation WHERE Campaign_Id=$id";
            $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
            if ($result->num_rows > 0) 
            {
                for ($i=0;$row=$result->fetch_assoc();$i++) 
                {
                    $PreviousDonation[$i]=new Donation($row["Donation_Id"]);
                }
            }
        }
    }
    public static function Select_AllCampaignsInDb()
    {
    
        $db = DbConnection::getInstance();
        $sql = "SELECT * FROM campaign ORDER BY Creation_date";
        $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
        $AllCampainns = array();
        if ($result->num_rows > 0) {

            for ($i = 0; $row2 = $result->fetch_assoc(); $i++) {
                $AllCampainns[$i] = new Campaign($row2['Campaign_Id']);
            }
        }
        return $AllCampainns;
    
    }
}


?>