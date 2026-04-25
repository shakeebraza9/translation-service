<template>
  <v-container max-width="1400" class="mx-auto pa-6 pa-md-10">
    <v-card color="surface" class="border">
      <div class="d-flex align-center justify-space-between px-6 py-5 border-b">
        <h3 class="text-h5 font-weight-bold text-white">Project Gallery</h3>
        <v-btn color="primary" prepend-icon="mdi-plus" @click="dialog = true">
          Add Gallery Image
        </v-btn>
      </div>

      <v-row class="pa-6">
        <v-col v-for="item in gallery" :key="item.id" cols="12" sm="6" md="4" lg="3">
          <v-card class="border overflow-hidden" elevation="0">
            <v-img :src="item.image" height="200" cover class="bg-grey-darken-4">
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular indeterminate color="grey-lighten-5"></v-progress-circular>
                </v-row>
              </template>
            </v-img>
            <v-card-title class="text-subtitle-1 py-2 d-flex justify-space-between align-center">
              {{ item.title }}
              <v-btn icon="mdi-delete" size="small" color="error" variant="text" @click="deleteImage(item.id)"></v-btn>
            </v-card-title>
          </v-card>
        </v-col>
        
        <v-col cols="12" v-if="gallery.length === 0" class="text-center py-10">
          <v-icon size="64" color="grey">mdi-image-multiple-outline</v-icon>
          <p class="text-grey mt-2">No images in gallery yet.</p>
        </v-col>
      </v-row>
    </v-card>

    <v-dialog v-model="dialog" max-width="500">
      <v-card title="Upload Gallery Image">
        <v-card-text>
          <v-text-field
            label="Image Title"
            v-model="uploadForm.title"
            variant="outlined"
            placeholder="e.g. Home Page, Dashboard"
          />
          <v-file-input
            label="Select Image"
            v-model="uploadForm.file"
            accept="image/*"
            variant="outlined"
            prepend-icon="mdi-camera"
            @update:modelValue="previewImage"
          />
          <v-img v-if="imagePreview" :src="imagePreview" class="mt-2 rounded border" max-height="200" contain />
        </v-card-text>
        <v-card-actions class="pa-4">
          <v-spacer />
          <v-btn variant="text" @click="closeDialog">Cancel</v-btn>
          <v-btn color="primary" :loading="uploading" :disabled="!uploadForm.file" @click="uploadImage">
            Upload Now
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      gallery: [],
      dialog: false,
      uploading: false,
      imagePreview: null,
      projectId: this.$route.params.id, // URL se project ID
      uploadForm: {
        project_id: this.$route.params.id,
        title: '',
        file: null,
      }
    };
  },

  mounted() {
    this.fetchGallery();
  },

  methods: {
    async fetchGallery() {
      try {
        const response = await General.get(`admin/project-gallery/${this.projectId}`);
        this.gallery = response.data.data ?? response.data;
      } catch (error) {
        this.$alertStore?.add("Failed to load gallery", "error");
      }
    },

    previewImage(file) {
      if (!file) {
        this.imagePreview = null;
        return;
      }
      this.imagePreview = URL.createObjectURL(Array.isArray(file) ? file[0] : file);
    },

    closeDialog() {
      this.dialog = false;
      this.uploadForm = { title: '', file: null };
      this.imagePreview = null;
    },

    async uploadImage() {
      this.uploading = true;
      try {


        await General.post('admin/project-gallery', this.uploadForm, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        this.$alertStore?.add("Image uploaded successfully!", "success");
        this.closeDialog();
        this.fetchGallery(); // Refresh list
      } catch (error) {
        this.$alertStore?.add("Upload failed", "error");
      } finally {
        this.uploading = false;
      }
    },

    async deleteImage(id) {
      if (!confirm("Are you sure you want to delete this image?")) return;
      try {
        await General.delete(`admin/project-gallery/${id}`);
        this.gallery = this.gallery.filter(item => item.id !== id);
        this.$alertStore?.add("Image deleted", "success");
      } catch (error) {
        this.$alertStore?.add("Delete failed", "error");
      }
    }
  }
};
</script>

<style scoped>
.border-b { border-bottom: 1px solid rgba(255, 255, 255, 0.12); }
</style>