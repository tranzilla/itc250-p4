<?php
/**
 * survey_view.php along with demo_list.php provides a list/view application
 * 
 * @package nmListView
 * @author Ge Jin
 * @version 2.10 2018/02/28
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see index.php
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php';
 
if(isset($_GET['id']) && (int)$_GET['id'] > 0){
	 $myID = (int)$_GET['id'];
}else{
//	myRedirect(VIRTUAL_PATH . "demo/demo_list.php");
    header('Location: index.php');
}

$survey = new Survey($myID);
dumpDie($survey);

if($survey->IsValid)
{
	$config->titleTag = $survey->Title;
}

get_header(); #defaults to theme header or header_inc.php
if($survey->IsValid)
{
?>
	<h3 align="center"><?=$survey->Title;?></h3>
    <p><?=$survey->Description?></p>
<?php
}else{
    echo '<div align="center">What! No such survey? There must be a mistake!!</div>';
    echo '<div align="center"><a href="' . VIRTUAL_PATH . 'survey/index.php">View surveys</a></div>';
}
get_footer(); #defaults to theme footer or footer_inc.php

class Survey {
    public $SurveyID = 0;
    public $Title = "";
    public $Description = "";
    public $IsValid = false;
    public $Questions = array();
    
    public function __construct($id) {
        $this->SurveyID = (int)$id;
        $sql = "select Title,Description from sm18_surveys where surveyID = $this->SurveyID";
        $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
        if(mysqli_num_rows($result) > 0)
        {
               $this->IsValid = true;	
               while ($row = mysqli_fetch_assoc($result))
               {
                    $this->Title = dbOut($row['Title']);
                    $this->Description = dbOut($row['Description']);
               }
        }
        @mysqli_free_result($result);
        if($this->IsValid) {
            return false;
        }
        
        $sql = "select Question,QuestionID,Description from sm18_questions where surveyID = $this->SurveyID";
        $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result))
               {
                    $this->Questions[] = new Question($row['QuestionID'], dbOut($row['Question']), dbOut($row['Description']));
               }
        }
        @mysqli_free_result($result);
    }
}

class Question {
    public $QuestionID = 0;
    public $QuestionText = '';
    public $Description = '';
    
    public function __construct($QuestionID, $QuestionText, $Description) {
        $this->QuestionID = $QuestionID;
        $this->QuestionText = $QuestionText;
        $this->Description = $Description;
    }
    
    
}