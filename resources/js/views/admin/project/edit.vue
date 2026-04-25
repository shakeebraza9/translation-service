<template>
  <v-container max-width="1400" class="mx-auto pa-6 pa-md-10">
    <v-card color="surface" class="border" elevation="2">
      <div class="d-flex align-center justify-space-between px-6 py-5 border-b">
        <h3 class="text-h5 font-weight-bold text-white">Edit Project: {{ form.name }}</h3>
        <v-btn
          variant="text"
          color="primary"
          class="text-capitalize font-weight-medium"
          to="/admin/project"
        >
          <v-icon start>mdi-arrow-left</v-icon>
          Back to Projects
        </v-btn>
      </div>

      <v-container fluid class="pa-8">
        <v-form @submit.prevent="submitForm" ref="form">
          <v-row density="comfortable">
            
            <v-col cols="12" md="6">
              <v-text-field label="Project Name *" v-model="form.name" variant="outlined" @input="generateSlug" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Slug *" v-model="form.slug" variant="outlined" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Live Demo URL" v-model="form.url" variant="outlined" prepend-inner-icon="mdi-link-variant" />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="GitHub Link" v-model="form.github_link" variant="outlined" prepend-inner-icon="mdi-github" />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field label="Framework" v-model="form.framework" variant="outlined" />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field label="Database" v-model="form.database" variant="outlined" />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field label="Project Date" v-model="form.date" type="date" variant="outlined" />
            </v-col>

            <v-col cols="12">
              <v-combobox
                v-model="form.technologies"
                label="Technologies Used"
                multiple
                chips
                closable-chips
                variant="outlined"
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Video Demo Link" v-model="form.video_link" variant="outlined" />
            </v-col>

            <v-col cols="12" md="6">
              <v-btn variant="outlined" color="primary" class="w-100 height-100" style="height: 72%;" @click="triggerUpload">
                <v-icon start>mdi-image-edit</v-icon>
                Change Image (Optional)
              </v-btn>
              <v-file-input ref="projectImage" class="d-none" accept="image/*" @update:modelValue="onFileChange" />
            </v-col>

            <v-col cols="12" v-if="imageUrl" class="text-center">
              <v-img :src="imageUrl" max-height="250" class="rounded-lg border mx-auto" contain />
              <p class="text-caption text-grey mt-2">New Preview</p>
            </v-col>
            <v-col cols="12" v-else-if="oldImageUrl" class="text-center">
              <v-img :src="oldImageUrl" max-height="250" class="rounded-lg border mx-auto" contain />
              <p class="text-caption text-grey mt-2">Current Image</p>
            </v-col>

            <v-col cols="12" class="mt-4">
              <label class="text-subtitle-1 text-white mb-2 d-block">Description</label>
              <QuillEditor
                v-if="isMounted"
                v-model:content="form.description"
                contentType="html"
                theme="snow"
                class="quill-editor"
              />
            </v-col>

            <v-col cols="12" class="text-center mt-10">
              <v-btn type="submit" color="primary" size="x-large" :loading="loading" class="px-12">
                <v-icon start>mdi-content-save</v-icon>
                Update Project
              </v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-container>
    </v-card>
  </v-container>
</template>

<script>
import General from '@/models/general.model';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  components: { QuillEditor },
  data() {
    return {
      isMounted: false,
      loading: false,
      imageUrl: null,
      oldImageUrl: null,
      form: {
        id: null,
        name: '',
        slug: '',
        url: '',
        github_link: '',
        technologies: [],
        framework: '',
        database: '',
        image: null,
        description: '',
        video_link: '',
        date: '',
        developed_by: 'Shakeeb',
        author: 'Shakeeb',
      }
    };
  },

  async mounted() {
    this.isMounted = true;
    await this.fetchProject();
  },

  methods: {
    async fetchProject() {
      const id = this.$route.params.id; 
      try {
        const response = await General.get(`admin/projects/${id}`);
        const data = response.data;
        
        // Form populate karein
        this.form = {
          ...this.form,
          id: data.id,
          name: data.name,
          slug: data.slug,
          url: data.url,
          github_link: data.github_link,
          technologies: typeof data.technologies === 'string' ? data.technologies.split(',') : data.technologies,
          framework: data.framework,
          database: data.database,
          description: data.description,
          video_link: data.video_link,
          date: data.date,
     
        };
        this.oldImageUrl = data.image_url; 
      } catch (error) {
        this.$alertStore.add("Could not load project data", "error");
      }
    },

    generateSlug() {
      this.form.slug = this.form.name.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
    },

    triggerUpload() {
      this.$refs.projectImage.click();
    },

    onFileChange(file) {
      if (!file) return;
      const selectedFile = Array.isArray(file) ? file[0] : file;
      this.form.image = selectedFile;
      if (this.imageUrl) URL.revokeObjectURL(this.imageUrl);
      this.imageUrl = URL.createObjectURL(selectedFile);
    },

async submitForm() {
  this.loading = true;
  try {

    const payload = {
      ...this.form,
      _method: 'PUT', // Laravel spoofing
      technologies: Array.isArray(this.form.technologies) 
        ? this.form.technologies.join(',') 
        : this.form.technologies
    };

    if (!(this.form.image instanceof File)) {
      delete payload.image;
    }


    console.log("Sending Direct Payload Object:", payload);


    await General.post(`admin/projects/${this.form.id}`, payload, {
      headers: { 
        'Content-Type': 'multipart/form-data' 
      }
    });

    this.$alertStore.add("Project Updated Successfully!", "success");
    this.$router.push('/admin/projects');

  } catch (error) {
    console.error("Update Error:", error);
    const msg = error.response?.data?.message || "Failed to update project";
    this.$alertStore.add(msg, "error");
  } finally {
    this.loading = false;
  }
}
  },

  beforeUnmount() {
    if (this.imageUrl) URL.revokeObjectURL(this.imageUrl);
  }
};
</script>

<style scoped>
.border-b { border-bottom: 1px solid rgba(255, 255, 255, 0.08); }
.quill-editor { min-height: 300px; background: white; color: black; border-radius: 0 0 8px 8px; }
:deep(.ql-toolbar) { background: #eeeeee !important; border-radius: 8px 8px 0 0 !important; }


</style>