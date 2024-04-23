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
        <label class="visually-hidden" for="autoSizingInputGroup">Course of Study</label>
        <div class="input-group">
          <div class="input-group-text">Course of Study</div>
          <select id="courses" name="course" required
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup">
                <!-- <option value="">Select Department</option> -->

                <!-- Add the following class to the option values (class="ddrop_down") -->
            </select>
        </div>
      </div>
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Preferred State</label>
        <div class="input-group">
          <div class="input-group-text">Preferred State</div>
          <select id="states" name="state" required 
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup" placeholder="State">
            </select>
        </div>
      </div>

      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Preferred City/Area</label>
        <div class="input-group">
          <div class="input-group-text">Preferred City/Area</div>
          <select id="cities" name="city" required 
            onchange="this.className=this.options[this.selectedIndex].className"
            class="form-control" id="autoSizingInputGroup" placeholder="City or Area">
            </select>
        </div>
      </div>


      <div class="col-auto">
        <button type="submit" id="submit-browse" class="btn btn-primary">Browse</button>
      </div>
      <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="col-auto">
          <button type="submit" id="get-all-companies" class="btn btn-primary">Get all companies</button>
        </div>
      <?php } ?>
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
      <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Company</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="companyModalForm">
                    <div class="form-floating mb-3" hidden>
                      <input type="text" class="form-control" id="companyId" name="id" placeholder="0">
                      <label for="companyName" class="form-label">Company ID</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="companyName" name="company_name" placeholder="John & Doe Co.">
                      <label for="companyName" class="form-label">Company Name</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="companyAddress" name="company_address" placeholder="U.I">
                      <label for="companyAddress" class="form-label">Company Address</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="courseOfStudy" name="course_of_study" placeholder="Industrial Training">
                      <label for="courseOfStudy" class="form-label">Course of Study</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="cityOrArea" name="city_or_area" placeholder="Ibadan">
                      <label for="cityOrArea" class="form-label">City or Area</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="state" name="state" placeholder="Oyo">
                      <label for="state" class="form-label">State</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="itcc@ui.edu.ng">
                      <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="08012345678">
                      <label for="phone" class="form-label">Phone</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="website" name="website" placeholder="itcc.ui.edu.ng">
                      <label for="website" class="form-label">Website</label>
                    </div>
                    <button type="submit" id="submitCompany" class="btn btn-primary">Save Company</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

      <?php } ?>
    </div>

</section>

