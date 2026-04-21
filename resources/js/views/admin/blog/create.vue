<template>
  <v-container max-width="1400" class="mx-auto pa-6 pa-md-10">
    <v-card color="surface" class="border" elevation="2">
      <div class="d-flex align-center justify-space-between px-6 py-5 border-b">
        <h3 class="text-h5 font-weight-bold text-white">Create New Blog Post</h3>

        <v-btn
          variant="text"
          color="primary"
          class="text-capitalize font-weight-medium"
          to="/admin/blog"
        >
          <v-icon start>mdi-arrow-left</v-icon>
          Back to Blogs
        </v-btn>
      </div>

      <v-container fluid class="pa-8">
        <v-form @submit.prevent="submitForm" ref="form">
          <v-row density="compact">
            
            <v-col cols="12" md="6">
              <Blogcategory
                label="Category"
                v-model="form.category_id"
                type="blog"
                variant="outlined"
                density="comfortable"
                hide-details
                clearable
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Blog Title *"
                v-model="form.title"
                variant="outlined"
                density="comfortable"
                hide-details
                clearable
                required
              />
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field
                label="Publish Date"
                v-model="form.date"
                type="date"
                variant="outlined"
                density="comfortable"
                hide-details
              />
            </v-col>

            <v-col cols="12" md="6">

              <v-btn
                variant="outlined"
                color="primary"
                class="w-100 text-capitalize"
                height="48"
                @click="uploadImage"
              >
                <v-icon start>mdi-upload</v-icon>
                Upload Featured Image
              </v-btn>

              <v-file-input
                ref="uploadInput"
                accept="image/*"
                @update:modelValue="handleFileChange"
                class="d-none"
              />
            </v-col>

            <v-col cols="12" v-if="imageUrl" class="text-center py-4">
              <v-card class="d-inline-block pa-2" color="grey-darken-4" flat border>
                <v-img
                  :src="imageUrl"
                  max-width="280"
                  max-height="180"
                  cover
                  class="rounded-lg"
                />
              </v-card>
            </v-col>

            <v-col cols="12" class="mt-4">
              <label class="text-caption text-grey-lighten-1 font-weight-medium d-block mb-2">
                Blog Content
              </label>
                    <v-col cols="12" class="mt-4">
                    <v-textarea
                        label="Blog Description"
                        v-model="form.description"
                        variant="outlined"
                        rows="8"
                        auto-grow
                        counter
                        clearable
                    />
                    </v-col>
            </v-col>

            <v-col cols="12" class="mt-6">
              <BlogSections v-model="form.sections" />
            </v-col>

            <v-col cols="12" class="text-center mt-8">
              <v-btn
                type="submit"
                color="primary"
                size="large"
                class="font-weight-bold px-12 text-capitalize"
                :loading="loading"
                height="52"
                elevation="4"
              >
                <v-icon start>mdi-content-save</v-icon>
                Create Blog Post
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
import Blogcategory from '@/components/blogcategory.vue';
import BlogSections from './BlogSections.vue';

export default {
  components: {
    Blogcategory,
    BlogSections
  },

  data() {
    return {
      isMounted: false, // For Quill initialization safety
      imageUrl: null,
      loading: false,

      editorOptions: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['link', 'image', 'video'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ header: [1, 2, 3, false] }],
            [{ align: [] }],
            ['clean']
          ]
        }
      },

      form: {
        category_id: null,
        title: '',
        description: '',
        date: new Date().toISOString().substr(0, 10), // Set default today date
        image: null,
        sections: [],
      }
    };
  },

mounted() {
  this.$nextTick(() => {
    setTimeout(() => {
      this.isMounted = true;
    }, 0);
  });

},

  methods: {
    uploadImage() {
      // In Vuetify 3, accessing the internal input via ref is clean
      this.$refs.uploadInput.click();
    },

    handleFileChange(file) {
      if (!file) return;
      this.form.image = file;

      if (this.imageUrl) {
        URL.revokeObjectURL(this.imageUrl);
      }
      this.imageUrl = URL.createObjectURL(file);
    },

    async submitForm() {


      this.loading = true;
      try {
        await General.post("admin/blog", this.form);
        this.$alertStore.add("Blog Created Successfully!", "success");
        this.$router.push('/admin/blog');
      } catch (error) {
        this.$alertStore.add(error.message || "Failed to create blog", "error");
      } finally {
        this.loading = false;
      }
    }
  },

  beforeUnmount() {
    if (this.imageUrl) {
      URL.revokeObjectURL(this.imageUrl);
    }
  }
};
</script>

<style scoped>
.border-b {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

/* Quill Styling for Dark Mode */
.quill-editor :deep(.ql-container) {
  min-height: 380px;
  font-size: 16px;
  background: #1e1e1e;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  border-color: rgba(255, 255, 255, 0.1);
}

.quill-editor :deep(.ql-editor) {
  min-height: 380px;
  color: #e0e0e0;
}

.quill-editor :deep(.ql-toolbar) {
  background: #f5f5f5; /* Light toolbar for better icon visibility */
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}
</style>