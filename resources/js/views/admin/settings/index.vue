<template>
  <user-title-bar title="Global Settings" />
  
  <v-container fluid class="pa-4" max-width="1400px">
    <v-row no-gutters>
      <v-col cols="12" md="3" class="bg-surface border-e">
        <v-tabs v-model="tab" direction="vertical" color="primary">
          <v-tab value="profile">
            <v-icon start>mdi-application-cog</v-icon>
            Site Information
          </v-tab>
          <v-tab value="personal">
            <v-icon start>mdi-account-details</v-icon>
            Personal Details
          </v-tab>
        </v-tabs>
      </v-col>

      <v-col cols="12" md="9" class="pa-8 bg-surface">
        <v-window v-model="tab">
          
          <v-window-item value="profile">
            <h2 class="text-h5 mb-6">Website & Social Links</h2>
            <v-row density="compact">
              <v-col cols="12" md="6">
                <v-text-field label="Website Name" v-model="form.website_name" variant="outlined" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Admin Email" v-model="form.admin_mail" variant="outlined" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Github URL" v-model="form.github" variant="outlined" prepend-inner-icon="mdi-github" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="LinkedIn URL" v-model="form.linkdin" variant="outlined" prepend-inner-icon="mdi-linkedin" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Facebook URL" v-model="form.facebook" variant="outlined" prepend-inner-icon="mdi-facebook" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="WhatsApp Number" v-model="form.whatsaap" variant="outlined" prepend-inner-icon="mdi-whatsapp" />
              </v-col>
              <v-col cols="12">
                <v-text-field label="Location" v-model="form.Location" variant="outlined" prepend-inner-icon="mdi-map-marker" />
              </v-col>
            </v-row>
          </v-window-item>

          <v-window-item value="personal">
            <h2 class="text-h5 mb-6">Professional Details</h2>
            <v-row density="compact">
              <v-col cols="12" md="6">
                <v-text-field label="Full Name" v-model="form.name" variant="outlined" />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field label="Tech Stack Title" v-model="form.stack" variant="outlined" />
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Years of Experience" v-model="form.exp_year" type="number" variant="outlined" />
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Projects Done" v-model="form.project_done" type="number" variant="outlined" />
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Contact Number" v-model="form.contact" variant="outlined" />
              </v-col>
              <v-col cols="12">
                <v-text-field label="Skills (Comma Separated)" v-model="form.skills" variant="outlined" hint="Laravel, Vue.js, Python..." persistent-hint />
              </v-col>
              <v-col cols="12">
                <v-textarea label="Short Experience Brief" v-model="form.exp" variant="outlined" rows="2" />
              </v-col>
              <v-col cols="12">
                <v-textarea label="Short Description" v-model="form.dsc" variant="outlined" rows="2" />
              </v-col>
              <v-col cols="12">
                <v-textarea label="Detailed About Me" v-model="form.detail_dsc" variant="outlined" rows="4" />
              </v-col>
            </v-row>
          </v-window-item>

        </v-window>

        <v-row class="mt-8">
          <v-col cols="12" class="text-right">
            <v-btn color="primary" size="large" :loading="loading" @click="saveSettings" prepend-icon="mdi-check-decagram">
              Update All Settings
            </v-btn>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import General from '@/models/general.model';

export default {
  data: () => ({
    tab: 'profile',
    loading: false,
    form: {
      website_name: '',
      name: '',
      exp: '',
      dsc: '',
      contact: '',
      exp_year: '',
      project_done: '',
      skills: '',
      github: '',
      facebook: '',
      linkdin: '',
      whatsaap: '',
      admin_mail: '',
      Location: '',
      detail_dsc: '',
      stack: '',
      email: ''
    },
  }),
  mounted() {
    this.loadData();
  },
  methods: {
    async loadData() {
      this.loading = true;
      try {
        let res = await General.get("/admin/settings");
        const data = res.data.data ?? res.data;
        
        // Loop through the array and map key-value pairs to the form object
        data.forEach(item => {
          if (item.key in this.form) {
            this.form[item.key] = item.value;
          } else {
            // Agar koi nai key aati hai jo form me predefined nahi hai
            this.form[item.key] = item.value;
          }
        });
      } catch (error) {
        this.$alertStore?.add("Failed to fetch settings", "error");
      } finally {
        this.loading = false;
      }
    },
    async saveSettings() {
      this.loading = true;
      try {
        const res = await General.post("/admin/settings", this.form);
        this.$alertStore.add(res.message || 'Settings Saved Successfully', 'success');
      } catch (error) {
        this.$alertStore.add(error.message || 'Settings Save Failed', 'error');
      } finally {
        this.loading = false;
      }
    }
  },
};
</script>