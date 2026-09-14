<?php
$message = '';
$message_type = '';

// Get message from URL parameters if redirected from process_registration.php
if (isset($_GET['message']) && isset($_GET['type'])) {
    $message = htmlspecialchars($_GET['message']);
    $message_type = htmlspecialchars($_GET['type']);
}
?>
<?php include_once "inc/header.php" ?>
<?php if ($message): ?>
<div class="container">
    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible" role="alert" style="margin-top: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $message; ?>
    </div>
</div>
<?php endif; ?>
        <main>
            <div class="layout-container container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			class="h3"
	  	>
    &nbsp;
    </div>
</div>
<div id="form-17037463377458750-num1-body"
     class="modul-r-formbuilder text-left nowow"
     data-success="0">
        <div class="panel  panel-default">
        <div class="panel-heading">
            <div class="panel-title">Registration Form</div>
        </div>
        <div class="panel-body">
                
                            <script type="text/javascript">
                    $(document).ready(function () {
                        //<![CDATA[
                        window.fbl_6981ed2e28152 = new CustomForm({
                            'form_id': '#form-17037463377458750-num1',
                            'uniqid': '6981ed2e28152',
                            'display_mode': 'single',
                            'validate_rules': {"contact_email":{"email":true},"text_input-17037466775267453":{"email":true},"text_input-1703747476156636":{"required":true},"text_input-17037474781664368":{"required":true},"text_input-17037474801003889":{"required":true},"text_input-17037474818383191":{"required":true},"file_input-17037476746001067":{"filetype":true},"file_input-17037476765907773":{"filetype":true},"file_input-17037476786775550":{"filetype":true},"file_input-17037476821786090":{"filetype":true},"text_input-17037481271432338":{"required":true},"text_input-17037481455067992":{"required":true},"text_input-17037481583976320":{"required":true},"text_input-17037481809166086":{"required":true},"contact_phone_0":{"required":true},"phone_input-17037483074413198_0":{"required":true}},
                            'fields': ["selectbox-17037599305407085","contact_firstname","text_input-17037466237876250","contact_lastname","contact_email","text_input-17037466775267453","radio-17037467237924392","text_input-17037468433392946","selectbox-17037599969911666","selectbox-17037601019284266","text_input-17037469113525962","text_input-17037469292272615","selectbox-17037601469765598","text_input-1703747476156636","text_input-17037474781664368","text_input-17037474801003889","text_input-17037474818383191","file_input-17037476746001067","file_input-17037476765907773","file_input-17037476786775550","file_input-17037476821786090","selectbox-17037602759865946","selectbox-17037603182803785","date_input-1703748024469416","selectbox-17037603478188271","text_input-17037480962499846","text_input-17037481130678525","text_input-17037481271432338","text_input-17037481455067992","text_input-17037481583976320","text_input-17037481809166086","selectbox-17037604275986512","contact_phone","phone_input-17037483074413198","checkbox-17037498555496739"],
                            'year': '',
                            'make': '',
                            'model': '',
                            'trim': '',
                            'motorized_type': '',
                            'vin': '',
                            'body_style': '',
                            'chainEmpties': {
                                'loading': 'Loading...',
                                'motorized_type': 'Any Make',
                                'make': 'Any Model',
                                'model': 'Any Trim',
                                'body': 'Any Body Style'
                            },
                        });
                        //]]>
                    });
                </script>
                                                    <form id="form-17037463377458750-num1" class="captcha_container form-builder-submit" role="form" data-display-mode="single"
      method="post" target="_self" action="process_registration.php" enctype="multipart/form-data" encoding="multipart/form-data">
    <input type="hidden" name="form_id" value="form-17037463377458750-num1"/>
    <input type="hidden" name="numForm" value="1"/>
    
    <div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037463377547615"><div id="1703746366177718" widget="fieldset" class="" data-role="layout" role="fb-widget">
    <fieldset>
                    <legend>                            Sign Up                        </legend>        
        <div id="content-1703746366177718" class="rsp-layout ">
            <div class="row" role="fb-row">
                <div class="col-xs-12 full-width-in-thin ui-sortable" role="fb-container" widget="placeholder" id="17037463663546060"><div id="17037464140335131" widget="html" class="form-group" role="fb-widget" style="">
    

<div style="text-align: center;">


<strong><p style="text-align: center;">
  
  Why Sign Up?</p></strong>






<ul style="text-align: left;">






	<li>Update your profile.</li>
	











	<li>Watch auction.</li>
	











	<li>Participate auctions.</li>
	











	<li>Load subscriptions for auctions and we'll email you to catalogue before the auction.</li>
	











</ul>





</div>















</div></div>
            </div>
        </div>
    </fieldset>
</div></div>
    </div>
<div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037463422496042"><div id="17037464897618581" widget="fieldset" class="" data-role="layout" role="fb-widget" style="position: relative; left: 0px; top: 0px;">
    <fieldset>
                    <legend>                            Personal                        </legend>        
        <div id="content-17037464897618581" class="rsp-layout ">
            <div class="row" role="fb-row">
                <div class="col-xs-12 full-width-in-thin ui-sortable" role="fb-container" widget="placeholder" id="17037464899337810"><div id="17037599305407085" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Title:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037599305407085" tabindex="1" class="form-control">
            <option value="Mr">Mr</option>
<option value="Mrs">Mrs</option>
<option value="Ms">Ms</option>
<option value="Miss">Miss</option>
<option value="Dr">Dr</option>
<option value="Rev">Rev</option>
<option value="Prof">Prof</option>
<option value="Sir">Sir</option>
        </select>
                <input type="hidden" name="selectbox-17037599305407085_params" value="group%3DPersonal%26title%3DTitle%26rules%3D">
        </div>
    </div>
</div></div>
            </div>
        <div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="1703746510149898"><div id="17037465884341882" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                First Name: </label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="contact_firstname" tabindex="2" class="form-control ">
        <input type="hidden" name="contact_firstname_params" value="group%3DPersonal%26title%3DName%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="1703746510803557"><div id="17037466237876250" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Initials:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037466237876250" tabindex="3" class="form-control ">
        <input type="hidden" name="text_input-17037466237876250_params" value="group%3DPersonal%26title%3DInitials%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037465117122038"><div id="17037466457417566" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Surname:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="contact_lastname" tabindex="4" class="form-control ">
        <input type="hidden" name="contact_lastname_params" value="group%3DPersonal%26title%3DName%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037465125869826"><div id="1703746661227476" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Email:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="contact_email" tabindex="5" class="form-control ">
        <input type="hidden" name="contact_email_params" value="group%3DPersonal%26title%3DEmail%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037465135568135"><div id="17037466775267453" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Confirm Email:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037466775267453" tabindex="6" class="form-control ">
        <input type="hidden" name="text_input-17037466775267453_params" value="group%3DPersonal%26title%3DConfirm+Email%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037465144442921"><div id="17037467237924392" widget="radio" class="form-horizontal col-lg-12" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Nationality:                            </label>
                                    <div class="visible-xs"></div>
            <div class="radio-inline no-padding-left-xs">
                                                        <label class="radio-inline control-label no-padding-top" style="width:200px">
                        <input type="radio" name="radio-17037467237924392" tabindex="7" class="radio-17037467237924392" value="SA citizen">
                        SA citizen                        <input type="hidden" name="radio-17037467237924392_params" value="group%3DPersonal%26title%3DNationality%26rules%3D">
                    </label>
                                                        <label class="radio-inline control-label no-padding-top" style="width:200px">
                        <input type="radio" name="radio-17037467237924392" tabindex="7" class="radio-17037467237924392" value="Foreign national residing in SA">
                        Foreign national residing in SA                        <input type="hidden" name="radio-17037467237924392_params" value="group%3DPersonal%26title%3DNationality%26rules%3D">
                    </label>
                            </div>
        
            </div>
</div></div>
    </div><div class="row" role="fb-row" data-col="col-md-6">
        <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037465411488392"><div id="17037468433392946" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                South African Identity number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037468433392946" tabindex="8" class="form-control " maxlength="13">
        <input type="hidden" name="text_input-17037468433392946_params" value="group%3DPersonal%26title%3DSouth+African+Identity+number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037468055858337"><div id="17037601019284266" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Country:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037601019284266" tabindex="10" class="form-control">
            <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cabo Verde">Cabo Verde</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Eswatini (fmr. " swaziland")"="">Eswatini (fmr. "Swaziland")</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option>
<option value="Grenada">Grenada</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Holy See">Holy See</option>
<option value="Honduras">Honduras</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Ivory Coast">Ivory Coast</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="North Korea">North Korea</option>
<option value="North Macedonia (formerly Macedonia)">North Macedonia (formerly Macedonia)</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestine State">Palestine State</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Korea">South Korea</option>
<option value="South Sudan">South Sudan</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Timor-Leste">Timor-Leste</option>
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
        </select>
                <input type="hidden" name="selectbox-17037601019284266_params" value="group%3DPersonal%26title%3DCountry%26rules%3D">
        </div>
    </div>
</div></div></div><div class="row" role="fb-row" data-col="col-md-6">
        <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037465418497313"><div id="17037599969911666" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Proof of identification:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037599969911666" tabindex="9" class="form-control">
            <option value="Driver's license">Driver's license</option>
<option value="Identification Document">Identification Document</option>
<option value="Birth certificate">Birth certificate</option>
        </select>
                <input type="hidden" name="selectbox-17037599969911666_params" value="group%3DPersonal%26title%3DProof+of+identification%26rules%3D">
        </div>
    </div>
</div></div>
    <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037468075905596"><div id="17037469113525962" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Passport Number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037469113525962" tabindex="11" class="form-control ">
        <input type="hidden" name="text_input-17037469113525962_params" value="group%3DPersonal%26title%3DPassport+Number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div></div><div class="row" role="fb-row" data-col="col-md-6">
        <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037465440926862"></div>
    <div class="full-width-in-thin col-xs-12 col-md-6 ui-sortable" role="fb-container" widget="placeholder" id="17037468318077803"><div id="17037469292272615" widget="text_input" class="" role="fb-widget" style="">
    <div class="form-group ">
                    <label class="control-label ">
                Traffic Register Number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037469292272615" tabindex="12" class="form-control ">
        <input type="hidden" name="text_input-17037469292272615_params" value="group%3DPersonal%26title%3DTraffic+Register+Number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div></div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471069424287"><hr id="17037500616087186" widget="separator" role="fb-widget" class="" style="position: relative; left: 0px; top: 0px;"><div id="17037471548838530" widget="html" class="form-group" role="fb-widget" style="">





<p style="text-align: center; font-size: 21px;">Why do we need this information</p>












<p style="text-align: left;"><strong>Please add your banking details:</strong></p>








    















</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471142155207"><div id="17037601469765598" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Bank name:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037601469765598" tabindex="13" class="form-control">
            <option value="ABSA">ABSA</option>
<option value="African Bank">African Bank</option>
<option value="Bidvest Bank">Bidvest Bank</option>
<option value="Capitec Bank">Capitec Bank</option>
<option value="FNB">FNB</option>
<option value="Investec">Investec</option>
<option value="Nedbank">Nedbank</option>
<option value="Postbank">Postbank</option>
<option value="SA Bank of Athens">SA Bank of Athens</option>
<option value="Standart Bank">Standart Bank</option>
<option value="HBZ Bank">HBZ Bank</option>
<option value="Ithala Bank">Ithala Bank</option>
<option value="Tyme Bank">Tyme Bank</option>
        </select>
                <input type="hidden" name="selectbox-17037601469765598_params" value="group%3DBanking+details%26title%3DBank+name%26rules%3D">
        </div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471161247897"><div id="1703747476156636" widget="text_input" class="" role="fb-widget" style="">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Account holder name:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-1703747476156636" tabindex="14" class="form-control " required="">
        <input type="hidden" name="text_input-1703747476156636_params" value="group%3DBanking+details%26title%3DAccount+holder+name%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471285551439"><div id="17037474781664368" widget="text_input" class="" role="fb-widget" style="position: relative; left: 0px; top: 0px;">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Account number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037474781664368" tabindex="15" class="form-control " required="">
        <input type="hidden" name="text_input-17037474781664368_params" value="group%3DBanking+details%26title%3DAccount+number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471303048319"><div id="17037474801003889" widget="text_input" class="" role="fb-widget" style="">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Branch name:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037474801003889" tabindex="16" class="form-control " required="">
        <input type="hidden" name="text_input-17037474801003889_params" value="group%3DBanking+details%26title%3DBranch+name%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471313976699"><div id="17037474818383191" widget="text_input" class="" role="fb-widget" style="">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Branch code:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037474818383191" tabindex="17" class="form-control " required="">
        <input type="hidden" name="text_input-17037474818383191_params" value="group%3DBanking+details%26title%3DBranch+code%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471328411408"><div id="1703747623762548" widget="html" class="form-group" role="fb-widget" style="">
    


<p>
<strong>Please upload the following documents
 (A maximum of 5MB allowed per upload):</strong>
</p>


</div><hr id="17037500061355793" widget="separator" role="fb-widget" class=""></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471352942853"><div id="17037476746001067" widget="file_input" class="modFinput" role="fb-widget">
    <div class="form-group ">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Passport/Identification document:</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">        <div class="input-group">
        <div class="input-group-btn">
            <div class="btn btn-primary btn-upload-group">
                Select                <input type="file" name="file_input-17037476746001067" tabindex="18" class="form-control input-upload input-file" onchange="$(this).closest('#17037476746001067').find('.file_text_file_input-17037476746001067').val(
                            $(this).val().replace(/^.*[\\\/]/i, '')
                        )">
            </div>
        </div>
        <div>
            <input type="text" class="form-control file_name file_text_file_input-17037476746001067" value="File not selected" name="file_text_file_input-17037476746001067" disabled="disabled">
        </div>
        <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="var $layer = $(this).closest('#17037476746001067'); $layer.html($layer.html());">
                Clear            </button>
        </span>
    </div>
        </div>
    <input type="hidden" name="file_input-17037476746001067_params" value="group%3D%26title%3D%26rules%3D">
    <input type="hidden" data-ftypes="file_input-17037476746001067" value="jpg,jpeg,png,pdf">
        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471360713252"><div id="17037476765907773" widget="file_input" class="modFinput" role="fb-widget">
    <div class="form-group ">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Traffic Register Letter:</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">        <div class="input-group">
        <div class="input-group-btn">
            <div class="btn btn-primary btn-upload-group">
                Select                <input type="file" name="file_input-17037476765907773" tabindex="19" class="form-control input-upload input-file" onchange="$(this).closest('#17037476765907773').find('.file_text_file_input-17037476765907773').val(
                            $(this).val().replace(/^.*[\\\/]/i, '')
                        )">
            </div>
        </div>
        <div>
            <input type="text" class="form-control file_name file_text_file_input-17037476765907773" value="File not selected" name="file_text_file_input-17037476765907773" disabled="disabled">
        </div>
        <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="var $layer = $(this).closest('#17037476765907773'); $layer.html($layer.html());">
                Clear            </button>
        </span>
    </div>
        </div>
    <input type="hidden" name="file_input-17037476765907773_params" value="group%3D%26title%3D%26rules%3D">
    <input type="hidden" data-ftypes="file_input-17037476765907773" value="jpg,jpeg,png,pdf">
        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471371491391"><div id="17037476786775550" widget="file_input" class="modFinput" role="fb-widget">
    <div class="form-group ">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Proof of address:</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">        <div class="input-group">
        <div class="input-group-btn">
            <div class="btn btn-primary btn-upload-group">
                Select                <input type="file" name="file_input-17037476786775550" tabindex="20" class="form-control input-upload input-file" onchange="$(this).closest('#17037476786775550').find('.file_text_file_input-17037476786775550').val(
                            $(this).val().replace(/^.*[\\\/]/i, '')
                        )">
            </div>
        </div>
        <div>
            <input type="text" class="form-control file_name file_text_file_input-17037476786775550" value="File not selected" name="file_text_file_input-17037476786775550" disabled="disabled">
        </div>
        <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="var $layer = $(this).closest('#17037476786775550'); $layer.html($layer.html());">
                Clear            </button>
        </span>
    </div>
        </div>
    <input type="hidden" name="file_input-17037476786775550_params" value="group%3D%26title%3D%26rules%3D">
    <input type="hidden" data-ftypes="file_input-17037476786775550" value="jpg,jpeg,png,pdf">
        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037471383554061"><div id="17037476821786090" widget="file_input" class="modFinput" role="fb-widget">
    <div class="form-group ">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Banking details (optional):</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">        <div class="input-group">
        <div class="input-group-btn">
            <div class="btn btn-primary btn-upload-group">
                Select                <input type="file" name="file_input-17037476821786090" tabindex="21" class="form-control input-upload input-file" onchange="$(this).closest('#17037476821786090').find('.file_text_file_input-17037476821786090').val(
                            $(this).val().replace(/^.*[\\\/]/i, '')
                        )">
            </div>
        </div>
        <div>
            <input type="text" class="form-control file_name file_text_file_input-17037476821786090" value="File not selected" name="file_text_file_input-17037476821786090" disabled="disabled">
        </div>
        <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="var $layer = $(this).closest('#17037476821786090'); $layer.html($layer.html());">
                Clear            </button>
        </span>
    </div>
        </div>
    <input type="hidden" name="file_input-17037476821786090_params" value="group%3D%26title%3D%26rules%3D">
    <input type="hidden" data-ftypes="file_input-17037476821786090" value="jpg,jpeg,png,pdf">
        <div class="clearfix"></div>
    </div>
</div></div>
    </div></div>
    </fieldset>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037463463683901"><div id="17037477791902616" widget="fieldset" class="headless" data-role="layout" role="fb-widget">
    <fieldset>
        
        <div id="content-17037477791902616" class="rsp-layout ">
            <div class="row" role="fb-row">
                <div class="col-xs-12 full-width-in-thin ui-sortable" role="fb-container" widget="placeholder" id="1703747779381407"><hr id="17037500374417298" widget="separator" role="fb-widget" class="" style="position: relative; left: 0px; top: 0px;"><div id="17037478347082977" widget="html" class="form-group" role="fb-widget" style="">
    

<style type="text/css">
        .gray-background {
            background-color: #f0f0f0; /* Use the hex code for gray */
            padding: 20px; /* Optional: add padding for better visibility */
        }

</style>


<div class="gray-background">

<p style="text-align: center;">Your documents must be verified before any vehicles will be released.</p>

</div>
</div></div>
            </div>
        <div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037477982656182"><div id="17037602759865946" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Race / Ethnic group:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037602759865946" tabindex="22" class="form-control">
            <option value="African">African</option>
<option value="Coloured">Coloured</option>
<option value="Indian">Indian</option>
<option value="White">White</option>
        </select>
                <input type="hidden" name="selectbox-17037602759865946_params" value="group%3DPersonal%26title%3DRace+%2F+Ethnic+group%26rules%3D">
        </div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037477994475910"><div id="17037603182803785" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Gender:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037603182803785" tabindex="23" class="form-control">
            <option value="Male">Male</option>
<option value="Female">Female</option>
        </select>
                <input type="hidden" name="selectbox-17037603182803785_params" value="group%3DPersonal%26title%3DGender%26rules%3D">
        </div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037478007034625"><div id="1703748024469416" widget="date_input" class="form-horizontal" role="fb-widget">
    <div class="form-group ">
                    <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12">
                Date of Birth:</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12">
                <div class="row dataSelect">
                    <div class="col-md-5 col-xs-12 no-padding-right-lg">
                        <select tabindex="24" name="date_input-1703748024469416_m" class="form-control">
                            <option value="">Select a Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="visible-xs visible-sm"><small>&nbsp;</small></div>
                    <div class="col-md-3 col-xs-12 no-padding-right-lg">
                        <select tabindex="24" name="date_input-1703748024469416_d" class="form-control">
                            <option value="">Day</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                    </div>
                    <div class="visible-xs visible-sm"><small>&nbsp;</small></div>
                    <div class="col-md-4 col-xs-12">
                                                <select tabindex="24" name="date_input-1703748024469416_y" class="form-control">
                            <option value="">Year</option>
                                                                                                <option value="2024">
                                        2024                                    </option>
                                                                    <option selected="selected" value="2023">
                                        2023                                    </option>
                                                                    <option value="2022">
                                        2022                                    </option>
                                                                    <option value="2021">
                                        2021                                    </option>
                                                                    <option value="2020">
                                        2020                                    </option>
                                                                    <option value="2019">
                                        2019                                    </option>
                                                                    <option value="2018">
                                        2018                                    </option>
                                                                    <option value="2017">
                                        2017                                    </option>
                                                                    <option value="2016">
                                        2016                                    </option>
                                                                    <option value="2015">
                                        2015                                    </option>
                                                                    <option value="2014">
                                        2014                                    </option>
                                                                    <option value="2013">
                                        2013                                    </option>
                                                                    <option value="2012">
                                        2012                                    </option>
                                                                    <option value="2011">
                                        2011                                    </option>
                                                                    <option value="2010">
                                        2010                                    </option>
                                                                    <option value="2009">
                                        2009                                    </option>
                                                                    <option value="2008">
                                        2008                                    </option>
                                                                    <option value="2007">
                                        2007                                    </option>
                                                                    <option value="2006">
                                        2006                                    </option>
                                                                    <option value="2005">
                                        2005                                    </option>
                                                                    <option value="2004">
                                        2004                                    </option>
                                                                    <option value="2003">
                                        2003                                    </option>
                                                                    <option value="2002">
                                        2002                                    </option>
                                                                    <option value="2001">
                                        2001                                    </option>
                                                                    <option value="2000">
                                        2000                                    </option>
                                                                    <option value="1999">
                                        1999                                    </option>
                                                                    <option value="1998">
                                        1998                                    </option>
                                                                    <option value="1997">
                                        1997                                    </option>
                                                                    <option value="1996">
                                        1996                                    </option>
                                                                    <option value="1995">
                                        1995                                    </option>
                                                                    <option value="1994">
                                        1994                                    </option>
                                                                    <option value="1993">
                                        1993                                    </option>
                                                                    <option value="1992">
                                        1992                                    </option>
                                                                    <option value="1991">
                                        1991                                    </option>
                                                                    <option value="1990">
                                        1990                                    </option>
                                                                    <option value="1989">
                                        1989                                    </option>
                                                                    <option value="1988">
                                        1988                                    </option>
                                                                    <option value="1987">
                                        1987                                    </option>
                                                                    <option value="1986">
                                        1986                                    </option>
                                                                    <option value="1985">
                                        1985                                    </option>
                                                                    <option value="1984">
                                        1984                                    </option>
                                                                    <option value="1983">
                                        1983                                    </option>
                                                                    <option value="1982">
                                        1982                                    </option>
                                                                    <option value="1981">
                                        1981                                    </option>
                                                                    <option value="1980">
                                        1980                                    </option>
                                                                    <option value="1979">
                                        1979                                    </option>
                                                                    <option value="1978">
                                        1978                                    </option>
                                                                    <option value="1977">
                                        1977                                    </option>
                                                                    <option value="1976">
                                        1976                                    </option>
                                                                    <option value="1975">
                                        1975                                    </option>
                                                                    <option value="1974">
                                        1974                                    </option>
                                                                    <option value="1973">
                                        1973                                    </option>
                                                                    <option value="1972">
                                        1972                                    </option>
                                                                    <option value="1971">
                                        1971                                    </option>
                                                                    <option value="1970">
                                        1970                                    </option>
                                                                    <option value="1969">
                                        1969                                    </option>
                                                                    <option value="1968">
                                        1968                                    </option>
                                                                    <option value="1967">
                                        1967                                    </option>
                                                                    <option value="1966">
                                        1966                                    </option>
                                                                    <option value="1965">
                                        1965                                    </option>
                                                                    <option value="1964">
                                        1964                                    </option>
                                                                    <option value="1963">
                                        1963                                    </option>
                                                                    <option value="1962">
                                        1962                                    </option>
                                                                    <option value="1961">
                                        1961                                    </option>
                                                                    <option value="1960">
                                        1960                                    </option>
                                                                    <option value="1959">
                                        1959                                    </option>
                                                                    <option value="1958">
                                        1958                                    </option>
                                                                    <option value="1957">
                                        1957                                    </option>
                                                                    <option value="1956">
                                        1956                                    </option>
                                                                    <option value="1955">
                                        1955                                    </option>
                                                                    <option value="1954">
                                        1954                                    </option>
                                                                    <option value="1953">
                                        1953                                    </option>
                                                                    <option value="1952">
                                        1952                                    </option>
                                                                    <option value="1951">
                                        1951                                    </option>
                                                                    <option value="1950">
                                        1950                                    </option>
                                                                    <option value="1949">
                                        1949                                    </option>
                                                                    <option value="1948">
                                        1948                                    </option>
                                                                    <option value="1947">
                                        1947                                    </option>
                                                                    <option value="1946">
                                        1946                                    </option>
                                                                    <option value="1945">
                                        1945                                    </option>
                                                                    <option value="1944">
                                        1944                                    </option>
                                                                    <option value="1943">
                                        1943                                    </option>
                                                                    <option value="1942">
                                        1942                                    </option>
                                                                    <option value="1941">
                                        1941                                    </option>
                                                                    <option value="1940">
                                        1940                                    </option>
                                                                    <option value="1939">
                                        1939                                    </option>
                                                                    <option value="1938">
                                        1938                                    </option>
                                                                    <option value="1937">
                                        1937                                    </option>
                                                                    <option value="1936">
                                        1936                                    </option>
                                                                    <option value="1935">
                                        1935                                    </option>
                                                                    <option value="1934">
                                        1934                                    </option>
                                                                    <option value="1933">
                                        1933                                    </option>
                                                                    <option value="1932">
                                        1932                                    </option>
                                                                    <option value="1931">
                                        1931                                    </option>
                                                                    <option value="1930">
                                        1930                                    </option>
                                                                    <option value="1929">
                                        1929                                    </option>
                                                                    <option value="1928">
                                        1928                                    </option>
                                                                    <option value="1927">
                                        1927                                    </option>
                                                                    <option value="1926">
                                        1926                                    </option>
                                                                    <option value="1925">
                                        1925                                    </option>
                                                                    <option value="1924">
                                        1924                                    </option>
                                                                    <option value="1923">
                                        1923                                    </option>
                                                                    <option value="1922">
                                        1922                                    </option>
                                                                    <option value="1921">
                                        1921                                    </option>
                                                                    <option value="1920">
                                        1920                                    </option>
                                                                    <option value="1919">
                                        1919                                    </option>
                                                                    <option value="1918">
                                        1918                                    </option>
                                                                    <option value="1917">
                                        1917                                    </option>
                                                                    <option value="1916">
                                        1916                                    </option>
                                                                    <option value="1915">
                                        1915                                    </option>
                                                                    <option value="1914">
                                        1914                                    </option>
                                                                    <option value="1913">
                                        1913                                    </option>
                                                                    <option value="1912">
                                        1912                                    </option>
                                                                    <option value="1911">
                                        1911                                    </option>
                                                                    <option value="1910">
                                        1910                                    </option>
                                                                    <option value="1909">
                                        1909                                    </option>
                                                                    <option value="1908">
                                        1908                                    </option>
                                                                    <option value="1907">
                                        1907                                    </option>
                                                                    <option value="1906">
                                        1906                                    </option>
                                                                    <option value="1905">
                                        1905                                    </option>
                                                                    <option value="1904">
                                        1904                                    </option>
                                                                    <option value="1903">
                                        1903                                    </option>
                                                                    <option value="1902">
                                        1902                                    </option>
                                                                    <option value="1901">
                                        1901                                    </option>
                                                                    <option value="1900">
                                        1900                                    </option>
                                                                                    </select>
                    </div>

                </div>
            </div>
                        <input type="hidden" name="date_input-1703748024469416_params" value="group%3DPersonal%26title%3DDate+of+Birth%26rules%3D">
            </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037478014491029"><div id="17037603478188271" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Where did you hear about us?:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037603478188271" tabindex="25" class="form-control">
            <option value="Advert in paper">Advert in paper</option>
<option value="Internet">Internet</option>
<option value="Radio">Radio</option>
<option value="Social media">Social media</option>
<option value="Street poster">Street poster</option>
<option value="Word of mouth">Word of mouth</option>
        </select>
                <input type="hidden" name="selectbox-17037603478188271_params" value="group%3DPersonal%26title%3DWhere+did+you+hear+about+us%3F%26rules%3D">
        </div>
    </div>
</div></div>
    </div></div>
    </fieldset>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="1703746351375544"><div id="1703748066968930" widget="fieldset" class="" data-role="layout" role="fb-widget">
    <fieldset>
                    <legend>                            Address                        </legend>        
        <div id="content-1703748066968930" class="rsp-layout ">
            <div class="row" role="fb-row">
                <div class="col-xs-12 full-width-in-thin ui-sortable" role="fb-container" widget="placeholder" id="17037480671334454"><div id="17037480962499846" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Complex Name and Unit Number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037480962499846" tabindex="26" class="form-control ">
        <input type="hidden" name="text_input-17037480962499846_params" value="group%3DAddress%26title%3DComplex+Name+and+Unit+Number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
            </div>
        <div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037480826174086"><div id="17037481130678525" widget="text_input" class="" role="fb-widget">
    <div class="form-group ">
                    <label class="control-label ">
                Street Number:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                <input type="text" name="text_input-17037481130678525" tabindex="27" class="form-control ">
        <input type="hidden" name="text_input-17037481130678525_params" value="group%3DAddress%26title%3DStreet+Number%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037480834701157"><div id="17037481271432338" widget="text_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Street Name:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037481271432338" tabindex="28" class="form-control " required="">
        <input type="hidden" name="text_input-17037481271432338_params" value="group%3DAddress%26title%3DStreet+Name%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037480845977241"><div id="17037481455067992" widget="text_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Suburb:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037481455067992" tabindex="29" class="form-control " required="">
        <input type="hidden" name="text_input-17037481455067992_params" value="group%3DAddress%26title%3DSuburb%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037480851771697"><div id="17037481583976320" widget="text_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Town:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037481583976320" tabindex="30" class="form-control " required="">
        <input type="hidden" name="text_input-17037481583976320_params" value="group%3DAddress%26title%3DTown%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="1703748085766516"><div id="17037481809166086" widget="text_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
                    <label class="control-label ">
                Postal Code:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="text" name="text_input-17037481809166086" tabindex="31" class="form-control " maxlength="4" required="">
        <input type="hidden" name="text_input-17037481809166086_params" value="group%3DAddress%26title%3DPostal+Code%26rules%3D">
        </div>        <div class="clearfix"></div>
    </div>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037480870637430"><div id="17037604275986512" widget="selectbox" class="form-horizontalFix" role="fb-widget">
    <div class="form-group ">
            <label class="control-label ">
            Province:</label>
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xxs-12 no-padding">
                <select name="selectbox-17037604275986512" tabindex="32" class="form-control">
            <option value="Eastern Cape">Eastern Cape</option>
<option value="Free State">Free State</option>
<option value="Gauteng">Gauteng</option>
<option value="KwaZulu-Natal">KwaZulu-Natal</option>
<option value="Limpopo">Limpopo</option>
<option value="Mpumalanga">Mpumalanga</option>
<option value="North West">North West</option>
<option value="Northern Cape">Northern Cape</option>
<option value="Western Cape">Western Cape</option>
        </select>
                <input type="hidden" name="selectbox-17037604275986512_params" value="group%3DAddress%26title%3DProvince%26rules%3D">
        </div>
    </div>
</div></div>
    </div></div>
    </fieldset>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037463540166508"><div id="17037481986019208" widget="fieldset" class="" data-role="layout" role="fb-widget">
    <fieldset>
                    <legend>                            Contact                        </legend>        
        <div id="content-17037481986019208" class="rsp-layout ">
            <div class="row" role="fb-row">
                <div class="col-xs-12 full-width-in-thin ui-sortable" role="fb-container" widget="placeholder" id="1703748198770864"><div id="17037482382675330" widget="phone_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Cellphone Number:</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="tel" tabindex="33" name="contact_phone_0" data-mask="****-***-****" class="form-control text-uppercase " required="">
        <input type="hidden" name="contact_phone_0_params" value="group%3DContact%26title%3DPhone%26rules%3D">
    </div>        <div class="clearfix"></div>
    </div>

</div></div>
            </div>
        <div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037482457797118"><div id="17037483074413198" widget="phone_input" class="" role="fb-widget">
    <div class="form-group has-feedback">
            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            Work Telephone Number:</label>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">                    <span class="glyphicon glyphicon-asterisk form-control-feedback text-danger" aria-hidden="true"></span>
                <input type="tel" tabindex="34" name="phone_input-17037483074413198_0" data-mask="****-***-****" class="form-control text-uppercase " required="">
        <input type="hidden" name="phone_input-17037483074413198_0_params" value="group%3DContact%26title%3DWork+Telephone+Number%26rules%3D">
    </div>        <div class="clearfix"></div>
    </div>

</div></div>
    </div></div>
    </fieldset>
</div></div>
    </div><div class="row" role="fb-row">
        <div class="full-width-in-thin col-xs-12 ui-sortable" role="fb-container" widget="placeholder" id="17037463564732743"><hr id="1703749978637600" widget="separator" role="fb-widget" class=""></div>
    </div><div class="row" role="fb-row" data-col="col-md-12">
        
    <div class="full-width-in-thin col-xs-12                                                                                                                                         col-md-12 ui-sortable" role="fb-container" widget="placeholder" id="17037494154761756"><div id="17037498555496739" widget="checkbox" class="" role="fb-widget">
<div class="form-group ">
            <label class="control-label ">
            &nbsp;                    </label>
                    <div class="checkbox-inline">
                                            <label class="control-label checkbox-inline">
                    <input type="checkbox" tabindex="35" class="checkbox-17037498555496739" value="Terms and conditions accepted">
                    <p>I have read and accept the <a href="terms-and-conditions.html" target="_blank">terms and conditions</a></p>                </label>
                    </div>
    
    <input class="fbr-value" type="hidden" name="checkbox-17037498555496739" value="">
    <input type="hidden" name="checkbox-17037498555496739_params" value="group%3DPersonal%26title%3DTerms+and+Conditions%26rules%3D">
    </div>
</div></div></div>        
    <div class="text-center">
                    <p class="text-muted text-center">
                <span class="glyphicon glyphicon-asterisk text-danger"></span>
                - indicates required fields            </p>
                  

        <div class="form-group">
                    <label class="control-label">
                Password:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                    <input type="password" name="password" tabindex="36" class="form-control" required>
                </div>
                <div class="clearfix"></div>
            </div>

        <div class="form-group">
                    <label class="control-label">
                Confirm Password:</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                    <input type="password" name="confirm_password" tabindex="37" class="form-control" required>
                </div>
                <div class="clearfix"></div>
            </div>

        <button class="btn btn-primary btn-fb-submit" type="submit">
            <span class="fa fa-check"></span> Submit        </button>
    </div>
</form>            
                        </div>
    </div>
    </div>
<script type="text/javascript">
    $(function() {
        var customRedirectionUrl = '';
        var $formSaverForm = $(".modul-r-formbuilder form");
        $formSaverForm.formSaver();
        $formSaverForm.formSaver("reset");

        $formSaverForm.find('.success-form-btn').click(function () {
            window.location.replace(
                    customRedirectionUrl.length
                            ? customRedirectionUrl
                            : window.location.href.split('#')[0]
            );
        });

        $formSaverForm.on('keypress', '.input-upload', function (e) {
            if (e.which == '13') {
                $(this).trigger('click');
                return false;
            }
        });
    });
    $.getScript('js/maf/listyears.js', function () {
        $(document).trigger('update_layout.mapfb');
    });
    </script>
<div class="widget-spacer">
	  <div 
			class="h3"
	  	>
    &nbsp;
    </div>
</div></div></div>
 </div>
        </main>
        <footer>
            <div class="layout-container container" data-container="footer">

            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_0_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed2e28d68                        nowow"
    >
    <div>
                    <style type="text/css"></style>
    <div>
            <div class="layout-container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			style="height:10px;"
	  	>
    &nbsp;
    </div>
</div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_0" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>BUY</h3>
    </header>
    <ul>
      <li><a href="simulcast-calendar.html">Auctions</a></li>
        <li><a href="media/dealer_101/storage/docs/Auction_Calculator.pdf" target="_blank">Auction Calculator</a></li>
        <li><a href="/#" id="js-searchLink" data-toggle="modal" >Search</a> </li>
        <li><a href="terms-and-conditions.html">Terms and conditions</a></li>
        <li><a href="frequently-asked-questions.html">FAQ</a></li>
        <li><a href="our-banking-details.php">Banking details</a></li>
    </ul>
</section>
<script type="text/javascript">
  $(function(){
    var targetLink = $('.js-headerSearch').parents('.btn').data().target;
    
    $('#js-searchLink').attr('data-target', targetLink);
  });
</script>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_1" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>QUICK LINKS</h3>
    </header>
    <ul>
         <li><a href="https://www.mfc.co.za/budget-calculator" target="_blank">Budget calculator</a></li>
         <li><a href="simulcast-calendar.html">Upcoming auctions</a></li>
         <li><a href="media/dealer_101/storage/docs/STEP_BY_STEP_ONLINE_AUCTION_GUIDE__1_.pdf" target="_blank">Step-by-step guide</a></li>
         <li><a href="media/dealer_101/storage/docs/MFC_Auction_House_Directions_GPS.pdf" target="_blank">Map and directions</a></li>
      <li><a href="https://www.mfc.co.za/finance-options" target="_blank">Finance options</a></li>
    </ul>
</section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_2" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-links">
    <header>
        <h3>Contact Us</h3>
    </header>
    <ul class="footer-phones">
		<li><a href="tel:081 003 2073"><i class="fa fa-phone" aria-hidden="true"></i>081 003 2073</a></li>
      <li><a href="mailto:MFCAuctionhouse@mfc.co.za"><i class="fa fa-envelope" aria-hidden="true"></i>Get in touch</a></li>
    </ul>
</section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div><div class="ax-container empty col-lg-3 col-md-3 col-sm-6 col-xs-6  thin" data-container="body_1_3" data-size-lg="3"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
  <style>
  .footer-socials{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 210px;
        }
        .footer-socials img{
            height:100%;
            width: 20px;
            max-height: 20px;
            filter: invert(1);
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .footer-socials a:hover > img{
            filter: invert(1);
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
    .footer-socials a{
      background: #cfcfd0;
      color: #fff;
      width: 36px;
      height: 36px;
      margin-right: 3px;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-facebook{
      background:#1877F2;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-twitter{
      background:#000;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-youtube{
      background:#ff0000;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-linkedin{
      background:#00A0DC;
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-instagram{
      background: linear-gradient(to bottom, #833ab4 0%,#fd1d1d 50%,#fcaf45 100%);
      transition: all 0.3s ease;
    }
    .footer-socials a.footer-icn-instagram:hover{
      background: linear-gradient(to bottom, #195e4a 0%,#195e4a 50%,#195e4a 100%);
      transition: all 0.3s ease;
    } 
    .footer-socials a:hover{
      background:#195e4a;
      transition: all 0.3s ease;
    }
  </style>
<section class="footer-links">
    <header>
        <h3>STAY CONNECTED</h3>
    </header>
   <section class="footer-socials">
        <a href="https://www.facebook.com/MFCSouthAfrica" class="footer-icn-facebook" target="_blank" title="We are on Facebook">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-facebook.svg">
        </a>
        <a href="https://twitter.com/mfc_sa"  class="footer-icn-twitter" target="_blank" title="Follow Us on Twitter">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-twitter.svg">
        </a>
        <a href="http://www.youtube.com/channel/UCeXBKw_dfIV51ZiXFaLURHg" class="footer-icn-youtube" target="_blank" title="Watch Us on Youtube">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-youtube.svg">
        </a>
        <a href="https://www.linkedin.com/company/mfc-a-division-of-nedbank" class="footer-icn-linkedin" target="_blank" title="Send your CV">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-linkedin.svg">
        </a>
        <a href="https://www.instagram.com/mfc_sa" class="footer-icn-instagram" target="_blank" title="We are on Instagram">
            <img src="https://autoxloo.com/landing/social_ico/foo-icn-instagram.svg">
        </a>
    </section>

</section>
</dev>
        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  hidden-lg hidden-md hidden-sm hidden-xs thin" data-container="body_2_0" data-size-lg="12" data-hidden-lg="1" data-hidden-md="1" data-hidden-sm="1" data-hidden-xs="1"><div class="widget-spacer">
	  <div 
			style="height:20px;"
	  	>
    &nbsp;
    </div>
</div><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
  <style>
    .footer-partners{
    list-style-type:none;
    margin:0px;
    padding:0px;
    display:flex;
    justify-content:space-evenly;
    align-items:center;
    filter: grayscale(1);
	opacity: 0.6;
    }
  </style>
<section>
    <ul class="footer-partners">
    <li>
      	<a href="https://auctionstreaming.com/" target = "_blank">
        	<img alt="auctionstreaming" src="media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
      	</a>
      </li>
<!--
    <li>
      <a href="https://www.nextgearcapital.com" target = "_blank">
        <img src="/media/dealer_101/storage/webstorage/partner-nextgear.svg" alt="Nextgear" />
      </a>
      </li>
    <li>
      <a href="https://www.autocheck.com" target = "_blank">
        <img src="/media/dealer_101/storage/webstorage/partner-autocheck.svg" alt="Autocheck" />
      </a>
      </li>
-->
    </ul>
</section>
</dev>
        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_3_0" data-size-lg="12"><div class="widget-spacer">
	  <div 
			style="height:20px;"
	  	>
    &nbsp;
    </div>
</div></div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_4_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<style>
  .footer-links h3{
    font-size:15px;
    font-weight:bold;
    text-transform:uppercase;
    color:#004d36;
  }
  .footer-links ul{
    list-style-type:none;
    margin:0px;
    padding:0px;
  }
  .footer-links li{
	font-size: 14px;
    color: #58585A;
    padding-bottom: 5px;
    display: flex;
    align-items: center;
  }
  .footer-links li a{
    color:#58585A;
    text-decoration:none;
  }
  .footer-links li a:hover{
    color:#004d36;
  }
  .footer-links li a:visited{
    color:#58585A;
    text-decoration:none;
  }
  .footer-phones .fa{
	background: #cfcfd0;
    color: #fff;
    font-size: 18px;
    width: 36px;
    height: 36px;
    margin-right: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
  }
  .footer-phones li a{
    display: flex;
    align-items: center;
  }
  .footer-phones li a:hover > .fa{
    background: #006341;
    transition: all 0.3s ease;
  }
  .footer-partners li {
    margin:0 0 10px;
  }
  .footer-partners img{
    max-width:170px;
    max-height:70px;
  }
  .modul-copyright{
    font-size:12px;
    padding: 10px 0 0;
    position:relative;
    color: #f5f5f5;
  }
  .modul-copyright a{
    color:#00b388;
  }
  .modul-copyright a:hover{
    color: #03f4a9;
  }

  footer{
    background: #006341;
    position:relative;
  }
  footer:before{
    position:absolute;
    content:'';
    width:100%;
    height:38px;
    background:#006341;
    left:0px;
    bottom:0px;
    z-index:0;
  }
  footer:after{
    position:absolute;
    content:'';
    z-index:1;
    top:0;
    width:100%;
    height:10px;
    background: #f2f9f5; 
}
  .footer-no {
    display:flex;
    flex-direction: row-reverse;
    align-items: center;
    margin: 10px 0 0;
    justify-content: space-between;
  }
  .footer-no p{
    font-size:14px;
    color:#f5f5f5;
    text-align:right;
    margin-bottom: 0px;
    margin-right:-380px;
  }
  .footer-no img{
    max-width:70px;
    margin: 0 0 0 25px;
  }
      .footer-no a.as-logo img{
      max-width:170px;
    }
  @media all and (max-width:1279px){
    footer:before {
    height: 60px;
	}
    .footer-no p {
    margin-right: -240px;
}
  }
    @media all and (max-width:1199px){
    .footer-no p {
    margin-right: -190px;
}
  }
     @media all and (max-width:1023px){
   .footer-no p {
    margin-right: 0px;
    text-align: center;
}
  }
      @media all and (max-width:768px){
    footer:before {
    height: 100px;
}
.footer-no {
    flex-direction: column;
    }
     .footer-no p {
    margin: 20px 0;
}
    .footer-no a.as-logo img {
    margin: 0 0 20px 0;
}
  }
  </style>
</dev>

        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 </div>
    </div>
            </div>
    <div class="clearfix"></div>
</div>

<script>
    var screenSize = screenSize || function (width) {
        var currentSize;

        if (width < $SESSIONDATA.sm_width) {
            currentSize = 'xs';
        } else if (width < $SESSIONDATA.md_width) {
            currentSize = 'sm';
        } else if (width < $SESSIONDATA.lg_width) {
            currentSize = 'md';
        } else {
            currentSize = 'lg';
        }

        return currentSize;
    };

    $(function() {
        var fullWidth = false,
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(242,249,245,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed2e28d68'),
            isFluidWrapper = !$module.closest('.layout-container').hasClass('container-fluid'),
            $window = $(window),
            sizes = [],
            resizeTimer;

        if (fullWidth && !data) {
            if (isFluidWrapper) {
                $module.children().addClass('container');
            }
        } else if (data) {
            // Determine sizes
            for (var size in data) {
                if (data.hasOwnProperty(size) && data[size]['bg_filling'] === 'full_width') {
                    sizes.push(size);
                }
            }

            if (sizes.length) {
                windowResize();

                $window.on('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(windowResize, 250);
                });
            }
        }

        function windowResize() {
            var currentSize = screenSize(window.innerWidth);

            if (sizes.indexOf(currentSize) !== -1) {
                $module.addClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().addClass('container');
                }
            } else {
                $module.removeClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().removeClass('container');
                }
            }
        }
    });
</script>
</div></div>
 
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="footer_1_0" data-size-lg="12">
<div class="modul-r-container
            container-6981ed2e28d8e                        nowow"
    >
    <div>
                    <style type="text/css"></style>
    <div>
            <div class="layout-container" data-container="body">
            
   <div class="row"><div class="ax-container empty col-lg-12 col-md-12 col-sm-12 col-xs-12  " data-container="body_0_0" data-size-lg="12"><div class="modul-r-editable nowow">
            <!-- no_designtime_scripts -->
        <dev>
<section class="footer-no">
  <a href="https://personal.nedbank.co.za/home.html" target = "_blank">
  <img src="https://www.mfc.co.za/content/dam/nedbank/icons/resources/logo.svg" alt="NedBank">
  </a>
  <p>
Nedbank Ltd Reg. No 1951/000009/06<br>
Authorised financial services and registered credit provider (NCRCP16)
  </p>
  <a class="as-logo" href="https://auctionstreaming.com/" target = "_blank">
  	<img alt="auctionstreaming" src="media/dealer_101/storage/webstorage/partner-auctionstreaming.svg" alt="Auctionstreaming"/>
  </a>
  </section>
</dev>        <!-- endof_no_designtime_scripts -->
    </div></div></div>
 </div>
    </div>
            </div>
    <div class="clearfix"></div>
</div>

<script>
    var screenSize = screenSize || function (width) {
        var currentSize;

        if (width < $SESSIONDATA.sm_width) {
            currentSize = 'xs';
        } else if (width < $SESSIONDATA.md_width) {
            currentSize = 'sm';
        } else if (width < $SESSIONDATA.lg_width) {
            currentSize = 'md';
        } else {
            currentSize = 'lg';
        }

        return currentSize;
    };

    $(function() {
        var fullWidth = false,
            data = {"active_tab":"lg","lg":{"inherited":"none","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"md":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"sm":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"},"xs":{"inherited":"lg","bg_filling":"full_width","background-image":"","background-color":"rgba(0,99,65,1)","background-position-x":"center","background-position-y":"top","background-size":"auto","background-repeat":"no-repeat","background-attachment":"scroll"}},
            $module = $('.container-6981ed2e28d8e'),
            isFluidWrapper = !$module.closest('.layout-container').hasClass('container-fluid'),
            $window = $(window),
            sizes = [],
            resizeTimer;

        if (fullWidth && !data) {
            if (isFluidWrapper) {
                $module.children().addClass('container');
            }
        } else if (data) {
            // Determine sizes
            for (var size in data) {
                if (data.hasOwnProperty(size) && data[size]['bg_filling'] === 'full_width') {
                    sizes.push(size);
                }
            }

            if (sizes.length) {
                windowResize();

                $window.on('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(windowResize, 250);
                });
            }
        }

        function windowResize() {
            var currentSize = screenSize(window.innerWidth);

            if (sizes.indexOf(currentSize) !== -1) {
                $module.addClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().addClass('container');
                }
            } else {
                $module.removeClass('container-full-width');

                if (isFluidWrapper) {
                    $module.children().removeClass('container');
                }
            }
        }
    });
</script>
</div></div>
 
        <div class="modul-copyright  nowow cprt__hover_null mcprt_font-s_12">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-left text-xs-center text-xxs-center">
                                  <p>Auction Management Solutions By: <a class="mcprt-link" href="https://auctionstreaming.com/" rel="nofollow" target="_blank">Auction Streaming</a></p>

                            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-right text-xs-center text-xxs-center pull-right ">
                                  <p>Powered by: <a class="mcprt-link" href="https://webxloo.com/" rel="nofollow" target="_blank">Webxloo</a></p>

                            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                                <a class="mcprt-link" href="/">
                    2026 &copy; NedbankMFC</a>
                            </div>
        </div>
    </div>

    
</div>
        </footer>
    </div>
</body>
<!--0.38912415504456-->

<!-- Mirrored from www.mfcauctions.co.za/register by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Feb 2026 12:43:01 GMT -->
</html>
