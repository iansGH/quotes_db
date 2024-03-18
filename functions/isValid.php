<?php
/* Message from Dave Gray
In my index.php I handle some conditionals before routing. 

For example, all HTTP methods except for POST need to confirm 
the id if submitted. That makes it a good place to add a 
conditional along the lines of: 
If the method is not equal to POST and the id was submitted, 
then verify the author actually exists in your database. 
From there, I created a helper function called isValid that 
verifies something is in a database related to an id. It returns 
a Boolean.

It receives 2 parameters: id and model. This lets me use it for any model. 

3 total lines inside the function:
Set the id on the model
Call the read_single method from the model
Return the result

This helper (aka utility) function comes in handy. It's the only one I created in this project. 

This will let you confirm something exists before trying to modify it.
 */

 function isValid($model, $id){ 
    $model->id = $id; //Set the id on the model
    $result = $model->read_single(); //Call the read_single method from the model
    return $result; //Return the result
 }

 ?>