
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include("./common/header.php"); ?>
<style><?php include ("./common/css/Site.css");

 ?></style>
<?php
//Restaurant Name listing
$message = "";
if (isset($_POST["semester"])) {
    $error="";
    $semester = $_POST["semester"];
    $_POST["semester"]=$semester;
}
//accessing xml file
$RestaurantReviews = simplexml_load_file('restaurant_review.xml');
$Restaurant = $RestaurantReviews->Restaurant;
//saving changed values to xml
if (isset($_POST['submitreview'])) {
    $Restaurant[$semester-1]->Address->StreetName = $_POST["streetaddress"];
    $Restaurant[$semester-1]->Address->City = $_POST["city"];
    $Restaurant[$semester-1]->Address->Province = $_POST["province"];
    $Restaurant[$semester-1]->Address->PostalCode = $_POST["postalcode"];
    $Restaurant[$semester-1]->Address->Rating = $_POST["streetaddress"];
    $Restaurant[$semester-1]->Summary = $_POST["summary"];
    $Restaurant[$semester-1]->Rating = $_POST["rating"];
    $RestaurantReviews->asXML('restaurant_review.xml');
    $message="Revised Restaurant has been saved to: restaurant_review.xml";
}
?>
<div class="container">
    
    <h1 style="text-align: center">Online Restaurant Review</h1>
    <div class="container">
        <form method="POST" action="">
            <div class="container">
                <p>Select a restaurant from the drop down list to view/edit its review </p>               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Restaurant:</label>
                    <div class="col-sm-4">
                        <!--dropdownlist -->
                       <select name="semester" onchange="this.form.submit()" class='form-control'>
                    <?php
                    print(empty($semester) ? "<option value='select'>Select</option>"  :  "<option value='" . $semester . "'>" . $Restaurant[$semester-1]->Name . "</option>");                      
                    foreach ($Restaurant as $restaurant)
                               {   
                                   $Restaurant_Name = $restaurant->Name;
                                   $Restaurant_Id = $restaurant->Id;
                                 echo "<option value='".$restaurant->Id."'>" . $restaurant->Name . "</option>";
                               }                                
                               ?>                                                       
                        </select> 
                    </div>   
                </div>
                <?php 
                if (!empty($semester))
                {
                 $Address= $Restaurant[$semester-1]->Address;
                 $Street_Name=$Address->StreetName;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">Street Address:</label>';
                 echo '<div class="col-sm-4">';
                 echo "<input type='text' class='form-control' value='".$Street_Name."' name='streetaddress'/></div>";
                 echo '</div>';
                 $City=$Address->City;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">City:</label>';
                 echo '<div class="col-sm-4">';
                 echo "<input type='text' class='form-control' value='".$City."' name='city'/></div>";
                 echo '</div>';
                 $Province=$Address->Province;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">Province/State:</label>';
                 echo '<div class="col-sm-4">';
                 echo "<input type='text' class='form-control' value='".$Province."' name='province'/></div>";
                 echo '</div>';
                 $PostalCode=$Address->PostalCode;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">Postal/Zip Code:</label>';
                 echo '<div class="col-sm-4">';
                 echo "<input type='text' class='form-control' value='".$PostalCode."' name='postalcode'/></div>";
                 echo '</div>';
                 $Summary=$Restaurant[$semester-1]->Summary;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">Summary:</label>';
                 echo '<div class="col-sm-4">';
                 echo "<textarea id='summary' class='form-control' name='summary' rows='4' cols='26'>$Summary</textarea></div>";
                 echo '</div>';
                 $Rating=$Restaurant[$semester-1]->Rating;
                 echo '<div class="form-group row">';       
                 echo '<label class="col-sm-2 col-form-label">Rating:</label>';
                 echo '<div class="col-sm-4">';
                 echo '<select name="rating" class="form-control">
                        <option value="'.$Rating.'">'.$Rating.'</option>'
                         . '<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>';
                 //echo "<input type='text' class='form-control' value='".$Rating."' name='rating'/></div>";
                 echo '</div>';
                 echo '<br />';
                 echo '<div class="form-group row">';   
                 echo '<label class="col-sm-2 col-form-label"></label>';
                 echo '<div class="col-sm-4">';
                 echo '<button type="submit" name="submitreview" style="Text-align:right">Save Changes</button></div>';
                 echo '</div>';
                 echo '<br />';
                 if($message!="")
                 {
                 echo '<div class="alert">'.$message.'</div>';
                 }
                }
                ?>
            </div>
    </form>
        
</div>
</div>

    <?php include('./common/footer.php'); ?>