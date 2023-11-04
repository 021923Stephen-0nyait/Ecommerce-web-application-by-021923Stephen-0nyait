<!-- Calling php function to output navigataion bar 
and it pass along the page title  -->

<?php
    include 'common_cms.php';
    outputheader_and_navbar("Home") 
?>

<!-- Linking css file and adding a title to the page 
which will be pass along the php function above-->

<title>Edit Product</title>
<link rel="stylesheet" href="../css/common_cms.css">

<!-- Adding a header using style to align the header in the center of the page 
and using form to add some input fields for the staff to edit a product  -->
<!--The div ID asks the user to input ProductID, when the staff will 
clicks on submit, the div edit will appear -->

<h1 style="text-align: center;">EDIT PRODUCT</h1>

<div id="ID">
  <form method='post' action="editingproduct.php">
    <label for="fname">Enter Product ID:</label>
    <input type="text" id="text" name="textIDEdit"><br>
    <input type="submit" value="Submit">
  </form>
</div>



<!-- The function allow_edit() will hide the input fields fron the div "edit"
when the user will press on the submit button, It will display the form   -->

<script>
  function allow_edit(){
    document.getElementById("edit").style.display = "block";
  }
</script>


</body>
</html>