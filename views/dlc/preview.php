<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $student['surname'] .'-'. $student['other_names']. '-' . $student['matric_no'] . "-IT Registration"?> </title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script>
    <link rel="stylesheet" href="/siwes/dlc/assets/styles/print.css" />
  </head>
  <body>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col l1'></div>
            <div id='main-content' class='col l10'>
                <div id='preview-content'>
                    <div id='content-header'>
                        <div id='indus'>INDUSTRIAL TRAINING COORDINATING CENTRE</div>
                        <div id='ui-below'>UNIVERSITY OF IBADAN</div>
                        <div id='ui-logo'><img src='/siwes/dlc/assets/images/logo_new.png'></div>
                        <div id='passport-block'><img id='passport' src=<?php echo "/siwes/dlc/uploads/passports/".$student['passport_link'] ?> ></div>
                    </div>
    
                    <div id='student-indus'>
                        <div class='center-align'><span id='student-indus-span'>STUDENT INDUSTRIAL TRAINING REGISTRATION FORM (IT-UI-011D)</span></div> 
                        <div style='font-size:90%;text-align:center'>(<?php echo strtoupper($student['duration'])?>)</div>
                    </div>
    
                    <div id='indus-content'>
                        
                            <div id='surname'>
                                <div>
                                    <div class='text-bold'>SURNAME</div> 
                                    <div><?php echo $student['surname'] ?></div>
                                </div>
                            </div>
    
                            <div>
                                <div>
                                    <div class='text-bold'>OTHER NAMES</div>
                                    <div> <?php echo $student['other_names'] ?> </div>
                                </div>
                            </div>
    
                            <div>
                                <div>
                                    <div class='text-bold'>MATRIC NO</div> 
                                    <div><?php echo $student['matric_no'] ?></div>
                                </div>
                            </div>
    
    
                        
    
                        
                            <div>
                                <div>
                                    <div class='text-bold'>FACULTY</div> 
                                    <div><?php echo $student['faculty'] ?></div>
                                </div>
                            </div>
    
                            <div>
                                <div>
                                    <div class='text-bold'>DEPARTMENT</div> 
                                    <div><?php echo $student['department'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>LEVEL</div> 
                                    <div><?php echo $student['level'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>SESSION</div>
                                    <div><?php echo $student['session'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>SESSION OF ENTRY TO DEPARTMENT</div> 
                                    <div><?php echo $student['session_of_entry_to_the_department'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>SEX</div> 
                                    <div><?php echo $student['sex'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>DATE OF BIRTH</div> 
                                    <div><?php echo $student['date_of_birth'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>PHONE NUMBER</div> 
                                    <div><?php echo $student['phone_number'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>E-MAIL</div> 
                                    <div id='email-value'><?php echo $student['email'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>MARITAL STATUS</div> 
                                    <div><?php echo $student['marital_status'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>PERMANENT HOME ADDRESS</div> 
                                    <div><?php echo $student['permanent_home_address'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>NATIONALITY</div>
                                    <div><?php echo $student['nationality'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>LANGUAGE OTHER THAN ENGLISH</div> 
                                    <div><?php echo $student['language_other_than_english'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>PHYSICAL DISABILITIES</div> 
                                    <div><?php echo $student['physical_disabilities'] ?></div>
                                </div>
                            </div>
                            
                            
                        
                            <div>
                                <div>
                                    <div class='text-bold'>ANY WORK EXPERIENCE</div> 
                                    <div><?php echo $student['previous_work_experience'] ?></div>
                                </div>
                            </div>
    
                            <div id='if-yes-where-block'>
                                <div><span class='text-bold'>IF YES WHERE:</span> <span id='if-yes-where'><?php echo $student['where_previous_work_experience'] ?></div>
                            </div>
    
    
                        
                            <div>
                                <div>
                                    <div class='text-bold'>NAME OF NEXT OF KIN</div> 
                                    <div><?php echo $student['name_of_next_of_kin'] ?></div>
                                </div>
                            </div>
    
                            <div>
                                <div>
                                    <div class='text-bold'>ADDRESS OF NEXT OF KIN</div> 
                                    <div style='text-align:center'><?php echo $student['address_of_next_of_kin'] ?></div>
                                </div>
                            </div>
                            
    
                            <div>
                                <div>
                                    <div class='text-bold'>PHONE NUMBER OF NEXT OF KIN</div> 
                                    <div style='text-align:center'><?php echo $student['phone_number_of_next_of_kin'] ?></div>
                                </div>
                            </div>
                            
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>IT DURATION</div> 
                                    <div><?php echo $student['duration'] ?></div>
                                </div>
                            </div>
                            
                            
                            <!-- <div>
                                <div>
                                    <div class='text-bold'>BANK ACCOUNT NUMBER</div> 
                                    <div><?php //echo $student['bank_account_number'] ?></div>
                                </div>
                            </div>
                            
                            
                            <div>
                                <div>
                                    <div class='text-bold'>BANK SORTCODE (9-DIGITS)</div> 
                                    <div><?php //echo $student['bank_sortcode'] ?></div>
                                </div>
                            </div> -->
                            
    
                    </div>
    
    
                    <div id='indus-footer'>
                        <div>
                            <div><span class='text-bold'>DATE</span><?php echo date("jS F, Y",$student['date']) ?></div>
                        </div>
    
                        <div>
                            <div style='display:flex;align-items:flex-end;'><span class='text-bold'>SIGNATURE</span> <img src=<?php echo "/siwes/dlc/uploads/signatures/".$student['signature_link'] ?>></div>
                        </div>
                    </div>
    
                    
                    <!--<div id='print-block'>
                        <div>
                            <button class='btn waves-effect waves-light pulse' id='print'>Print <i class='large material-icons'>print</i> </button>
                        </div>
                    </div>-->
    
                    <button class='btn waves-effect waves-light pulse btn-floating' id='print'><i class='large material-icons'>print</i> </button>
    
    
                </div>
        
            
    
            <div class='col l1'></div>
    
        </div>    
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script src="/siwes/dlc/assets/js/profile/print.js" type="module"></script>

  </body>
  </html>