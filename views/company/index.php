<section class="details">

  <div style='margin-bottom:4px; display:flex;justify-content:center''>
      <img src='/siwes/dlc/assets/images/logo_new.png'>
  </div>
  <div>
    <h5>INDUSTRIAL TRAINING</h5>
    <h1>Company Directory</h1>
  </div>
  <div id="search-company" class="row pb-4 px-2">
    <form id="browse-companies" class="row gy-2 gx-3 align-items-center" method="post" action="companies">
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Faculty</label>
        <div class="input-group">
          <div class="input-group-text">Faculty</div>
          <select id="faculty" required 
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup" placeholder="Faculty">
                <!-- <option class="drop_down" value="">Select Faculty</option> -->
                <!-- Add the following class to the option value (class="drop_down") -->
            </select>
        </div>
      </div>
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Department</label>
        <div class="input-group">
          <div class="input-group-text">Department</div>
          <select id="department" name="course" required
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup">
                <!-- <option value="">Select Department</option> -->

                <!-- Add the following class to the option values (class="ddrop_down") -->
            </select>
        </div>
      </div>
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">State</label>
        <div class="input-group">
          <div class="input-group-text">State</div>
          <select id="states" required 
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup" placeholder="State">
            </select>
        </div>
      </div>

      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">City or Area</label>
        <div class="input-group">
          <div class="input-group-text">City or Area</div>
          <select id="cities" name="city" required 
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup" placeholder="City or Area">
            </select>
        </div>
      </div>


      <div class="col-auto">
        <button type="submit" id="submit-browse" class="btn btn-primary">Browse</button>
      </div>
    </form>
  </div>
    <div id="company-datatable" class="card text-center">
      <div class="card-header">
        <h5 >Industrial Training Coordinating Centre, Univerisity of Ibadan</h5>
      </div>
        <div class="card-body">
        <div class="table-responsive">
                <div class="position-relative">
                    <table class="dataTable table table-striped" id="companies">
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

