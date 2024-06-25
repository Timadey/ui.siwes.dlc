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
      <!-- <div class="col-auto"> -->
        <div class="form-floating">
          <select id="courses" name="course" required 
            class="form-select" id="autoSizingInputGroup" placeholder="State">
          </select>
          <label for="courses" class="form-label">Course of Study</label>
        </div>
      <!-- </div> -->
      <!-- <div class="col-auto"> -->
        <div class="form-floating">
          <select id="states" name="state" required 
            class="form-select" id="autoSizingInputGroup" placeholder="State">
          </select>
          <label for="states" class="form-label">Preferred State</label>
        </div>
      <!-- </div> -->

      <!-- <div class="col-auto"> -->
        <div class="form-floating">
          <select id="cities" name="city" required 
            class="form-select" id="autoSizingInputGroup" placeholder="State">
          </select>
          <label for="cities" class="form-label">Preferred City/Area</label>
        </div>
      <!-- </div> -->


      <div class="col-auto">
        <button type="submit" id="submit-browse" class="btn btn-primary">Browse</button>
      </div>
      <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="col-auto">
          <button type="button" id="get-all-companies" class="btn btn-danger">Get all companies</button>
        </div>
        <div class="col-auto">
          <button type="button" id="new-company" class="btn btn-secondary">+ New Company</button>
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
                    <label for="companyId" class="form-label">Company ID</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyName" name="company_name" placeholder="John & Doe Co.">
                    <label for="companyName" class="form-label">Company Name</label>
                    <ul id="companyNameSuggestionList" class="dropdown-menu bg-secondary" aria-labelledby="companyName">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Separated link</a></li>

                    </ul>
                    <span class="error  invalid-feedback" id="company_name_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyAddress" name="company_address" placeholder="U.I">
                    <label for="companyAddress" class="form-label">Company Address</label>
                    <span class="error invalid-feedback" id="company_address_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <!-- <input type="text" class="form-control" id="courseOfStudy" name="course_of_study" placeholder="Industrial Training"> -->
                    <select id="courseOfStudy" name="course_of_study" required
                      class="form-select" id="autoSizingInputGroup" placeholder="Industrial Training">
                    </select>
                    <!-- <label for="courseOfStudy" class="form-label">Course of Study</label> -->
                    <span class="error invalid-feedback" id="course_of_study_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <select id="stateInModal" name="state" required 
                      class="form-select" id="autoSizingInputGroup" placeholder="State">
                    </select>
                    <label for="state" class="form-label">State</label>
                    <span class="error invalid-feedback" id="state_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <!-- <input type="text" class="form-control" id="cityOrArea" name="city_or_area" placeholder="Ibadan"> -->
                    <select id="cityOrArea" name="city_or_area" required 
                      class="form-select" id="autoSizingInputGroup" placeholder="Ibadan">
                    </select>
                    <label for="cityOrArea" class="form-label">City or Area</label>
                    <span class="error invalid-feedback" id="city_or_area_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="itcc@ui.edu.ng">
                    <label for="email" class="form-label">Email</label>
                    <span class="error invalid-feedback" id="email_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="08012345678">
                    <label for="phone" class="form-label">Phone</label>
                    <span class="error invalid-feedback" id="phone_error"></span>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="website" name="website" value="" placeholder="https://www.itcc.ui.edu.ng">
                    <label for="website" class="form-label">Website</label>
                    <span class="error invalid-feedback" id="website_error"></span>
                  </div>
                  <button id="submitCompany" type="submit" class="btn btn-success">Save Company</button>
                  <!-- <button id="submitEditCompany" class="btn btn-primary">Edit Company</button> -->
                </form>
              </div>
            </div>
          </div>
        </div>

    <?php } ?>

</section>

