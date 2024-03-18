  
  <section class="details">

  <div style='margin-bottom:4px; display:flex;justify-content:center''>
      <img src='/siwes/dlc/assets/images/logo_new.png'>
  </div>
  <div>
    <h5>DLC INDUSTRIAL TRAINING</h5>
    <h1>REGISTRATION FORM (IT-UI-011D)</h1>
  </div>


  <form id="create-profile-form" enctype="multipart/form-data" method="post"> 
      <div class="first_index form-page">
        <div class="first">
          <div class="capsule">
            <label for="surname"> </label>
            <input type="text" name="surname" id="surname" placeholder="Surname" required>
            <span class="error" id="surname_error"></span>
          </div>
          <div class="capsule">
            <label for="other_names"> </label>
            <input type="text" name="other_names" id="other_names" placeholder="Other Names" required>
            <span class="error" id="other_names_error"></span>
          </div>
        </div>
        
        <div class="second">
          <div class="capsule">
            <label for="sex"> </label>
            <select name="sex" id="sex"
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value=" " selected hidden> Sex</option>
              <option class="male" value="male">Male</option>
              <option class="female" value="female">Female</option>
            </select>
            <span class="error" id="sex_error"></span>
          </div>


          <div class="capsule">
            <label for="date_of_birth"> </label>
            <!-- <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth"> -->
            <input type="text" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" onfocus="(this.type='date')">
            <span class="error" id="date_of_birth_error"></span>
          </div>
        </div>
        <div class="third">
          <div class="capsule">
            <label for="matric_no"> </label>
            <input type="text" name="matric_no" id="matric_no" placeholder="Matriculation Number" required>
            <span class="error" id="matric_no_error"></span>
          </div>
          <div class="capsule">
            <label for="level"> </label>
            <input type="number" name="level" id="level" placeholder="Level" required>
            <span class="error" id="level_error"></span>
          </div>
        </div>
      </div>

       <!-- FOurth page -->
      <div class="fourth_index form-page">
        <div class="first">
          <div class="capsule">
              <label for="phone_number"> </label>
              <input type="number" name="phone_number" id="phone_number" placeholder="Phone Number" required>
              
            <span class="error" id="phone_number_error"></span>
            </div>
          <div class="capsule">
            <label for="email"> </label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <span class="error" id="email_error"></span>

          </div>

        </div>
        <div class="second">
          <div class="capsule">
            <label for="duration"> </label>
            <select name="duration" id="duration" required ="duration"
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value=" " selected hidden> IT Duration</option>
              <option class="drop_down" value="3-month">3 Months IT</option>
              <option class="drop_down" value="6-month">6 Months IT</option>
            </select>
            <span class="error" id="duration_error"></span>

          </div>
          <div class="capsule">
            <label for="session_of_entry_to_the_department"> </label>
            <input type="text" name="session_of_entry_to_the_department" id="session_of_entry_to_the_department" required placeholder="Session of Entry to the Department">
            <span class="error" id="session_of_entry_to_the_department_error"></span>

          </div>
        </div>
        <div class="third">
        <div class="capsule">
            <label for="faculty"> </label>
            <select name="faculty" id="faculty" required 
            onchange="this.className=this.options[this.selectedIndex].className">
                <option value="">Select Faculty</option>
                <!-- Add the following class to the option value (class="drop_down") -->
            </select>
            <span class="error" id="faculty_error"></span>

          </div>
          <div class="capsule">
            <label for="department"> </label>
            <select id="department" name="department" required
            onchange="this.className=this.options[this.selectedIndex].className">
                <option value="">Select Department</option>

                <!-- Add the following class to the option values (class="ddrop_down") -->
            </select>
            <span class="error" id="department_error"></span>

          </div>
         
        </div>
      </div>

      <!-- second page -->
      <div class="second_index form-page">
        <div class="first">
          <div class="capsule">
            <label for="marital_status"> </label>
            <select name="marital_status" id="marital_status" required
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value=" " selected hidden> Marital Status</option>
              <option class="drop_down" value="single">Single</option>
              <option class="drop_down" value="married">Married</option>
              <option class="drop_down" value="divorced">Divorced</option>
              <option class="drop_down" value="widow">Widowed</option>
            </select>
            <span class="error" id="marital_status_error"></span>
          </div>

          <div class="capsule">
            <label for="nationality"> </label>
            <input type="text" name="nationality" id="nationality" placeholder="Nationality" required>
            <span class="error" id="nationality_error"></span>
          </div>
        </div>
        <div class="second">
          <div class="capsule">
            <label for="permanent_home_address"> </label>
            <input type="text" name="permanent_home_address" id="permanent_home_address" placeholder="Permanent Home Address">
            <span class="error" id="permanent_home_address_error"></span>

          </div>
          <div class="capsule">
            <label for="physical_disabilities"> </label>
            <select name="physical_disabilities" id="physical_disabilities"
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value=" " selected hidden> Any physical disabilities?</option>
              <option class="drop_down" value="yes">Yes</option>
              <option class="drop_down" value="no">No</option>
            </select>
            <span class="error" id="physical_disabilities_error"></span>
          </div>

        </div>
        <div class="third">
          <div class="capsule">
            <label for="previous_work_experience"> </label>
            <select name="previous_work_experience" id="previous_work_experience"
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value=" " selected hidden> Any work experience(s)?</option>
              <option class="drop_down" value="yes">Yes</option>
              <option class="drop_down" value="no">No</option>
            </select>
            <span class="error" id="previous_work_experience_error"></span>
          </div>
          <div class="capsule">

            <label for="where_previous_work_experience"> </label>
            <input type="text" name="where_previous_work_experience" id="where_previous_work_experience" placeholder="If yes, where?"
              required>
            <span class="error" id="where_previous_work_experience_error"></span>

          </div>
        </div>
      </div>


      

     

      <!-- The last goes here -->
      <div class="fifth_index form-page">
        <div class="first">
          <div class="capsule">
            <label for="name_of_next_of_kin"> </label>
          <input type="text" name="name_of_next_of_kin" id="name_of_next_of_kin" placeholder="Name of Next of Kin" required>
          <span class="error" id="name_of_next_of_kin_error"></span>

          </div>
          <div class="capsule">
            <label for="address_of_next_of_kin"> </label>
          <input type="text" name="address_of_next_of_kin" id="address_of_next_of_kin" placeholder="Address of Next of Kin"
            required>
          <span class="error" id="address_of_next_of_kin_error"></span>
 
          </div>       </div>
        <div class="second">
          <div class="capsule">
            <label for="phone_number_of_next_of_kin"> </label>
            <input type="tel" id="phone_number_of_next_of_kin" name="phone_number_of_next_of_kin" required
              placeholder="Phone Number of Next of Kin">
            <span class="error" id="phone_number_of_next_of_kin_error"></span>

          </div>
          <div class="capsule">
            <label for="language_other_than_english"> </label>
            <input type="text" name="language_other_than_english" id="language_other_than_english" placeholder="Language(s) other than English" required>
            <span class="error" id="language_other_than_english_error"></span>
          </div>
          <!-- <div class="capsule">
            <label for="next_of_kin_relationship"> </label>
          <input type="text" name="next_of_kin_relationship" id="next_of_kin_relationship" required
            placeholder="Relationship with Next of Kin">
          <span class="error" id="next_of_kin_relationship_error"></span>
       
          </div>  -->
        </div>
        <div class="third">
        <div class="capsule">
            <label for="session"> </label>
            <input type="text" name="session" id="session" placeholder="IT Session" value="2022/2023" hidden required>
            <span class="error" id="session_error"></span>
          </div>
        </div>
      </div>

        <!-- Third page -->

      <div class="third_index form-page">
        <div class="first">
          
          <div class="capsule">
            <label for="passport_link" class="passport"> <img src="./assets/images/passpoert.png" alt="passport_link">Upload your
              Passport </label>
            <input type="file" name="passport_link" id="passport_link" placeholder="Upload your passport" accept="image/*">
            <span class="error" id="passport_link_error"></span>

          </div>

          <div class="capsule">
            <label for="signature_link" class="signature"> <img src="./assets/images/sign.png" alt="signature_link">Upload your
              Signature</label>
            <input type="file" placeholder="Upload signature" id="signature_link" name="signature_link" accept="image/*">
            <span class="error" id="signature_link_error"></span>

          </div>
        </div>
        <div >
          <div style='display:flex;justify-content:center'>
            <blockquote  class="error_old" style='max-width:max-content;color:black; padding:20px; font-size:small;'>
                <div>Files must be less than 800 KB.</div>
                <div>Allowed file types: jpg, jpeg, png, gif.</div>
            </blockquote>
        </div>

        </div>

      </div>

      <footer class="footer">
        <img src="./assets/images/Chevron Right.png" alt="chevron left" id="prev-btn" onclick="prevPage()"
          class="prev_btn">
        <div class="circles">
          <div class="circ active"></div>
          <div class="circ"></div>
          <div class="circ"></div>
          <div class="circ"></div>
          <div class="circ"></div>
        </div>

        <!-- <div id="next-btn" onclick="nextPage()"> Next</div> -->
        <button id="submit-btn"> Submit</button>
        <img src="./assets/images/Chevron Right.png" alt="right" id="next-btn" onclick="nextPage()">
      </footer>
    </form>
  </section>
