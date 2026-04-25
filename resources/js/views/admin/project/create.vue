<template>
  <v-container max-width="1400" class="mx-auto pa-6 pa-md-10">
    <v-card color="surface" class="border" elevation="2">
      <div class="d-flex align-center justify-space-between px-6 py-5 border-b">
        <h3 class="text-h5 font-weight-bold text-white">Upload New Project</h3>

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
              <v-text-field
                label="Project Name *"
                v-model="form.name"
                variant="outlined"
                required
                @input="generateSlug"
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Slug (Auto-generated) *"
                v-model="form.slug"
                variant="outlined"
                hint="URL friendly name"
                persistent-hint
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Live Demo URL"
                v-model="form.url"
                variant="outlined"
                prepend-inner-icon="mdi-link-variant"
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="GitHub Link"
                v-model="form.github_link"
                variant="outlined"
                prepend-inner-icon="mdi-github"
              />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field
                label="Framework (e.g. Laravel 11)"
                v-model="form.framework"
                variant="outlined"
              />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field
                label="Database (e.g. PostgreSQL)"
                v-model="form.database"
                variant="outlined"
              />
            </v-col>

            <v-col cols="12" md="4">
              <v-text-field
                label="Project Date"
                v-model="form.date"
                type="date"
                variant="outlined"
              />
            </v-col>

            <v-col cols="12">
              <v-combobox
                v-model="form.technologies"
                label="Technologies Used"
                multiple
                chips
                closable-chips
                variant="outlined"
                hint="Press Enter to add multiple tech (Vue, Tailwind, etc.)"
                persistent-hint
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Video Demo Link (YouTube/Vimeo)"
                v-model="form.video_link"
                variant="outlined"
                prepend-inner-icon="mdi-video-play-outline"
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-btn
                variant="outlined"
                color="primary"
                class="w-100 text-capitalize"
                height="56"
                @click="triggerUpload"
              >
                <v-icon start>mdi-image-plus</v-icon>
                {{ form.image ? 'Change Project Image' : 'Upload Project Image *' }}
              </v-btn>
              <v-file-input
                ref="projectImage"
                class="d-none"
                accept="image/*"
                @update:modelValue="onFileChange"
              />
            </v-col>

            <v-col cols="12" v-if="imageUrl" class="text-center">
              <v-img :src="imageUrl" max-height="250" class="rounded-lg border mx-auto" contain />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field label="Developed By" v-model="form.developed_by" variant="outlined" />
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field label="Author" v-model="form.author" variant="outlined" />
            </v-col>

            <v-col cols="12" class="mt-4">
              <label class="text-subtitle-1 text-white mb-2 d-block">Project Detailed Description</label>
              <QuillEditor
                v-if="isMounted"
                v-model:content="form.description"
                contentType="html"
                theme="snow"
                :options="editorOptions"
                class="quill-editor"
              />
            </v-col>

            <v-col cols="12" class="text-center mt-10">
              <v-btn
                type="submit"
                color="primary"
                size="x-large"
                class="font-weight-bold px-12 rounded-lg"
                :loading="loading"
                elevation="8"
              >
                <v-icon start>mdi-rocket-launch</v-icon>
                Publish Project
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
      editorOptions: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ header: [1, 2, 3, false] }],
            ['link', 'code-block', 'clean'],
          ]
        },
        placeholder: 'Write about your project architecture, challenges, and solutions...'
      },
      form: {
        name: 'test',
        slug: 'test',
        url: 'https://chatgpt.com',
        github_link: 'https://github.com/test',
        technologies: ['Vue.js', 'Laravel','HTML', 'CSS', 'JavaScript', 'Webpack','wordpress','react','angular','nodejs','expressjs','django','flask','springboot','ruby on rails','asp.net','flutter','react native','swift','kotlin'],
        framework: 'laravel',
        database: 'mysql',
        image: null,
        description: 'pending',
        video_link: '',
        date: new Date().toISOString().substr(0, 10),
        developed_by: 'Shakeeb',
        author: 'Shakeeb',
      }
    };
  },

  mounted() {
    this.isMounted = true;
  },

  methods: {
    generateSlug() {
      this.form.slug = this.form.name
        .toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
    },

    triggerUpload() {
      this.$refs.projectImage.click();
    },

    onFileChange(file) {
      if (!file) return;
      this.form.image = file;
      if (this.imageUrl) URL.revokeObjectURL(this.imageUrl);
      this.imageUrl = URL.createObjectURL(file);
    },

    async submitForm() {
      if (!this.form.name || !this.form.image) {
        this.$alertStore.add("Project name and image are required", "error");
        return;
      }

      this.loading = true;
      try {
        // Agar aapka model FormData handle karta hai to simple post karein
        await General.post("admin/projects", this.form);
        this.$alertStore.add("Project Uploaded Successfully!", "success");
        // this.$router.push('/admin/project');
      } catch (error) {
        this.$alertStore.add(error.message || "Failed to upload project", "error");
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
.border-b {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.quill-editor {
  min-height: 300px;
  background: #1e1e1e;
  color: white;
  border-radius: 0 0 8px 8px;
}

:deep(.ql-toolbar) {
  background: #eeeeee !important;
  border-radius: 8px 8px 0 0 !important;
}

:deep(.ql-container) {
  border-color: rgba(255, 255, 255, 0.1) !important;
}

:deep(.v-field__input) {
  font-size: 15px;
}
</style>