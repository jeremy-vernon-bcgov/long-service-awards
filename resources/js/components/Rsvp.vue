<template>
        <!-- Main form -->
    <form @submit.prevent="submit">
        <!-- Initial section - only the following two will be available.
             RSVP - radio
             Guest - radio
        -->
        <!-- RSVP acknowledgement -->
        <h3>RSVP</h3>
        <div class="form-group">
            <p class="title-rsvp" > Will you attend? </p>
            <input type="radio" name="rsvp" id="rsvp-true" value="true" v-model="fields.rsvp" required="required">
            <label type="radio" for="rsvp-true">yes</label>
            <input type="radio" name="rsvp" id="rsvp-false" value="false" v-model="fields.rsvp" required="required" >
            <label type="radio" for="rsvp-false">no </label>
            <!-- Error -->
            <div v-if="errors && errors.rsvp " class="text-danger">{{ errors.rsvp[0] }}</div>
        </div>
        <!-- Guest section -->
        <div class="form-group" v-show="fields.rsvp === 'true'">
            <p> Will you bring a guest? </p>
            <input type="radio" name="guest" id="guest-rsvp-true" value="true" v-model="fields.guest"  >
            <label type="radio" for="guest-rsvp-true">yes</label>
            <input type="radio" name="guest" id="guest-rsvp-false" value="false" v-model="fields.guest" >
            <label type="radio" for="guest-rsvp-false">no</label>
            <!-- Error -->
            <div v-if="errors && errors.guest" class="text-danger">{{ errors.guest[0] }}</div>
        </div>
        <!------------------------
            Accessibility section.
            ------------------------>
        <div  v-show="fields.rsvp === 'true'">
            <h3>Inclusivity</h3>
            <p>The Long Service Awards ceremonies are welcoming and accessible events.</p>
            <p>Government House has gender-neutral washroom facilities. </p>
            <p>Check the <a href="https://longserviceawards.gww.gov.bc.ca/ceremony/%5d" target="_blank">Ceremony page</a> for specific locations or contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a> with questions.</p>
        </div>
        <!--
            Recipient Accessibility section.
                - Recipient accessibility radio.
                - Recipient accessibility checkbox.
                - Recipient accessibilty other.
        -->
        <div v-show="fields.rsvp === 'true'">
            <h3>Accessibility Requirements</h3>
            <p>To ensure you and your guest can enjoy the festivities, please share your accessibility requirements with us.</p>
            <p>If you'd like a preview of accessible facilities at Government House including ramps, elevators and washroom facilities, visit the <a href="https://longserviceawards.gww.gov.bc.ca/ceremony/%5d" target="_blank">Ceremony page</a>.</p>
            <p>If you have questions or wish to connect with a member of the Long Service Awards team directly, contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a></p>
        </div>
        <div class="form-group">
            <fieldset class="form-group" name="accessibility" id="accessibility_group" v-show="fields.rsvp === 'true'">
                <div class="access-reqs" v-show="fields.rsvp === 'true'">
                    <p><strong> Do you require accessibility considerations? </strong></p>
                    <input type="radio" name="access_group_recip" id="access_form_recipient_true" value="true" v-model="fields.access_group_recip">
                    <label type="radio" for="access_form_recipient_true">yes</label>
                    <input type="radio" name="access_group_recip" id="access_form_recipient_false" value="false" v-model="fields.access_group_recip">
                    <label type="radio" for="access_form_recipient_false">no</label>
                    <div v-if="errors && errors.access_group_recip" class="text-danger">{{ errors.access_group_recip[0] }}</div>
                 </div>
                <fieldset class="form-group" name="access-group-recip" id="access_form_recipient" v-show="fields.access_group_recip === 'true'">
                    <p>I require:</p>
                    <div v-if="errors && errors.recip_access_checkbox" class="text-danger">{{ errors.recip_access_checkbox[0] }}</div>
                    <!-- Add in all accessibility restrictions in foreach from db -->
                    <div v-for="access in $attrs.userdata.access" :key="access.short_name">
                        <input type="checkbox" v-bind:id="access.short_name" :value="access.short_name" v-model="fields.recip_access_checkbox">
                        <label class="block font-medium text-sm text-gray-700" :for="access.short_name"> {{ access.description }}</label>
                    </div>
                    <div class="other"  v-show="inArray('Other', fields.recip_access_checkbox)"> <!-- our own inArray method -->
                        <textarea class="form-control" cols="100" rows="6" name="recip_access_other" id="recip_access_other" v-model="fields.recip_access_other"></textarea>
                        <label for="recip_access_other">Please specify (255 characters max)</label>
                        <div v-if="errors && errors.recip_access_other" class="text-danger">{{ errors.recip_access_other[0] }}</div>
                    </div>
                </fieldset>
                <!--
                Guest Accessibility section.
                    - Guest accessibility radio.
                    - Guest accessibility checkbox.
                    - Guest accessibilty other.
                -->
                <div class="access-reqs" v-show="fields.guest === 'true'">
                    <p><strong>Does your guest require accessibility considerations?</strong></p>
                    <input type="radio" name="guest_access" id="guest_access_true" value="true" v-model="fields.guest_access">
                    <label type="radio" for="guest_access_true">yes</label>
                    <input type="radio" name="guest_access" id="guest_access_false" value="false" v-model="fields.guest_access">
                    <label type="radio" for="guest_access_false">no</label>
                    <div v-if="errors && errors.guest_access" class="text-danger">{{ errors.guest_access[0] }}</div>
                </div>
                <fieldset class="form-group" name="access-group-guest" id="accessible_form_guest"  v-show="fields.guest_access === 'true'">
                    <p>My guest requires:</p>
                    <div v-if="errors && errors.guest_access_checkbox" class="text-danger">{{ errors.guest_access_checkbox[0] }}</div>
                    <!-- Add in all accessibility restrictions in foreach -->
                    <div v-for="access in $attrs.userdata.access" :key="access.short_name">
                        <input type="checkbox" v-bind:id="access.short_name" :value="access.short_name" v-model="fields.guest_access_checkbox">
                        <label class="block font-medium text-sm text-gray-700" :for="access.short_name"> {{ access.description }}</label>
                    </div>
                    <div class="other" v-show="inArray('Other', fields.guest_access_checkbox)">
                        <textarea cols="100" rows="6" name="guest_access_other" id="guest_access_other" v-model="fields.guest_access_other"></textarea>
                        <label for="guest_access_other">Please specify (255 characters max)</label>
                        <div v-if="errors && errors.guest_access_other" class="text-danger">{{ errors.guest_access_other[0] }}</div>
                    </div>
                </fieldset>
            </fieldset>
        </div>


        <!-------------------------------------------
            Dietary section
            ------------------------------------------>
        <div v-show="fields.rsvp === true">
            <h3>Dietary Requirements</h3>
            <p>To ensure we have menu options that will accommodate your dietary restrictions and allergies, please indicate your requirements.</p>
        </div>
        <div class="form-group">
            <!--
            Recipient Dietary section.
                - Recipient Dietary radio.
                - Recipient Dietary checkbox.
                - Recipient Dietary other.
            -->
            <fieldset class="form-group" name="dietary" id="dietary_group" v-show="fields.rsvp === 'true'">
                <fieldset class="form-group" name="diet-group-recip" id="diet_form_recipient" >
                    <!-- Guest dietary radio yes/no -->
                    <div class="diet-reqs" v-show="fields.rsvp === 'true'">
                        <p><strong>Do you have dietary requirements or allergies we should be made aware of? </strong></p>
                        <input type="radio" name="recipient_diet" id="recipient_diet_true" value="true" v-model="fields.recipient_diet">
                        <label type="radio" for="recipient_diet_true">yes</label>
                        <input type="radio" name="recipient_diet" id="recipient_diet_false" value="false" v-model="fields.recipient_diet">
                        <label type="radio" for="recipient_diet_false">no</label>
                        <div v-if="errors && errors.recipient_diet" class="text-danger">{{ errors.recipient_diet[0] }}</div>
                    </div>
                    <div class="diet-check" v-show="fields.recipient_diet==='true'">
                        <p>My dietary requirements are:</p>
                        <div v-if="errors && errors.recip_diet_checkbox" class="text-danger">{{ errors.recip_diet_checkbox[0] }}</div>
                        <!-- Add in all dietary restrictions checkboxes in foreach -->
                        <div v-for="diet in $attrs.userdata.diet" :key="diet.short_name">
                            <input type="checkbox" v-bind:id="diet.short_name" :value="diet.short_name" v-model="fields.recip_diet_checkbox">
                            <label class="block font-medium text-sm text-gray-700" :for="diet.short_name"> {{diet.short_name}}</label>
                        </div>
                    </div>
                    <!-- recipient dietary restrictions other textblock -->
                    <div class="other" v-show="inArray('Other', fields.recip_diet_checkbox)">
                        <textarea class="form-control" cols="100" rows="6" name="recip_diet_other" id="recip_diet_other" v-model="fields.recip_diet_other"></textarea>
                        <label class="block font-medium text-sm text-gray-700" for="recip_diet_other">Please specify (255 characters max)</label>
                        <div v-if="errors && errors.recip_diet_other" class="text-danger">{{ errors.recip_diet_other[0] }}</div>
                    </div>
                </fieldset>

                <fieldset class="form-group" name="diet-group-diet" id="diet_form_guest" v-show="fields.guest==='true'">
                    <!--
                    Guest Dietary section.
                        - Guest Dietary radio.
                        - Guest Dietary checkbox.
                        - Guest Dietary other.
                    -->
                    <!-- Guest dietary radio yes/no -->
                    <div class="diet-reqs" >
                    <p><strong>Does your guest have dietary requirements or allergies we should be made aware of?</strong></p>
                        <input type="radio" name="guest_diet" id="guest_diet_true" value="true"  v-model="fields.guest_diet">
                        <label type="radio" for="guest_diet_true">yes</label>
                        <input type="radio" name="guest_diet" id="guest_diet_false" value="false" v-model="fields.guest_diet">
                        <label type="radio" for="guest_diet_false">no</label>
                        <div v-if="errors && errors.guest_diet" class="text-danger"> {{ errors.guest_diet[0] }} </div>
                    </div>
                    <div class="diet_check" v-show="fields.guest_diet ==='true'">
                        <p>My guest's dietary requirements are:</p>
                        <div v-if="errors && errors.guest_diet_checkbox" class="text-danger">{{ errors.guest_diet_checkbox[0] }}</div>
                        <!-- Add in all dietary restrictions checkboxes in foreach -->
                        <div v-for="diet in $attrs.userdata.diet" :key="diet.short_name" >
                            <input type="checkbox" v-bind:id="diet.short_name" :value="diet.short_name" v-model="fields.guest_diet_checkbox">
                            <label class="block font-medium text-sm text-grey-700" :for="diet.short_name"> {{ diet.short_name }}</label>
                        </div>
                    </div>

                    <!-- Guest dietary other textbox -->
                    <div class="other" v-show="inArray('Other', fields.guest_diet_checkbox)" >
                        <textarea class="form-control" name="guest_diet_other" id="guest_diet_other" cols="100" rows="6" v-model="fields.guest_diet_other" > </textarea>
                        <label class="block font-medium text-sm text-gray-700" for="recip_diet_other">Please specify (255 characters max)</label>
                        <div v-if="errors && errors.guest_diet_other" class="text-danger">{{ errors.guest_diet_other[0] }}</div>
                    </div>
                </fieldset>
            </fieldset>
        </div>
        <!--------------------------------------
        Retirement Section
        ---------------------------------------->
        <div class="retirement-section" v-show="fields.rsvp === 'true' || fields.rsvp === 'false'"> <!-- we only want this to show after an rsvp selection is made -->
            <fieldset class="form-group" name="retirement" id="retirement-fieldset">
                <div id="retirement-fields">
                    <!-- Retirement status radio y/n -->
                    <p>Are you retiring before your Long Service Awards ceremony?</p>
                    <input type="radio" name="retirement_status" id="retirement_status_true" value="true"  v-on:change="preferChange" v-model="fields.retirement_status">
                    <label type="radio" for="retirement_status_true">yes</label>
                    <input type="radio" name="retirement_status" id="retirement_status_false" value="false" v-model="fields.retirement_status">
                    <label type="radio" for="retirement_status_false">no</label>
                    <div v-if="errors && errors.retirement_status" class="text-danger"> {{ errors.retirement_status[0] }} </div>
                    <!-- Retirement date (date) -->
                    <div class="date" v-show="fields.retirement_status === 'true'">
                        <label class="block font-medium text-sm text-gray-700" for="retirement_date">  When are you retiring? </label>
                        <input type="date" id="retirement_date" name="retirement_date" v-model="fields.retirement_date">
                        <div v-if="errors && errors.retirement_date" class="text-danger"> {{ errors.retirement_date[0] }} </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <!------------------------------
            Contact information section.
            ------------------------------->
        <div class="form-group">
            <fieldset class="form-group" name="contact-info" id="contact-info-fieldset" v-show="fields.rsvp === 'false' && fields.retirement_status === 'false'">
                <div id="contact-details-preamble">
                    <p>Please confirm your office address so we can ensure you receive your Long Service Award.</p>
                    <p>Employees in Victoria should provide their office's physical address.</p>
                </div>
                <!--
                Address fields.
                -->
                <div id="gift-location-address">
                    <div>
                        <!-- optional -->
                        <label class="block font-medium text-sm text-gray-700" for="gift_location_floor"> Floor/room/care of: </label>
                        <input type="text" name="gift_location_floor" id="gift_location_floor" v-model="fields.gift_location_floor" />
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="gift_location_suit"> suite  </label>
                        <input type="text" name="gift_location_suit" id="gift_location_suit" v-model="fields.gift_location_suit" />
                        <div v-if="errors && errors.gift_location_suit" class="text-danger"> {{ errors.gift_location_suit[0] }} </div>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="gift_location_addr"> address: </label>
                        <input type="text" name="gift_location_addr" id="gift_location_addr" v-model="fields.gift_location_addr" />
                        <div v-if="errors && errors.gift_location_addr" class="text-danger"> {{ errors.gift_location_addr[0] }} </div>

                    </div>
                    <div>
                        <label class="block font-medium text-sm text-grey-700" for="community" > office community </label>
                        <select name="gift_location_community" id="community" v-model="fields.gift_location_community" >
                            <option v-for="communities in $attrs.userdata.communities" :value="communities.id">{{ communities.name }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="gift_location_postal"> postal code: </label>
                        <input type="text" name="gift_location_postal" id="gift_location_postal" v-model="fields.gift_location_postal" />
                        <div v-if="errors && errors.gift_location_postal" class="text-danger"> {{ errors.gift_location_postal[0] }} </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <!-- Contact update radio yes/no  - only really need this is they are not retiring. -->
        <div id="contact-update" v-show="fields.rsvp === 'true' && fields.retirement_status === 'false'">
            <p>Has your contact information changed since you registered?</p>
            <!-- Gift location radio yes/no -->
            <input type="radio" name="contact_update" id="contact_update_true" value="true"  v-model="fields.contact_update">
            <label type="radio" for="contact_update_true">yes</label>
            <input type="radio" name="contact_update" id="contact_update_false" value="false" v-model="fields.contact_update">
            <label type="radio" for="contact_update_false">no</label>
            <div v-if="errors && errors.contact_update" class="text-danger"> {{ errors.contact_update[0] }} </div>
        </div>
        <!--
            Email/Phone update.
            This shows for an RSVP if they note they want to update their contact info.
            This also shows for non-RSVP as part of the gift send.
            This also shows if the user notes that they are retiring.
            -->
        <div class="retire-address" v-show="fields.retirement_status === 'true'">
            <div id="retirement-note">
                How can we contact you after that date?
            </div>
        </div>
        <div class="preferred-contact" v-show="(fields.retirement_status === 'true' || fields.contact_update === 'true' || fields.rsvp === 'false') && (fields.retirement_status === 'true' || fields.retirement_status === 'false')">
            <div class="Form-group">
                <fieldset class="form-group" name="preferred-contact" id="preferred-contact-fieldset">
                    <div id="preferred-contact-fields">
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="home_email"> Home email: </label>
                            <input type="text" name="home_email" id="home_email" v-model="fields.home_email" />
                            <div v-if="errors && errors.home_email" class="text-danger"> {{errors.home_email[0] }}</div>
                        </div>
                        <div v-show="fields.retirement_status === 'false'">
                            <label class="block font-medium text-sm text-gray-700" for="office_email"> Office email: </label>
                            <input type="text" name="office_email" id="office_email" v-model="fields.office_email" />
                            <div v-if="errors && errors.office_email" class="text-danger"> {{errors.office_email[0] }}</div>
                        </div>
                        <div>
                            <label v-show="fields.retirement_status === 'true'" class="block font-medium text-sm text-gray-700" for="preferred_phone"> Home phone: </label>
                            <label v-show="fields.retirement_status !== 'true'" class="block font-medium text-sm text-gray-700" for="preferred_phone"> Office Phone: </label>
                            <input type="text" name="preferred_phone" id="preferred_phone" v-model="fields.preferred_phone" />
                            <div v-if="errors && errors.preferred_phone" class="text-danger"> {{errors.preferred_phone[0] }}</div>
                        </div>
                    </div>
                    <div id="preferred-select" v-show="fields.retirement_status === 'false' && (fields.contact_update === 'true'|| fields.rsvp === 'false')"  >
                        <p>Which email would you prefer we use?</p>
                        <input type="radio" name="prefer_contact" id="prefer_contact_home" value="home"  v-model="fields.prefer_contact">
                        <label type="radio" for="prefer_contact_home">Home</label>
                        <input type="radio" name="prefer_contact" id="prefer_contact_office" value="office" v-model="fields.prefer_contact">
                        <label type="radio" for="prefer_contact_office">Office</label>
                        <div v-if="errors && errors.prefer_contact" class="text-danger"> {{ errors.prefer_contact[0] }} </div>
                    </div>
                </fieldset>
            </div>
        </div>


        <!--------------------------
            Submit button.
            ------------------------->
        <div class="form-group">
            <button type="submit" class="btn btn-primary" >
                Submit
            </button>
        </div>

    </form>
</template>

<script>
    // Form related JS for Vue.
    export default {
        data() {
            return {
                fields: {
                    recip_access_checkbox: [],
                    guest_access_checkbox: [],
                    recip_diet_checkbox: [],
                    guest_diet_checkbox: [],
                    prefer_contact: 'office',
                },
                errors: {},
            }
        },
        methods: {
            inArray: function (needle, haystack) {
                let length = haystack.length;
                for(let i=0; i < length; i++) {
                    if(haystack[i] === needle) {
                        return true;
                    }
                }
                return false;
            },
            preferChange: function () {
              if(this.fields.retirement_status === 'true') {
                  // Defaults to home contact for retired users.
                  this.fields.prefer_contact = 'home';
              }  // No else statement because current employees choose either.
            },
            submit: function () {
                this.errors = {};
                axios.post('/rsvp', this.fields).then(response => {
                    alert('Message sent!');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
        },
    }

</script>
