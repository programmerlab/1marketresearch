
<div class="tab-pane" id="p-view-3">
    <div class="  btn-default" style="padding: 10px; background-color: #ccc">Enquiry Before Buying</div>
<hr>
    <div class="tab-inner">
        <div class="event-content head-team">

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--table_of_contents_tab panel entry-content wc-tab" id="tab-table_of_contents_tab" style="display: block;">
                                                   
                                        
            <form novalidate="" id="Enquiry" name="sentMessage">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="request_type" value="Enquiry">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Full Name :</label> <span class="required" style="color:red;">*</span>
                        <input type="text" name="name" id="name" class="form-control isrequired" aria-invalid="false">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label>Your Business Email: </label>  <span class="required" style="color:red;">*</span>
                        <input type="text" name="email" id="email" class="form-control isrequired">
                    <div class="help-block"></div></div>
                    </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Your country:</label> <span class="required" style="color:red;">*</span>
                        <input type="text" name="country" id="country" class="form-control isrequired">
                    <div class="help-block"></div></div>
                    </div>
                    <div class="control-group form-group">
                    <div class="controls">
                        <label>Job Title:</label> <span class="required" style="color:red;">*</span>
                        <input type="text" name="job_title" id="job_title" class="form-control isrequired">
                    <div class="help-block"></div></div>
                    </div>
                    <div class="control-group form-group">
                    <div class="controls">
                        <label>Phone No. (Pls. Affix Country Code):</label> <span class="required" style="color:red;">*</span>
                        <input type="tel" name="phone" id="phone" class="form-control isrequired">
                    <div class="help-block"></div></div>
                    </div>
                    <div class="control-group form-group">
                    <div class="controls">
                        <label>Any Specific Request:</label> <span class="required" style="color:red;">*</span>
                        <textarea style="resize:none" maxlength="999" id="request_description" name="request_description" class="form-control isrequired" cols="100" rows="10"></textarea>
                    <div class="help-block"></div></div>
                </div>


                <div class="control-group form-group">
                    <div class="controls">

                        <!-- START CAPTCHA -->
                        <label>Enter Captcha:</label>
                        <span id="mainCaptcha" style="margin-left: 10px; font-weight: 700; font-size: 25px" /> </span>
                        <i class="fa fa-refresh" onclick="Captcha();"  aria-hidden="true" style="color: #337ab7; font-size: 30px; padding-left: 10px;"></i>

                        <span class="cptch_reload_button dashicons dashicons-update"></span>
                        <input type="text" id="txtInput" class="form-control" onkeyup="ValidCaptcha(1)"> 
                        <div id="CaptchaMsg" style="color: red"></div>
                    </div>
                </div>
                <span class="successMsg"></span>
                <button class="btn btn-primary" type="submit" id="btnSubmit" onclick="ValidCaptcha(1)">Submit Request</button>
            </form>
            </div>
        </div>
    </div>
</div> 