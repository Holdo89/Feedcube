<style>
#element{
  width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:15px; 
  font-size: 16px; 
  border:none; 
  border-radius:30px; 
  color:white; 
  background-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>
}

#element2{
      width:250px;
  position: relative;
  margin:auto;
  text-align:center;
  margin-top:25px; 
  margin-left:-50px;
  margin-right:20px;
  margin-bottom:30px; 
  cursor:pointer; 
  padding:13px; 
  font-size: 16px; 
  border:3px solid; 
  border-radius:30px; 
  border-color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>;
  color:<?php $sql='SELECT farbe FROM system'; $exec=mysqli_query($link,$sql); $result=mysqli_fetch_assoc($exec); echo $result['farbe']?>; 
  background-color:white
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modalform{
    width:95%; 
    text-align:center;
    margin:auto;
    max-width:1000px; 
    padding:30px; 
    overflow:auto; 
    border-radius: 15px;
}
@media only screen and (max-width: 600px){
 #icon{
     width:200px;
     height:70px;
 }  
 
#element2{
    margin:auto;
    margin-left:0px;
    margin-top:60px;
}
#element{
    margin:auto;
    margin-left:0px;
    margin-top:10px;
}
}
</style>