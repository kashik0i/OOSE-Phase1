<?php

#use function PHPSTORM_META\type;

require_once "VolunteerModel.php";
require_once "CampaignModel.php";
require_once "My_DB.php";



class Volunteer
{
    public $Id;
    public $FirstName;
    public $LastName;
    public $Address;
    public $PreviousCampaigns=array();

    public function __construct($id)
    {
        $db=DbConnection::getInstance();
        
        if ($id !="") {
            $sql = "SELECT * FROM volunteer where Volunteer_Id=$id";
            #$VolunteerDataSet = mysqli_query($sql) or die(mysqli_error();
            #require "My_DB.php";
            $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
            if ($result->num_rows>0)
            {
                $row = $result->fetch_assoc();
                $this->Id=$row["Volunteer_Id"];
                $this->FirstName=$row["First_Name"];
                $this->LastName= $row["Last_Name"];
                $this->Address= $row["Address"];
                #stores id of campaign and volunteer and acts as a lookup table
                #Campaign->CampaignVolunteer<-Volunteer

                $sql = "SELECT Campaign_Id FROM campaign_Volunteer where Volunteer_Id=$id";
                $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
                if ($result->num_rows > 0) 
                {
                    for($i=0;$row1= $result->fetch_assoc();$i++)
                    {
                        #echo $row1["Campaign_Id"]."\t";
                        $this->PreviousCampaigns[$i]=new Campaign($row1["Campaign_Id"]);
                        
                    }
                    #echo "<br>";
                    #echo("<pre>".var_dump($this->PreviousCampaigns)."</pre>");
                }
            }
        }
    }

    public static function Select_AllVolunteersInDb()
    {
        $db=DbConnection::getInstance();
        $sql= "SELECT Volunteer_Id FROM volunteer ORDER BY First_Name";
        $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
        $Allvolunteers=array();
        if ($result->num_rows > 0) 
        {
             
            for ($i = 0; $row2 = $result->fetch_assoc(); $i++)
            {
                $Allvolunteers[$i]=new Volunteer($row2['Volunteer_Id']);
            }
           
        }
        return $Allvolunteers;
    }
    public function Update_Volunteer(array $post)
    {
        $db = DbConnection::getInstance();
        
        if(isset($post))
        {
            $changed=false;
            $sql="UPDATE volunteer SET ";
            if($post['FirstName']!="")
            {
                $this->FirstName= $post['FirstName'];
                $sql.= " First_Name='$this->FirstName'";
                $changed=true;
            }
            if($post['LastName']!="")
            {
                $this->LastName = $post['LastName'];
                if($changed) $sql.=",";
                $sql .= " Last_Name='$this->LastName'";
                $changed = true;
            }

            if($post['Address']!="")
            {

                $this->Address = $post['Address'];
                if ($changed) $sql .= ",";
                $sql .= " Address='$this->Address'";
            }
            $sql.=" WHERE Volunteer_Id=$this->Id";
            #echo $sql;
            $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
            return $result;
        }
    }
    public static function Next($Id)
    {
        $db = DbConnection::getInstance();
        if (isset($Id)) 
        {
            $sql = "SELECT * FROM volunteer WHERE Volunteer_Id>$Id ORDER BY Volunteer_Id LIMIT 1";
            $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
            $row= $result->fetch_assoc();
            #echo var_dump(($row));
            if($result->num_rows>0) return new Volunteer($row["Volunteer_Id"]);
            else return null;
            #else return new Volunteer(1);
        }
    }
    public static function Previous($Id)
    {
        $db = DbConnection::getInstance();
        if (isset($Id)) {
            $sql = "SELECT * FROM volunteer WHERE Volunteer_Id<$Id ORDER BY Volunteer_Id LIMIT 1";
            $result = mysqli_query($db->getConn(), $sql) or die(mysqli_error($db->getConn()));
            $row = $result->fetch_assoc();
            #echo var_dump(($row));
            if ($result->num_rows > 0) return new Volunteer($row["Volunteer_Id"]);
            else return null;
            #else return new Volunteer(1);
        }
    }
}
