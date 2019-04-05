<?php
    //Start session management
    session_start();

    //Remove all session variables
    session_unset(); 

    //Destroy the session 
    if (session_destroy()){ 
    header('Location: cmsindex.html');
	}


    
    