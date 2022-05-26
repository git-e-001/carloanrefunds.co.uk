<template>
    <div>
        <div v-show="address.visible" class="prev-address well" v-for="(address, key) in addresses">
            <hr v-if="key !== 0">
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">Postcode</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type="text"
                               class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][postcode]'" :data-key="key"
                               data-field="postcode" v-bind:value="address.postcode">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">Address Line 1</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type="text"
                               class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][line_1]'" :data-key="key"
                               data-field="address_line_1" v-bind:value="address.address_line_1">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">Address Line 2</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input type="text" class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][line_2]'" :data-key="key"
                               data-field="address_line_2" v-bind:value="address.address_line_2">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">Address Line 3</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input type="text" class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][line_3]'" :data-key="key"
                               data-field="address_line_3" v-bind:value="address.address_line_3">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">City</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input type="text" class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][city]'" :data-key="key" data-field="city"
                               v-bind:value="address.city">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-12 text-lg-right">
                        <label class=" control-label">Country</label>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <input type="text" class="form-control input-md previous-address-field"
                               v-bind:name="'previous_addresses[' + key + '][county]'" :data-key="key"
                               data-field="county"
                               v-bind:value="address.county">
                    </div>
                </div>
            </div>
        </div>

        <div v-if="visible_addresses == 50" class="form-group">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-danger">
                        We are sorry but we can only collect 5 previous addresses on this application form. We do need
                        all of
                        your previous addresses, so if you need to add more than 5 please email them to <a
                        href="mailto:claimsteam@carloanrefunds.co.uk">claimsteam@carloanrefunds.co.uk</a> or call us
                        on
                        01284 544733.
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="form-group text-center">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-12 text-lg-right"></div>
                <div class="col-lg-4 col-md-12">
                    <button type="button" class="btn btn-primary" v-on:click="showAddress()"><i
                        class="fa fa-plus"></i> Address
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        if (this.addresses.length === 0) {
            for (let i = 0; i <= 50; i++) {
                this.addAddress(i === 0);
            }
        }

        if (this.prefillAddresses){
            let self = this;
            jQuery.each(this.prefillAddresses, function (key, address) {
                if (address.city || address.county || address.line_1 || address.line_2 || address.line_3 || address.postcode){
                    self.showAddress()
                }
            });
        }
    },

    computed: {
        isHr() {
            return this.addresses.length
        }
    },
    props: ['prefillAddresses'],

    data: function () {
        return {
            visible_addresses: 0,
            addresses: (typeof this.prefillAddresses !== 'object')
                ? [] : this.prefillAddresses
        }
    },

    methods: {
        saveValues: function () {
            let self = this;
            jQuery('.previous-address-field').each(function () {
                self.addresses[jQuery(this).data('key')][jQuery(this).data('field')] = jQuery(this).val();
            });
        },
        addAddress: function (visible) {
            let self = this;
            Vue.nextTick(function () {
                self.saveValues();

                Vue.nextTick(function () {
                    self.addresses.push({
                        visible: visible,
                        address_line_1: '',
                        address_line_2: '',
                        address_line_3: '',
                        city: '',
                        county: ''
                    });

                    self.countVisibleAddresses();
                });
            });
        },
        countVisibleAddresses: function () {
            let self = this;

            self.visible_addresses = 0;
            jQuery.each(self.addresses, function (key, address) {
                if (address.visible) {
                    self.visible_addresses++;
                }
            });
        },
        showAddress: function () {
            let self = this;
            Vue.nextTick(function () {
                self.saveValues();

                Vue.nextTick(function () {
                    let found = false;
                    jQuery.each(self.addresses, function (key, address) {
                        if (!found) {
                            if (!address.visible) {
                                address.visible = true;

                                found = true;
                            }
                        }
                    });

                    self.countVisibleAddresses();
                });
            });
        }
    }
}
</script>

