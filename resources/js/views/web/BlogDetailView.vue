<template>
  <v-container v-if="blog" id="blog" fluid class="py-16 bg-background position-relative min-vh-100">
    <v-btn
      variant="text"
      color="primary"
      prepend-icon="mdi-arrow-left"
      class="mb-8"
      @click="$router.back()"
    >
      Back to Articles
    </v-btn>

    <v-row justify="center">
      <v-col cols="12" lg="9" md="10">
        <div class="mb-10 text-center">
          <v-chip color="primary" variant="flat" size="small" class="mb-4">
            {{ blog.category?.title }}
          </v-chip>
          <h1 class="text-h3 font-weight-black text-white mb-6 leading-tight">
            {{ blog.title }}
          </h1>
          
          <div class="d-flex align-center justify-center">
            <v-avatar size="40" class="mr-3" border="border">
              <v-img src="https://via.placeholder.com/40" alt="Author"></v-img>
            </v-avatar>
            <div class="text-left">
              <div class="text-subtitle-2 text-white font-weight-bold">{{ blog.author?.name }}</div>
              <div class="text-caption text-light_text_on">{{ formatDate(blog.date) }} • 5 min read</div>
            </div>
          </div>
        </div>

        <v-img
          :src="blog.image_preview"
          class="rounded-xl mb-12 shadow-lg"
          aspect-ratio="16/9"
          cover
        ></v-img>

        <div class="blog-content text-body-1 text-light_text_on mb-16">
          <div v-html="blog.description"></div>
        </div>

        <div v-if="blog.details && blog.details.length > 0" class="additional-sections">
          <v-divider class="mb-12 border-opacity-25" color="primary"></v-divider>
          
          <div v-for="section in blog.details" :key="section.id" class="mb-12">
            <h2 class="text-h4 font-weight-bold text-white mb-4">
              {{ section.title }}
            </h2>
            
            <v-row :dir="section.alignment === 'right' ? 'rtl' : 'ltr'" align="center">
              <v-col cols="12" :md="section.preview_image ? '7' : '12'">
                <p class="text-body-1 text-light_text_on white-space-pre-line">
                  {{ section.description }}
                </p>
              </v-col>
              <v-col v-if="section.preview_image" cols="12" md="5">
                <v-img :src="section.preview_image" class="rounded-lg shadow-md"></v-img>
              </v-col>
            </v-row>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>

  <v-container v-else class="fill-height justify-center align-center">
    <v-progress-circular indeterminate color="primary" size="64"></v-progress-circular>
  </v-container>
</template>

<script>
import General from '@/models/general.model';

export default {
  data() {
    return {
      loading: false,
      blog: null,
    }
  },
  methods: {
    async fetchBlogDetail() {
      this.loading = true;
      const slug = this.$route.params.slug; // URL se slug lena
      try {
        // Aapki di hui API URL structure ke mutabiq
        const response = await General.get(`blogs/${slug}`);
        
        if (response.status) {
          this.blog = response.data;
        }
      } catch (error) {
        console.error("Blog fetching error:", error);
        if (this.$alertStore) {
          this.$alertStore.add('Could not load blog post', 'error');
        }
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return '';
      return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    }
  },
  async mounted() {
    // Settings load ho rahi hain toh thik hai
    if (this.globalStore?.loadSettings) {
      await this.globalStore.loadSettings();
    }
    // Blog load karne ke liye call
    await this.fetchBlogDetail();
  }
}
</script>


<style scoped>
.blog-content :deep(p) {
  margin-bottom: 1.5rem;
  line-height: 1.8;
}

.white-space-pre-line {
  white-space: pre-line;
}

.leading-tight {
  line-height: 1.2 !important;
}

.shadow-lg {
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
}
:deep(.blog-content) {
  color: #b0b0b0;
}

:deep(.blog-content h2, .blog-content h3) {
  color: white;
  margin-top: 2rem;
  margin-bottom: 1rem;
}
</style>